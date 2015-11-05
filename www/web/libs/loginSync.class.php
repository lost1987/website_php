<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/2/5
     * Time: 下午8:11
     */

    namespace web\libs;


    use core\Base;
    use core\Cookie;
    use core\DB;
    use common\model\GameAreaModel;

    class LoginSync extends Base
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function loginSuccess( $user , $xfDb )
        {
            /*处理COOKIE**/
            $cookie = Cookie::instance();
            $expire_time = $this->config->common['cookie']['timeout'];

            $cookie->set_timeout( $expire_time );
            //TODO:读取游戏分区
            $area_id = 1;
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );
            $sql = "SELECT wins,total FROM gamesummary WHERE player_id = ?";
            $gameDB->execute( $sql , array( $user['user_id'] ) );
            $gamesummary = $gameDB->fetch();
            $sql = "SELECT vip_level FROM profile WHERE user_id = ?";
            $gameDB->execute( $sql , array( $user['user_id'] ) );
            $profile = $gameDB->fetch();
            $user['vip_level'] = $profile['vip_level'];
            unset( $gameDB , $server );
            $cookie_data = $user;
            if ( false != $gamesummary )
                $cookie_data = array_merge( $cookie_data , $gamesummary );
            UserUtil::instance()->setUserCookie( $cookie_data );
        }
    }