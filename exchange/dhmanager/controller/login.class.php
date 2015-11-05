<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/11
     * Time: 上午9:37
     */

    namespace dhmanager\controller;


    use core\Cookie;
    use core\Redirect;
    use dhmanager\core\DhController;
    use dhmanager\libs\AdminUtil;
    use dhmanager\libs\Error;
    use dhmanager\model\AdminModel;
    use libs\geetest\GeetestLib;

    class Login extends DhController
    {
            function __construct(){}

            function index(){
                $this->tpl->display('login.html');
            }

            function in(){
                    $account = $this->input->post('account');
                    $password = $this->input->post('password');

                    $geetestPassed = Cookie::instance()->userdata( 'geetest_passed' );
                    Cookie::instance()->unset_userdata( 'geetest_passed' );
                    if ( $geetestPassed != 1 ) {
                        $this->response(\common\Error::AUTH_CODE_ERROR);
                    }

                    if(empty($account) || empty($password))
                                $this->response(Error::ADMIN_PASSWORD_ERROR);

                    $password = AdminUtil::instance()->covertPassword($password);
                    $admin = AdminModel::instance()->read($account,array('id,password,account,is_administrator'));
                    if(false == $admin)
                        $this->response(Error::ADMIN_USER_NOT_EXIST);
                    if($admin['password'] != $password)
                        $this->response(Error::ADMIN_PASSWORD_ERROR);

                    AdminUtil::instance()->initAdmin($admin);
                    $this->response();
            }

            function out(){
                Cookie::instance()->sess_destroy();
                die('<script>window.parent.location.reload();</script>');
            }

            /**
             * 极验证码
             */
            function authCode()
            {
                GeetestLib::instance()->geeValidation( $this->config->dhmanager['geetest']['key'] );
            }
    }