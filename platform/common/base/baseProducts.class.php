<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/23
     * Time: 上午9:49
     */

    namespace common\base;


    use common\XfModel;
    use core\RCache;

    /**
     * 平台商品
     * Class BaseProducts
     * @package common\base
     */
    class BaseProducts extends XfModel
    {

        const MONETARY = 1;//普通的道具兑换

        const REAL = 2;//实物兑换

        /**
         * @var RCache|null
         */
        protected $_rCahce = null;

        /**
         * @var \common\base\BaseItems
         */
        protected static $_instance = null;

        function __construct(){
            parent::__construct();
            $this->_rCache = RCache::instance($this->redis);
        }

        function read($product_id){
                $list = $this->lists();
                return $list[$product_id];
        }

        function readByServerId($server_id){
            $products = array();
            $list = $this->lists();
            foreach($list as $product){
                    if($product['server_id'] == $server_id)
                        $products[] = $product;
            }
            return $products;
        }

        function lists(){
            $key = $this->_rCache->createKey(__CLASS__,__FUNCTION__);
            $list =  $this->_rCache->getMap($key,'id');
            if(empty($list)){
                $sql = "SELECT * FROM xf_platform_store_products WHERE visible = 1 ORDER BY squeue ASC";
                $this->db->execute($sql);
                $list = $this->db->fetch_all();
                if(count($list) > 0)
                    $this->_rCache->map($key,$list);
                $list =  $this->_rCache->getMap($key,'id');
            }
            return $list;
        }

        function clear(){
            $key = $this->_rCache->createKey(__CLASS__,'lists');
            $this->_rCache->fuzzyClear($key);
        }
    }