<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/23
     * Time: 上午9:45
     */

    namespace exchangefactory;

    /**
     * 兑换工厂接口
     */
    interface IExchange
    {
        /**
         * @param int $platform   平台渠道
         * @param int $product_id 商品ID
         * @param int $user_id    用户ID
         * @param int $area_id    区域(游戏服务器)ID
         * @param int $game_id    游戏ID
         * @param int $product_num 购买数量
         * @return mixed
         */
        function doExchange( $platform , $product_id , $user_id , $area_id , $game_id, $product_num = 1 );
    }