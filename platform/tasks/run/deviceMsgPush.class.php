<?php
    /**
     * Created by PhpStorm.
     * User: buhuan
     * Date: 15/7/1
     * Time: 下午3:25
     */

    namespace tasks\run;


    use core\DB;
    use core\Redis;
    use interfaces\IExecutable;
    use libs\device\AndroidPusher;
    use libs\device\IosPusher;

    /**
     * 武汉麻将 消息推送
     * Class DeviceMsgPush
     * @package run
     */
    class DeviceMsgPush extends IExecutable
    {
        /**
         * @var \core\DB
         */
        private $_gmsDB;

        /**
         * @var \core\DB
         */
        private $_xfDB;

        /**
         * 设置是否是产品模式
         * @var bool
         */
        private $_notifiction_product_mode = true;

        protected function run()
        {
            $hour = intval( date( 'H' ) );
            $day = intval( date( 'd' ) );
            $sql = "SELECT * FROM gms_msg_push_task";
            $this->_gmsDB = new DB();
            $this->_gmsDB->init_db_from_config( 'gms' );
            $this->_gmsDB->execute( $sql );
            $tasks = $this->_gmsDB->fetch_all();

            $this->_xfDB = new DB();
            $this->_xfDB->init_db_from_config( 'xinfeng' );

            foreach ( $tasks as $task ) {
                if ( $day == intval( $task['task_day'] ) && $task['task_day'] != 0 ) {
                    if ( $hour == intval( $task['task_hour'] ) ) {
                        $this->notify( $task );
                    }
                } else {
                    if ( $hour == intval( $task['task_hour'] ) && $task['task_day'] == 0 ) {
                        $this->notify( $task );
                    }
                }
            }
            $this->_gmsDB->close();
            $this->_xfDB->close();
            $this->redis->close();
            sleep( 3600 );
        }

        private function notify( $task )
        {
            if ( $task['users_type'] == 'broadcast' ) {
                if ( $task['device'] == 1 ) {
                    $this->sendAndroid( $task );
                } else if ( $task['device'] == 2 ) {
                    $this->sendIOS( $task );
                } else {
                    $this->sendAndroid( $task );
                    $this->sendIOS( $task );
                }
            } else {
                $infos = $this->redis->lrange( $task['users_type'] , 0 , - 1 );
                if ( false !== $infos ) {
                    $user_ids = array();
                    $login_names = array();
                    foreach ( $infos as $info ) {
                        list( $user_ids[] , $login_names[] ) = explode( '`' , $info );
                    }

                    if ( $task['device'] == 1 ) {
                        $this->sendAndroid( $task , $login_names );
                    } else if ( $task['device'] == 2 ) {
                        $this->sendIOS( $task , $login_names );
                    } else {
                        $this->sendAndroid( $task , $login_names );
                        $this->sendIOS( $task , $login_names );
                    }
                }
            }
        }

        private function sendAndroid( $task , $login_names = null )
        {
            if ( $login_names === null )
                AndroidPusher::instance()->send( $task['title'] , $task['content'] , AndroidPusher::BROADCAST , $this->_notifiction_product_mode );
            else
                AndroidPusher::instance()->send( $task['title'] , $task['content'] , AndroidPusher::USERGROUP , $this->_notifiction_product_mode , $login_names );
        }

        private function sendIOS( $task , $login_names = null )
        {
            //取imei号
            $imei = array();
            if ( $login_names === null ) {
                $sql = "SELECT imei FROM xf_imei WHERE  type=2";
            } else {
                $login_names = implode( ',' , $login_names );
                $sql = "SELECT imei FROM xf_imei WHERE FIND_IN_SET(login_name,'$login_names') > 0 AND type=2";
            }
            $this->_xfDB->execute( $sql );
            $result = $this->_xfDB->fetch_all();
            foreach ( $result as $r ) {
                $imei[] = $r['imei'];
            }
            if ( count( $imei ) > 0 ) {
                IosPusher::instance()->send( $task['content'] , $imei ,$this->_notifiction_product_mode );
            }
        }

    }