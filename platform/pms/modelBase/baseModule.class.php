<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/22
     * Time: 上午11:46
     */

    namespace pms\modelBase;


    use core\RCache;
    use core\Singleton;

    class BaseModule extends Singleton
    {

        /**
         * @var RCache|null
         */
        protected $_rCache = null;

        protected static $_instance = null;

        function __construct(){
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
                $sql = "SELECT * FROM pms_core_module ORDER BY orders ASC";
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