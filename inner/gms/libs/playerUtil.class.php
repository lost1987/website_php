<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/10
     * Time: 上午10:07
     */

    namespace gms\libs;


    use common\model\UserModel_M;
    use core\DB;
    use gms\model\Player_M;
    use gms\model\PurchaseProfile_M;
    use gms\model\UserMessages_M;
    use utils\Strings;
    use utils\Tools;

    class PlayerUtil
    {

        const FORBBIDEN = 1;
        const UNFORBBIDEN = 0;

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         ** #针对网站
         * 发送一条信息给玩家
         * @param $uid   int 玩家ID
         * @param $msg   string 要发送的消息
         * @return  int|bool   false是失败
         */
        function sendMsg( $uid , $msg )
        {
            return UserMessages_M::instance()->save_message( $uid , $msg );
        }

        /**
         * 封停/解封 玩家
         * @param int $op        对应常量
         * @param int $player_id 玩家ID
         */
        function forbidden( $op , $player_id )
        {
            $db = new DB();
            $db->init_db_from_config( 'xinfeng' );
            $sql = "UPDATE xf_user SET forbidden=? WHERE user_id = ?";
            $db->execute( $sql , array( $op , $player_id ) );
            unset( $db );

            return 1;
        }

        /**
         * 重置密码
         * @param int $player_id
         * @param int $user_number
         * @return 重置后的原始密码|false
         */
        function reset_password( $player_id , $user_number )
        {
            $source_password = strtolower( Strings::make_rand_str( 6 ) );
            $password = md5( md5( $source_password ) . '#' . $user_number );
            $params = array(
                'password' => $password
            );
            if ( UserModel_M::instance()->update( $params , $player_id ) )
                return $source_password;

            return false;
        }

        /**
         * 重置消费密码
         * @param int $player_id
         * @param int $user_number
         * @return 重置后的原始密码|false
         */
        function reset_purchase_password( $player_id , $user_number )
        {
            $source_password = strtolower( Strings::make_rand_str( 6 ) );
            $password = md5( md5( $source_password ) . '#' . $user_number );
            $params = array(
                'purchase_password' => $password
            );
            if ( PurchaseProfile_M::instance()->update( $params , $player_id ) )
                return $source_password;

            return false;
        }


        /**
         * 从文件抓取随机昵称
         * @return string
         */
        function randomName()
        {
            $words = Tools::getCSVdata( BASE_PATH . '/gms/libs/name_generator.csv' );
            $words = array_slice( $words , 0 , 375 );
            $indexes = array_rand( $words , 2 );
            $chooser1 = $words[ $indexes[0] ];
            $chooser2 = $words[ $indexes[1] ];
            $name = ${'chooser' . rand( 1 , 2 )}['first_name'] . ${'chooser' . rand( 1 , 2 )}['last_name'];

            return $name;
        }

    }