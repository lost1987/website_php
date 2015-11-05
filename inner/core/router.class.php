<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/16
     * Time: 下午4:25
     */
    namespace core;

    use api\controller\Gateway;

    /**
     * 游戏工厂模式 路由器
     */
    class Router
    {

        private $_router = null;

        private static $_instance = null;

        static function instance( $configFile )
        {
            if ( self::$_instance == null )
                self::$_instance = new self( $configFile );

            return self::$_instance;
        }

        /**
         * 绝对路径的路由配置文件
         * @param $configFile
         */
        function __construct( $configFile )
        {
            $this->setRouterConfigPath( $configFile );
        }

        private function setRouterConfigPath( $configFile )
        {
            if ( !is_file( $configFile ) )
                throw new \Exception( '路由配置文件错误或不存在!' );
            else {
                if ( $this->_router === null )
                    $this->_router = include( $configFile );
            }
        }

        /**
         * @param int    $router_id 路由表 ID
         * @param object $context   上下文对象
         */
        function invoke( $router_id , Gateway $context = null )
        {
            //controller类 需要实现setContext方法 且需要要_context对象属性
            list( $controllerName , $methodName ) = $this->_router[ $router_id ];
            $controller = new $controllerName;
            call_user_func( array( $controller , 'setContext' ) , $context );
            call_user_func( array( $controller , $methodName ) );
        }

    }