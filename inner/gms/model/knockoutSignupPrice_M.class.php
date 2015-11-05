<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/18
     * Time: 下午4:00
     */

    namespace gms\model;


    use gms\core\GameModel;

    class KnockoutSignupPrice_M extends GameModel
    {


        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function read( $match_id )
        {
            $sql = "SELECT * FROM knockout_signup_price WHERE match_id = ?";
            $this->_game_server->execute( $sql , array( $match_id ) );

            return $this->_game_server->fetch();
        }

        function update( $fields , $match_id )
        {
            return $this->_game_server->update( $fields , 'knockout_signup_price' , ' WHERE match_id=' . $match_id );
        }
    }