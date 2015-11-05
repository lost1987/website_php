<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/21
     * Time: 下午4:54
     */
    namespace exchangefactory;

    /**
     * 兑换工厂类
     */
    class FactoryExchange
    {
        /**
         * @param $className
         * @return \exchangefactory\IExchange
         */
        static function invoke( $className )
        {
            return call_user_func( array( __NAMESPACE__ . '\\' . $className , 'instance' ) );
        }
    }