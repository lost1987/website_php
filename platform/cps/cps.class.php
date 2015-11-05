<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/8
     * Time: 下午4:00
     */

    namespace cps;
    use core\Base;


    /**
     * CPS/CPA 广告抽象类
     * Class Cps
     * @package cps
     * 注册访问地址需要是这样的 : xxxx.com/user/register/platform_id/
     * 通过platform_id取到广告平台传递的用户id参数key 从而获取从$_GET[key]里得到用户id的值
     */
    abstract class Cps extends Base
    {
        /**
         * 注册后的回调地址
         * @var null
         */
        protected  $_register_call_back_url = null;

        private static $_instance = null;

        //延迟绑定
        static function instance(){
            if(static::$_instance === null)
                static::$_instance = new static;
            return static::$_instance;
        }

        protected function __clone(){}

        /**
         * @var null
         * 广告平台分配的加密key
         */
        protected $_ad_key = null;

        /**
         * @var null
         * 分配给广告平台的加密key
         */
        protected $_secrect_key = null;

        /**
         * 根据广告平台的ID获得广告平台用户关联ID的key
         * @return $platform_id_key 例如: 广告平台传递的request的参数 tid = xxxx  那么tid就是该方法返回的数据
         */
        abstract function  getPlatformIdName();


            /**
             * 给广告商平台的用户增加虚拟货币
             * @param array $post  请求的参数数组
             * @param int $platform_id
             * @param int  $area_id
             */
            abstract  function addResource($post,$platform_id,$area_id);
            /**
             * 注册后回调广告平台方法
             * @param int $user_id
             * @param int $platform_user_id
             * @param int $platform_id
             */
            abstract   function callCooperAfterRegister($user_id,$platform_user_id,$platform_id);

            /**
             * 提供给广告平台的查询接口
             * @param array $post 查询参数
             * @return mixed
             */
            abstract  function roleInfo($post,$platform_id,$area_id);
    }