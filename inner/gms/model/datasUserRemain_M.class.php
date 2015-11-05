<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/3
     * Time: 下午4:28
     */

    namespace gms\model;


    use core\Model;

    class DatasUserRemain_M extends Model
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
                SUM(register_num) AS registerNum,
                SUM(second_day_num) AS secondDayNum,
                SUM(week_day_num) AS weekDayNum,
                SUM(month_day_num) AS monthDayNum,
                create_time AS createDate
                FROM gms_analysis_remain
                {$this->_condition}
                GROUP BY create_time $limit";
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
                SUM(register_num) AS registerNum,
                SUM(second_day_num) AS secondDayNum,
                SUM(week_day_num) AS weekDayNum,
                SUM(month_day_num) AS monthDayNum,
                UNIX_TIMESTAMP(FROM_UNIXTIME(create_time,'%Y-%m-01')) AS createDate
                FROM gms_analysis_remain
                {$this->_condition}
                GROUP BY FROM_UNIXTIME(create_time,'%Y%m')  $limit";
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
                $this->_condition[] = " create_time >= {$params['start_time']} ";
            }

            if ( !empty( $params['end_time'] ) ) {
                $this->_condition[] = " create_time <= {$params['end_time']} ";
            }

            if ( intval( $params['platform'] ) > 0 ) {
                $this->_condition[] = " platform_type = {$params['platform']}";
            }

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }