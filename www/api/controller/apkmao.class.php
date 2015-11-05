<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/8
     * Time: 下午3:53
     */

    namespace api\controller;


    use api\core\Baseapi;
    use api\libs\Error;
    use common\model\GameAreaModel;
    use common\model\PaymentOrder;
    use common\model\PurchaseProfileModel;
    use common\model\UserModel;
    use common\Platform;
    use core\DB;
    use gamefactory\GameFactory;
    use libs\badwords\BadWords;
    use libs\payment\AlipayNotify;
    use libs\payment\PayAliPay;
    use utils\Arrays;
    use utils\Strings;
    use utils\Tools;
    use web\libs\DataUtil;
    use web\libs\UserUtil;

    /**
     * 应用猫接入
     * Class Apkmao
     * @package api\controller
     */
    class Apkmao extends Baseapi
    {

        /**
         * 用户登陆
         */
        function login()
        {
            $third_login_name = $this->input->post( 'third_login_name' );
            //MD5后的密码
            $third_password = $this->input->post( 'third_password' );

            //检测登陆用户名是否正确
            $user = UserModel::instance()->getUserByLoginName( $third_login_name );
            if ( false == $user ) {//如果用户名不存在 则尝试用手机号登录
                $user = UserModel::instance()->getUserByMobile( $third_login_name );
                if ( false == $user ) {//如果手机号登录失败 则尝试用邮箱登录
                    $user = UserModel::instance()->getUserByMail( $third_login_name );
                    if ( false == $user )
                        $this->response( null , Error::USER_NOT_EXSIT );
                    else {
                        //判断邮箱是否认证过
                        $auth = UserUtil::instance()->get_auth( $user['user_id'] );
                        if ( !$auth[ UserUtil::USER_AUTH_MAIL ] )
                            $this->response( null , Error::USER_NOT_EXSIT );
                    }
                } else {
                    //判断手机号是否认证过
                    $auth = UserUtil::instance()->get_auth( $user['user_id'] );
                    if ( !$auth[ UserUtil::USER_AUTH_SMS ] )
                        $this->response( null , Error::USER_NOT_EXSIT );
                }
            }

            if ( !UserUtil::instance()->is_password_valid( $third_password , $user['password'] , $user['user_number'] ) )
                $this->response( null , Error::PASSWORD_INVALID );

            $game_id = empty( $_POST['game_id'] ) ? 1 : $this->input->post( 'game_id' );
            $area_id = empty( $_POST['area_id'] ) ? 1 : $this->input->post( 'area_id' );
            //TODO 读取游戏分区
            DataUtil::instance()->doAfterLogin( Platform::CLIENT_APKMAO , $user , $game_id );
            $expire_time = $this->config->common['cookie']['timeout'];
            $session_key = UserUtil::instance()->createSessionId( $expire_time , $user , $area_id , $game_id );
            $response = array(
                'session_name' => 'sessionid' ,
                'session_key'  => $session_key ,
                'user_number'  => $user['user_number'] ,
                'uid'          => $user['user_id'] ,
                'resource_uri' => '/user/info'
            );
            $response = Arrays::std_array_format( $response );
            $this->response( $response , 0 , false );
        }

        /**
         * 用户注册
         */
        function  register()
        {
            $quick_register = $this->args[0];
            $userModel = UserModel::instance();
            $user_number = $userModel->getMaxUserNumber() + 1;
            if ( $quick_register == 'quickmao' ) {//快速注册
                $login_name = 'quickmao' . uniqid();
                $nickname = UserUtil::instance()->randomName();
                while ( 1 ) {
                    if ( !UserModel::instance()->isNickNameExsit( $nickname ) )
                        break;
                    $nickname = UserUtil::instance()->randomName();
                }
                $source_password = UserUtil::instance()->makeSourcePasswordByLoginName( $login_name , 8 );
                $password = UserUtil::instance()->makePasswordAuto( $source_password , $user_number );
                $isrobot = 0;
                $register_time = intval( date( 'YmdHis' ) );
                $gender = 0;
                $area = 1;

            } else {//正常注册
                $login_name = $this->input->post( 'login_name' );
                $nickname = $this->input->post( 'nickname' );
                $password = $this->input->post( 'password' );
                $password1 = $this->input->post( 'password1' );
                $isrobot = 0;
                $register_time = intval( date( 'YmdHis' ) );
                $gender = $this->input->post( 'gender' );
                $area = $this->input->post( 'area' );

                $error = 0;
                if ( UserModel::instance()->getUserByLoginName( $login_name ) )
                    $this->response( array( 'login_name' ) , Error::FIELD_VALUE_ALREALLY_EXSITS );
                $error_field = array();
                if ( strlen( $login_name ) < 4 || strlen( $login_name ) > 16 ) {
                    $error = Error::FORM_STRING_FORMAT;
                    $error_field['login_name'] = $login_name;
                }

                if ( Strings::strlen_ex( $nickname ) < 3 || Strings::strlen_ex( $nickname ) > 8 ) {
                    $error = Error::FORM_STRING_FORMAT;
                    $error_field['nickname'] = $nickname;
                }

                if ( $userModel->isNickNameExsit( $nickname ) || !BadWords::instance()->checkBadWords( $nickname ) || !BadWords::instance()->checkBadUserName( $nickname ) ) {
                    $error = Error::FORM_STRING_FORMAT;
                    $error_field['nickname'] = $nickname;
                }

                if ( strlen( $password ) != 32 ) {//已转为MD5
                    $error = Error::FORM_STRING_FORMAT;
                    $error_field['password'] = $password;
                }

                if ( $password != $password1 ) {
                    $error = Error::FORM_STRING_FORMAT;
                    $error_field['password1'] = $password1;
                }

                if ( $error == Error::FORM_STRING_FORMAT )
                    $this->response( $error_field , $error );

                $password = UserUtil::instance()->makePassword( $password , $user_number );
            }

            /*users**/
            $fields1 = array(
                'login_name'    => $login_name ,
                'nickname'      => $nickname ,
                'password'      => $password ,
                'user_number'   => $user_number ,
                'regist_time'   => $register_time ,
                'is_robot'      => $isrobot ,
                'forbidden'     => 0 ,
                'gender'        => $gender ,
                'area'          => $area ,
                'register_type' => Platform::CLIENT_APKMAO
            );

            $game_id = empty( $_POST['game_id'] ) ? 1 : $this->input->post( 'game_id' );
            $area_id = empty( $_POST['area_id'] ) ? 1 : $this->input->post( 'area_id' );
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDb = new DB();
            $gameDb->init_db( $server );
            $gameFunc = GameFactory::invoke( $game_id , $gameDb );

            try {
                $this->db->begin();
                $gameDb->begin();
                /*写入user**/
                if ( !$userModel->saveUser( $fields1 ) )
                    throw new \Exception( Error::DATA_WRITE_ERROR );
                $uid = $this->db->insert_id();

                $fields2 = array(
                    'user_id'           => $uid ,
                    'purchase_password' => '' ,
                    'confirmation_key'  => ''
                );

                if ( !PurchaseProfileModel::instance()->saveProfile( $fields2 ) )
                    throw new \Exception ( Error::DATA_WRITE_ERROR );

                $gameFunc->initProfile( $uid );

                $this->db->commit();
                $gameDb->commit();
            } catch (\Exception $e) {
                $this->db->rollback();
                $gameDb->rollback();
                $this->response( null , $e->getMessage() );
            }

            DataUtil::instance()->doAfterRegister( Platform::CLIENT_APKMAO , $uid , $game_id , $area_id );
            $expire_time = $this->config->common['cookie']['timeout'];
            $user = array( 'login_name' => $login_name , 'user_number' => $user_number , 'user_id' => $uid );
            $session_key = UserUtil::instance()->createSessionId( $expire_time , $user , $area_id , $game_id );

            $response = array(
                'session_name' => 'sessionid' ,
                'session_key'  => $session_key ,
                'user_number'  => $user_number ,
                'uid'          => $user['user_id'] ,
                'resource_uri' => '/user/info'
            );

            if ( $quick_register == 'quickmao' ) {
                $response['login_name'] = $login_name;
                $response['password'] = $source_password;
            }

            $response = Arrays::std_array_format( $response );
            $this->response( $response , 0 , false );
        }

        /**
         * 第三方注册接口
         * @param $fast_register_params
         */
        function third_register()
        {
            $third_account_name = $this->input->post( 'third_account_name' ); //第三方登陆名或ID
            $third_prefix = $this->input->post( 'third_prefix' );//第三方用户前缀标示
            $login_name = $third_prefix . '_' . $third_account_name;
            $forbidden = 0;
            $regist_time = date( 'YmdHis' );
            $is_robot = 0;

            $userModel = UserModel::instance();
            $user = $userModel->getUserByLoginName( $login_name );
            if ( $user ) {
                $game_id = empty( $_POST['game_id'] ) ? 1 : $this->input->post( 'game_id' );
                $area_id = empty( $_POST['area_id'] ) ? 1 : $this->input->post( 'area_id' );
                DataUtil::instance()->doAfterLogin( Platform::CLIENT_APKMAO , $user , $game_id );

                $expire_time = $this->config->common['cookie']['timeout'];
                $session_key = UserUtil::instance()->createSessionId( $expire_time , $user , $area_id , $game_id );
                $response = array(
                    'session_name' => 'sessionid' ,
                    'session_key'  => $session_key ,
                    'user_number'  => $user['user_number'] ,
                    'uid'          => $user['user_id'] ,
                    'resource_uri' => '/user/info'
                );
                $response = Arrays::std_array_format( $response );
                $this->response( $response , 0 , false );

            } else {
                $nick_name = UserUtil::instance()->randomName();
                while ( 1 ) {
                    if ( !UserModel::instance()->isNickNameExsit( $nick_name ) )
                        break;
                    $nick_name = UserUtil::instance()->randomName();
                }

                $user_number = $userModel->getMaxUserNumber() + 1;
                $source_password = UserUtil::instance()->makeSourcePasswordByLoginName( $login_name , 8 );
                $password = UserUtil::instance()->makePasswordAuto( $source_password , $user_number );

                /*users**/
                $fields1 = array(
                    'login_name'    => $login_name ,
                    'nickname'      => $nick_name ,
                    'password'      => UserUtil::instance()->makePassword( $password , $user_number ) ,
                    'user_number'   => $user_number ,
                    'regist_time'   => $regist_time ,
                    'is_robot'      => $is_robot ,
                    'forbidden'     => $forbidden ,
                    'register_type' => Platform::CLIENT_APKMAO ,
                );

                $game_id = empty( $_POST['game_id'] ) ? 1 : $this->input->post( 'game_id' );
                $area_id = empty( $_POST['area_id'] ) ? 1 : $this->input->post( 'area_id' );
                $server = GameAreaModel::instance()->read( $area_id );
                $gameDb = new DB();
                $gameDb->init_db( $server );
                $gameFunc = GameFactory::invoke( $game_id , $gameDb );

                try {
                    $this->db->begin();
                    $gameDb->begin();
                    /*写入user**/
                    if ( !$userModel->saveUser( $fields1 ) )
                        throw new \Exception( Error::DATA_WRITE_ERROR );
                    $uid = $this->db->insert_id();

                    $fields2 = array(
                        'user_id'           => $uid ,
                        'purchase_password' => '' ,
                        'confirmation_key'  => ''
                    );

                    if ( !PurchaseProfileModel::instance()->saveProfile( $fields2 ) )
                        throw new \Exception ( Error::DATA_WRITE_ERROR );

                    $gameFunc->initProfile( $uid );

                    $this->db->commit();
                    $gameDb->commit();
                } catch (\Exception $e) {
                    $this->db->rollback();
                    $gameDb->rollback();
                    $this->response( null , $e->getMessage() );
                }


                $expire_time = $this->config->common['cookie']['timeout'];
                $user = array( 'login_name' => $login_name , 'user_number' => $user_number , 'user_id' => $uid );
                $session_key = UserUtil::instance()->createSessionId( $expire_time , $user , $area_id , $game_id );
                DataUtil::instance()->doAfterRegister( Platform::CLIENT_APKMAO , $uid , $game_id , $area_id );

                $response = array(
                    'session_name' => 'sessionid' ,
                    'session_key'  => $session_key ,
                    'user_number'  => $user_number ,
                    'resource_uri' => '/user/info' ,
                    'password'     => $source_password
                );
                $response = Arrays::std_array_format( $response );
                $this->response( $response , 0 , false );
            }
        }


        /**
         * 支付宝 通知回调接口
         */
        function alipay()
        {
            $alipay = new PayAliPay();
            $config['partner'] = $alipay->_mid;
            $config['key'] = $alipay->_key;
            $config['sign_type'] = $this->input->post( 'sign_type' );
            $config['input_charset'] = 'utf-8';
            $config['cacert'] = BASE_PATH . '\libs\payment\cacert.pem';
            $config['transport'] = 'http';
            $notify = new AlipayNotify( $config );

            $verify_result = $notify->verifyNotify();
            if ( $verify_result ) {
                //查询该订单信息
                $out_trade_no = $this->input->post( 'out_trade_no' );

                $trade_no = $this->input->post( 'trade_no' );

                $trade_status = $this->input->post( 'trade_status' );

                $amount = $this->input->post( 'total_fee' );

                $extra_common_param = $this->input->post( 'extra_common_param' );

                list( $game_id , $area_id ) = explode( '|' , $extra_common_param );
                if ( empty( $game_id ) )
                    $game_id = 1;
                if ( empty( $area_id ) )
                    $area_id = 1;
                $server = GameAreaModel::instance()->read( $area_id );
                $gameDB = new DB();
                $gameDB->init_db( $server );
                $gameFunc = GameFactory::invoke( $game_id , $gameDB );

                try {
                    $this->db->begin();
                    $gameDB->begin();

                    if ( $trade_status != 'TRADE_FINISHED' && $trade_status != 'TRADE_SUCCESS' )
                        throw new \Exception( '交易失败' );

                    $myorder = PaymentOrder::instance()->getByOrderNo( $out_trade_no );
                    if ( !$myorder )
                        throw new \Exception( '订单号不存在' );

                    if ( intval( $myorder['status'] ) > 0 ) {
                        die( 'success' );
                        //'订单已完成,非法请求';
                    }

                    if ( $myorder['money'] != $amount )
                        throw new \Exception( '充值金额与订单金额不符' );

                    //给用户增加资源
                    $gameFunc->payCallBack( $myorder );

                    //修改订单状态
                    $fields = array(
                        'pay_at' => date( 'Y-m-d H:i:s' ) ,
                        'status' => 1
                    );
                    if ( !PaymentOrder::instance()->updateByOrderNo( $fields , $out_trade_no ) )
                        throw new \Exception( '订单状态修改失败' );

                    $this->db->commit();
                    $gameDB->commit();
                    echo 'success';
                    //=============银行通知结束=============
                    //TODO 读取游戏库
                    DataUtil::instance()->doAfterRecharge( $myorder , Platform::RECHARGE_APKMAO , $area_id , $game_id );
                } catch (\Exception $e) {
                    Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , $e->getMessage() );
                    $this->db->rollback();
                    $gameDB->rollback();
                    die( 'fail' );
                }
            } else {
                Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , 'SIGN验证失败' );
                die( 'fail' );
            }
        }
    }