<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/20
     * Time: 下午3:04
     */

    namespace pms\model;



    use common\XfModel;

    class Activity_M extends XfModel
    {

        protected static $_instance = null;

        private $_condition = '';

        function save( $fields )
        {
            $this->db->save( $fields , 'xf_platform_activities' );

            return $this->db->insert_id();
        }

        function update( $fields , $id )
        {
            return $this->db->update( $fields , 'xf_platform_activities' , 'WHERE id=' . $id );
        }


        function read( $id )
        {
            $sql = "SELECT * FROM xf_platform_activities WHERE id = ? ";
            $this->db->execute( $sql , array( $id ) );

            return $this->db->fetch();
        }

        function del( $id )
        {
            $sql = "DELETE FROM xf_platform_activities WHERE id = ?";

            return $this->db->execute( $sql , array( $id ) );
        }

        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT * FROM xf_platform_activities  {$this->_condition}  ORDER BY create_time DESC $limit ";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }


        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM xf_platform_activities {$this->_condition}";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch()['num'];
        }

        /**
         * @param array $cond
         */
        function set_condition( $params )
        {
            $this->_condition = array();

            $this->_condition[] = " server_id = {$params['server_id']} ";

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }