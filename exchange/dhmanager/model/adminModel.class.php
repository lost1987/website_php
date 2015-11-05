<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/11
     * Time: 上午11:32
     */

    namespace dhmanager\model;


    use core\Model;

    class AdminModel extends Model
    {

        private static $_instance = null;

        /**
         * @return \dhmanager\model\AdminModel
         */
        static function instance(){
            if(self::$_instance == null)
                self::$_instance = new self;
            return self::$_instance;
        }

        function lists($start = null ,$count = null){
                $limit = '';
                if(null !== $start && null !== $count){
                    $limit =  " limit $start,$count ";
                }
                $sql = "SELECT * FROM dh_admin WHERE is_administrator = 0  $limit";
                $this->db->execute($sql);
                return $this->db->fetch_all();
        }

        function num_rows(){
            $sql = "SELECT COUNT(*) as num FROM dh_admin ";
            $this->db->execute($sql);
            return $this->db->fetch()['num'];
        }

        function read($account,$fieldNames = null){
            return $this->db->one('dh_admin'," where account = '$account ' ",$fieldNames);
        }

        function readByID($id,$fieldNames = null){
            return $this->db->one('dh_admin'," where id = $id ",$fieldNames);
        }

        function del($id){
                $sql = "DELETE FROM dh_admin WHERE id = ?";
                return $this->db->execute($sql,array($id));
        }
    }