<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/12/12
     * Time: 下午2:06
     */

    namespace pms\model;



    use common\XfModel;

    class SystemMessage_M extends XfModel
    {

        protected static $_instance = null;

        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT * FROM xf_platform_system_messages  ORDER BY pri DESC,id DESC  $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }


        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM xf_platform_system_messages";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch()['num'];
        }

        function save( $contents,$server_id,$pri=1 )
        {
            $sql = "INSERT INTO xf_platform_system_messages (content,msg_time,state,pri,server_id) VALUES ";
            $time = time();
            $sql .= " ('$contents','$contents',$time,1,$pri,$server_id) ";

            return $this->db->execute( $sql );
        }

        function del( $id )
        {
            $sql = "DELETE FROM xf_platform_system_messages WHERE id = ?";
            return $this->db->execute( $sql , array( $id ) );
        }
    }