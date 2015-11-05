<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/12
     * Time: 下午4:35
     */

    namespace common;


    class Error
    {
            const DB_INSERT_ERROR = 10001;
            const DB_UPDATE_ERROR = 10002;
            const DB_DELETE_ERROR = 10003;
            const DB_CONNECT_ERROR = 10004;
            const DB_QUERY_NULL = 10005;//查询语句未查询到任何数据
            const COMMAND_NOT_EXSIT = 10010;//CMD_ID 命令号不存在
            const CLASS_NOT_EXSIT = 10011;//指定类不存在
            const CURL_CONNETCT_ERROR = 10020;
            const CURL_RETURN_LOGIC_ERROR = 10021;
            const SESSION_CREATE_FAILED = 10030;//用户会话创建失败
            const SESSION_DESTROY_FAILED = 10031;//销毁会话失败
            const USER_STATUS_NEED_WAIT = 10032;//用户需等待 稍后尝试(可能登陆卡号等等)
            const GAME_CONNECT_FAILED = 10033;//无法连接游戏服务器socket
            const GAME_COMMUNICATION_TIMEOUT = 10034;//与游戏socket服务器通讯超时

            const AUTH_CODE_ERROR = 20000;//验证码错误
            const ACCOUNT_UNAUTH_MOBILE_ERROR = 20001;//用户未绑定手机号
            const SMS_SEND_FAILED = 20002;//短信发送失败
            const SUPPORTER_ACCOUNT_FORBIDDEN = 20003;  //扶持账号禁止操作
            const NOT_ENOUGH_DIAMOND = 20004; //钻石不足
            const NOT_ENOUGH_ITEM = 20005;  //物品不足
            const USER_IS_EXSIT = 20006;//用户已存在
            const USER_NOT_EXSIT = 20007;//用户不存在
            const SIGN_ERROR = 20008;//签名验证失败
            const FORM_STRING_FORMAT_ERROR = 20009;//字段格式错误
            const FORM_STRING_FORBBIDEN = 20010;//敏感词汇
            const NICKNAME_EXSIT = 20011;//昵称已存在
            const LOGINNAME_EXSIT = 20022;//账号已存在
            const PASSWORD_ERROR = 20023;//密码错误
            const LOGIN_NEEDED = 20024;//用户未登录
            const SMS_TIME_OUT = 20025;//短信超时
            const SERVER_ID_NOT_EXSIT = 20026;//游戏服务器ID不存在
            const USER_MSG_TYPE_MISS = 20027;//用户消息类型未指定
            const USER_MSG_NOT_EXSIT = 20028;//用户消息不存在
            const USER_MSG_FETCH_TYPE_ERROR = 20029;//用户领取的消息类型错误
            const USER_MSG_ITEMS_NOT_EXSIT = 20030;//用户消息领取的物品不存在
            const STORE_PRODUCT_NOT_EXSIT = 20031;//商品不存在
            const STORE_PRODUCT_TYPE_ERROR = 20032;//商品类型错误
            const APPSTORE_VERIFY_FAILED = 20033;//苹果商店验证失败
            const PAYMENT_ORDER_NOT_EXSIT = 20034;//订单号不存在
            const PAYMENT_ORDER_DONE= 20035;//订单已完成
            const PAYMENT_ORDER_INVALID = 20036;//订单号效验失败
            const PAYMENT_AMOUNT_ERROR = 20037;//充值金额错误
            const STRING_TOO_LONG = 20038;//字符超出限制
    }