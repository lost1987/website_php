<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/24
     * Time: 上午10:47
     */

    namespace pms\model;



    use common\XfModel;

    class PurchaseProfile_M extends XfModel
    {

        protected static $_instance = null;

        function update( $fields , $user_id )
        {
            return $this->db->update( $fields , 'xf_purchaseprofile' , " WHERE user_id=$user_id" );
        }
    }