<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-9-16
     * Time: 下午12:27
     */

    namespace common\model;


    use core\Model;
    use core\Redis;

    class UserModel extends Model
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * 用过用户名获取用户表[users]信息
         * @param $username
         * @return mixed
         */
        function getUserByLoginName( $username )
        {
            $sql = "SELECT * FROM xf_user WHERE login_name = ?";
            $this->db->execute( $sql , array( $username ) );

            return $this->db->fetch();
        }


        function getUserByUserNumber( $user_number )
        {
            $sql = "SELECT * FROM xf_user WHERE user_number = ?";
            $this->db->execute( $sql , array( $user_number ) );

            return $this->db->fetch();
        }


        function getUserByInviteCode( $inviteCode )
        {
            $sql = "SELECT * FROM xf_user WHERE invite_code = ?";
            $this->db->execute( $sql , array( $inviteCode ) );

            return $this->db->fetch();
        }


        function getUserByMail( $mail )
        {
            $sql = "SELECT * FROM xf_user WHERE email = ?";
            $this->db->execute( $sql , array( $mail ) );

            return $this->db->fetch();
        }

        function getUserByIDCard( $idCard )
        {
            $sql = "SELECT * FROM xf_user WHERE id_card = ?";
            $this->db->execute( $sql , array( $idCard ) );

            return $this->db->fetch();
        }

        function getUserByMobile( $mobile )
        {
            $sql = "SELECT * FROM xf_user WHERE mobile = ?";
            $this->db->execute( $sql , array( $mobile ) );

            return $this->db->fetch();
        }

        function getVipLevel( $uid )
        {
            $sql = "SELECT vip_level FROM xf_user WHERE user_id = ?";
            $this->db->execute( $sql , array( $uid ) );

            return $this->db->fetch()['vip_level'];
        }

        /**
         * 通过uid获取用户表[users]信息
         * @param $uid
         * @return mixed
         */
        function getUserByUid( $uid )
        {
            $sql = "SELECT * FROM xf_user WHERE user_id = ?";
            $this->db->execute( $sql , array( $uid ) );

            return $this->db->fetch();
        }

        /**
         * 判断昵称是否存在
         * @param $nickname
         * @return bool
         */
        function  isNickNameExsit( $nickname )
        {
            $sql = "SELECT COUNT(*) as num  FROM xf_user WHERE nickname = ?";
            $this->db->execute( $sql , array( $nickname ) );
            $r = $this->db->fetch();
            if ( $r['num'] > 0 )
                return true;

            return false;
        }

        /**
         * 判断用户名是否存在
         * @param $loginname
         * @return bool
         */
        function isLoginNameExsit( $loginname )
        {
            $sql = "SELECT COUNT(*) as num FROM xf_user WHERE login_name = ?";
            $this->db->execute( $sql , array( $loginname ) );
            $r = $this->db->fetch();
            if ( $r['num'] > 0 )
                return true;

            return false;
        }


        function isEmailExsit( $email )
        {
            $sql = "SELECT COUNT(*) as num FROM xf_user WHERE email = ?";
            $this->db->execute( $sql , array( $email ) );
            $r = $this->db->fetch();
            if ( $r['num'] > 0 )
                return true;

            return false;
        }


        function isMobileExsit( $mobile )
        {
            $sql = "SELECT COUNT(*) as num FROM xf_user WHERE mobile = ?";
            $this->db->execute( $sql , array( $mobile ) );
            $r = $this->db->fetch();
            if ( $r['num'] > 0 )
                return true;

            return false;
        }

        function isIDCardExsit( $idCard )
        {
            $sql = "SELECT COUNT(*) as num FROM users WHERE id_card = ?";
            $this->db->execute( $sql , array( $idCard ) );
            $r = $this->db->fetch();
            if ( $r['num'] > 0 )
                return true;

            return false;
        }

        /**
         * 取userNumber最大值
         */
        function getMaxUserNumber()
        {
            $sql = "SELECT MAX(user_number) as a FROM xf_user";
            $this->db->execute( $sql );
            $r = $this->db->fetch();

            return $r['a'];
        }

        /**
         * 保存用户信息
         */
        function saveUser( Array $fields )
        {
            return $this->db->save( $fields , 'xf_user' );
        }

        function updateUser( Array $fields , $uid )
        {
            return $this->db->update( $fields , 'xf_user' , 'WHERE user_id = ' . $uid );
        }

        function updateUserByLoginName( $fields , $login_name )
        {
            return $this->db->update( $fields , 'xf_user' , "WHERE login_name = '$login_name'" );
        }

        /**
         * 是否设置了消费密码
         * @param $uid
         * @return bool
         */
        function is_set_purchase( $uid )
        {
            $is_set_purchase = false;
            $purchaseProfile = PurchaseProfileModel::instance()->read( $uid );
            if ( !empty( $purchaseProfile['purchase_password'] ) )
                $is_set_purchase = true;

            return $is_set_purchase;
        }

        /**
         *获取用户信息全局缓存-包括排名
         */
        function getGlobalCache( $type , $user_number )
        {
            $config = $this->config->common['redis'];
            $r = new Redis( $config['host'] , $config['port'] );
            $redis = $r->getResource();
            $redis->select( 2 );
            $data = $redis->hGetAll( $type . ':rank_info:user:' . $user_number );
            $redis->close();

            return $data;
        }

        /**
         * 判断用户今日是否登录了游戏
         * @param $uid
         * @return bool
         */
        function hasLoginToday( $uid )
        {
            $today = date( 'Y-m-d' );
            $sql = "SELECT COUNT(*) as num FROM xf_user_visit_history WHERE user_id = $uid and '$today' = LEFT(login_time,10)";
            $this->db->execute( $sql );
            $num = $this->db->fetch()['num'];
            if ( $num > 0 )
                return true;

            return false;
        }
    }