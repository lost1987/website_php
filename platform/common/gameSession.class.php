<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/14
     * Time: 11:29
     */

    namespace common;


    use core\Singleton;
    use utils\Tools;

    /**
     * 用户游戏会话
     * Class GameSession
     * @package common
     */
    class GameSession extends Singleton
    {

        protected static $_instance = null;

        /**
         * 创建会话
         * @param            $user    用户属性数组
         * @return string
         */
        function create($user){
            //取得加密密匙
            $entry_key = $this->config->common['session_entry_key'];
            $timeout = $this->config->common['session_time_out'];
            $entry_data = array(
                'login_name'  => $user['login_name'] ,
                'user_number' => $user['user_number'] ,
                'user_id'         => $user['user_id']
            );
            $entry_data = serialize( $entry_data );
            $session_data = Tools::authcode( $entry_data , 'ENCODE' , $entry_key );
            $session_key = uniqid();
            $session_id = Tools::authcode($user['user_id'].'#'.$session_key,'ENCODE',$entry_key);
            $redis_session_key = $this->redisKey($user['user_id'],$session_key);
            $this->redis->set($redis_session_key,$session_data,$timeout);
            return $session_id;
        }

        /**
         * 验证会话
         * @param $session_id
         * @return array|bool
         */
        function auth($session_id){
                $entry_key = $this->config->common['session_entry_key'];
                if(strpos($session_id,' ') > -1)
                    $session_id = str_replace(' ','+',$session_id);
                list($user_id,$session_key) = explode('#',Tools::authcode($session_id,'DECODE',$entry_key));
                $redis_session_key = $this->redisKey($user_id,$session_key);
                $session_data = $this->redis->get($redis_session_key);
                if(empty($session_data))
                    return false;

                $session_data = unserialize(Tools::authcode($session_data,'DECODE',$entry_key));
                return $session_data;
        }

        /**
         * 模糊清除用户的会话
         * @param $user_id
         */
        function clean($user_id){
                $sessionid = 'session:platform:'.$user_id.':*';
                $keys = $this->redis->keys($sessionid);
                foreach($keys as $key){
                    $this->redis->del($key);
                }
        }

        /**
         * 精确清除用户会话
         * @param $session_id
         * @return bool
         */
        function destroy($session_id){
                $entry_key = $this->config->common['session_entry_key'];
                list($user_id,$session_key) = explode('#',Tools::authcode($session_id,'DECODE',$entry_key));
                $redis_session_key = $this->redisKey($user_id,$session_key);
                if($this->redis->del($redis_session_key))
                    return true;
                return false;
        }

        protected  function redisKey($user_id,$session_key){
                return    'session:platform:'.$user_id.':'.$session_key;
        }

    }