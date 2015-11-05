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
    define( 'PROJECT_MODE' , 'product' );

    switch (PROJECT_MODE) {
        case 'develop' :
            /**本地服务器配置*/
//            define( 'BASE_HOST' , 'http://127.0.0.1:9999' );
//            define( 'API_HOST' , 'http://api.16yx.com' );//API host地址
//            define( 'DOMAIN' , 'dh.com' );
            /**局域网服务器配置*/
            define( 'BASE_HOST' , 'http://dh.web.com' );
            define( 'API_HOST' , 'http://127.0.0.1:8082' );//API host地址
            define( 'DOMAIN' , 'web.com' );
            /**sndu服务器配置*/
//        define('BASE_HOST','http://www.16youxi.cc');
//        define('API_HOST','http://api.16youxi.cc');//API host地址
//        define('UAD_HOST','http://uad.16youxi.cc');
//        define('GMS_HOST','http://gms.16youxi.cc');
//        define('DOMAIN','16youxi.cc');

            define( 'XHPROF_ENABLE' , 0 );
            error_reporting( E_ALL & ~E_NOTICE );
            ini_set( 'display_errors' , 'on' );
            break;
        case  'product':
            define( 'BASE_HOST' , 'http://code.xy777.net' );
            define( 'API_HOST' , 'http://api.16youxi.com/' );//API host地址
            define( 'DOMAIN' , '/' );
            define( 'XHPROF_ENABLE' , 0 );
            error_reporting( E_ALL & ~E_NOTICE );
            ini_set( 'display_errors' , 'off' );
            break;
    }

    define( 'BASE_PATH' , dirname( dirname( __FILE__ ) ) );
    define( 'BASE_PROJECT' , 'dh' );
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
