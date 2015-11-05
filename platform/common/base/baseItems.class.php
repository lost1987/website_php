<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/18
     * Time: 下午2:45
     */

    namespace common\base;


    use common\XfModel;
    use core\RCache;

    /**
     * 平台游戏物品
     * Class BaseItems
     * @package common\base
     */
    class BaseItems extends XfModel
    {
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

        function lists(){
            $key = $this->_rCache->createKey(__CLASS__,__FUNCTION__);
            $list =  $this->_rCache->getMap($key,'item_id');
            if(empty($list)){
                $sql = "SELECT * FROM xf_platform_base_items";
                $this->db->execute($sql);
                $list = $this->db->fetch_all();
                if(count($list) > 0)
                    $this->_rCache->map($key,$list);
                $list =  $this->_rCache->getMap($key,'item_id');
            }
            return $list;
        }

        function read($server_id){
             $item_start_id = $server_id * 10000;
             $item_end_id = $item_start_id+9999;

            $items = $this->lists();
            $serverItems = array();
            foreach($items as $item_id => $data){
                    if(intval($item_id) >= $item_start_id && intval($item_id) <= $item_end_id)
                        $serverItems[$item_id] = $data;
            }
            return $serverItems;
        }

        function clear(){
            $key = $this->_rCache->createKey(__CLASS__,'lists');
            $this->_rCache->fuzzyClear($key);
        }
    }