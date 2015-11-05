<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/16
     * Time: 09:39
     */

    namespace common\base;


    use common\XfModel;
    use core\RCache;

    /**
     * 平台大厅公告
     * Class BaseHallAnnouncement
     * @package common\base
     */
    class BaseHallAnnouncement extends XfModel
    {
        /**
         * @var \core\RCache
         */
        protected $_rCahce = null;


        /**
         * @var \common\base\BaseGameAnnouncement
         */
        protected static $_instance = null;

        function __construct(){
            parent::__construct();
            $this->_rCache = RCache::instance($this->redis);
        }


        function lists(){
            $key = $this->_rCache->createKey(__CLASS__,__FUNCTION__);
            $list =  $this->_rCache->getMap($key,'id');
            if(empty($list)){
                $sql = "SELECT * FROM xf_platform_base_hall_announcement ORDER BY id ASC";
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