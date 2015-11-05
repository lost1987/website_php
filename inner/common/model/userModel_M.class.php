<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/19
     * Time: 上午10:55
     */

    namespace common\model;

    use gms\core\XfModel;
    use utils\Tools;

    class UserModel_M extends XfModel
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
            return $this->db->update( $fields , 'xf_user' , 'WHERE user_id = ' . $user_id );
        }

        function read( $user_id )
        {
            $sql = "SELECT * FROM xf_user WHERE user_id = ?";
            $this->db->execute( $sql , array( $user_id ) );

            return $this->db->fetch();
        }

        function readByLoginName( $login_name_or_nickname )
        {
            if ( Tools::entry_int( $login_name_or_nickname ) ) {
                $sql = "SELECT * FROM xf_user WHERE login_name = ? or nickname = ? or user_id = ?";
                $this->db->execute( $sql , array( $login_name_or_nickname , $login_name_or_nickname , $login_name_or_nickname ) );
            } else {
                $sql = "SELECT * FROM xf_user WHERE login_name = ? or nickname = ?";
                $this->db->execute( $sql , array( $login_name_or_nickname , $login_name_or_nickname ) );
            }
            return $this->db->fetch();
        }

        function listsByConsume( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT * FROM xf_user WHERE consume > 0  ORDER BY consume DESC $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }

        function total()
        {
            $sql = "SELECT COUNT(*) as num FROM xf_user";
            $this->db->execute( $sql );

            return $this->db->fetch()['num'];
        }
    }