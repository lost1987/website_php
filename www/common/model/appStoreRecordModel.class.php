<?php

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    namespace common\model;

    use core\Model;

    /**
     * Description of appStoreRecordModel
     *
     * @author shameless
     */
    class AppStoreRecordModel extends Model
    {

        private static $_instance = null;

        /**
         * @return AppStoreRecordModel
         */
        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         *
         * @param string $record
         */
        function save( $record )
        {
            $sql = "INSERT INTO xf_appstore_record (app_store_info) VALUES ('$record')";

            return $this->db->simple_exec( $sql );
        }

        /*
         * 查看appstore验证记录是否存在
         * @param string $record
         */
        function recordExsit( $record )
        {
            $sql = "SELECT COUNT(*) AS num FROM xf_appstore_record WHERE app_store_info = '$record'";
            $this->db->execute( $sql );
            $data = $this->db->fetch();
            if ( intval( $data['num'] ) > 0 )
                return true;

            return false;
        }
    }
