<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/19
     * Time: 下午3:02
     */

    namespace libs\device;

    /**
     * 负责android设备的消息推送 友盟提供接口
     * Class AndroidPusher
     * @package libs\device
     */
    class AndroidPusher
    {

        const APP_KEY = '53c7317156240b2f320c73c9';

        const APP_MASTER_SECRET = 'utopuqnsugxvvbrsvbqtzwsmxqxpvtii';

        const BROADCAST = 1;

        const USERGROUP = 2;

        private static $_instance = null;

        /**
         * @return \libs\device\AndroidPusher
         */
        static function instance()
        {
            if ( self::$_instance == null ) {
                self::$_instance = new self;
            }

            return self::$_instance;
        }

        /**
         * 生成签名
         * @param $http_method
         * @param $url
         * @param $post_body
         * @return string
         */
        private function sign( $http_method , $url , $post_body )
        {
            return md5( $http_method . $url . $post_body . self::APP_MASTER_SECRET );
        }

        /**
         * 发送消息
         * @param      $title
         * @param      $msg
         * @param int  $send_type       广播或者单播
         * @param bool $production_mode 测试=false 正式=true
         * @param null $alias           通过alias发送消息
         * @return mixed
         * @throws \Exception
         */
        function send( $title , $msg , $send_type = self::USERGROUP , $production_mode = false , $alias = null )
        {
            $url = 'http://msg.umeng.com/api/send';
            $http_method = 'POST';

            switch ($send_type) {
                case self::BROADCAST:
                    $params = $this->broadcast_params( $title , $msg , $production_mode );
                    break;
                case self::USERGROUP:
                    $params = $this->usergroup_params( $title , $msg , $production_mode , $alias );
                    break;
                default:
                    throw new \Exception( 'error send type' );
                    break;
            }

            $post_body = json_encode( $params );
            $sign = $this->sign( $http_method , $url , $post_body );

            $url = $url . '?sign=' . $sign;
            $ch = curl_init();
            curl_setopt( $ch , CURLOPT_URL , $url );
            curl_setopt( $ch , CURLOPT_RETURNTRANSFER , 1 );
            curl_setopt( $ch , CURLOPT_POST , 1 );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $post_body );
            curl_setopt( $ch , CURLOPT_CONNECTTIMEOUT_MS , 1000 );
            $r = curl_exec( $ch );
            if ( !$r )
                throw new \Exception( 'send msg android error:' . $r );

            return $r;
        }

        /**
         * 生成广播消息参数
         * @param $title
         * @param $msg
         * @param $production_mode
         * @return array
         */
        private function broadcast_params( $title , $msg , $production_mode )
        {
            return array(
                'appkey'          => self::APP_KEY ,
                'timestamp'       => time() ,
                "type"            => "broadcast" ,
                'payload'         => array(
                    'display_type' => 'notification' ,
                    'body'         => array(
                        "ticker"     => $title ,
                        "title"      => $title ,
                        "text"       => $msg ,
                        "after_open" => "go_app"
                    )
                ) ,
//                            'policy' => array(
//                                "start_time"=>"2013-10-29 12:00:00", //定时发送
//                                "expire_time"=> "2013-10-30 12:00:00"
//                            ),
                "description"     => "广播通知-Android" ,
                "production_mode" => $production_mode
            );
        }

        /**
         * 生成单播消息参数
         * @param $title
         * @param $msg
         * @param $production_mode
         * @param $alias
         * @return array
         * @throws \Exception
         */
        private function usergroup_params( $title , $msg , $production_mode , $alias )
        {

            if ( !is_array( $alias ) || count( $alias ) > 50 )
                throw new \Exception( '特定用户推送消息必须要指定用户帐号列表,并且不超过50个' );

            return array(
                'appkey'          => self::APP_KEY ,
                'timestamp'       => time() ,
                "type"            => "customizedcast" ,
                'alias'           => implode( ',' , $alias ) ,
                'alias_type'      => 'newbee' ,
                'payload'         => array(
                    'display_type' => 'notification' ,
                    'body'         => array(
                        "ticker"     => $title ,
                        "title"      => $title ,
                        "text"       => $msg ,
                        "after_open" => "go_app"
                    )
                ) ,
//                            'policy' => array(
//                                "start_time"=>"2013-10-29 12:00:00", //定时发送
//                                "expire_time"=> "2013-10-30 12:00:00"
//                            ),
                "description"     => "用户列表通知-Android" ,
                "production_mode" => $production_mode
            );
        }

    }