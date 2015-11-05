<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/12/9
     * Time: 下午4:36
     */

    namespace gms\model;


    use gms\core\XfModel;

    class GameServer_M extends XfModel
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function read()
        {
            $sql = "SELECT * FROM  xf_server ";
            $this->db->execute( $sql );

            return $this->db->fetch();
        }

        function update( $fields , $id = 1 )
        {
            return $this->db->update( $fields , 'xf_server' , ' WHERE id = ' . $id );
        }

    }