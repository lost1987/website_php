<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/16
     * Time: 下午5:20
     */

    namespace core;

    /**
     * 单例模式抽象类
     * Class Singleton
     * @package core
     */
   abstract class Singleton extends Base
    {

        private static $_instance = null;

        private function __clone(){}

        static function instance(){
            if(static::$_instance === null)
                static::$_instance = new static;
            return static::$_instance;
        }

    }