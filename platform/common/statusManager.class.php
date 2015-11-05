<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/22
     * Time: 15:29
     */

    namespace common;


    use core\ReflectClass;
    use core\SingleNess;

    /**
     * 状态管理--所有订单状态 或 客服状态
     * Class StatusManager
     * @package common
     */
    class StatusManager extends SingleNess
    {
        protected static $_instance = null;

        const NOTHING_DONE = 0;//未处理
        const COMPLETE = 1;//已处理
        const WATCHED = 2;//已知晓
        const SENDING = 3;//已发货
        const REPLY = 4;//已回复

        function names(){
            return array(
                0 => '未处理',
                1 => '已处理',
                2 => '已知晓',
                3 => '已发货',
                4 => '已回复'
            );
        }

        /**
         * 查看状态
         * @param int $status 状态号
         */
        function output($status){
           return $this->names()[$status];
        }
    }