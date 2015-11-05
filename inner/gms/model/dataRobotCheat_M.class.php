<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/5/13
     * Time: 上午11:36
     */

    namespace gms\model;


    use core\Model;

    class DataRobotCheat_M extends Model
    {

        private static $_instance = null;

        private $_condition = '';

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function lists(Array $fields)
        {
            //coins,nums,online,tablelv1,tablelv2,tablelv3,cheat_rate_lv1,cheat_rate_lv2,cheat_rate_lv3
            $fields = implode(',',$fields);
            $sql = "SELECT $fields,FROM_UNIXTIME(create_time,'%Y-%m-%d %H:%i:%s') as create_time  FROM gms_analysis_robot_coins {$this->_condition}";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }

        function listsByHour(Array $fields)
        {
            //SUM(coins) as coins,SUM(nums) as nums,SUM(tablelv1) as tablelv1,SUM(tablelv2) as tablelv2,SUM(tablelv3) as tablelv3,
            //SUM(cheat_rate_lv1) as cheat_rate_lv1 ,SUM(cheat_rate_lv2) as cheat_rate_lv2,SUM(cheat_rate_lv3) as cheat_rate_lv3
            $fields = implode(',',$fields);
            $sql = "SELECT $fields,FROM_UNIXTIME(create_time,'%Y-%m-%d %H:00:00') as create_time  FROM gms_analysis_robot_coins {$this->_condition} GROUP BY  FROM_UNIXTIME(create_time,'%Y-%m-%d %H')";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }

        /**
         * 获取最新的一条数据
         */
        function lastOne()
        {
            $sql = "SELECT * FROM gms_analysis_robot_coins ORDER BY create_time DESC LIMIT 1";
            $this->db->execute( $sql );

            return $this->db->fetch();
        }

        /**
         * @param string precision
         */
        function set_condition( $precision )
        {
            $this->_condition = array();

            if ( $precision == 'minute' ) {
                $end_time = time();
                $start_time = $end_time - 60 * 60 * 24;
            } else {
                $end_time = time();
                $start_time = strtotime( date( 'Y-m-d' ) );
            }

            $this->_condition[] = " create_time >= $start_time ";
            $this->_condition[] = " create_time <= $end_time ";

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }