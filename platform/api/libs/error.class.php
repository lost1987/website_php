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
                const REGISTER_MOBILE_FORMAT_ERROR = 100001;//注册的手机号格式错误
                const REGISTER_MOBILE_EXSIT = 100002;//注册的手机号已存在
                const REGISTER_SMS_CODE_EXPIRED = 100003;//注册发送的验证码有效期过期
                const REGISTER_SMS_CODE_ERROR = 100004;//注册的验证码短信验证错误
                const REGISTER_SMS_SEND_ERROR = 100005;//注册短信发送失败
    }