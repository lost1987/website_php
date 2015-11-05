<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/9
     * Time: 15:40
     */

    namespace common;


    use core\Singleton;
    use utils\Arrays;

    class Sms extends Singleton
    {

        private $_host = 'http://106.ihuyi.cn/webservice/sms.php?method=Submit';

        private $_user = 'cf_nbgame';

        private $_passwd = '16youxi';

        protected  static $_instance = null;

        function createSmsCode($redisCodeKey,$timeout=60){
                $smsCode = mt_rand(100000,999999);
                $this->redis->set($redisCodeKey,$smsCode,$timeout);
                return $smsCode;
        }

        function validSmsCode($redisCodeKey,$userSmsCode){
                $smsCode = $this->redis->get($redisCodeKey);
                if(empty($smsCode))
                        return 1;//短信验证码超时
                if(strcmp($userSmsCode,$smsCode) !== 0)
                    return 2;//短信验证码错误

                $this->redis->del($redisCodeKey);
                return 0;//正常
        }

        function send($mobile,$content){
            $params = array(
                'account'  => $this->_user ,
                'password' => $this->_passwd ,
                'mobile'   => $mobile ,
                'content'  => $content
            );

            $curl = curl_init();
            curl_setopt( $curl , CURLOPT_URL , $this->_host );
            curl_setopt( $curl , CURLOPT_HEADER , false );
            curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true );
            curl_setopt( $curl , CURLOPT_NOBODY , true );
            curl_setopt( $curl , CURLOPT_POST , true );
            curl_setopt( $curl , CURLOPT_POSTFIELDS , $params );
            $result = curl_exec( $curl );
            curl_close( $curl );
            $result = Arrays::xml_to_array( $result );
            error_log( '短信平台返回代码为:' . $result['SubmitResult']['code'] );
            if ( $result['SubmitResult']['code'] == 2 ) {
                return true;
            }
            error_log( 'sms send failed:' . $result['SubmitResult']['code'] . ';' . $content );

            return false;
        }

    }