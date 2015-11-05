<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/4
     * Time: 下午2:33
     */

    namespace gms\model;


    use core\Model;

    class DatasDiamondTable_M extends Model
    {

        private static $_instance = null;

        private $_condition = '';

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function lists(){
            $sql = "SELECT table_num,chi_change,create_time as createDate  FROM gms_analysis_diamond_table {$this->_condition}";
            $this->db->execute($sql);
            return $this->db->fetch_all();
        }

        function listsByDays(){
            $sql = "SELECT
                    SUM(table_num) as table_num,
                    SUM(chi_change) as chi_change,
                   UNIX_TIMESTAMP(FROM_UNIXTIME(create_time,'%Y/%m/%d')) AS createDate
                    FROM    gms_analysis_diamond_table {$this->_condition}
                    GROUP BY FROM_UNIXTIME(create_time,'%Y/%m/%d') ";
            $this->db->execute($sql);
            return $this->db->fetch_all();
        }

        /**
         * @param string precision
         */
        function set_condition( $start_time,$end_time )
        {
            $this->_condition = array();

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