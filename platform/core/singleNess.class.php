<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/19
     * Time: 10:55
     */

    namespace core;


    abstract class SingleNess
    {
        private static $_instance = null;

        private function __clone(){}

        static function instance(){
            if(static::$_instance === null)
                static::$_instance = new static;
            return static::$_instance;
        }
    }