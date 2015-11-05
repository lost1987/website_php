<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/3
     * Time: 下午2:49
     */

    namespace gms\model;


    use core\Model;

    class DatasVigorous_M extends Model
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
         * 取得今日的活跃用户
         * @return mixed
         */
        function todayNum()
        {
            $start_time = strtotime( date( 'Y-m-d' ) );
            $end_time = strtotime( date( 'Y-m-d' ) ) + 24 * 60 * 60;
            $sql = "SELECT SUM(vigorous_num) as num FROM gms_analysis_vigorous WHERE  create_time > ? AND create_time < ?";
            $this->db->execute( $sql , array( $start_time , $end_time ) );
            $r = $this->db->fetch();
            if ( !empty( $r['num'] ) )
                return $r['num'];

            return 0;
        }

        /**
         * 按渠道取$start_time到$end_time的总数据
         * @param int $start_time
         * @param int $end_time
         * @param int $platform 渠道
         */
        function NumByPlatform( $start_time , $end_time , $platform )
        {
            $sql = "SELECT
               SUM(vigorous_num) AS vigorousNum
               FROM gms_analysis_vigorous
               WHERE create_time >= ? AND create_time <= ? AND platform_type = ?
               ";
            $this->db->execute( $sql , array( $start_time , $end_time , $platform ) );
            $r = $this->db->fetch();
            if ( !empty( $r['vigorousNum'] ) )
                return $r['vigorousNum'];

            return 0;
        }

        function listsByHours( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT
                SUM(vigorous_num) AS vigorousNum,
                SUM(new_vigorous_num) AS newVigorousNum,
                SUM(old_vigorous_num) AS oldVigorousNum,
                create_time AS createDate
                FROM gms_analysis_vigorous
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
                SUM(vigorous_num) AS vigorousNum,
                SUM(new_vigorous_num) AS newVigorousNum,
                SUM(old_vigorous_num) AS oldVigorousNum,
                create_date AS createDate
                FROM gms_analysis_vigorous
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
                SUM(vigorous_num) AS vigorousNum,
                SUM(new_vigorous_num) AS newVigorousNum,
                SUM(old_vigorous_num) AS oldVigorousNum,
                UNIX_TIMESTAMP(FROM_UNIXTIME(create_date,'%Y-%m-01')) AS createDate
                FROM gms_analysis_vigorous
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