<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/6
     * Time: 下午3:29
     */

    namespace gms\model;


    use core\Model;

    class DatasBaoxiangTable extends Model
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
            $sql = "SELECT *  FROM gms_analysis_baoxiang {$this->_condition}";
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