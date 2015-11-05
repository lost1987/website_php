<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/17
     * Time: 上午9:57
     */

    namespace gamefactory;

    /**
     * 游戏工厂接口
     */
    interface IGameFactory
    {

        /**
         * 游戏数据库PDO对象实例
         * @param object $gameDB
         */
        function __construct( $gameDB );

        /**
         * 初始化属性（角色）
         * @param int $user_id
         */
        function initProfile( $user_id );

        /**
         * 存储属性（角色）
         * @param array $fields
         */
        function saveProfile( $fields );

        /**
         * 直读数据库
         * @param $user_id
         * @return mixed
         */
        function readProfileDirect($user_id);

        /**
         * 读取属性（角色） 必须包含属性: vip_level
         * @param int $user_id
         * @return array
         */
        function readProfile( $user_id );

        /**
         * 更新属性（角色）
         * @param int   $user_id
         * @param array $fields
         */
        function updateProfile( $user_id , $fields );

        /**
         * 独立的游戏充值回调接口
         * @param array $order 订单对象数组
         */
        function payCallBack( Array $order );

        /**
         * 玩家数据总计（成就）
         * @param int $user_id
         */
        function gameSummary( $user_id );

    }