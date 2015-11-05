<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/13
     * Time: 14:35
     */

    namespace common\base;


    use common\XfModel;
    use core\RCache;

    /**
     * 平台游戏公告
     * Class BaseGameAnnouncement
     * @package common\base
     */
    class BaseGameAnnouncement extends XfModel
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
                    $sql = "SELECT * FROM xf_platform_base_game_announcement ORDER BY squeue ASC";
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
                $announces = array();
                foreach($lists as $id => $announce){
                        if($server_id == $announce['server_id'])
                            $announces[] = $announce;
                }
                return $announces;
            }

            function clear(){
                $key = $this->_rCache->createKey(__CLASS__,'lists');
                $this->_rCache->fuzzyClear($key);
            }
    }