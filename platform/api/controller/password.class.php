<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/13
     * Time: 10:05
     */

    namespace api\controller;


    use api\core\BaseApi;
    use common\Account;
    use common\model\UserModel;
    use common\Response;
    use common\Sms;
    use utils\Strings;
    use common\Error as CommonError;

    class Password extends BaseApi
    {
        function login_1(){
            $mobile =$this->input->post('mobile');
            if(!Strings::is_mobile($mobile))
                Response::instance()->say(CommonError::FORM_STRING_FORMAT_ERROR);

            $user = UserModel::instance()->getUserByMobile($mobile,array('user_id'));
            if(empty($user))
                Response::instance()->say(CommonError::USER_NOT_EXSIT);

            $sms = Sms::instance();
            $key = 'sms:platform:fp:'.$user['user_id'];
            $code = $sms->createSmsCode($key,300);
            $content = "密码找回验证码：{$code}，请不要把验证码泄露给其他人。如非本人操作，请删除本条短信！";

            if(!$sms->send($mobile,$content))
                Response::instance()->say(CommonError::SMS_SEND_FAILED);
            Response::instance()->success();
        }

        function login_2(){
            $mobile =$this->input->post('mobile');
            if(!Strings::is_mobile($mobile))
                Response::instance()->say(CommonError::FORM_STRING_FORMAT_ERROR);

            $user = UserModel::instance()->getUserByMobile($mobile,array('user_id'));
            if(empty($user))
                Response::instance()->say(CommonError::USER_NOT_EXSIT);

            $smscode= $this->input->post('smscode');
            $key = 'sms:platform:fp:'.$user['user_id'];

            $result = Sms::instance()->validSmsCode($key,$smscode);
            if($result == 1)
                Response::instance()->say(CommonError::SMS_TIME_OUT);
            else if($result == 2)
                Response::instance()->say(CommonError::AUTH_CODE_ERROR);

            Response::instance()->success();
        }

        function login_3(){
            $time = $this->input->post('time');
            $secrect = $this->config->api['sign_secret_key'];
            $password = $this->input->post('password');
            $sign = $this->input->post('sign');

            $mobile =$this->input->post('mobile');
            if(!Strings::is_mobile($mobile))
                Response::instance()->say(CommonError::FORM_STRING_FORMAT_ERROR);

            $mysign = md5($time.$mobile.$secrect);
            if(strcmp($sign,$mysign) !== 0)
                Response::instance()->say(CommonError::SIGN_ERROR);

            $user = UserModel::instance()->getUserByMobile($mobile,array('user_id','user_number'));
            if(empty($user))
                Response::instance()->say(CommonError::USER_NOT_EXSIT);
            $passwd= Account::instance()->makePassword( $password , $user['user_number'] );
            $fields = array('password' => $passwd);
            if(!$this->db->update($fields,'xf_user','WHERE user_id='.$user['user_id']))
                Response::instance()->say(CommonError::DB_UPDATE_ERROR);

            Response::instance()->success();
        }
    }