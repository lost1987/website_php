<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/2/28
     * Time: 上午11:48
     */

    namespace pms\model;


    use common\GmsModel;

    class DatasLoginNum_M extends GmsModel
    {

        protected static $_instance = null;

        private $_condition = '';

        function listsByHours( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT
                SUM(login_num) AS loginNum,
                SUM(new_login_num) AS newLoginNum,
                SUM(old_login_num) AS oldLoginNum,
                SUM(regress_num) AS regressNum,
                create_time AS createDate
                FROM gms_analysis_login_num
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
                SUM(login_num) AS loginNum,
                SUM(new_login_num) AS newLoginNum,
                SUM(old_login_num) AS oldLoginNum,
                SUM(regress_num) AS regressNum,
                create_date AS createDate
                FROM gms_analysis_login_num
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
                SUM(login_num) AS loginNum,
                SUM(new_login_num) AS newLoginNum,
                SUM(old_login_num) AS oldLoginNum,
                SUM(regress_num) AS regressNum,
                UNIX_TIMESTAMP(FROM_UNIXTIME(create_date,'%Y-%m-01')) AS createDate
                FROM gms_analysis_login_num
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