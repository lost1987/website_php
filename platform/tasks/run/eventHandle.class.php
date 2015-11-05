<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/29
     * Time: 下午3:14
     */

    namespace tasks\run;


    use common\Event;
    use common\GameMsg;
    use common\ItemChangeLog;
    use common\Platform;
    use core\DB;
    use core\Encoder;
    use interfaces\IExecutable;
    use utils\Tools;

    /**
     * 负责web或者api的事件处理
     * Class EventHandle
     * @package run
     */
    class EventHandle extends IExecutable
    {

        /**
         * @var \ZMQSocket
         */
        private $_socket = null;

        /**
         * @var \core\DB
         */
        private $_gmsDB = null;

        /**
         * @var \core\DB
         */
        private $_xfDB = null;

        /**
         * 用来初始化一些必要事件和参数
         */
        protected function onBeforeRun()
        {
            $this->_gmsDB = new DB();
            $this->_gmsDB->init_db_from_config('gms');
            $this->_gmsDB->setSessionWaitTimeOut(86400);

            $this->_xfDB = new DB();
            $this->_xfDB->init_db_from_config('xinfeng');
            $this->_xfDB->setSessionWaitTimeOut(86400);
        }

        function __destruct(){
            $this->_gmsDB->close();
            $this->_xfDB->close();
        }

        /**
         * 开始执行,执行入口
         */
        function execute()
        {
                $this->onBeforeRun();
                //监听端口9001
                $context = new \ZMQContext(1);
                $this->_socket = new \ZMQSocket($context,\ZMQ::SOCKET_PULL);
                $this->_socket->bind("tcp://*:9002");
                $this->run();
        }


        /**
         * 重复执行的任务
         * @return mixed
         */
        protected function run()
        {
                while(1){
                    $response = $this->_socket->recv();
                    $response = Encoder::instance()->decode($response,Encoder::MSGPACK);
                    if(!empty($response)){
                        switch($response['event']){
                            case Event::DO_AFTER_EXCHANGE:
                                $this->doAfterExchange($response['data']);
                                break;
                            case Event::DO_AFTER_LOGIN:
                                $this->doAfterLogin($response['data']);
                                break;
                            case Event::DO_AFTER_RECHARGE:
                                $this->doAfterRecharge($response['data']);
                                break;
                            case Event::DO_AFTER_REGISTER:
                                $this->doAfterRegister($response['data']);
                                break;
                        }
                    }
                    usleep(100);
                }
        }


        private function doAfterExchange($data){
            $platform_id = $data['platform_id'];
            $user_id = $data['user_id'];
            $product = $data['product'];

            ItemChangeLog::instance()->saveChangeLog(
                $user_id,
                ItemChangeLog::instance()->exchangeDesp($product),
                $product['item_cost_type'],
                $product['item_cost_num'],
                $product['item_get_type'],
                $product['item_get_num'],
                $product['server_id']
            );

            //发送itemChange
            GameMsg::instance()->itemChangeNotifiction($user_id,$product['item_cost_type'],$product['item_get_type']);
        }


        private function doAfterRegister($data){
            $user_id = $data['user_id'];
            $platform_id = $data['platform_id'];

            if(!empty($user_id) && !empty($platform_id)){
                    //写入注册统计数据
                    $create_date = strtotime(date('Y-m-d'));
                    $create_time = strtotime(date('Y-m-d H:00:00'));

                    $sql = "SELECT id,register_num  FROM gms_analysis_register WHERE create_time = ? and platform_type = ?";
                    $this->_gmsDB->execute($sql,array($create_time,$platform_id));
                    $result = $this->_gmsDB->fetch();
                    if(empty($result['id'])){//写新数据
                            $fields = array(
                                'sid' => 1,
                                'register_num' => 1,
                                'platform_type' => $platform_id,
                                'game_version' => '1.001.22',
                                'create_time' => $create_time,
                                'create_date' => $create_date,
                                'game_id' => 1
                            );
                            $this->_gmsDB->save($fields,'gms_analysis_register');
                    }else{//更新数据
                            $fields = array(
                                'register_num' => intval($result['register_num'])+1
                            );
                            $this->_gmsDB->update($fields,'gms_analysis_register',' WHERE id='.$result['id']);
                    }

                    //创建登陆记录
                    $fields = array(
                        'user_id' => $user_id,
                        'login_time' => date('Y-m-d H:i:s'),
                        'login_type' => $platform_id,
                        'ip_address' => Tools::getip()
                    );
                    $this->_xfDB->save($fields,'xf_user_visit_history');
            }
        }


        private function doAfterLogin($data){
                $user_id = $data['user_id'];
                $platform_id = $data['platform_id'];
                $sid = empty($data['server_id']) ? 1 : $data['server_id'];

                if(!empty($user_id) && !empty($platform_id)){
                    //写入登陆统计数据
                    $create_date = strtotime(date('Y-m-d'));
                    $create_time = strtotime(date('Y-m-d H:00:00'));

                    //判断是否是新用户
                    $sql = "SELECT MAX(UNIX_TIMESTAMP(login_time)) as login_time FROM xf_user_visit_history WHERE user_id = ?";
                    $this->_xfDB->execute($sql,array($user_id));
                    $result = $this->_xfDB->fetch();
                    $is_new_user =  false;
                    $is_regress_user = false;
                    if(empty($result['login_time'])) {
                        $is_new_user = true;
                    }else{
                        //是否是回归用户
                        $regressDays = 7;//大于7天未登录 本次登录就算是回归用户
                        $diffDays = ( $create_date - $result['login_time'] ) / ( 24 * 60 * 60 );
                        if($diffDays >= 7)
                            $is_regress_user = true;
                    }

                    //是否是今天第一次登陆
                    $is_login_today = false;
                    if($result['login_time'] > $create_date)
                        $is_login_today = true;

                    if(!$is_login_today) {
                        $sql = "SELECT id,login_num,new_login_num,old_login_num,regress_num  FROM gms_analysis_login_num WHERE create_time = ? and platform_type= ? ";
                        $this->_gmsDB->execute( $sql , array( $create_time , $platform_id ) );
                        $result = $this->_gmsDB->fetch();
                        $login_num = 0;
                        $new_login_num = 0;
                        $old_login_num = 0;
                        $regress_num = 0;
                        if ( !empty( $result['id'] ) ) {
                                $login_num = $result['login_num']+1;
                                $new_login_num =  $result['new_login_num'] ;
                                $old_login_num = $result['old_login_num'] ;
                                $regress_num  = $result['regress_num'];
                                if($is_new_user)
                                    $new_login_num++;
                                else
                                    $old_login_num++;
                                if($is_regress_user)
                                    $regress_num++;

                                $fields = array(
                                    'login_num' => $login_num,
                                    'new_login_num' => $new_login_num,
                                    'old_login_num' => $old_login_num,
                                    'regress_num' => $regress_num
                                );

                                $this->_gmsDB->update($fields,'gms_analysis_login_num',' WHERE id='.$result['id']);

                        } else {
                                 $login_num = 1;
                                if($is_new_user)
                                    $new_login_num++;
                                else
                                    $old_login_num++;
                                if($is_regress_user)
                                    $regress_num++;

                                $fields = array(
                                    'login_num' => $login_num,
                                    'new_login_num' => $new_login_num,
                                    'old_login_num' => $old_login_num,
                                    'regress_num' => $regress_num,
                                    'platform_type' =>$platform_id,
                                    'create_time' => $create_time,
                                    'create_date' => $create_date,
                                    'sid' => $sid,
                                    'game_version' => '1.00',
                                    'game_id' => 1
                                );

                                $this->_gmsDB->save($fields,'gms_analysis_login_num');
                        }
                    }

                    //登陆次数
                    $sql = "SELECT id,login_count,new_login_count,old_login_count   FROM gms_analysis_login_count WHERE create_time = ? and platform_type= ? ";
                    $this->_gmsDB->execute( $sql , array( $create_time , $platform_id ) );
                    $result = $this->_gmsDB->fetch();
                    $login_count = 0;
                    $new_login_count = 0;
                    $old_login_count = 0;
                    if ( !empty( $result['id'] ) ) {
                        $login_count = $result['login_count']+1;
                        $new_login_count =  $result['new_login_count'] ;
                        $old_login_count = $result['old_login_count'] ;
                        if($is_new_user)
                            $new_login_count++;
                        else
                            $old_login_count++;

                        $fields = array(
                            'login_count' => $login_count,
                            'new_login_count' => $new_login_count,
                            'old_login_count' => $old_login_count
                        );

                        $this->_gmsDB->update($fields,'gms_analysis_login_count',' WHERE id='.$result['id']);

                    } else {
                        $login_count = 1;
                        if($is_new_user)
                            $new_login_count++;
                        else
                            $old_login_count++;

                        $fields = array(
                            'login_count' => $login_count,
                            'new_login_count' => $new_login_count,
                            'old_login_count' => $old_login_count,
                            'platform_type' =>$platform_id,
                            'create_time' => $create_time,
                            'create_date' => $create_date,
                            'sid' => $sid,
                            'game_version' => '1.001.22',
                            'game_id' => 1
                        );

                        $this->_gmsDB->save($fields,'gms_analysis_login_count');
                    }
                }

                //创建登陆记录
                $fields = array(
                    'user_id' => $user_id,
                    'login_time' => date('Y-m-d H:i:s'),
                    'login_type' => $platform_id,
                    'ip_address' => Tools::getip()
                );
                $this->_xfDB->save($fields,'xf_user_visit_history');

                //通知游戏服务器踢掉所有该用户的会话
                $ch = curl_init();
                $url = $this->config->common['http_monitor'].'';
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
                curl_exec($ch);
                curl_close($ch);
        }


        private function doAfterRecharge($data){
                    $order_no = $data['order_no'];
                    $user_id = $data['user_id'];
                    $recharge_type = $data['recharge_type'];
                    $platform = Platform::instance()->getRechargePlatform($order_no);

                    $sql = "SELECT money FROM xf_payment_order WHERE order_no = ?";
                    $this->_xfDB->execute($sql,array($order_no));
                    $order = $this->_xfDB->fetch();
                    $money = floatval($order['money']);
                    if(!empty($order)){
                        $ch = curl_init();
                        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
                        //通知游戏服务器充值累计
                        curl_setopt($ch,CURLOPT_URL,$this->config->common['http_monitor']."add-consume?uid={$order['user_id']}&consume= {$order['money']}");
                        curl_exec($ch);
                        curl_close($ch);


                        //判断是否是首次充值
                        $is_first_recharge = false;
                        $sql = "SELECT COUNT(*)  as  num FROM xf_payment_order WHERE user_id = ? AND status = 1";
                        $this->_xfDB->execute($sql,array($user_id));
                        $payment = $this->_xfDB->fetch();
                        if($payment['num']  <=  1)
                            $is_first_recharge = true;

                        $create_date = strtotime(date('Y-m-d'));
                        $create_time = strtotime(date('Y-m-d H:00:00'));
                        $sql = "SELECT * FROM gms_analysis_recharge WHERE create_time = ? AND platform_type = ?";
                        $this->_gmsDB->execute($sql,array($create_time,$platform));
                        $recharge = $this->_gmsDB->fetch();

                        $fields['sid'] = 1;
                        $fields['version'] = '1.001.22';
                        $fields['recharge_count'] = 1;
                        $fields['recharge_num'] = 1;
                        $fields['old_recharge_count'] = 0;
                        $fields['new_recharge_count'] = 0;
                        $fields['old_recharge_num'] = 0;
                        $fields['new_recharge_num'] = 0;
                        $fields['platform_type'] = $platform;
                        $fields['recharge_type'] = $recharge_type;
                        $fields['create_time'] = $create_time;
                        $fields['create_date'] = $create_date;

                        if(empty($recharge)){
                            $fields['recharge_money'] = $money;

                            if($is_first_recharge) {
                                $fields['new_recharge_count'] ++;
                                $fields['new_recharge_num']++;
                                $fields['new_recharge_money'] = $money;
                            }
                            else {
                                $fields['old_recharge_count'] ++;
                                $fields['old_recharge_num']++;
                                $fields['old_recharge_money'] = $money;
                            }

                            $this->_gmsDB->save($fields,'gms_analysis_recharge');

                        }else{
                            $fields['recharge_money'] = floatval($recharge['recharge_money'])+$money;
                            $fields['recharge_count'] = $recharge['recharge_count'] + 1;
                            $fields['recharge_num'] = $recharge['recharge_num'] + 1;

                            if($is_first_recharge) {
                                $fields['new_recharge_count'] = $recharge['new_recharge_count'] + 1;
                                $fields['new_recharge_num'] = $recharge['new_recharge_num'] + 1;
                                $fields['new_recharge_money'] = $recharge['new_recharge_money'] + $money;
                            }
                            else {
                                $fields['old_recharge_count']  = $recharge['old_recharge_count'] + 1;
                                $fields['old_recharge_num'] = $recharge['old_recharge_num'] + 1;
                                $fields['old_recharge_money'] = $recharge['old_recharge_money'] + $money;
                            }

                            $this->_gmsDB->update($fields,'gms_analysis_recharge','WHERE id = '.$recharge['id']);
                        }
                    }
        }
    }