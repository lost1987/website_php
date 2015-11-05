<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/2/28
     * Time: 上午11:32
     */

    namespace gms\model;


    use core\Model;

    class DatasLoginCount_M extends Model
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
         * 获取今日的登录次数
         * @return mixed
         */
        function todayNum()
        {
            $start_time = strtotime( date( 'Y-m-d' ) );
            $end_time = strtotime( date( 'Y-m-d' ) ) + 24 * 60 * 60;
            $sql = "SELECT SUM(login_count) as num FROM gms_analysis_login_count WHERE  create_time > ? AND create_time < ?";
            $this->db->execute( $sql , array( $start_time , $end_time ) );
            $r = $this->db->fetch();
            if ( !empty( $r['num'] ) )
                return $r['num'];

            return 0;
        }

        function listsByHours( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT
                SUM(login_count) AS loginCount,
                SUM(new_login_count) AS newLoginCount,
                SUM(old_login_count) AS oldLoginCount,
                create_time AS createDate
                FROM gms_analysis_login_count
                {$this->_condition}
                GROUP BY create_time
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
                SUM(login_count) AS loginCount,
                SUM(new_login_count) AS newLoginCount,
                SUM(old_login_count) AS oldLoginCount,
                create_date AS createDate
                FROM gms_analysis_login_count
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
                SUM(login_count) AS loginCount,
                SUM(new_login_count) AS newLoginCount,
                SUM(old_login_count) AS oldLoginCount,
                UNIX_TIMESTAMP(FROM_UNIXTIME(create_date,'%Y-%m-01')) AS createDate
                FROM gms_analysis_login_count
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