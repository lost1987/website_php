<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/1/15
     * Time: 上午9:48
     */

    namespace adm\model;


    use core\Model;

    class RewardLogin_M extends Model
    {
        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function read( $uid )
        {
            $sql = "SELECT * FROM adm_reward_login WHERE uid = ?";
            $this->db->execute( $sql , array( $uid ) );

            return $this->db->fetch();
        }

        function save( $fields )
        {
            return $this->db->save( $fields , 'adm_reward_login' );
        }

        function update( $fields , $uid )
        {
            return $this->db->update( $fields , 'adm_reward_login' , " WHERE uid = $uid" );
        }

    }