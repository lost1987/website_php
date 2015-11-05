<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/10
     * Time: 下午4:11
     */

    namespace gms\model;


    use gms\core\XfModel;
    use gms\libs\Error;

    class StoreCategory_M extends XfModel
    {

        private static $_instance = null;

        private $_condition = '';

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function read( $product_id )
        {
            $sql = "SELECT * FROM xf_store_category WHERE id = ?";
            $this->db->execute( $sql , array( $product_id ) );

            return $this->db->fetch();
        }

        function save( $fields )
        {
            return $this->db->save( $fields , 'xf_store_category' );
        }

        function del( $id )
        {
            //先判断商品表里 是否有关联数据
            $sql = "SELECT COUNT(*)  as  num FROM xf_store_products WHERE category_id = $id";
            $this->db->execute( $sql );
            $result = $this->db->fetch()['num'];
            if ( $result > 0 )
                throw new \Exception( Error::DATA_REFERENCE );

            $sql = "DELETE FROM xf_store_category  WHERE id = ?";

            return $this->db->execute( $sql , array( $id ) );
        }

        function update( $fields , $id )
        {
            return $this->db->update( $fields , 'xf_store_category' , " WHERE id=$id" );
        }


        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT * FROM xf_store_category {$this->_condition} $limit ";
            $this->db->execute( $sql );
            $this->_condition = '';
            $result_array = $this->db->fetch_all();
            $array = array();
            foreach ( $result_array as $k => $v ) {
                $array[ $v['id'] ] = $v;
            }
            unset( $result_array );

            return $array;
        }


        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM  xf_store_category  {$this->_condition}";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch()['num'];
        }

    }