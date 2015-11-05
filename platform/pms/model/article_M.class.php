<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/2/2
     * Time: 下午4:52
     */

    namespace pms\model;


    use common\PmsModel;

    class Article_M extends PmsModel
    {

        protected static $_instance = null;

        private $_condition = '';

        function save( $fields )
        {
            $this->db->save( $fields , 'pms_articles' );

            return $this->db->insert_id();
        }

        function update( $fields , $id )
        {
            return $this->db->update( $fields , 'pms_articles' , 'WHERE id=' . $id );
        }


        function read( $id )
        {
            $sql = "SELECT * FROM pms_articles WHERE id = ? ";
            $this->db->execute( $sql , array( $id ) );

            return $this->db->fetch();
        }

        function del( $id )
        {
            $sql = "DELETE FROM pms_articles WHERE id = ?";

            return $this->db->execute( $sql , array( $id ) );
        }

        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT a.*,b.category_name FROM pms_articles  a LEFT JOIN pms_articles_category b ON a.category_id = b.id   {$this->_condition} ORDER BY publish_time DESC $limit ";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }


        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM pms_articles {$this->_condition}";
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