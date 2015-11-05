<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/13
     * Time: 上午10:09
     */

    namespace common;


    class Error
    {
                const LOGIN_FAILED = 1001;
                const USER_NOT_LOGIN = 1002;
                const USER_NOT_EXIST = 1003;
                const PURCHARSE_ERROR_OR_NOT_SET = 1004;
                const AUTH_CODE_ERROR = 1005;//验证码错误

                const DB_INSERT_ERROR = 2001;
                const DB_UPDATE_ERROR = 2002;
                const DB_DELETE_ERROR = 2003;
                const DB_CONNECT_ERROR = 2004;
    }