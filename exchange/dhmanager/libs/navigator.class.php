<?php

    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/11
     * Time: 上午10:48
     */
    namespace dhmanager\libs;

    use core\Base;

    class Navigator extends Base
    {

        private static $_instance = null;

        private $_trees = array(
            array(
                'name' => '管理员项' ,
                'flag' => 'admin' ,
                'data' => array(
                    array(
                        'name' => '用户管理' ,
                        'flag' => 'admin_manager' ,
                        'url'  => '/admin/lists'
                    ),
                    array(
                        'name' => '购物券管理',
                        'flag' => 'admin_excode',
                        'url' => '/excode/lists'
                    )
                )
            ) ,

            array(
                'name' => '用户项' ,
                'flag' => 'user' ,
                'data' => array(
                    array(
                        'name' => '兑换管理' ,
                        'flag' => 'exchange_manager' ,
                        'url'  => '/exchange/lists'
                    ),
                    array(
                        'name' => '兑换统计' ,
                        'flag' => 'exchange_analysis' ,
                        'url'  => '/exchange/analysis'
                    )
                )
            )
        );

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function init()
        {
            $trees = $this->_trees;
            if ( !AdminUtil::instance()->isAdministrator() ) {
                unset( $trees[0] );
            }

            return $trees;
        }
    }