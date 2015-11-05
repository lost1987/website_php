<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/5
     * Time: 下午2:16
     */

    namespace gms\model;


    use core\Model;

    class DatasMonetary_M extends Model
    {


        private static $_instance = null;

        private $_condition = '';

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function listsByHours( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT
                coins_num AS coins_num,
                coupon_num AS coupon_num,
                diamond_num AS diamond_num,
                ticket_num AS ticket_num,
                create_time AS createDate
                FROM gms_analysis_resource
                {$this->_condition}
                $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }

        function listsByDays( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT
                SUM(coins_num) AS coins_num,
                SUM(coupon_num) AS coupon_num,
                SUM(diamond_num) AS diamond_num,
                SUM(ticket_num) AS ticket_num,
                create_date AS createDate
                FROM gms_analysis_resource
                {$this->_condition}
                GROUP BY create_date $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }

        function listsByMonths( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT
                SUM(coins_num) AS coins_num,
                SUM(coupon_num) AS coupon_num,
                SUM(diamond_num) AS diamond_num,
                SUM(ticket_num) AS ticket_num,
                UNIX_TIMESTAMP(FROM_UNIXTIME(create_date,'%Y-%m-01')) AS createDate
                FROM gms_analysis_resource
                {$this->_condition}
                GROUP BY FROM_UNIXTIME(create_date,'%Y%m') $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }

        /**
         * @param array $cond
         */
        function set_condition( $params )
        {
            $this->_condition = array();

            if ( !empty( $params['start_time'] ) ) {
                $this->_condition[] = " create_date >= {$params['start_time']} ";
            }

            if ( !empty( $params['end_time'] ) ) {
                $this->_condition[] = " create_date <= {$params['end_time']} ";
            }

            if ( !empty( $params['resource_type'] ) ) {
                $this->_condition[] = " resource_type = {$params['resource_type']}";
            }

            if ( !empty( $params['monetary'] ) ) {
                $this->_condition[] = " {$params['monetary']} > 0 ";
            }

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }