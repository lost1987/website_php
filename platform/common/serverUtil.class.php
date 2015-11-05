<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/18
     * Time: 下午5:59
     */

    namespace common;


    use common\base\BaseServers;

    class ServerUtil
    {
        private static $_instance = null;

        /**
         * @return ServerUtil|null
         */
        static function instance(){
            if(self::$_instance == null)
                self::$_instance = new self;
            return self::$_instance;
        }

        function getServerIDFromItemNo($item_id){
                return  ($item_id/10000) >> 0;
        }

        function getServerInfoFromItemNo($item_id){
              $servers = BaseServers::instance()->lists();
             $server_id = $this->getServerIDFromItemNo($item_id);
            return $servers[$server_id];
        }
    }