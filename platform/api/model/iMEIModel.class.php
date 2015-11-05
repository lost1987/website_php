<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/8
     * Time: 下午4:21
     */

    namespace api\model;

    use core\Base;

    class IMEIModel extends Base
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * @param $login_name
         * @param $imei
         */
        function save( $login_name , $imei ,$type)
        {
            if ( !empty( $imei ) ) {
                $fields = array(
                    'login_name' => $login_name ,
                    'imei'       => $imei,
                    'type'       => $type
                );
                $this->db->save( $fields ,'xf_imei' );
            }
        }
    }