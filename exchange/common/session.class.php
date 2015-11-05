<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/13
     * Time: 下午2:24
     */

    namespace common;


    use utils\Tools;

    class Session
    {

        private static $_instance = null;

        /**
         * @var \Redis
         */
        private $_redis = null;

        static function instance(\Redis $redis){
            if(self::$_instance == null)
                self::$_instance = new self($redis);
            return self::$_instance;
        }

        function __construct(\Redis $redis){
                $this->_redis = $redis;
        }

        /**
         *  存储用户的会话
         * @param array  $user
         * @param string $entry_key
         * @param int    $expiredTime
         */
        function create(Array $user,$entry_key = '',$expiredTime = 3600){
            $sessionData = array(
                    'uid' => $user['id'],
                    'name' => $user['name'],
                    'account' => $user['account']
                );
                $sessionData = Tools::authcode(serialize($sessionData),'ENCODE',$entry_key);
                $sessionKey = $this->createKey($user['id']);
                $this->_redis->set($sessionKey,$sessionData,$expiredTime);
                $this->_redis->close();
        }

        /**
         *  获取用户的会话
         * @param        $uid
         * @param string $entry_key
         * @return bool|array
         */
        function get($uid,$entry_key = ''){
                $sessionKey = $this->createKey($uid);
                $sessionData = $this->_redis->get($sessionKey);
                if(!$sessionData)
                    return false;

                $sessionData = unserialize(Tools::authcode($sessionData,'DECODE',$entry_key));
                return $sessionData;
        }


        protected  function createKey($uid){
                return 'session:'.$uid;
        }

    }