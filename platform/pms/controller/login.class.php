<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/28
     * Time: 上午9:39
     */

    namespace pms\controller;


    use common\base\BaseServers;
    use common\model\GameAreaModel;
    use core\Base;
    use core\Cookie;
    use core\Encoder;
    use core\Redirect;
    use pms\libs\AdminUtil;
    use pms\libs\ModuleDictionary;
    use pms\libs\SystemLog;
    use pms\model\Admin_M;
    use pms\model\AdminModule_M;
    use pms\model\Server_M;
    use libs\geetest\GeetestLib;

    /**
     * 登陆控制器
     * Class Login
     * @package pms\controller
     */
    class Login extends Base
    {

        function index()
        {
            $account = $this->input->post( 'username' );
            $password = $this->input->post( 'password' );

            if ( empty( $account ) || empty( $password ) ) {
                $this->tpl->display( 'login.html' );
            } else {
                $geetestPassed = Cookie::instance()->userdata( 'geetest_passed' );
                Cookie::instance()->unset_userdata( 'geetest_passed' );
                if ( $geetestPassed != 1 ) {
                    $this->set_login_error( '验证码错误!' );
                }

                if ( strlen( $password ) != 32 )
                    $this->set_login_error( '密码长度错误!' );
                //登录流程
                $admin = Admin_M::instance()->get_admin_by_account( $account );
                if ( false == $admin ) {
                    $this->set_login_error( "账号不存在!" );
                }
                $mypassword = AdminUtil::instance()->make_password( $password );
                if ( $mypassword != $admin['password'] )
                    $this->set_login_error( '密码错误!' );

                unset( $admin['password'] );
                Cookie::instance()->set_userdata( 'session_data' , Encoder::instance()->encode( $admin ) );
                Cookie::instance()->set_userdata( 'is_administrator' , $admin['superman'] );
                $permissions = AdminModule_M::instance()->get_list_by_admin_id( $admin['id'] );
                if ( !empty( $permissions ) )
                    Cookie::instance()->set_userdata( 'session_p' , Encoder::instance()->encode( $permissions ) );
                if ( !empty( $admin['selected_server_id'] ) ) {
                    $server = BaseServers::instance()->read($admin['selected_server_id']);
                    Cookie::instance()->set_userdata( 'server' , Encoder::instance()->encode( $server ) );
                }
                SystemLog::instance()->save( ModuleDictionary::ROOT_MODULE_LOGIN );
                Redirect::instance()->forward( '/index' );
            }

        }

        /**
         * 极验证码
         */
        function authCode()
        {
            GeetestLib::instance()->geeValidation( $this->config->pms['geetest']['key'] );
        }

        /**
         * 登陆时,检查账号是否存在
         * 存在反回true,否则返回错误信息
         */
        function check_account()
        {
            $account = $this->input->post( 'username' );
            if ( AdminUtil::instance()->admin_exsit( $account ) )
                die( 'true' );
            die( '账号不存在,请重新输入' );
        }

        /**
         * 登陆时,检查账号是否存在
         * 不存在返回true , 否则返回错误信息
         */
        function check_account_toggle()
        {
            $account = $this->input->post( 'username' );
            if ( AdminUtil::instance()->admin_exsit( $account ) )
                die( '账号已存在,请重新输入' );
            die( 'true' );
        }

        function  set_login_error( $msg )
        {
            $output_data = array(
                'msg' => $msg
            );
            $this->tpl->display( 'login.html' , $output_data );
            exit;
        }

        /**
         * 注销
         */
        function logout()
        {
            Cookie::instance()->sess_destroy();
            Redirect::instance()->forward();
        }

    }