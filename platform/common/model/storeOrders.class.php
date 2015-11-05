<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/30
     * Time: 下午4:15
     */

    namespace common\model;


    use common\XfModel;

    class StoreOrders extends XfModel
    {
        protected static $_instance = null;

        private $_condition = '';

        function read( $order_no )
        {
            $sql = "SELECT * FROM xf_platform_store_orders  WHERE order_no = ?";
            $this->db->execute( $sql , array( $order_no ) );

            return $this->db->fetch();
        }

        function readByID($id){
            $sql = "SELECT * FROM xf_platform_store_orders  WHERE id = ?";
            $this->db->execute( $sql , array( $id ) );

            return $this->db->fetch();
        }

        function save( $fields )
        {
            return $this->db->save( $fields , 'xf_platform_store_orders' );
        }


        function update( $fields , $id )
        {
            return $this->db->update( $fields , 'xf_platform_store_orders' , " WHERE id=$id" );
        }

        function lists( $start = null , $count = null )
        {
            if($start !== null && $count !== null){
                $limit = " limit $start,$count";
            }
            $sql = "SELECT a.*,b.product_name,b.product_type,c.login_name,c.nickname FROM xf_platform_store_orders a LEFT JOIN xf_platform_store_products b ON a.product_id = b.id LEFT JOIN xf_user c ON a.user_id = c.user_id {$this->_condition} ORDER BY a.create_time DESC $limit";
            $this->db->execute($sql);
            $this->_condition = '';
            return $this->db->fetch_all();
        }

        function numRows()
        {
            $sql = "SELECT COUNT(*) as num FROM xf_platform_store_orders a LEFT JOIN xf_platform_store_products b ON a.product_id = b.id LEFT JOIN xf_user c ON a.user_id = c.user_id {$this->_condition}";
            $this->db->execute($sql);
            $this->_condition = '';
            return $this->db->fetch()['num'];
        }

        /**
         * @param array $cond
         */
        function setCondition( $params )
        {
            $this->_condition = array();

            if(!empty($params['user_id']))
                $this->_condition[] = " a.user_id = {$params['user_id']} ";

            if(!empty($params['server_id']))
                $this->_condition[] = " a.server_id = {$params['server_id']}";

            if(intval($params['product_type']) > 0)
                $this->_condition[] = " b.product_type = {$params['product_type']}";

            if( $params['state'] != ''){
                $this->_condition[] = " a.state = {$params['state']}";
            }

            if(!empty($params['login_name']))
                $this->_condition[] = " c.login_name = '{$params['login_name']}' ";

            if(!empty($params['start_timestamp']) && !empty($params['end_timestamp']))
                $this->_condition[] = "a.create_time >= {$params['start_timestamp']} and a.create_time <= {$params['end_time']} ";

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }