<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/29
     * Time: 下午4:49
     */

    namespace pms\model;



    use common\PmsModel;

    class AdminModule_M extends PmsModel
    {
        protected static $_instance = null;

        /**
         * 通过管理员ID获得模块权限列表
         */
        function get_list_by_admin_id( $admin_id )
        {
            $sql = "SELECT * FROM pms_core_admin_module WHERE admin_id = ?";
            $this->db->execute( $sql , array( $admin_id ) );

            return $this->db->fetch_all();
        }

        function read( $id )
        {
            $sql = "SELECT * FROM pms_core_admin_module WHERE id = ?";
            $this->db->execute( $sql , array( $id ) );

            return $this->db->fetch();
        }

        function get_admin_module_by_admin_id( $admin_id , $module_id )
        {
            $sql = "SELECT * FROM pms_core_admin_module WHERE admin_id = ? and module_id = ?";
            $this->db->execute( $sql , array( $admin_id , $module_id ) );

            return $this->db->fetch();
        }

        function save( $fields )
        {
            return $this->db->save( $fields , 'pms_core_admin_module' );
        }

        function update( $fields , $id )
        {
            return $this->db->update( $fields , 'pms_core_admin_module' , "WHERE id = $id" );
        }

        function del_by_admin_id( $admin_id )
        {
            $sql = "DELETE FROM pms_core_admin_module WHERE admin_id = ?";

            return $this->db->execute( $sql , array( $admin_id ) );
        }
    }