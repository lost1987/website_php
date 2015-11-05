<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/9
     * Time: 上午10:14
     */

    namespace gms\model;

    use gms\core\GameModel;


    /**
     * 钻石消耗
     * Class DatasDiamondCost
     * @package gms\model
     */
    class DatasDiamondCost_M extends GameModel
    {

        private static $_instance = null;

        private $_condition = '';

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function listsByDays( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT
                DISTINCT(COUNT(uid)) AS costUserNum,
                COUNT(uid) AS costUserCount,
                SUM(price) AS costTotal,
                UNIX_TIMESTAMP(FROM_UNIXTIME(create_time,'%Y/%m/%d')) AS createDate
                FROM user_resource_log
                {$this->_condition}
                GROUP BY
                FROM_UNIXTIME(create_time,'%Y/%m/%d') $limit";
            $this->_game_server->execute( $sql );
            $this->_condition = '';

            return $this->_game_server->fetch_all();
        }


        function listsByMonths( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT
                DISTINCT(COUNT(uid)) AS costUserNum,
                COUNT(uid) AS costUserCount,
                SUM(price) AS costTotal,
                UNIX_TIMESTAMP(FROM_UNIXTIME(create_time,'%Y-%m-01')) AS createDate
                FROM user_resource_log
                {$this->_condition}
                GROUP BY FROM_UNIXTIME(create_time,'%Y%m') $limit";
            $this->_game_server->execute( $sql );
            $this->_condition = '';

            return $this->_game_server->fetch_all();
        }

        /**
         * @param array $cond
         */
        function set_condition( $params )
        {
            $this->_condition = array();

            $this->_condition[] = ' price_type = 1 ';

            if ( !empty( $params['start_time'] ) ) {
                $this->_condition[] = " create_time >= {$params['start_time']} ";
            }

            if ( !empty( $params['end_time'] ) ) {
                $this->_condition[] = " create_time <= {$params['end_time']} ";
            }

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }