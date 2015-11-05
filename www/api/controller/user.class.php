<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/20
     * Time: 上午9:25
     * 用户相关API
     */

    namespace api\controller;


    use api\core\Baseapi;
    use api\libs\Error;
    use common\model\GameAreaModel;
    use common\model\ProductOrderModel;
    use core\DB;
    use core\Redis;
    use cps\Cps;
    use gamefactory\GameFactory;
    use libs\badwords\BadWords;
    use uad\libs\UserRelationShip;
    use utils\Arrays;
    use utils\Curl;
    use utils\Strings;
    use utils\Tools;
    use web\libs\DataUtil;
    use common\Platform;
    use web\libs\Sms;
    use web\libs\UserUtil;
    use common\model\PurchaseProfileModel;
    use common\model\UserModel;

    /**
     * 用户相关的接口类
     * Class User
     * @package api\controller
     */
    class User extends Baseapi
    {
        /**
         * 玩家登录大厅
         */
        function loginHall(){
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

            $expire_time = $this->config->common['cookie']['timeout'];
            $list =   GameAreaModel::instance()->listCache();
            $response = array(
                'session_name' => 'sessionid',
                'user_number' => $user['user_number'],
                'uid' => $user['user_id'],
                'login_name'=>$user['login_name'],
                'nickname' => $user['nickname'],
                'avatar' => $user['avatar'],
                'gender' => $user['gender'],
                'diamond' => $user['diamond'],
                'resource_uri' => '/user/info'
            );
            $games = array();
            foreach($list as $item){
                $games[] = array(
                    'game_id' => $item['game_id'],
                    'area_id' => $item['area_id'],
                    'session_key' => UserUtil::instance()->createSessionId( $expire_time , $user ,  $item['area_id'] , $item['game_id'] )
                );
            }

            $games = Arrays::std_array_format($games);
            $response = Arrays::std_array_format($response);
            $response['games'] = $games;
            $this->response($response,0,false);
        }


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
            DataUtil::instance()->doAfterLogin( Platform::CLIENT_ORIGIN_MOBILE , $user , $game_id );
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
            $cps_platform_id = $this->input->post('cps_platform_id');
            $platform = Platform::CLIENT_ORIGIN_MOBILE;
            if(!empty($cps_platform_id)){
                $platformInfo = \cps\Platform::instance()->platformInfo($cps_platform_id);
                if(is_array($platformInfo))
                    $platform = $platformInfo['common_platform_id'];
            }
            if ( $quick_register == 'quick' ) {//快速注册
                $login_name = 'quick' . uniqid();
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
                'register_type' => $platform
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

                if(!empty($cps_platform_id))
                {
                    $cpsPlatform =    \cps\Platform::instance()->cpsInstance($cps_platform_id);
                    $cpsPlatform->saveRelationShip($uid,uniqid('offer99_mobile'),$cps_platform_id);
                }

                $this->db->commit();
                $gameDb->commit();
            } catch (\Exception $e) {
                $this->db->rollback();
                $gameDb->rollback();
                $this->response( null , $e->getMessage() );
            }

            DataUtil::instance()->doAfterRegister( $platform , $uid , $game_id , $area_id );
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

            if ( $quick_register == 'quick' ) {
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
                DataUtil::instance()->doAfterLogin( Platform::CLIENT_WEIBO , $user , $game_id );

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
                    'register_type' => Platform::CLIENT_WEIBO ,
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
                $platform = Platform::instance()->getPlatformFromThird( $third_prefix );
                DataUtil::instance()->doAfterRegister( $platform , $uid , $game_id , $area_id );

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
         * 用户变更区域
         */
        function change_area()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $uid = $session['uid'];
            $area_index = $this->input->post( 'area' );
            $area = $this->config->common['areas'][ $area_index ];
            $fields = array( 'area' => $area_index );
            if ( !UserModel::instance()->updateUser( $fields , $uid ) )
                $this->response( null , Error::DATA_WRITE_ERROR );
            $this->response( $area );
        }

        /**
         * 用户变更手机号
         */
        function change_mobile()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $uid = $session['uid'];
            $mobile = $this->input->post( 'mobile' );
            //验证手机号的规范
            if ( !Strings::is_mobile( $mobile ) )
                $this->response( null , Error::FORM_STRING_FORMAT );
            $fields = array( 'mobile' => $mobile );
            if ( !UserModel::instance()->updateUser( $fields , $uid ) )
                $this->response( null , Error::DATA_WRITE_ERROR );
            $this->response( $mobile );
        }

        /**
         * 用户变更登陆密码
         */
        function change_password()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $uid = $session['uid'];
            $user_number = $session['user_number'];
            $password = $this->input->post( 'password' );
            $password1 = $this->input->post( 'password1' );

            if ( strlen( $password ) != 32 || strlen( $password1 ) != 32 )
                $this->response( null , Error::FORM_STRING_FORMAT );

            if ( $password != $password1 )
                $this->response( null , Error::STRING_CMP_ERROR );

            $newpassword = UserUtil::instance()->makePassword( $password , $user_number );
            $fields = array(
                'password' => $newpassword
            );

            if ( !UserModel::instance()->updateUser( $fields , $uid ) )
                $this->response( null , Error::DATA_WRITE_ERROR );

            $this->response( null );
        }


        function purchase_pwd_validate()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $uid = $session['uid'];
            $purchase_profile = PurchaseProfileModel::instance()->read( $uid );
            $user = UserModel::instance()->getUserByUid( $uid );
            $password = $this->input->post( 'password' );
            if ( !UserUtil::instance()->is_purchase_password_valid( $password , $purchase_profile['purchase_password'] , $user['user_number'] ) )
                $this->response( null , Error::PASSWORD_INVALID );
            $this->response( null );
        }

        /**
         * 变更交易密码
         */
        function change_purchase_pwd()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $uid = $session['uid'];
            $user_number = $session['user_number'];
            $password = $this->input->post( 'password' );
            $password1 = $this->input->post( 'password1' );

            if ( strlen( $password ) != 32 || strlen( $password1 ) != 32 )
                $this->response( null , Error::FORM_STRING_FORMAT );

            if ( $password != $password1 )
                $this->response( null , Error::STRING_CMP_ERROR );

            $newpassword = UserUtil::instance()->makePassword( $password , $user_number );
            $fields = array(
                'purchase_password' => $newpassword
            );

            if ( !PurchaseProfileModel::instance()->updateProfile( $fields , $uid ) )
                $this->response( null , Error::DATA_WRITE_ERROR );

            $this->response( null );
        }

        /**
         * 修改头像
         */
        function change_avatar()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $avatar = intval( $this->input->post( 'avatar' ) );

            $uid = $session['uid'];
            $user = UserModel::instance()->getUserByUid( $uid );

            $area_id = $session['area_id'];
            $game_id = $session['game_id'];
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );
            $gameFunc = GameFactory::invoke( $game_id , $gameDB );
            $profile = $gameFunc->readProfileDirect( $uid );
            $items = explode(',',$profile['items']);

            if( !in_array('43',$items)) {//试用VIP 给予换头像的功能 不判断VIP等级
                $vipLv = $profile['vip_level'];
                if ( $vipLv == 0 && $avatar > 2 )
                    $this->response( null , Error::VIP_LEVEL_NOT_ENOUGH_PERMISSION );
            }

            $gender = $user['gender'];

            if ( !UserModel::instance()->updateUser( array( 'avatar' => $avatar ) , $uid ) )
                $this->response( null , Error::DATA_WRITE_ERROR );

            $file_prefix = $gender == 0 ? 'male' : 'female';
            $url = WWW_HOST . '/img/tx/' . $file_prefix . $avatar . '.jpg';
            $msg = $gender . '_' . $avatar;

            $data = array(
                'url' => $url ,
                'msg' => $msg
            );

            //为了和游戏同步 , 更新 redis
            $r = new Redis( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
            $redis = $r->getResource();
            $redis->select( 0 );
            $redis->hSet('MjUserInfo:' . $uid , 'Avatar' , $avatar );
            $redis->close();

            $this->response( $data );
        }

        function randName()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            while ( 1 ) {
                $name = UserUtil::instance()->randomName();
                if ( !UserModel::instance()->isNickNameExsit( $name ) )
                    break;
                usleep( 100 );
            }

            $this->response( $name );
        }

        function getInviteCode()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $uid = $session['uid'];
            $xfUser = UserModel::instance()->getUserByUid( $uid );
            $inviteCode = $xfUser['invite_code'];

            $admDB = new DB();
            $admDB->init_db_from_config( 'adm' );

            if ( empty( $inviteCode ) ) {
                try {
                    $admDB->begin();
                    $this->db->begin();
                    if ( !UserRelationShip::instance( $admDB , $this->db )->createRelationShipFromGame( $xfUser , $inviteCode ) )
                        throw new \Exception( Error::DATA_WRITE_ERROR );

                    $admDB->commit();
                    $this->db->commit();
                } catch (\Exception $e) {
                    Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , '绑定推广系统出错' , $e );
                    $admDB->rollback();
                    $this->db->rollback();
                    $this->response( null , $e->getMessage() );
                }

                $response = array(
                    'inviteCode' => intval( $inviteCode ) ,
                    'childNum'   => 0
                );

            } else {
                $childNum = UserRelationShip::instance( $admDB , $this->db )->getChildrenNumTopLeaf( $uid );
                $response = array(
                    'inviteCode' => intval( $inviteCode ) ,
                    'childNum'   => intval( $childNum )
                );
            }
            $this->response( $response );
        }

        /**
         * 奖品兑换历史
         */
        function pyExchangeHistory(){
          $session = $this->check_session( $this->input->post( 'sessionid' ) );
          if ( !$session )
              $this->response( null , Error::USER_NOT_LOGIN );

          $uid = $session['uid'];
          $list = ProductOrderModel::instance()->read_physical($uid);
          foreach($list as $k => &$item){
//              echo dirname(dirname(BASE_PATH.'/omni.class.php')).'/inner/gms'.$item['product_pic'].chr(10);
              if(!file_exists(dirname(dirname(BASE_PATH.'/omni.class.php')).'/inner/gms'.$item['product_pic']))
                  unset($list[$k]);
              else
                  $item['product_pic'] =  WWW_HOST.$item['product_pic'];
          }
          $list = Arrays::std_multi_array_format($list);
          $this->response($list);
        }

        function forgetPassword_1(){
            $mobile =$this->input->post('mobile');
            if(!Strings::is_mobile($mobile))
                $this->response(null,Error::FORM_STRING_FORMAT);

            $user = UserModel::instance()->getUserByMobile($mobile);
            if(empty($user))
                $this->response(null,Error::USER_NOT_EXSIT);

            $sms = Sms::instance();
            $code = $sms->createCode();
            $content = "密码找回验证码：{$code}，请不要把验证码泄露给其他人。如非本人操作，请删除本条短信！";
            $key = $sms->getRedisKey($user['user_id'],'sms:fp:');
            $r = new Redis($this->config->common['redis']['host'],$this->config->common['redis']['port']);
            $redis = $r->getResource();
            $redis->select(2);
            $redis->set($key,$code,300);
            $redis->close();
            if(!$sms->sendGet($content,$mobile))
                $this->response(null,Error::AUTH_SMS_SEND_FAILED);
            $this->response(null);
        }

        function forgetPassword_2(){
            $mobile =$this->input->post('mobile');
            if(!Strings::is_mobile($mobile))
                $this->response(null,Error::FORM_STRING_FORMAT);

            $user = UserModel::instance()->getUserByMobile($mobile);
            if(empty($user))
                $this->response(null,Error::USER_NOT_EXSIT);

            $smscode= $this->input->post('smscode');

            $key = Sms::instance()->getRedisKey($user['user_id'],'sms:fp:');
            $r = new Redis($this->config->common['redis']['host'],$this->config->common['redis']['port']);
            $redis = $r->getResource();
            $redis->select(2);
            $mysmscode = $redis->get($key);
            if(empty($mysmscode))
                $this->response(null,Error::AUTH_SMS_EXPIRED);
            if(strcmp($smscode,$mysmscode) !== 0)
                $this->response(null,Error::AUTH_SMS_CODE_ERROR);

            $redis->del($key);
            $redis->close();
            $this->response(null);
        }

        function forgetPassword_3(){
                $time = $this->input->post('time');
                $secrect = 'fwk9023u84235';
                $password = $this->input->post('password');
                $sign = $this->input->post('sign');

                $mobile =$this->input->post('mobile');
                if(!Strings::is_mobile($mobile))
                    $this->response(null,Error::FORM_STRING_FORMAT);

                $mysign = md5($time.$mobile.$secrect);
                if(strcmp($sign,$mysign) !== 0)
                    $this->response(null,Error::SIGN_ERROR);

                $user = UserModel::instance()->getUserByMobile($mobile);
                if(empty($user))
                    $this->response(null,Error::USER_NOT_EXSIT);
                $passwd = UserUtil::instance()->makePassword($password,$user['user_number']);
                $fields = array('password' => $passwd);
                if(!$this->db->update($fields,'xf_user','WHERE user_id='.$user['user_id']))
                    $this->response(null,Error::DATA_WRITE_ERROR);

                $this->response(null);
        }
    }
