<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/4
     * Time: 下午4:52
     */

    namespace gms\model;


    use gms\core\GameModel;

    class UserCoujiangData_M extends GameModel
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT json,zj_amount,begin_time FROM user_coujiang_data {$this->_condition}  ORDER BY begin_time DESC  $limit";
            $this->_game_server->execute( $sql );
            $this->_condition = '';

            return $this->_game_server->fetch_all();
        }


        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM user_coujiang_data {$this->_condition}";
            $this->_game_server->execute( $sql );
            $this->_condition = '';

            return $this->_game_server->fetch()['num'];
        }

        /**
         * @param array $cond
         */
        function set_condition( $params )
        {
            $this->_condition = array();

            if ( !empty( $params['search_type'] ) )
                $this->_condition[] = " zj_type = {$params['search_type']} ";

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }

    }