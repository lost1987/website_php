<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/5/4
     * Time: 上午10:02
     */

    namespace pms\model;



    use common\XfModel;

    class PayMentOrder_M extends XfModel
    {

        protected static $_instance = null;

        private $_condition = '';

        /**
         * 获取所有的充值人数
         * @return mixed
         */
        function rechargeNum()
        {
            $sql = "SELECT COUNT(DISTINCT(user_id)) as num FROM xf_payment_order WHERE status = 1";
            $this->db->execute( $sql );

            return $this->db->fetch()['num'];
        }

        /**
         * 获取所有的充值金额
         * @return mixed
         */
        function rechargeTotal()
        {
            $sql = "SELECT SUM(money) as money FROM xf_payment_order WHERE status = 1";
            $this->db->execute( $sql );

            return $this->db->fetch()['money'];
        }

        function lists($start=null,$count=null){
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT * FROM xf_payment_order  {$this->_condition}  ORDER BY create_at DESC $limit ";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }

        function totalMoney(){
            $sql = "SELECT SUM(money) as money  FROM xf_payment_order {$this->_condition}";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch()['money'];
        }

        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM xf_payment_order {$this->_condition}";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch()['num'];
        }

        /**
         * @param array $cond
         */
        function set_condition( $params )
        {
            $this->_condition = array();

            $this->_condition[] = ' status = 1 ';

            if(!empty($params['start_time']))
                $this->_condition[] =  " create_at  >= '{$params['start_time']}'";

            if(!empty($params['end_time']))
                $this->_condition[] =  " create_at  <= '{$params['end_time']}'";

            if(!empty($params['user_id']))
                $this->_condition[] =  " user_id  = {$params['user_id']}";

            if(!empty($params['platform']))
                $this->_condition[] =  " order_no like '{$params['platform']}%'";

            if(!empty($params['order_no']))
                $this->_condition[] =  " order_no =  '{$params['order_no']}'";

            if(!empty($params['serial_number']))
                $this->_condition[] =  " serial_number =  '{$params['serial_number']}'";

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }