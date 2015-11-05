<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/11
     * Time: 上午10:03
     */

    namespace gms\model;


    use gms\core\XfModel;

    class StoreProducts_M extends XfModel
    {

        private static $_instance = null;

        private $_condition = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function read( $product_id )
        {
            $sql = "SELECT * FROM xf_store_products WHERE id = ?";
            $this->db->execute( $sql , array( $product_id ) );

            return $this->db->fetch();
        }

        function save( $fields )
        {
            return $this->db->save( $fields , 'xf_store_products' );
        }

        function del( $id )
        {
            $sql = "DELETE FROM xf_store_productorder WHERE product_id = ? ;DELETE FROM xf_store_products  WHERE id = ?";

            return $this->db->execute( $sql , array( $id , $id ) );
        }

        function update( $fields , $id )
        {
            return $this->db->update( $fields , 'xf_store_products' , " WHERE id=$id" );
        }

        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT * FROM xf_store_products  {$this->_condition}  $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }

        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM  xf_store_products  {$this->_condition}";
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

            if ( !empty( $params['name'] ) )
                $this->_condition[] = " name like '{$params['name']}%' ";

            if ( intval( $params['product_type'] ) > - 1 && $params['product_type'] !== null )
                $this->_condition[] = " product_type = {$params['product_type']} ";

            if ( intval( $params['is_top'] ) > - 1 && $params['is_top'] !== null )
                $this->_condition[] = " is_top = {$params['is_top']} ";

            if ( intval( $params['is_promote'] ) > - 1 && $params['is_promote'] !== null )
                $this->_condition[] = " is_promote = {$params['is_promote']} ";

            if ( intval( $params['is_visible'] ) > - 1 && $params['is_visible'] !== null )
                $this->_condition[] = " is_visible = {$params['is_visible']} ";

            if ( intval( $params['category_id'] ) > - 1 && $params['category_id'] !== null )
                $this->_condition[] = " category_id = {$params['category_id']} ";

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }

        function lottery_lists()
        {
            $sql = "SELECT * FROM xf_store_products WHERE category_id = 4";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }

    }