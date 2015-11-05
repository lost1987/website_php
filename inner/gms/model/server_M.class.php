<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/31
     * Time: 上午9:56
     */

    namespace gms\model;


    use gms\core\XfModel;

    class Server_M extends XfModel
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function read( $game_id , $area_id )
        {
            $sql = "SELECT * FROM xf_game_area WHERE game_id = ? AND area_id = ?";
            $this->db->execute( $sql , array( $game_id , $area_id ) );

            return $this->db->fetch();
        }

    }