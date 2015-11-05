<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/9
     * Time: 10:25
     */

    namespace api\controller;

    use api\core\BaseApi;
    use api\libs\Error;
    use common\Account;
    use common\Event;
    use common\EventDispatcher;
    use common\GameSession;
    use common\ItemsManager;
    use common\model\UserModel;
    use common\Platform;
    use common\Response;
    use common\Sms;
    use libs\badwords\BadWords;
    use utils\Arrays;
    use utils\Strings;
    use utils\Tools;

    class Register extends BaseApi
    {

        function originSms()
        {
            $mobile = $this->input->post( 'mobile' );
            if ( !Strings::is_mobile( $mobile ) )
                Response::instance()->say( Error::REGISTER_MOBILE_FORMAT_ERROR );

            $user = UserModel::instance()->getUserByMobile( $mobile , array( 'user_id' ) );
            if ( !empty( $user['user_id'] ) )
                Response::instance()->say( \common\Error::USER_IS_EXSIT );

            //发送短信验证码
            $sms = Sms::instance();
            $key = 'sms:register:' . $mobile;
            $smscode = $sms->createSmsCode( $key );
            $content = "验证码：{$smscode}，若非本人操作，请忽略本短信。";

            if ( !$sms->send( $mobile , $content ) )
                Response::instance()->say( Error::REGISTER_SMS_SEND_ERROR );

            $data = array( 'smscode' => $smscode );
            Response::instance()->success( $data );
        }

        function originValid()
        {
            $smscode = $this->input->post( 'smscode' );
            $mobile = $this->input->post( 'mobile' );
            if ( !Strings::is_mobile( $mobile ) )
                Response::instance()->say( Error::REGISTER_MOBILE_FORMAT_ERROR );

            $user = UserModel::instance()->getUserByMobile( $mobile , array( 'user_id' ) );
            if ( !empty( $user['user_id'] ) )
                Response::instance()->say( \common\Error::USER_IS_EXSIT );

            $key = 'sms:register:' . $mobile;
            $result = Sms::instance()->validSmsCode( $key , $smscode );
            if ( $result == 1 )
                Response::instance()->say( Error::REGISTER_SMS_CODE_EXPIRED );
            else if ( result == 2 )
                Response::instance()->say( Error::REGISTER_SMS_CODE_ERROR );

            Response::instance()->success();
        }

        function originDone()
        {
            $sign = $this->input->post( 'sign' );
            $time = $this->input->post( 'time' );
            $password = $this->input->post( 'password' );
            $nickname = $this->input->post( 'nickname' );
            $gender = $this->input->post( 'gender' );
            $mobile = $this->input->post( 'mobile' );
            $pt =$this->input->post('pt');
            if(empty($pt))
                $pt = Platform::CLIENT_ORIGIN_MOBILE_PLATFORM;

            $mysign = md5( $time . $mobile . $nickname . $gender . $this->config->api['sign_secret_key'] );

            if ( !Strings::is_mobile( $mobile ) )
                Response::instance()->say( Error::REGISTER_MOBILE_FORMAT_ERROR );

            $userModel = UserModel::instance();
            $user = $userModel->getUserByMobile( $mobile , array( 'user_id' ) );
            if ( !empty( $user['user_id'] ) )
                Response::instance()->say( \common\Error::USER_IS_EXSIT );

            if ( strcmp( $sign , $mysign ) !== 0 )
                Response::instance()->say( \common\Error::SIGN_ERROR );

            //开始注册流程
            if ( Strings::strlen_ex( $nickname ) < 3 || Strings::strlen_ex( $nickname ) > 8 )
                Response::instance()->say( \common\Error::FORM_STRING_FORMAT_ERROR );

            if ( $userModel->isNickNameExsit( $nickname ) )
                Response::instance()->say( \common\Error::NICKNAME_EXSIT );

            if ( !BadWords::instance()->checkBadWords( $nickname ) || !BadWords::instance()->checkBadUserName( $nickname ) )
                Response::instance()->say( \common\Error::FORM_STRING_FORBBIDEN );

            if ( strlen( $password ) != 32 )
                Response::instance()->say( \common\Error::FORM_STRING_FORMAT_ERROR );

            $login_name = 'M' . $mobile;
            if ( UserModel::instance()->getUserByLoginName( $login_name ) )
                Response::instance()->say( \common\Error::LOGINNAME_EXSIT );

            $user_number = $userModel->getMaxUserNumber() + 1;

            try {
                $this->db->begin();

                $fields = array(
                    'user_number'   => $user_number ,
                    'login_name'    => $login_name ,
                    'password'      => Account::instance()->makePassword( $password , $user_number ) ,
                    'nickname'      => $nickname ,
                    'regist_time'   => date( 'YmdHis' ) ,
                    'register_type' => $pt ,
                    'gender'        => $gender ,
                    'mobile'        => $mobile,
                    'items'    => '10000,10001',
                    'items_num' => '0,0'
                );

                if ( !$this->db->save( $fields , 'xf_user' ) )
                    throw new \Exception( \common\Error::DB_INSERT_ERROR );
                $user_id = $this->db->insert_id();

                $fields2 = array(
                    'user_id'           => $user_id ,
                    'purchase_password' => '' ,
                    'confirmation_key'  => ''
                );

                if ( !$this->db->save( $fields2 , 'xf_purchaseprofile' ) )
                    throw new \Exception( \common\Error::DB_INSERT_ERROR );

                $fields3 = array(
                    'uid' => $user_id,
                    'auth_type' => Account::USER_AUTH_SMS,
                    'auth_time' => time(),
                );
                if(!$this->db->save($fields3,'xf_user_auth'))
                    throw new \Exception( \common\Error::DB_INSERT_ERROR );

                $this->db->commit();

                //发送统计数据
                $data = array(
                    'user_id'     => $user_id ,
                    'platform_id' => $pt
                );
                @EventDispatcher::instance()->dispatch( Event::DO_AFTER_REGISTER , $data );

                //返回数据给客户端
                unset( $fields['password'] , $fields['regist_time'] );
                $fields['diamond'] = 0;
                $fields['user_id'] = $user_id;
                $fields['items'] = ItemsManager::instance()->format($fields['items'],$fields['items_num']);
                unset($fields['items_num']);
                $fields['items'] = Arrays::std_array_format($fields['items']);

                GameSession::instance()->clean($user_id);
                $fields['sessionid'] = GameSession::instance()->create($fields);
                $responseData = Arrays::std_array_format( $fields );
                Response::instance()->success( $responseData );
            } catch (\Exception $e) {
                $this->db->rollback();
                Tools::debug_log( __CLASS__ , __FUNCTION__ , $e->getMessage() , $e );
            }
        }

        function originQuick()
        {
            //签名验证
            $sign = $this->input->post('sign');
            $time = $this->input->post('time');
            $pt =$this->input->post('pt');
            if(empty($pt))
                $pt = Platform::CLIENT_ORIGIN_MOBILE_PLATFORM;
            $mysign = md5($time.$this->config->api['sign_secret_key']);
            if(strcmp($sign,$mysign) !== 0)
                Response::instance()->say(\common\Error::SIGN_ERROR);
            $rand = Strings::make_rand_str(8);
            $fields['login_name'] = 'quickpt_' .$rand;
            $nickname = Account::instance()->randomName();
            while ( UserModel::instance()->isNickNameExsit( $nickname ) ) {
                $nickname = Account::instance()->randomName();
                usleep( 10 );
            }
            $fields['nickname'] = $nickname;
            $fields['regist_time'] = date( 'YmdHis' );
            $fields['register_type'] = $pt;
            $fields['user_number'] = UserModel::instance()->getMaxUserNumber() + 1;
            $password = $rand;
            $fields['password'] =  Account::instance()->makePassword(md5($password),$fields['user_number']);
            $fields['items']    = '10000,10001';
            $fields['items_num'] = '0,0';

            try {
                $this->db->begin();

                if ( !$this->db->save( $fields , 'xf_user' ) )
                    throw new \Exception( \common\Error::DB_INSERT_ERROR );
                $user_id = $this->db->insert_id();

                $fields2 = array(
                    'user_id'           => $user_id ,
                    'purchase_password' => '' ,
                    'confirmation_key'  => ''
                );

                if ( !$this->db->save( $fields2 , 'xf_purchaseprofile' ) )
                    throw new \Exception( \common\Error::DB_INSERT_ERROR );

                $this->db->commit();

                //发送统计数据
                $data = array(
                    'user_id'     => $user_id ,
                    'platform_id' => $pt
                );
                @EventDispatcher::instance()->dispatch( Event::DO_AFTER_REGISTER , $data );

                //返回数据给客户端
                unset( $fields['password'] , $fields['regist_time'] );
                $fields['chip'] = 0;
                $fields['diamond'] = 0;
                $fields['user_id'] = $user_id;
                $fields['password'] = $password;
                $fields['items'] = ItemsManager::instance()->format($fields['items'],$fields['items_num']);
                unset($fields['items_num']);
                $fields['items'] = Arrays::std_array_format($fields['items']);

                GameSession::instance()->clean($user_id);
                $fields['sessionid'] = GameSession::instance()->create($fields);
                $responseData = Arrays::std_array_format( $fields );
                Response::instance()->success( $responseData );
            } catch (\Exception $e) {
                $this->db->rollback();
                Tools::debug_log( __CLASS__ , __FUNCTION__ , $e->getMessage() , $e );
            }
        }

        function randName()
        {
                //签名验证
            $sign = $this->input->post( 'sign' );
            $time = $this->input->post( 'time' );
            $mysign = md5( $time . $this->config->api['sign_secret_key'] );
            if ( strcmp( $sign , $mysign ) !== 0 )
                Response::instance()->say( \common\Error::SIGN_ERROR );

            $nickname = Account::instance()->randomName();
            while ( UserModel::instance()->isNickNameExsit( $nickname ) ) {
                $nickname = Account::instance()->randomName();
                usleep( 10 );
            }

            $response = array('nickname' => $nickname);
            Response::instance()->success($response);
        }
    }