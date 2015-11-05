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
            define( 'BASE_HOST' , 'http://pt.16yx.com' );
            define( 'UAD_HOST' , 'http://uad.16yx.com' );
            define( 'API_HOST' , 'http://api.16yx.com' );//API host地址
            define( 'GMS_HOST' , 'http://dev.pms.com' );
            define('WHMJ_HOST','http://newbee.16yx.com');
            define('GAME_SOCKET_ADDR','tcp://10.144.181.190:8384');
            define('CDN_PLATFORM_HOST','http://res.16youxi.cc/assets/platform/beta');
            define( 'DOMAIN' , '16yx.com' );
            /**局域网服务器配置*/
//        define('BASE_HOST','http://pt.newbee.com');
//        define('API_HOST','http://api.newbee.com');//API host地址
//        define('UAD_HOST','http://uad.newbee.com');
//        define('GMS_HOST','http://test.pms.com');
//        define('WHMJ_HOST','http://test.newbee.com');
//        define('GAME_SOCKET_ADDR','tcp://192.168.2.21:8384');
//        define('CDN_PLATFORM_HOST','http://res.16youxi.cc/assets/platform/beta');
//        define('DOMAIN','newbee.com');
            /**sndu服务器配置*/
//        define('BASE_HOST','http://www.16youxi.cc');
//        define('API_HOST','http://api.16youxi.cc');//API host地址
//        define('UAD_HOST','http://uad.16youxi.cc');
//        define('GMS_HOST','http://pms.16youxi.cc');
//        define('DOMAIN','16youxi.cc');

            define( 'XHPROF_ENABLE' , 0 );
            error_reporting( E_ALL & ~E_NOTICE );
            ini_set( 'display_errors' , 'on' );
            break;
        case  'product':
            define( 'BASE_HOST' , 'http://pt.16youxi.com' );
            define( 'API_HOST' , 'http://platformApi.16youxi.cc' );//API host地址
            define( 'GMS_HOST' , 'http://pms.16youxi.cc' );
            define( 'UAD_HOST' , 'http://uad.16youxi.com' );
            define('WHMJ_HOST','http://www.16youxi.com');
            define('GAME_SOCKET_ADDR','tcp://10.144.181.190:8384');
            define('CDN_PLATFORM_HOST','http://res.16youxi.cc/assets/platform/release');
            define( 'DOMAIN' , '16youxi.com' );
            define( 'XHPROF_ENABLE' , 0 );
            error_reporting( E_ALL & ~E_NOTICE );
            ini_set( 'display_errors' , 'off' );
            break;
    }

    define( 'BASE_PATH' , dirname( dirname( __FILE__ ) ) );
    define( 'BASE_PROJECT' , 'web' );
    define( 'STATIC_HOST' , BASE_HOST );
    define( 'CDN' , 'http://res.16youxi.cc/assets/platform/');

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
