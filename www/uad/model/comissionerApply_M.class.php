<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/25
     * Time: 上午10:19
     */

    namespace uad\model;


    use core\Model;

    class ComissionerApply_M extends Model
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * 取得用户自己的最新一条奖励申请
         * @param $uid
         * @return mixed
         */
        function getLastApply( $uid )
        {
            $sql = "SELECT uid,state,comment FROM adm_comissioner_ratio_apply WHERE uid = ? ORDER BY  apply_time DESC LIMIT 0,1";
            $this->db->execute( $sql , array( $uid ) );

            return $this->db->fetch();
        }


        function save( $fields )
        {
            return $this->db->save( $fields , 'adm_comissioner_ratio_apply' );
        }
    }