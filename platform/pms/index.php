<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-8-18
     * Time: 下午4:23
     * newbee gms入口
     * 独立配置文件对应 conf目录下BASE_PROJECT.'.inc.php'
     */
    session_start();
    define( 'PROJECT_MODE' , 'develop' );
    switch (PROJECT_MODE) {
        case 'develop' :
            /***本地配置****/
            define( 'BASE_HOST' , 'http://dev.pms.com' );
            define( 'WWW_HOST' , 'http://pt.16yx.com' );
            define('GAME_SOCKET_ADDR','tcp://192.168.2.21:8384');
            define( 'DOMAIN' , 'pms.com' );
            /***局域网配置***/
//        define('BASE_HOST','http://test.pms.com');
//        define('WWW_HOST','http://pt.newbee.com');
//        define('GAME_SOCKET_ADDR','tcp://192.168.2.21:8384');
//        define('DOMAIN','pms.com');
            /****sndu服务器配置****/
//        define('BASE_HOST','http://g.16youxi.cc');
//        define('WWW_HOST','http://www.16youxi.cc');
//        define('DOMAIN','16youxi.cc');

            define( 'XHPROF_ENABLE' , 0 );
            error_reporting( E_ERROR | E_WARNING | E_PARSE );
            ini_set( 'display_errors' , 'on' );
            break;
        case  'product':
            define( 'BASE_HOST' , 'http://pms.16youxi.cc' );
            define( 'WWW_HOST' , 'http://pt.16youxi.com' );
            define('GAME_SOCKET_ADDR','tcp://10.144.181.190:8384');
            define( 'DOMAIN' , '16youxi.cc' );
            define( 'XHPROF_ENABLE' , 0 );
            error_reporting( E_ERROR | E_WARNING | E_PARSE );
            ini_set( 'display_errors' , 'off' );
            break;
    }

    define( 'BASE_PATH' , dirname( dirname( __FILE__ ) ) );
    define( 'BASE_PROJECT' , 'pms' );
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


