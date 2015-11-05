<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/11
     * Time: 上午11:25
     */

    namespace dhmanager\libs;


    use core\Base;
    use core\Cookie;

    class AdminUtil extends Base
    {

        private static $_instance = null;

        /**
         * @return \dhmanager\libs\AdminUtil
         */
        static function instance(){
             if(self::$_instance == null)
                 self::$_instance = new self;
            return self::$_instance;
        }

        /**
         * 生成管理员密码
         * @param $md5Pwd md5后的密码
         * @return string
         */
            function covertPassword($md5Pwd){
                    $secrect = $this->config->dhmanager['admin_secrect'];
                    return md5($md5Pwd.'@'.$secrect);
            }

            function isAdministrator(){
                    if(Cookie::instance()->userdata('is_administrator'))
                        return true;
                    return false;
            }

            function initAdmin($admin){
                    Cookie::instance()->set_userdata('admin_id',$admin['id']);
                    Cookie::instance()->set_userdata('account',$admin['account']);
                    Cookie::instance()->set_userdata('is_administrator',$admin['is_administrator']);
                    Cookie::instance()->set_userdata('is_login',1);
            }
    }