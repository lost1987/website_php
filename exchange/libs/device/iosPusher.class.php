<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/19
     * Time: 下午3:02
     */

    namespace libs\device;

    /**
     * 负责ios端的消息推送
     * Class IosPusher
     * @package libs\device
     */
    class IosPusher
    {

        private static $_instance = null;

        const PASS_PHRASE = 'a123456';

        const SANDBOX_URL = 'ssl://gateway.sandbox.push.apple.com:2195';

        const SANDBOX_CERTIFICATE = 'sandbox.apple.push.pem';

        const DEPLOY_URL = 'ssl://gateway.push.apple.com:2195';

        const DEPLOY_CERTIFICATE = 'deploy.apple.push.pem';

        /**
         * @return \libs\device\IosPusher
         */
        static function instance()
        {
            if ( self::$_instance == null ) {
                self::$_instance = new self;
            }

            return self::$_instance;
        }

        /**
         * 推送消息
         * @param       $msg
         * @param array $deviceTokens IOS设备号
         * @return bool
         */
        function send( $msg , Array $deviceTokens ,$product_mode = false)
        {
            if($product_mode) {
                $url = self::DEPLOY_URL;
                $certificateName = self::DEPLOY_CERTIFICATE;
            }
            else {
                $url = self::SANDBOX_URL;
                $certificateName = self::SANDBOX_CERTIFICATE;
            }
            $ctx = stream_context_create();
            @stream_context_set_option( $ctx , 'ssl' , 'local_cert' , $certificateName );
            @stream_context_set_option( $ctx , 'ssl' , 'passphrase' , self::PASS_PHRASE );
            @$fp = stream_socket_client( $url , $err , $errstr , 60 , STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT , $ctx );
            if ( !$fp ) {
                error_log( "Failed to connect: $err $errstr" );
                return false;
            }

            $body['aps'] = array(
                'alert' => $msg ,
                'sound' => 'default'
            );

            $preload = json_encode( $body );
            foreach ( $deviceTokens as $token ) {
                $msg = chr( 0 ) . pack( 'n' , 32 ) . pack( 'H*' , $token ) . pack( 'n' , strlen( $preload ) ) . $preload;
                $result = fwrite( $fp , $msg , strlen( $msg ) );
                if ( !$result ) {
                    error_log( 'send ios message error:' . $result );

                    return false;
                }
            }
            fclose( $fp );

            return true;
        }

    }