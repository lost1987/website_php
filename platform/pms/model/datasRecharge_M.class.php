<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/4
     * Time: 上午10:43
     */

    namespace pms\model;


    use common\GmsModel;

    class DatasRecharge_M extends GmsModel
    {

        protected static $_instance = null;

        private $_condition = '';

        function listsByHours( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT
                SUM(recharge_num) AS rechargeNum,
                SUM(new_recharge_num) AS newRechargeNum,
                SUM(old_recharge_num) AS oldRechargeNum,
                SUM(recharge_count) AS rechargeCount,
                SUM(new_recharge_count) AS newRechargeCount,
                SUM(old_recharge_count) AS oldRechargeCount,
                SUM(recharge_money) AS rechargeMoney,
                SUM(new_recharge_money) AS newRechargeMoney,
                SUM(old_recharge_money) AS oldRechargeMoney,
                create_time AS createDate
                FROM gms_analysis_recharge
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
                SUM(recharge_num) AS rechargeNum,
                SUM(new_recharge_num) AS newRechargeNum,
                SUM(old_recharge_num) AS oldRechargeNum,
                SUM(recharge_count) AS rechargeCount,
                SUM(new_recharge_count) AS newRechargeCount,
                SUM(old_recharge_count) AS oldRechargeCount,
                SUM(recharge_money) AS rechargeMoney,
                SUM(new_recharge_money) AS newRechargeMoney,
                SUM(old_recharge_money) AS oldRechargeMoney,
                create_date AS createDate
                FROM gms_analysis_recharge
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
                SUM(recharge_num) AS rechargeNum,
                SUM(new_recharge_num) AS newRechargeNum,
                SUM(old_recharge_num) AS oldRechargeNum,
                SUM(recharge_count) AS rechargeCount,
                SUM(new_recharge_count) AS newRechargeCount,
                SUM(old_recharge_count) AS oldRechargeCount,
                SUM(recharge_money) AS rechargeMoney,
                SUM(new_recharge_money) AS newRechargeMoney,
                SUM(old_recharge_money) AS oldRechargeMoney,
                UNIX_TIMESTAMP(FROM_UNIXTIME(create_date,'%Y-%m-01')) AS createDate
                FROM gms_analysis_recharge
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

            if ( intval( $params['recharge_type'] ) > 0 ) {
                $this->_condition[] = " recharge_type = {$params['recharge_type']}";
            }

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }