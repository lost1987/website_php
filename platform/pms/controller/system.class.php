<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/29
     * Time: 上午11:50
     */

    namespace pms\controller;


    use common\base\BaseGameAnnouncement;
    use common\base\BaseGameHelp;
    use common\base\BaseHallAnnouncement;
    use common\base\BaseItems;
    use common\base\BaseProducts;
    use common\base\BaseServers;
    use core\Encoder;
    use core\Permission;
    use core\Redis;
    use pms\core\AdminController;
    use core\Cookie;
    use core\Redirect;
    use pms\libs\AdminUtil;
    use pms\libs\Error;
    use pms\libs\ModuleDictionary;
    use pms\model\Guide_M;
    use pms\model\SystemMonitor_M;
    use pms\modelBase\BaseModule;
    use utils\Page;
    use utils\Upload;

    /**
     * 系统功能控制器
     * Class System
     * @package pms\controller
     */
    class System extends AdminController
    {

        /**
         * 清除缓存:
         * 1.redis导航缓存
         */
        function ajax_clear_cache()
        {
            BaseHallAnnouncement::instance()->clear();
            BaseGameHelp::instance()->clear();
            BaseGameAnnouncement::instance()->clear();
            BaseServers::instance()->clear();
            BaseModule::instance()->clear();
            BaseItems::instance()->clear();
            BaseProducts::instance()->clear();
            Redirect::instance()->forward();
        }


        function php_info()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_INFO_PHP );
            $this->init_navigator();
            $this->output_data['obj'] = $this;
            $this->render( 'php_env.html' );
        }

        function twig_info()
        {
            if ( function_exists( 'phpinfo' ) )
                phpinfo();
        }

        function selectServer()
        {
            $server_id = $this->input->post( 'area_id' );
            $server = BaseServers::instance()->read($server_id);
            Cookie::instance()->set_userdata( 'server' , Encoder::instance()->encode( $server ) );
            AdminUtil::instance()->setSelectedServer( $server_id );
            $this->response( $server['game_name'] );
        }
    }