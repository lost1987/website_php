<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/13
     * Time: 15:11
     */

    namespace common\base;


    use common\XfModel;
    use core\RCache;

    /**
     * 平台游戏帮助
     * Class BaseGameHelp
     * @package common\base
     */
    class BaseGameHelp extends XfModel
    {
        /**
         * @var \core\RCache
         */
        protected $_rCahce = null;


        /**
         * @var \common\base\BaseGameHelp
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
                $sql = "SELECT * FROM xf_platform_base_game_help";
                $this->db->execute($sql);
                $list = $this->db->fetch_all();
                if(count($list) > 0)
                    $this->_rCache->map($key,$list);
                $list =  $this->_rCache->getMap($key,'id');
            }
            return $list;
        }

        function readByServerId($server_id){
            $lists = $this->lists();
            $returnHelp = false;
            foreach($lists as $id => $help){
                if($server_id == $help['server_id'])
                    $returnHelp = $help;
            }
            return $returnHelp;
        }

        function clear(){
            $key = $this->_rCache->createKey(__CLASS__,'lists');
            $this->_rCache->fuzzyClear($key);
        }
    }