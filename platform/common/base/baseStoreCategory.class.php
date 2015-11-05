<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/23
     * Time: 上午11:26
     */

    namespace common\base;


    use common\XfModel;
    use core\RCache;

    /**
     * 平台游戏栏目
     * Class BaseStoreCategory
     * @package common\base
     */
    class BaseStoreCategory extends XfModel
    {

        /**
         * @var RCache|null
         */
        protected $_rCache = null;

        protected static $_instance = null;

        function __construct(){
            parent::__construct();
            $this->_rCache = RCache::instance($this->redis);
        }

        function read($product_id){
            $products = $this->lists();
            return !empty($products[$product_id]) ? $products[$product_id] : null;
        }

        function lists(){
            $key = $this->_rCache->createKey(__CLASS__,__FUNCTION__);
            $list =  $this->_rCache->getMap($key,'id');
            if(empty($list)){
                $sql = "SELECT * FROM xf_platform_store_category";
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