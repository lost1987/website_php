<?php

    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/17
     * Time: 上午9:23
     */
    namespace common\base;

    use common\XfModel;
    use core\RCache;

    /**
     * 平台服务器
     * Class BaseServers
     * @package common\base
     */
    class BaseServers extends XfModel
    {

        /**
         * @var \core\RCache|null
         */
        protected $_rCache = null;

        /**
         * @var \common\base\BaseServers
         */
        protected static $_instance = null;

        function __construct(){
                parent::__construct();
                $this->_rCache = RCache::instance($this->redis);
        }

        function read($server_id){
            $servers = $this->lists();
            return !empty($servers[$server_id]) ? $servers[$server_id] : null;
        }

        function lists(){
                $key = $this->_rCache->createKey(__CLASS__,__FUNCTION__);
                $list =  $this->_rCache->getMap($key,'id');
                if(empty($list)){
                    $sql = "SELECT * FROM xf_platform_base_servers WHERE visible = 1 ORDER BY squeue ASC";
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