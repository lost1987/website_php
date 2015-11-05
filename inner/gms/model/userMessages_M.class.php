<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/10
     * Time: 上午10:12
     */

    namespace gms\model;


    use core\Encoder;
    use gms\core\GameModel;

    class UserMessages_M extends GameModel
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * 保存信息
         */
        function save_message( $uid , $content )
        {
            $params['receiver_uid'] = $uid;
            $content = array(
                'title'   => '系统消息' ,
                'content' => $content
            );
            $params['msg_jsoned_params'] = Encoder::instance()->encode( $content );
            $params['msg_time'] = date( 'YmdHi' );
            $params['sender'] = 'system';
            $params['has_read'] = 0;
            $params['msg_type'] = 9;

            return $this->_game_server->save( $params , 'user_messages' );
        }
    }