<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-9-19
     * Time: 上午9:58
     */

    namespace common\model;


    use core\Model;

    class ProductOrderModel extends Model
    {
        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * 联表查询 store_product_order 和 store_products
         * @param $uid
         */
        function read( $uid , $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null ) {
                $limit = " LIMIT $start,$count";
            }
            $sql = "SELECT  a.id,a.create_at,a.product_name,a.cost_info,a.get_info, b.name,c.result FROM xf_store_productorder a LEFT JOIN xf_store_products b ON a.product_id = b.id LEFT JOIN xf_index_handleresult c  ON a.handler_id = c.id WHERE user_id = ? and b.category_id <> 4 order by a.id DESC $limit ";
            $this->db->execute( $sql , array( $uid ) );

            return $this->db->fetch_all();
        }

        function read_num_rows( $uid )
        {
            $sql = "SELECT count(*) as num FROM xf_store_productorder a LEFT JOIN xf_store_products b ON a.product_id = b.id WHERE a.user_id = ? AND b.category_id <> 4 ";
            $this->db->execute( $sql , array( $uid ) );

            return $this->db->fetch()['num'];
        }

        /**
         * 读取用户兑换过的实物商品
         */
        function read_physical($uid){
            $sql = "SELECT product_name,product_pic,count(product_id) as num FROM xf_store_productorder WHERE product_id IN (SELECT id FROM xf_store_products WHERE category_id  = 3) AND user_id = ? GROUP BY product_name";
            $this->db->execute($sql,array($uid));

            return $this->db->fetch_all();
        }


        /**
         * 联表查询 store_product_order 和 store_products
         * @param $uid
         */
        function readByOrderId( $orderid )
        {
            $sql = "SELECT  a.id,a.product_id,a.create_at,a.name as realname,a.mobile,a.address,a.handler_id,a.product_name,a.cost_info,a.get_info,b.name,b.tool,b.tool_type,b.price,b.price_type,c.result,c.handler_type FROM xf_store_productorder a LEFT JOIN xf_store_products b ON a.product_id = b.id LEFT JOIN  xf_index_handleresult c ON a.handler_id = c.id  WHERE a.id = ?";
            $this->db->execute( $sql , array( $orderid ) );

            return $this->db->fetch();
        }

        /**
         * 通过主键ID获取一条数据
         * @param $id
         * @return mixed
         */
        function readById( $id )
        {
            $sql = "SELECT * FROM xf_store_productorder WHERE id = ?";
            $this->db->execute( $sql , array( $id ) );

            return $this->db->fetch();
        }


        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT  $start,$count";
            $sql = "SELECT * FROM xf_store_productorder  ORDER BY create_at DESC $limit";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }


        function update( Array $fields , $id )
        {
            return $this->db->update( $fields , 'xf_store_productorder' , 'WHERE id = ' . $id );
        }

        function save( Array $fields )
        {
            return $this->db->save( $fields , 'xf_store_productorder' );
        }

    }