<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/14
     * Time: 下午5:22
     */

    namespace tasks\run;


    use core\DB;
    use core\Redis;
    use interfaces\IExecutable;
    use utils\Arrays;

    /**
     * 机器人作弊统计
     * Class RobotCheat
     * @package run
     */
    class RobotCheat extends IExecutable
    {
        /**
         * @var \core\DB
         */
        private $_gmsDB = null;

        private $_counter = 0;

        /**
         * 用来初始化一些必要事件和参数
         */
        protected function onBeforeRun()
        {
            $this->redis->select( 0 );

            $this->_gmsDB = new DB();
            $this->_gmsDB->init_db_from_config( 'gms' );
            $this->_gmsDB->setSessionWaitTimeOut(86400);
        }

        /**
         * 重复执行的任务
         * @return mixed
         */
        protected function run()
        {
            $fields = array();
            $fields['create_time'] = time();
            $fields['create_date'] = strtotime( date( 'Y-m-d' ) );

            //取系统人数
            $fields['online'] = count( $this->redis->keys( 'sessionid:*' ) );
            //取系统中机器人输赢的金币数量差
            $fields['source_win_coins'] = intval( $this->redis->get( 'cheat_robot_win_coins' ) ) ;
            $fields['source_lost_coins'] = intval( $this->redis->get( 'cheat_robot_lost_coins' ) );
            $fields['coins'] =$fields['source_lost_coins']  - $fields['source_win_coins'] ;

            if(!$this->redis->get( 'cheat_state' )){
                $this->redis->set('cheat_lv1_rate',5);
                $this->redis->set('cheat_lv2_rate',18);
            }

            if($fields['coins'] > 200000 || $fields['coins'] < -100000 )
                $this->_counter++;

            if(   ($fields['coins'] > 200000 || $fields['coins'] < -100000)  && $this->_counter > 2){
                //开始调整机器人作弊
                $this->redis->set('cheat_lv1_rate',10);
                $this->redis->set('cheat_lv2_rate',28);

                $code= '机器人作弊'.mt_rand(0,10);
                $content = "系统发生实时错误，错误信息：{$code}，请及时排除。";
                $params = array(
                    'account'  => 'cf_nbgame' ,
                    'password' => '16youxi' ,
                    'mobile'   => '18601191616' ,
                    'content'  => $content
                );

                $this->_counter  = 0;
                $curl = curl_init();
                curl_setopt( $curl , CURLOPT_URL ,'http://106.ihuyi.cn/webservice/sms.php?method=Submit');
                curl_setopt( $curl , CURLOPT_HEADER , false );
                curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true );
                curl_setopt( $curl , CURLOPT_NOBODY , true );
                curl_setopt( $curl , CURLOPT_POST , true );
                curl_setopt( $curl , CURLOPT_POSTFIELDS , $params );
                $result = curl_exec( $curl );
                curl_close( $curl );
                $result = Arrays::xml_to_array( $result );
                error_log( '短信平台返回代码为:' . $result['SubmitResult']['code'] );
                if ( $result['SubmitResult']['code'] == 2 ) {
                    return true;
                }
                error_log( 'sms send failed:' . $result['SubmitResult']['code'] . ';' . $content );
            }

            //取系统中AI的输赢黄钻数
            $fields['yellow_diamonds'] = intval($this->redis->get('cheat_robot_lost_dias') - intval($this->redis->get('cheat_robot_win_dias')));
            //取初级场桌数
            $fields['tablelv1'] = $this->redis->get( 'cheat_lv1_tables' );
            //取中级场桌数
            $fields['tablelv2'] = $this->redis->get( 'cheat_lv2_tables' );
            //取高级场桌数
            $fields['tablelv3'] = $this->redis->get( 'cheat_lv3_tables' );
            //取初级场作弊几率
            $fields['cheat_rate_lv1'] = $this->redis->get( 'cheat_lv1_rate' );
            //取中级场作弊几率
            $fields['cheat_rate_lv2'] = $this->redis->get( 'cheat_lv2_rate' );
            //取高级场作弊几率
            $fields['cheat_rate_lv3'] = $this->redis->get( 'cheat_lv3_rate' );
            //取输了金币的机器人数量
            $fields['nums'] = $this->redis->get( 'cheat_current_robot_num' );
            //清除输了金币的机器人数量
            $this->redis->del( 'cheat_current_robot_num' );

            $this->_gmsDB->save( $fields , 'gms_analysis_robot_coins' );

            sleep( 300 );
        }
    }