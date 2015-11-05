<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/7
     * Time: 下午5:01
     */

    namespace pms\model;



    use common\XfModel;

    class Suspend_M extends XfModel
    {

        protected static $_instance = null;

        private $_condition = '';

        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT a.*,b.reporter_name,b.assign_to,b.result,b.handler_type,b.handle_time  FROM xf_index_usersuspend a   LEFT JOIN xf_index_handleresult b ON a.handler_id = b.id  {$this->_condition} ORDER BY a.create_at DESC $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }

        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM xf_index_usersuspend a  LEFT JOIN xf_index_handleresult b ON a.handler_id = b.id {$this->_condition}";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch()['num'];
        }

        function set_condition( $params )
        {
            $this->_condition = array();

            if ( !empty( $params['reporter_name'] ) )
                $this->_condition[] = " b.reporter_name = '{$params['reporter_name']}' ";

            if ( intval( $params['result'] ) > - 1 && $params['result'] !== null )
                $this->_condition[] = " b.result = {$params['result']} ";

            if ( !empty( $params['start_time'] ) )
                $this->_condition[] = " a.create_at >= '{$params['start_time']}' ";

            if ( !empty( $params['end_time'] ) )
                $this->_condition[] = " a.create_at <= '{$params['end_time']}' ";

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }


        function read( $id )
        {
            $sql = "SELECT * FROM xf_index_usersuspend WHERE id  = ?";
            $this->db->execute( $sql , array( $id ) );

            return $this->db->fetch();
        }
    }