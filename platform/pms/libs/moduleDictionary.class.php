<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/28
     * Time: 下午5:57
     */

    namespace pms\libs;

    /**
     * 模块字典 需要和模块表同步
     * Class ModuleDictionary
     * @package pms\libs
     */
    class ModuleDictionary
    {

        //module_alias  =  module_id
        /**
         * 用户登陆
         */
        const ROOT_MODULE_LOGIN = 1;

        /**
         * 用户管理
         */
        const ROOT_MODULE_ADMIN = 2;

        /**
         * 添加/编辑 用户
         */
        const MODULE_ADMIN_ADD = 3;

        /**
         * 用户列表
         */
        const MODULE_ADMIN_LIST = 4;

        /**
         * 日志管理
         */
        const ROOT_MODULE_LOGS = 5;

        /**
         * 系统日志列表
         */
        const MODULES_SYSTEM_LOG_LIST = 6;

        /**
         * 模块管理
         */
        const ROOT_MODULE_MODULE = 7;

        /**
         * 模块列表
         */
        const MODULE_MODULE_LIST = 8;

        /**
         * 添加模块
         */
        const MODULE_MODULE_ADD = 9;

        /**
         * 权限管理
         */
        const ROOT_MODULE_PERMISSION = 10;

        /**
         * 赋予权限
         */
        const MODULE_PERMISSION_GIVE = 11;

        /**
         * 删除用户
         */
        const MODULE_ADMIN_DELETE = 12;

        /**
         * 删除模块
         */
        const MODULE_MODULE_DEL = 13;

        /**
         * 系统信息
         */
        const ROOT_MODULE_SYSTEM_INFO = 17;

        /**
         * PHP运行时 配置
         */
        const MODULE_SYSTEM_INFO_PHP = 18;


        /**
         * 商城根模块
         */
        const ROOT_MODULE_STORE  = 19;

        /**
         * 添加商品
         */
        const MODULE_STORE_PRODUCTS_ADD = 20;

        /**
         * 商品列表
         */
        const MODULE_STORE_PRODUCTS_LIST = 21;

        /**
         * 系统公告列表
         */
        const MODULE_SYSTEM_MESSAGE_LIST = 22;

        /**
         * 添加系统公告
         */
        const  MODULE_SYSTEM_MESSAGE_ADD = 24;

        /**
         * 消息推送
         */
        const  ROOT_MODULE_MSG_PUSH = 25;

        /**
         * 广播
         */
        const  MODULE_MSG_PUSH = 26;

        /**
         * 消息推送任务列表
         */
        const  MODULE_MSG_PUSH_TASK_LIST = 27;

        /**
         * 添加消息推送
         */
        const  MODULE_MSG_PUSH_TASK_ADD = 28;

        /**
         * 引导公告列表
         */
        const MODULE_SYSTEM_GUIDE_LIST = 29;

        /**
         * 添加引导公告
         */
        const MODULE_SYSTEM_GUIDE_ADD = 30;


        /**
         * 添加引导公告
         */
        const ROOT_MODULE_SERVICE = 30;

        /**
         * 添加引导公告
         */
        const ROOT_MODULE_SERVICES = 31;

        /**
         * 玩家反馈
         */
        const MODULE_SERVICES_FEEDBACK = 32;

        /**
         * 玩家举报
         */
        const MODULE_SERVICES_TIPOFF = 33;

        /**
         * 玩家申述
         */
        const MODULE_SERVICES_SUSPEND = 34;

        /**
         * 玩家兑换
         */
        const MODULE_SERVICES_EXCHANGE = 35;

        /**
         * 充值订单
         */
        const MODULE_SERVICES_PAYMENT_ORDER = 36;

        /**
         * 文章管理
         */
        const ROOT_MODULE_ARTICLES = 37;

        /**
         * 文章添加
         */
        const MODULE_ARTICLE_ADD = 38;

        /**
         * 文章列表
         */
        const MODULE_ARTICLE_LIST = 39;

        /**
         * 文章删除
         */
        const MODULE_ARTICLE_DEL = 40;

        /**
         * 活动管理
         */
        const ROOT_MODULE_ACTIVITY  = 41;

        /**
         * 活动列表
         */
        const MODULE_ACTIVITY_LIST = 42;

        /**
         * 添加活动
         */
        const MODULE_ACTIVITY_ADD = 43;

        /**
         * 删除活动
         */
        const MODULE_ACTIVITY_DEL = 44;

        /**
         * 数据分析
         */
        const ROOT_MODULE_DATA_ANALYSIS = 45;

        /**
         * 数据总览
         */
        const MODULE_DATA_ANALYSIS_TOTAL = 46;

        /**
         * 注册
         */
        const MODULE_DATA_ANALYSIS_REGISTER = 47;

        /**
         * 登录人数
         */
        const MODULE_DATA_ANALYSIS_LOGIN_NUM = 48;

        /**
         * 登录次数
         */
        const MODULE_DATA_ANALYSIS_LOGIN_COUNT = 49;

        /**
         * 活跃度
         */
        const MODULE_DATA_ANALYSIS_VIGOROUS = 50;

        /**
         * 留存率
         */
        const MODULE_DATA_ANALYSIS_REMAIN = 51;

        /**
         * 回归用户
         */
        const MODULE_DATA_ANALYSIS_REGRESS = 52;

        /**
         * 游戏数据查询
         */
        const ROOT_MODULE_GAME_DATA = 53;

        /**
         * 具体游戏数据
         */
        const MODULE_GAME_DATA_QUERY = 54;

        /**
         * 游戏管理
         */
        const ROOT_MODULE_GAME_MANAGER = 55;

        /**
         * 游戏参数设置
         */
        const MODULE_GAME_MANAGER_ARGUMENT_SETTINGS = 56;
    }