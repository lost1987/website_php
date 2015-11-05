<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/5/29
     * Time: 下午2:16
     */

    namespace common;


    use core\Base;
    use core\Redis;
    use utils\Arrays;

    /**
     * Class ResourceManager 玩家的资源属性管理 负责扣除和增加玩家的资源属性 如金币,门票等等,
     * 注意 钻石处理除外
     * @package common
     */
    class ResourceManager extends Base
    {

        private static $_instance = null;

        private $_targetIDs = null;

        /**
         * @return \common\ResourceManager
         */
        static function instance()
        {
            if ( self::$_instance == null ) {
                self::$_instance = new self;
            }

            return self::$_instance;
        }

        function __construct()
        {
            $this->_targetIDs = $this->config->common['tool_type'];
        }


        /**
         * 设置用户资源 , 并返回用户增加物品后的物品类型数组和物品类型数量数组
         * @param int    $target              物品类型/ID
         * @param int    $targetNum           物品数量
         * @param string $sourceCollection    用户拥有的物品类型数组
         * @param string $sourceNumCollection 用户拥有的物品类型数量数组
         */
        function setResource( $target , $targetNum , &$sourceCollection , &$sourceNumCollection){

            if ( array_key_exists( $target , $this->_targetIDs ) ) {

                if ( empty( $sourceCollection ) || empty( $sourceNumCollection ) )
                    return false;

                $sourceCollection = explode( ',' , $sourceCollection );
                $sourceNumCollection = explode( ',' , $sourceNumCollection );

                $targetIdx = Arrays::array_toggle_fetch_value( $target , $sourceCollection );
                if ( $targetIdx === null ) {
                    $sourceCollection[] = $target;
                    $sourceNumCollection[] = $targetNum;
                } else {
                    $sourceNumCollection[ $targetIdx ] = $targetNum;
                }

                $sourceCollection = implode( ',' , $sourceCollection );
                $sourceNumCollection = implode( ',' , $sourceNumCollection );
            } else
                throw new \Exception ( 'target id is not exist' );

            return $this;
        }

        /**
         * 给用户增加资源 , 并返回用户增加物品后的物品类型数组和物品类型数量数组
         * @param int    $target              物品类型/ID
         * @param int    $targetNum           物品数量
         * @param string $sourceCollection    用户拥有的物品类型数组
         * @param string $sourceNumCollection 用户拥有的物品类型数量数组
         */
        function addResource( $target , $targetNum , &$sourceCollection , &$sourceNumCollection )
        {

            if ( array_key_exists( $target , $this->_targetIDs ) ) {

                if ( empty( $sourceCollection ) || empty( $sourceNumCollection ) )
                    return false;

                $sourceCollection = explode( ',' , $sourceCollection );
                $sourceNumCollection = explode( ',' , $sourceNumCollection );

                $targetIdx = Arrays::array_toggle_fetch_value( $target , $sourceCollection );
                if ( $targetIdx === null ) {
                    $sourceCollection[] = $target;
                    $sourceNumCollection[] = $targetNum;
                } else {
                    $sourceNum = $sourceNumCollection[ $targetIdx ];
                    $sourceNumCollection[ $targetIdx ] = $sourceNum + $targetNum;
                }

                $sourceCollection = implode( ',' , $sourceCollection );
                $sourceNumCollection = implode( ',' , $sourceNumCollection );
            } else
                throw new \Exception ( 'target id is not exist' );

            return $this;
        }


        /**
         * 给用户减少资源 , 并返回用户增加物品后的物品类型数组和物品类型数量数组
         * @param int    $target              物品类型/ID
         * @param int    $targetNum           物品数量
         * @param string $sourceCollection    用户拥有的物品类型数组
         * @param string $sourceNumCollection 用户拥有的物品类型数量数组
         */
        function reduceResource( $target , $targetNum , &$sourceCollection , &$sourceNumCollection )
        {

            if ( array_key_exists( $target , $this->_targetIDs ) ) {
                if ( empty( $sourceCollection ) || empty( $sourceNumCollection ) )
                    return false;
                $sourceCollection = explode( ',' , $sourceCollection );
                $sourceNumCollection = explode( ',' , $sourceNumCollection );

                $targetIdx = Arrays::array_toggle_fetch_value( $target , $sourceCollection );
                if ( $targetIdx === null ) {
                    return false;
                } else {
                    $sourceNum = $sourceNumCollection[ $targetIdx ];
                    if ( $sourceNum < $targetNum )
                        return false;
                    else if ( $sourceNum == $targetNum ) {
                        unset( $sourceCollection[ $targetIdx ] , $sourceNumCollection[ $targetIdx ] );

                    } else {
                        $sourceNumCollection[ $targetIdx ] = $sourceNum - $targetNum;
                    }
                }

                $sourceCollection = implode( ',' , $sourceCollection );
                $sourceNumCollection = implode( ',' , $sourceNumCollection );
            } else
                throw new \Exception ( 'target id is not exist' );

            return $this;
        }

        /**
         * 检查用户扣除的目标资源是否足够
         * @param  int    $target
         * @param  int    $targetNum
         * @param  string $sourceCollection
         * @param  string $sourceNumCollection
         * @return bool
         */
        function checkResource( $target , $targetNum , &$sourceCollection , &$sourceNumCollection )
        {

            if ( array_key_exists( $target , $this->_targetIDs ) ) {

                if ( empty( $sourceCollection ) || empty( $sourceNumCollection ) )
                    return false;

                $sourceCollection = explode( ',' , $sourceCollection );
                $sourceNumCollection = explode( ',' , $sourceNumCollection );

                $targetIdx = Arrays::array_toggle_fetch_value( $target , $sourceCollection );
                if ( $targetIdx === null ) {
                    return false;
                } else {
                    $sourceNum = $sourceNumCollection[ $targetIdx ];
                    if ( $sourceNum < $targetNum )
                        return false;
                    else
                        return true;
                }
            } else
                throw new \Exception ( 'target id is not exist' );
        }

        /**
         * 将数据库中存储的以","链接的物品ID和物品数量 格式化为接口需要的数组
         * @param string $items
         * @param string $items_num
         */
        function formatToArray( $items , $items_num )
        {
            $game_resource_changetypes = array_flip( $this->config->common['game_resource_changetypes'] );
            $data = array();

            $items = explode( ',' , $items );
            $items_num = explode( ',' , $items_num );

            $tool_type_columns = $this->config->common['tool_type_columns'];
            unset( $tool_type_columns[1] );
            foreach ( $tool_type_columns as $k => $v ) {
                $data[ $v ] = 0;
                for ( $i = 0 ; $i < count( $items ) ; $i ++ ) {
                    $item_id = $game_resource_changetypes[ intval($items[ $i ]) ];
                    if($item_id !== 0 && empty($item_id))continue;
                    if ( intval($k) == intval($item_id) ) {
                        $data[ $v ] = $items_num[ $i ];
                        break;
                    }
                }
            }
            return $data;
        }

        /**
         * @param $user_id
         */
        function refreshCache($user_id)
        {
            $key = 'MjUserInfo:'.$user_id;
            $r = new Redis($this->config->common['redis']['host'],$this->config->common['redis']['port']);
            $redis = $r->getResource();
            $redis->select(0);
            $redis->del($key);
            $redis->close();
        }
    }