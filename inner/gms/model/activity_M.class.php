<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/20
     * Time: 下午3:04
     */

    namespace gms\model;


    use gms\core\XfModel;

    class Activity_M extends XfModel
    {

        private static $_instance = null;

        private $_condition = '';

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function save( $fields )
        {
            $this->db->save( $fields , 'xf_activities' );

            return $this->db->insert_id();
        }

        function update( $fields , $id )
        {
            return $this->db->update( $fields , 'xf_activities' , 'WHERE id=' . $id );
        }


        function read( $id )
        {
            $sql = "SELECT * FROM xf_activities WHERE id = ? ";
            $this->db->execute( $sql , array( $id ) );

            return $this->db->fetch();
        }

        function del( $id )
        {
            $sql = "DELETE FROM xf_activities WHERE id = ?";

            return $this->db->execute( $sql , array( $id ) );
        }

        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT * FROM xf_activities  {$this->_condition}  ORDER BY publish_time DESC $limit ";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }


        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM xf_activities {$this->_condition}";
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

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }