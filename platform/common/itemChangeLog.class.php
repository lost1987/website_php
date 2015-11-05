<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/28
     * Time: 14:22
     */

    namespace common;


    use common\base\BaseProducts;

    /**
     * 玩家物品日志变化记录
     * Class ItemChange
     * @package common
     */
    class ItemChangeLog extends XfModel
    {

        protected static $_instance = null;

        const FROM_NAME_TASK ='php-task';

        const FROM_NAME_ZJH = '金花游戏服务';

        /**
         * 存储用户的物品变化日志
         * @param  int      $user_id       用户id
         * @param  string   $desp          具体描述
         * @param  int      $cost_item_id  扣除的物品id
         * @param  int      $cost_item_num 扣除的物品数量
         * @param  int      $get_item_id   获得的物品id
         * @param  int      $get_item_num  获得的物品数量
         * @param  int      $server_id     服务器id 默认值-1 指非具体游戏的物品变化
         * @param  string   $from_name     变化来源 如具体游戏描述
         * @return boolean
         */
        function saveChangeLog($user_id,$desp,$cost_item_id,$cost_item_num,$get_item_id,$get_item_num,$server_id=-1,$from_name=self::FROM_NAME_TASK){
            $fields = array(
                'user_id' => $user_id,
                'desp' => $desp,
                'cost_item_id' => $cost_item_id,
                'cost_item_num' => $cost_item_num,
                'get_item_id' => $get_item_id,
                'get_item_num' => $get_item_num,
                'server_id' => $server_id,
                'from_name' => $from_name,
                'create_time' => time(),
                'create_date' => strtotime(date('Y-m-d'))
            );
            return $this->db->save($fields,'xf_platform_items_change_log');
        }

        /**
         * 用户注册描述
         * @return string
         */
        function registerDesp(){
            return '用户注册';
        }

        /**
         * 用户兑换描述
         * @param array $product
         * @return string
         */
        function exchangeDesp($product){
            return '兑换物品 '.$product['product_name'].',物品ID为'.$product['id'];
        }
    }