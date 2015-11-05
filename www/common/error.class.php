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
            const CURL_CONNETCT_ERROR = 10020;
            const CURL_RETURN_LOGIC_ERROR = 10021;

            //用户未绑定手机号
            const ACCOUNT_UNAUTH_MOBILE_ERROR = 20001;
            //短信发送失败
            const SMS_SEND_FAILED = 20002;
    }