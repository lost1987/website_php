<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/28
     * Time: 15:41
     */

    $args = getopt('n:');
    define('BASE_PATH',dirname(dirname(__FILE__)));
    define( 'BASE_PROJECT' , 'tasks' );
    define('RUN_MODE','task');
    define('DOMAIN','');
    define('XHPROF_ENABLE',0);

    require BASE_PATH . '/core/autoload.class.php';
    require BASE_PATH . '/core/configure.class.php';
    require BASE_PATH . '/core/db.class.php';
    require BASE_PATH . '/core/base.class.php';
    require BASE_PATH . '/omni.class.php';

    $omni = Omni::instance();
    $omni->className = $args['n'];
    $omni->run( BASE_PROJECT );