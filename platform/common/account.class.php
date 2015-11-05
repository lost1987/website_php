<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/21
     * Time: 下午4:39
     */

    namespace common;

    use common\base\BaseItems;
    use common\base\BaseServers;
    use common\model\UserAuthModel;
    use common\model\UserModel;
    use common\model\VisitHistoryModel;
    use core\DB;
    use core\Singleton;
    use utils\Tools;

    class Account extends Singleton
    {

        const USER_AUTH_IDCARD = 1; //身份证验证

        const USER_AUTH_MAIL = 2; //邮箱认证

        const USER_AUTH_SMS = 3; //短信认证

        const STATE_NOT_IN_GAME = 0;//0:没有

        const STATE_IN_HALL = 1;//1:在大厅已经踢出

        const STATE_IN_GAME = 2;//2:在游戏稍后踢出

        protected static $_instance = null;

        private $_user_id = null;

        function setUserId( $user_id )
        {
            $this->_user_id = $user_id;

            return $this;
        }

        function makePassword( $md5_32_password , $user_number )
        {
            return md5( $md5_32_password . '#' . $user_number );
        }

        /**
         * 检查是否加载的缓存中的物品静态表
         */
        private function itemsLoaded()
        {
            if ( $this->_items === null )
                $this->_items = BaseItems::instance()->lists();
        }

        /**
         * 获得该账号所拥有的账号物品
         */
        function publicItems( $user = null )
        {
            //10000~20000 之间为公共物品
            if ( $user === null )
                $user = UserModel::instance()->getUserByUid( $this->_user_id );

            $data = ItemsManager::instance()->format( $user['items'] , $user['items_num'] );
            $data['diamond'] = $user['diamond'];
            return $data;
        }

        /**
         * 获得账号在该游戏服务器的物品
         * @param $server_id
         */
        function gameItems( $server_id )
        {

        }


        /**
         * 用户认证
         * @param $uid
         * @param $auth_type
         * @return bool
         */
        function auth( $uid , $auth_type )
        {
            if ( UserAuthModel::instance()->save( $uid , $auth_type ) )
                return true;

            return false;
        }


        /**
         * 检查用户的认证状态
         * @param $uid
         * @return array 以auth_type为下标的数组 值1为已认证 0为未认证
         */
        function getAuth( $uid )
        {
            $auths = UserAuthModel::instance()->read( $uid );
            $user_auth = array();
            $user_auth[ self::USER_AUTH_IDCARD ] = 0;
            $user_auth[ self::USER_AUTH_MAIL ] = 0;
            $user_auth[ self::USER_AUTH_SMS ] = 0;

            $auth_types = array_keys( $user_auth );
            foreach ( $auths as $auth ) {
                if ( in_array( $auth['auth_type'] , $auth_types ) ) {
                    $user_auth[ $auth['auth_type'] ] = 1;
                }
            }
            unset( $auth_types , $auths );

            return $user_auth;
        }

        function isValidPassword($md5_32_password,$user_number,$md5_twice_32_password){
            if ( md5( $md5_32_password . '#' . $user_number ) == $md5_twice_32_password )
                return true;

            return false;
        }

        /**
         * 创建访问记录
         * @param $uid
         * @param $login_type
         */
        function createVisitHistory( $uid , $login_type )
        {
            $fields = array(
                'user_id'    => $uid ,
                'login_time' => date( 'Y-m-d H:i:s' ) ,
                'ip_address' => Tools::getip() ,
                'login_type' => $login_type
            );
            VisitHistoryModel::instance()->save( $fields );
        }

        /**
         * 从文件抓取随机昵称
         * @return string
         */
        function randomName()
        {
            $words = Tools::getCSVdata( BASE_PATH . '/common/name_generator.csv' );
            $words = array_slice( $words , 0 , 375 );
            $indexes = array_rand( $words , 2 );
            $chooser1 = $words[ $indexes[0] ];
            $chooser2 = $words[ $indexes[1] ];
            $name = ${'chooser' . rand( 1 , 2 )}['first_name'] . ${'chooser' . rand( 1 , 2 )}['last_name'];

            return $name;
        }

        /**
         * 给用户增加物品
         * @param $items
         * @param $items_num
         */
        function addItems(Array $items, Array $items_num){
                $gameDbs= array();
                for($i = 0; $i < count($items) ; $i++){
                        $server = ServerUtil::instance()->getServerInfoFromItemNo($items[$i]);
                        if($server['id'] == 1){//全局物品
                                $user = UserModel::instance()->getUserByUid($this->_user_id,array('items','items_num'));
                                ItemsManager::instance()->addItems( $items[$i] , $items_num[$i] , $user['items'] , $user['items_num'] );
                                $this->db->update($user,'xf_user',' WHERE user_id = '.$this->_user_id);
                        }else{//游戏物品
                            if(!array_key_exists($server['id'],$gameDbs)) {
                                $gamedb  = new DB();
                                $gamedb->init_db_from_config($server['server_db_name']);
                                $gameDbs[$server['id']] = $gamedb;
                            }else{
                                $gamedb = $gameDbs[$server['id']];
                            }

                            $profile  = new Profile();
                            $profileData = $profile->setGameDB($gamedb)->setUserId($this->_user_id)->read(array('items','items_num'));
                            ItemsManager::instance()->addItems( $items[$i] , $items_num[$i] , $profileData['items'] , $profileData['items_num'] );
                            $profile->update($profileData);
                        }
                        usleep(10);
                }

                //关闭数据库链接
                foreach($gameDbs as $db){
                    $db->close();
                    usleep(10);
                }

                $this->flush();
        }

        /**
         * 清除用户缓存(资金,游戏金币,筹码,道具等等)
         */
        function flush(){
                $servers = BaseServers::instance()->lists();
                $this->redis->select(0);
                foreach($servers as $server){
                    $this->redis->del($server['user_info_rkey'].$this->_user_id);
                }
                $this->redis->select(2);
        }
    }