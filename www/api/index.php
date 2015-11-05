<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-8-18
     * Time: 下午4:23
     * newbee api接口入口
     * 独立配置文件对应 conf目录下BASE_PROJECT.'.inc.php'
     */
    session_start();
    define( 'PROJECT_MODE' , 'develop' );
    switch (PROJECT_MODE) {
        case 'develop' :
            /**本地服务器配置*/
//            define( 'BASE_HOST' , 'http://api.16yx.com' );
//            define( 'DH_HOST' , 'http://127.0.0.1:9999' );
//            define( 'WWW_HOST' , 'http://newbee.16yx.com' );//API host地址
//            define( 'GMS_HOST' , 'http://dev.gms.com' );
            /**局域网服务器配置*/
        define('BASE_HOST','http://api.newbee.com');
        define('WWW_HOST','http://test.newbee.com');//API host地址
        define( 'DH_HOST' , 'http://dh.web.com' );
        define('GMS_HOST','http://test.gms.com');
            /**sndu 服务器配置*/
//        define('BASE_HOST','http://api.16youxi.cc');
//        define('WWW_HOST','http://www.16youxi.cc');//API host地址
//            define( 'DH_HOST' , 'http://127.0.0.1:9999' );
//        define('GMS_HOST','http://gms');

            define( 'XHPROF_ENABLE' , 0 );
            error_reporting( E_ALL & ~E_NOTICE );
            ini_set( 'display_errors' , 'on' );
            break;
        case  'product':
            define( 'BASE_HOST' , 'http://api.16youxi.com' );
            define( 'WWW_HOST' , 'http://www.16youxi.com' );//API host地址
            define( 'GMS_HOST' , 'http://gms.16youxi.cc' );
            define( 'DH_HOST' , 'http://code.xy777.net' );
            define( 'XHPROF_ENABLE' , 0 );
            error_reporting( E_ALL & ~E_NOTICE );
            ini_set( 'display_errors' , 'off' );
            break;
    }

    define( 'BASE_PATH' , dirname( dirname( __FILE__ ) ) );
    define( 'BASE_PROJECT' , 'api' );
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
