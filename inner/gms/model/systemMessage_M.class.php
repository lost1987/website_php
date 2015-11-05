<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/12/12
     * Time: 下午2:06
     */

    namespace gms\model;


    use gms\core\XfModel;

    class SystemMessage_M extends XfModel
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT * FROM xf_system_messages  ORDER BY pri DESC,id DESC  $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }


        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM xf_system_messages";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch()['num'];
        }

        function save( $contents,$pri=1 )
        {
            $sql = "INSERT INTO xf_system_messages (title,content,msg_time,publish_time,expire_time,state,handler_id,pri) VALUES ";
            $time = time();
            $sql .= " ('$contents','$contents',$time,$time,$time,1,1,$pri) ";

            return $this->db->execute( $sql );
        }

        function del( $id )
        {
            $sql = "DELETE FROM xf_system_messages WHERE id = ?";
            return $this->db->execute( $sql , array( $id ) );
        }
    }