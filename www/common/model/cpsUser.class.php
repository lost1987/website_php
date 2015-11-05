<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/9
     * Time: 下午1:43
     */

    namespace common\model;


    use core\Model;

    class CpsUser extends Model
    {
        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }


    }