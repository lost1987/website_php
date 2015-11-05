<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/24
     * Time: 上午10:47
     */

    namespace gms\model;


    use gms\core\XfModel;

    class PurchaseProfile_M extends XfModel
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }


        function update( $fields , $user_id )
        {
            return $this->db->update( $fields , 'xf_purchaseprofile' , " WHERE user_id=$user_id" );
        }
    }