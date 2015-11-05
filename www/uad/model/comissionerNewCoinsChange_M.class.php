<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/26
     * Time: 下午3:51
     */

    namespace uad\model;


    use core\Model;

    /**
     * 专员月总结新蜂币变化
     * Class ComissionerNewCoinsChange_M
     * @package uad\model
     */
    class ComissionerNewCoinsChange_M extends Model
    {

        private static $_instance = null;

        private $_condition = '';

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }


        /**
         * @param null $start
         * @param null $count
         * @return mixed
         */
        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT * FROM adm_comissioner_newcoins_change {$this->_condition}  $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }


        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM adm_comissioner_newcoins_change {$this->_condition}";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch()['num'];
        }

        /**
         * @param array $cond
         */
        function set_condition( $params )
        {
            $this->_condition = array();

            if ( !empty( $params['uid'] ) )
                $this->_condition[] = " uid = {$params['uid']} ";

            if ( !empty( $params['change_time'] ) )
                $this->_condition[] = " change_time = {$params['change_time']}";

            if ( !empty( $params['from_uid'] ) )
                $this->_condition[] = " from_uid  = {$params['from_uid']}";

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }