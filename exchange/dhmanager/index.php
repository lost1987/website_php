<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-8-18
     * Time: 下午4:23
     * newbee网站前台入口
     * 独立配置文件对应 conf目录下BASE_PROJECT.'.inc.php'
     */
    session_start();
    define( 'PROJECT_MODE' , 'develop' );

    switch (PROJECT_MODE) {
        case 'develop' :
            /**本地服务器配置*/
            define( 'BASE_HOST' , 'http://dev.dh.com' );
            define( 'DOMAIN' , 'dh.com' );
            /**局域网服务器配置*/
//        define('BASE_HOST','http://manager.dh.com');
//        define('DOMAIN','dh.com');
            /**sndu服务器配置*/
//        define('BASE_HOST','http://www.16youxi.cc');
//        define('DOMAIN','16youxi.cc');

            define( 'XHPROF_ENABLE' , 0 );
            error_reporting( E_ALL & ~E_NOTICE );
            ini_set( 'display_errors' , 'on' );
            break;
        case  'product':
            define( 'BASE_HOST' , 'http://123.57.95.98:8000' );
            define( 'DOMAIN' , '123.57.95.98' );
            define( 'XHPROF_ENABLE' , 0 );
            error_reporting( E_ALL & ~E_NOTICE );
            ini_set( 'display_errors' , 'off' );
            break;
    }

    define( 'BASE_PATH' , dirname( dirname( __FILE__ ) ) );
    define( 'BASE_PROJECT' , 'dhmanager' );
    define( 'STATIC_HOST' , BASE_HOST );

    require BASE_PATH . '/core/autoload.class.php';
    require BASE_PATH . '/core/configure.class.php';
    require BASE_PATH . '/core/db.class.php';
    require BASE_PATH . '/core/base.class.php';
    require BASE_PATH . '/core/cookie.class.php';
    require BASE_PATH . '/core/utf8.class.php';
    require BASE_PATH . '/core/security.class.php';
    require BASE_PATH . '/core/input.class.php';
    require BASE_PATH . '/omni.class.php';

    $omni = Omni::instance();
    $omni->run( BASE_PROJECT );
