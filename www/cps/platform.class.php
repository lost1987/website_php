<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/8
     * Time: 下午3:55
     */

    namespace cps;

    /**
     * 广告平台
     * Class Platform
     * @package cps
     */
    class Platform
    {
        /**
         *易瑞特平台
         */
        const OFFER99 = 1;

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function platformInfo( $platform_id )
        {
            switch ($platform_id) {
                case self::OFFER99:
                    return array(
                        'platform_classname' => 'Offer99',
                        'platform_id_name' => Offer99::instance()->getPlatformIdName(),
                        'platform_task_url' =>'http://list.offer99.com/index.php?action=offerlist&pid=l422dd752933d06cb8f675a620e82859',
                        'common_platform_id' => \common\Platform::CLIENT_CPS_OFFER99
                    );
                    break;
            }
        }

        /**
         * @param $platform_id
         * @return \cps\Cps
         */
        function cpsInstance($platform_id){
              $cpsPlatform =  $this->platformInfo($platform_id);
              $class = '\\'.__NAMESPACE__.'\\'.$cpsPlatform['platform_classname'];
              return call_user_func(array($class,'instance'));
        }

    }