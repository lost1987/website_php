<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/21
     * Time: 上午10:57
     */

    namespace dhmanager\model;


    use core\Base;

    class ExcodeModel extends Base
    {
        private static $_instance = null;

        /**
         * @return  \dhmanager\model\ExcodeModel
         */
        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( null !== $start && null !== $count ) {
                $limit = " limit $start,$count ";
            }
            $sql = "SELECT * FROM dh_excode WHERE state = 0  ORDER BY  create_time DESC $limit";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }

        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM dh_excode WHERE state = 0";
            $this->db->execute( $sql );

            return $this->db->fetch()['num'];
        }

        function readByID($id){
            $sql = "SELECT * FROM dh_excode WHERE id = ?";
            $this->db->execute($sql,array($id));
            return $this->db->fetch();
        }

        function readByCode($excode){
            $sql = "SELECT * FROM dh_excode WHERE excode = ?";
            $this->db->execute($sql,array($excode));
            return $this->db->fetch();
        }


        function del($id){
            $sql = "DELETE  FROM dh_excode WHERE id = ?";
            return $this->db->execute($sql,array($id));
        }

        function save($fields){
            return $this->db->save($fields,'dh_excode');
        }

        function update($fields,$id){
            return $this->db->update($fields,'dh_excode'," WHERE id = $id ");
        }
    }