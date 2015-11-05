<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/26
     * Time: 10:41
     */

    namespace pms\model;


    use common\PmsModel;

    class StoreOrdersLog_M extends PmsModel
    {
        protected static $_instance = null;

        function read($order_id){
            $sql = "SELECT a.*,b.nickname FROM pms_store_orders_log a LEFT JOIN pms_core_admin b ON a.admin_id = b.id WHERE a.order_id = ?";
            $this->db->execute($sql,array($order_id));
            return $this->db->fetch();
        }

    }