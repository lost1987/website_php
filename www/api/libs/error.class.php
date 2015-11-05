<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/20
     * Time: 下午1:10
     * 接口错误返回代码
     */
    namespace api\libs;

    class Error
    {
        /**500:系统错误****/

        /**
         * 数据库写入错误
         */
        const DATA_WRITE_ERROR = 500;
        /**
         * 参数错误
         */
        const ARGUMENTS_ERROR = 501;
        /**
         * 参数值错误
         */
        const ARGUMENTS_VALUE_ERROR = 502;

        /**
         * REDIS操作错误
         */
        const REDIS_HSET_ERROR = 601;


        /**1000:参数错误或逻辑错误********/

        /**
         * 用户不存在
         */
        const USER_NOT_EXSIT = 1000;

        /**
         * 表单字段格式错误
         */
        const FORM_STRING_FORMAT = 1001;

        /**
         * 用户未登录
         */
        const USER_NOT_LOGIN = 1002;

        /**
         * 字符串相等验证错误
         */
        const STRING_CMP_ERROR = 1003;

        /**
         * 密码错误
         */
        const PASSWORD_INVALID = 1004;

        /**
         * 字段唯一性验证失败[已存在,非唯一]
         */
        const FIELD_VALUE_ALREALLY_EXSITS = 1005;

        /**
         * 字段为空错误
         */
        const FIELD_NULL_ERROR = 1006;

        /**
         * 密码未设定
         */
        const PASSWORD_UNSET = 1007;

        /**
         * 登录已过期
         */
        const LOGIN_OUTTIME = 1008;


        /**
         * 2000 开头特殊及具体的错误
         */
        const NOT_ENOUGH_RESOURCE = 2000;

        /**
         * 代券/兑换码不足
         */
        const NOT_ENOUGH_EXCODE = 2007;

        /**
         *  非法兑换或购买
         */
        const EXCHANGE_ILLEGAL = 2008;

        /**
         * 兑换的物品是唯一物品 且该用户已经拥有该物品
         */
        const EXCHANGE_UNIQUE_ERROR = 2009;
        /**
         * 资源兑换类型错误
         */
        const EXCHANGE_TYPE_ERROR = 2010;
        /**
         * 商品不存在
         */
        const NO_SUCH_PRODUCT = 2011;
        /**
         * 客户端版本过低,需强制升级
         */
        const CLIENT_FORCE_UPDATE = 2012;
        /**
         * 服务器正在维护
         */
        const SERVER_ON_UPHOLD = 2013;
        /**
         * 未检测到版本号
         */
        const  CLIENT_VERSION_MISS = 2014;
        /**
         * APPSTORE 验证失败
         */
        const APP_STORE_VERIFY_FAILED = 2015;
        /**
         * 订单号不存在
         */
        const NO_PAYMENT_ORDER = 2016;
        /**
         * 订单已完成
         */
        const PAYMENT_ORDER_ALREALLY_FINISHED = 2030;
        /**
         * 无效的订单号
         */
        const PAYMENT_ORDER_INVALID = 2031;


        /**
         * anysdk private key 验证失败
         */
        const ANYSDK_PKEY_INVALID = 2017;
        /**
         * anysdk 登录失败
         */
        const ANYSDK_LOGIN_FAILED = 2018;
        /**
         * http访问anysdk 得不到响应
         */
        const ANYSDK_RESPONSE_FAILED = 2019;


        /**
         * 认证错误(可能是重复认证或者是数据出错)
         */
        const AUTH_ERROR = 2020;
        /**
         * 错误的认证类型
         */
        const AUTH_TYPE_ERROR = 2021;
        /**
         * 已经认证 无法重复认证
         */
        const AUTH_ALREADY_ERROR = 2022;
        /**
         * 验证身份证格式错误
         */
        const AUTH_IDCARD_ERROR = 2023;
        /**
         * 短信验证码处于限制发送时间内
         */
        const AUTH_SMS_IN_SEND_LIMIT = 2024;
        /**
         * 短信验证码已过期
         */
        const AUTH_SMS_EXPIRED = 2025;
        /**
         * 短信验证码错误
         */
        const AUTH_SMS_CODE_ERROR = 2026;
        /**
         * 短信发送失败
         */
        const AUTH_SMS_SEND_FAILED = 2027;
        /**
         * 解除认证邮箱不匹配
         */
        const UN_AUTH_MAIL_NO_MATCH = 2028;
        /**
         * 解除认证手机不匹配
         */
        const UN_AUTH_SMS_NO_MATCH = 2029;

        /**
         * 邮箱已存在
         */
        const UNIQUE_EMAIL_ALREALLY_EXSIT = 3001;
        /**
         * 手机已存在
         */
        const UNIQUE_MOBILE_ALREALLY_EXSIT = 3002;
        /**
         * 身份证已存在
         */
        const UNIQUE_IDCARD_ALREALLY_EXSIT = 3003;

        const INVITE_CODE_NOT_EXSIT = 3004;

        /**
         * 已经有上线了无法再绑定上线
         */
        const BIND_FAILED_ALREADY_HAS_PARENT = 3005;

        /**
         * 下线已经存在的且无法绑定上线的错误码
         */
        const BIND_FAILED_CHILDREN_ALREADY_EXSITS = 3006;

        /**
         * 邀请人并未加入推广系统 - 逻辑错误非法操作
         */
        const BIND_FAILED_UNKOWN_PARENT = 3007;

        /**
         * 被邀请人已经是该邀请人的下线 不能重复绑定
         */
        const BIND_FAIED_IS_PARENT_CHILD = 3008;

        /**
         * VIP权限不足
         */
        const VIP_LEVEL_NOT_ENOUGH_PERMISSION = 3100;

        /**
         * 游戏服务器->web服务器 http请求签名验证失败
         */
        const GAME_TO_WEB_HTTP_SIGN_INVALID = 5001;

        //特殊规则错误都放这里
        /**
         * 问卷调查等级小于5 没有资格提交
         */
        const SURVEY_ANA_LEVEL5 = 50001;

        /**
         * 扶持帐号禁止的操作
         */
        const SUPPORTER_ACCOUNT_FORBIDDEN = 50002;

        /**
         * 扶持帐号兑换实物 奖券限额不足
         */
        const SUPPORTER_ACCOUNT_LIMIT = 50003;

        const SIGN_ERROR = 50004;
    }