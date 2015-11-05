<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/21
     * Time: 下午4:25
     */

    namespace common;


    use common\base\BaseItems;
    use core\Singleton;
    use utils\Arrays;

    /**
     * 物品管理器
     * Class ItemsManager
     * @package common
     */
    class ItemsManager extends Singleton
    {

        protected static $_instance = null;

        private $_items = null;

        const ITEM_CHANGE_FROM_NAME_HTTP = '';

        const ITEM_CHANGE_FROM_NAME_ZJH = '';

        const ITEM_CHANGE_DESCPRIPTION_REGISTER = '';

        const ITEM_CHANGE_DESCRIPTION_EXCHANGE = '';

        function __construct()
        {
            $this->_items = BaseItems::instance()->lists();
        }

        protected function itemsExsit( $item_id )
        {
            if ( !array_key_exists( $item_id , $this->_items ) )
                return false;

            return true;
        }

        /**
         * 设置用户资源 , 并返回用户增加物品后的物品类型数组和物品类型数量数组
         * @param int    $target              物品类型/ID
         * @param int    $targetNum           物品数量
         * @param string $sourceCollection    用户拥有的物品类型数组
         * @param string $sourceNumCollection 用户拥有的物品类型数量数组
         */
        public function setItems( $target , $targetNum , &$sourceCollection , &$sourceNumCollection )
        {
            if ( $this->itemsExsit( $target ) ) {

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
                throw new \Exception ( 'item id is not exist' );

            return $this;
        }


        /**
         * 给用户增加资源 , 并返回用户增加物品后的物品类型数组和物品类型数量数组
         * @param int    $target              物品类型/ID
         * @param int    $targetNum           物品数量
         * @param string $sourceCollection    用户拥有的物品类型数组
         * @param string $sourceNumCollection 用户拥有的物品类型数量数组
         */
        public function addItems( $target , $targetNum , &$sourceCollection , &$sourceNumCollection )
        {
            if ( $this->itemsExsit( $target ) ) {

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
                throw new \Exception ( 'item id is not exist' );

            return $this;
        }

        /**
         * 给用户减少资源 , 并返回用户增加物品后的物品类型数组和物品类型数量数组
         * @param int    $target              物品类型/ID
         * @param int    $targetNum           物品数量
         * @param string $sourceCollection    用户拥有的物品类型数组
         * @param string $sourceNumCollection 用户拥有的物品类型数量数组
         */
        public function costItems( $target , $targetNum , &$sourceCollection , &$sourceNumCollection )
        {
            if ( $this->itemsExsit( $target ) ) {
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
                throw new \Exception ( 'item id is not exist' );

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
        public function checkItems( $target , $targetNum , $sourceCollection , $sourceNumCollection )
        {
            if ( $this->itemsExsit( $target ) ) {

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
         * @param mixed $items
         * @param mixed $items_num
         */
        public function format( $user_items , $user_items_num )
        {
            if ( is_string( $user_items ) )
                $user_items = explode( ',' , $user_items );
            if ( is_string( $user_items_num ) )
                $user_items_num = explode( ',' , $user_items_num );

            $formattedItems = array();
            for ( $i = 0 ; $i < count( $user_items ) ; $i ++ ) {
                $item = $this->_items[ $user_items[ $i ] ];
                $formattedItems[ $item['item_key'] ] = $user_items_num[ $i ];
            }

            return $formattedItems;
        }
    }