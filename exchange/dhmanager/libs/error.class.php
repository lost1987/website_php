<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/11
     * Time: 下午1:51
     */

    namespace dhmanager\libs;


    class Error
    {
            const ADMIN_PASSWORD_ERROR = 1000;

            const ADMIN_USER_LOGIN_EXPIRED  = 1001;

            const ADMIN_USER_NOT_EXIST = 1002;

            const ADMIN_FORBIDDEN = 1003;

            const DB_INSERT_ERROR = 5000;

            const DB_UPDATE_ERROR = 5001;

            const DB_DELETE_ERROR = 5002;
    }