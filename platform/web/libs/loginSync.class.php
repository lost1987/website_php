<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/2/5
     * Time: 下午8:11
     */

    namespace web\libs;


    use common\Account;
    use core\Base;
    use core\Cookie;
    use core\DB;
    use common\model\GameAreaModel;

    class LoginSync extends Base
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function loginSuccess( $user , $xfDb=null )
        {
            /*处理COOKIE**/
            $cookie = Cookie::instance();
            $expire_time = $this->config->common['cookie']['timeout'];

            $cookie->set_timeout( $expire_time );
            $cookie_data = $user;
            $publicItems = Account::instance()->publicItems($user);
            $cookie_data['chip'] = empty($publicItems['chip']) ? 0 : $publicItems['chip'];
            unset($publicItems);
            UserUtil::instance()->setUserCookie( $cookie_data );
        }
    }