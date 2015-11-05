<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/9
     * Time: 09:14
     */

    namespace api\core;


    use common\GameSession;
    use common\model\SessionModel;
    use core\Base;
    use utils\Tools;

    class BaseApi extends Base
    {
        /**
         * 检查session 时效是否过期[django_session表]
         * @param $sessionid
         * @return mixed  $session:array 有效,未过期 false:bool 失效,已过期
         */
        protected function checkSession($sessionid )
        {
                return GameSession::instance()->auth($sessionid);
        }
    }