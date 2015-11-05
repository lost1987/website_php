<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/19
     * Time: 17:30
     */

    namespace tasks\run;


    use common\base\BaseServers;
    use core\DB;
    use core\ReflectClass;
    use interfaces\IExecutable;

    /**
     * 进程天任务
     * Class DayTask
     * @package run
     */
    class DayTask extends IExecutable
    {

        /**
         * @var \core\DB;
         */
        private $_xfDB = null;

        /**
         * @var \core\DB;
         */
        private $_gmsDB = null;

        /**
         * @var \core\DB;
         */
        private $_pmsDB = null;

        /**
         * 重复执行的任务
         * @return mixed
         */
        protected function run()
        {
            $hour = date('H');
            if($hour == 3){//定在每天凌晨3点执行任务
                        if($this->_xfDB === null) {
                            $this->_xfDB = new DB();
                            $this->_xfDB->init_db_from_config( 'xinfeng' );
                        }

                        if($this->_gmsDB === null) {
                            $this->_gmsDB = new DB();
                            $this->_gmsDB->init_db_from_config( 'gms' );
                        }

                        if($this->_pmsDB === null) {
                            $this->_pmsDB = new DB();
                            $this->_pmsDB->init_db_from_config( 'pms' );
                        }

                        $this->userRemain();
                        $this->userGameRemain();
                        $this->gameVigorous();
                        error_log('所有任务执行完毕');

                        $this->_xfDB->close();
                        $this->_gmsDB->close();
                        $this->_pmsDB->close();
                        $this->_xfDB = null;
                        $this->_gmsDB = null;
                        $this->_pmsDB = null;
            }
            sleep(3600);
        }

        /**
         * 平台留存率
         */
        private function  userRemain(){
                $end_unix_time = strtotime(date('Y-m-d'));
                $start_unix_time =  $end_unix_time - 24*60*60;
                $second_day_unix_time = $start_unix_time - 24*60*60;//次日留存时间
                $week_day_unix_time = $start_unix_time - 7*24*60*60;//7日留存时间
                $month_day_unix_time = $start_unix_time - 30*24*60*60;//30日留存时间

                $reflect = new ReflectClass('common\Platform');
                $platforms = $reflect->getConstants();

                foreach ($platforms as $platformName => $platform_type){
                    //查找今日的注册人数(其实就是前一日的注册人数因为该程序会在次日凌晨更新数据)
                    $sql = "SELECT SUM(register_num) as register_num FROM gms_analysis_register WHERE sid=1 AND platform_type=? AND create_time>? AND create_time<? AND game_id = 1";
                    $this->_gmsDB->execute($sql,array($platform_type,$start_unix_time,$end_unix_time));
                    $result = $this->_gmsDB->fetch();
                    $registerNum = intval($result['register_num']);

                    //先写入今日的留存空数据 等日后来更新
                    $fields =  array(
                        'sid' => 1,
                        'platform_type'=>$platform_type,
                        'register_num' => $registerNum,
                        'second_day_num' => 0,
                        'week_day_num' => 0,
                        'month_day_num' => 0,
                        'create_time' => $end_unix_time,
                        'game_id' =>1
                    );
                    $this->_gmsDB->save($fields,'gms_analysis_remain');

                    //开始计算留存率
                    //统计前一天的留存数据
                    $remain = $this->remainNDay($second_day_unix_time,$start_unix_time,$end_unix_time,$platform_type);
                    if($remain['id'] != null){
                        $fields = array('second_day_num' => $remain['stillLoginNum']);
                        $this->_gmsDB->update($fields,'gms_analysis_remain',' WHERE id = '.$remain['id']);
                    }

                    //统计前七天的留存数据
                    $remain = $this->remainNDay($week_day_unix_time,$start_unix_time,$end_unix_time,$platform_type);
                    if($remain['id'] != null){
                        $fields = array('week_day_num' => $remain['stillLoginNum']);
                        $this->_gmsDB->update($fields,'gms_analysis_remain',' WHERE id = '.$remain['id']);
                    }

                    //统计前三十天的留存数据
                    $remain = $this->remainNDay($month_day_unix_time,$start_unix_time,$end_unix_time,$platform_type);
                    if($remain['id'] != null){
                        $fields = array('month_day_num' => $remain['stillLoginNum']);
                        $this->_gmsDB->update($fields,'gms_analysis_remain',' WHERE id = '.$remain['id']);
                    }
                    usleep(100);
                }

        }

        /**
         **@param int dayTime 查询注册的起始时间
         **@param today_start_time 今日的起始时间
         **@param today_end_time 今日的结束时间
         **@param platform_type 渠道
         **@return ndayLoginNum 注册当天的gms留存数据的id 今日仍在登登录的玩家数
         **/
        private function remainNDay($dayTime,$today_start_time,$today_end_time,$platform_type){
            $start_time = date('YmdHis',$dayTime);
            $end_time = date('YmdHis',$dayTime+60*60*24);

            $user_visit_start_time = date('Y-m-d H:i:s',$today_start_time);
            $user_visit_end_time = date('Y-m-d H:i:s',$today_end_time);

            //查找当天的注册人数
            $sql = "SELECT user_id FROM xf_user WHERE regist_time > ? AND regist_time < ? AND is_robot = 0 AND register_type=?";
            $this->_xfDB->execute($sql,array($start_time,$end_time,$platform_type));
            $registers  =  $this->_xfDB->fetch_all();

            //查找今天的登陆人数
            $sql = "SELECT DISTINCT(a.user_id) as user_id FROM xf_user_visit_history a LEFT JOIN xf_user b ON a.user_id=b.user_id WHERE a.login_time > ? AND a.login_time < ? AND b.is_robot = 0 AND a.login_type=? AND a.game_id = 1";
            $this->_xfDB->execute($sql,array($user_visit_start_time,$user_visit_end_time,$platform_type));
            $loginers = $this->_xfDB->fetch_all();

            //计算当天的注册人数中 今天还在登陆的人数
            $stillLoginNum = 0;
            foreach($registers as $register){
                foreach($loginers as $loginer){
                        if($register['user_id'] == $loginer['user_id']) {
                            $stillLoginNum ++;
                            break 1;
                        }
                }
            }

            //查询当天注册的gms里的数据id
            $sql = "SELECT id FROM gms_analysis_remain WHERE create_time=? AND sid=1 AND platform_type=?";
            $this->_gmsDB->execute($sql,array($dayTime+60*60*24,$platform_type));
            $result = $this->_gmsDB->fetch();
            if(empty($result['id']))
                $result['id'] = null;
            $result['stillLoginNum'] = $stillLoginNum;
            return $result;
        }

        /**
         * 游戏里的留存率
         * @throws \Exception
         */
        private function userGameRemain(){
            $servers = BaseServers::instance()->lists();
            $end_unix_time = strtotime(date('Y-m-d'));
            $start_unix_time =  $end_unix_time - 24*60*60;
            $second_day_unix_time = $start_unix_time - 24*60*60;//次日留存时间
            $third_day_unix_time = $start_unix_time - 3*24*60*60;//3日留存时间
            $week_day_unix_time = $start_unix_time - 7*24*60*60;//7日留存时间

            $reflect = new ReflectClass('common\Platform');
            $platforms = $reflect->getConstants();

            foreach($servers as $server_id => $server){
                $gameDB = new DB();
                $gameDB -> init_db($server);
                foreach($platforms as $platform_type){
                    //查找今日的注册人数(其实就是前一日的注册人数因为该程序会在次日凌晨更新数据)
                    $sql = "SELECT SUM(register_num) as register_num FROM gms_analysis_register WHERE sid=1 AND platform_type=? AND create_time>? AND create_time<? AND game_id = 1";
                    $this->_gmsDB->execute($sql,array($platform_type,$start_unix_time,$end_unix_time));
                    $result = $this->_gmsDB->fetch();
                    $registerNum = intval($result['register_num']);

                    //先写入今日的留存空数据 等日后来更新
                    $fields =  array(
                        'platform_type'=>$platform_type,
                        'register_num' => $registerNum,
                        'second_day_num' => 0,
                        'third_day_num' => 0,
                        'week_day_num' => 0,
                        'create_time' => $end_unix_time,
                        'server_id' =>$server_id
                    );
                    $this->_pmsDB->save($fields,'pms_analysis_game_remain');

                    //开始计算留存率
                    //统计前一天的留存数据
                    $remain = $this->gameRemainNDay($second_day_unix_time,$start_unix_time,$end_unix_time,$platform_type,$server_id,$gameDB);
                    if($remain['id'] != null){
                        $fields = array('second_day_num' => $remain['stillLoginNum']);
                        $this->_pmsDB->update($fields,'pms_analysis_game_remain',' WHERE id = '.$remain['id']);
                    }

                    //统计前三天的留存数据
                    $remain = $this->gameRemainNDay($third_day_unix_time,$start_unix_time,$end_unix_time,$platform_type,$server_id,$gameDB);
                    if($remain['id'] != null){
                        $fields = array('third_day_num' => $remain['stillLoginNum']);
                        $this->_pmsDB->update($fields,'pms_analysis_game_remain',' WHERE id = '.$remain['id']);
                    }

                    //统计前七天的留存数据
                    $remain = $this->gameRemainNDay($week_day_unix_time,$start_unix_time,$end_unix_time,$platform_type,$server_id,$gameDB);
                    if($remain['id'] != null){
                        $fields = array('week_day_num' => $remain['stillLoginNum']);
                        $this->_pmsDB->update($fields,'pms_analysis_game_remain',' WHERE id = '.$remain['id']);
                    }
                    usleep(100);
                }
                $gameDB->close();
                error_log('server_id:'.$server['id'].'游戏留存统计完毕');
                sleep(1);
            }
        }

        /**
         * 游戏内留存率算法
         * @param $dayTime
         * @param $today_start_time
         * @param $today_end_time
         * @param $platform_type
         * @param $server_id
         * @param $gameDB
         * @return mixed
         */
        private function gameRemainNDay($dayTime , $today_start_time , $today_end_time, $platform_type,$server_id,$gameDB){
            $start_time = date('YmdHis',$dayTime);
            $end_time = date('YmdHis',$dayTime+60*60*24);

            $user_visit_start_time = date('Y-m-d H:i:s',$today_start_time);
            $user_visit_end_time = date('Y-m-d H:i:s',$today_end_time);

            //查找当天的注册人数
            $sql = "SELECT user_id FROM xf_user WHERE regist_time > ? AND regist_time < ? AND is_robot = 0 AND register_type=?";
            $this->_xfDB->execute($sql,array($start_time,$end_time,$platform_type));
            $registers  =  $this->_xfDB->fetch_all();

            //查找今天的登陆游戏人数
            $sql = "SELECT DISTINCT(a.user_id) as user_id FROM xf_user_visit_history a LEFT JOIN xf_user b ON a.user_id=b.user_id WHERE a.login_time > ? AND a.login_time < ? AND b.is_robot = 0 AND a.login_type=? AND a.game_id = 1";
            $this->_xfDB->execute($sql,array($user_visit_start_time,$user_visit_end_time,$platform_type));
            $loginers = $this->_xfDB->fetch_all();

            //计算当天的注册人数中 今天还在登陆的人数
            $stillPlayNum = 0;
            foreach($registers as $register){
                foreach($loginers as $loginer){
                    if($register['user_id'] == $loginer['user_id']) {
                        //查找当前用户是否在游戏牌局打过牌
                        $sql = "SELECT COUNT(*) as num FROM user_table_log WHERE  user_id = ? AND table_begin_time > ? AND table_end_time < ?";
                        $gameDB->execute($sql,array($loginer['user_id'],$start_time,$end_time));
                        $result = $gameDB->fetch();
                        if($result['num'] > 0)
                                $stillPlayNum ++;
                        break 1;
                    }
                }
            }

            //查询当天注册的pms里的数据id
            $sql = "SELECT id FROM pms_analysis_game_remain WHERE create_time=? AND server_id=? AND platform_type=?";
            $this->_pmsDB->execute($sql,array($dayTime+60*60*24,$server_id,$platform_type));
            $result = $this->_pmsDB->fetch();
            if(empty($result['id']))
                $result['id'] = null;
            $result['stillPlayNum'] = $stillPlayNum;
            return $result;
        }

        /**
         * 游戏里的活跃度
         */
        function gameVigorous(){
            $servers = BaseServers::instance()->lists();
            $end_unix_time = strtotime(date('Y-m-d'));
            $start_unix_time =  $end_unix_time - 24*60*60;
            $start_three_day_ago_unix_time = $end_unix_time - 24*60*60*3;
            $start_week_day_ago_unix_time = $end_unix_time - 24*60*60*7;
            $start_month_day_ago_unix_time = $end_unix_time - 24*60*60*30;


            $reflect = new ReflectClass('common\Platform');
            $platforms = $reflect->getConstants();

            foreach($servers as $server_id => $server){
                $gameDB = new DB();
                $gameDB -> init_db($server);
                foreach($platforms as $platform_type){
                    //最近3天注册，当日有进行游戏的用户数
                    $sql = "SELECT user_id FROM xf_user WHERE regist_time > ? AND regist_time < ? AND platform_type = ?";
                    $this->_xfDB->execute($sql,array(date('YmdHis',$start_three_day_ago_unix_time),date('YmdHis',$end_unix_time),$platform_type));
                    $users = $this->_xfDB->fetch_all();

                    $sql = "SELECT DISTINCT(user_id) as user_id FROM user_table_log WHERE table_begin_time > ? AND table_end_time < ?";
                    $gameDB-> execute($sql,array($start_unix_time,$end_unix_time));
                    $playGameUsers = $gameDB->fetch_all();

                    $playerNums = 0;
                    foreach($users as $user){
                        foreach($playGameUsers as $playUser){
                            if($user['user_id'] == $playUser['user_id']) {
                                $playerNums ++;
                                break 1;
                            }
                        }
                    }

                    //当日登陆2小时或以上游戏的用户数
                    $today_vigorous_num = 0;
                    $twoHourSeconds = 60*60*2;
                    $sql = "SELECT  user_id  FROM user_on_off_line WHERE on_line_time > ? AND off_line_time < ? GROUP BY user_id HAVING SUM(off_line_time-on_line_time) >= ? ORDER BY null";
                    $gameDB->execute($sql,array($start_unix_time,$end_unix_time,$twoHourSeconds));
                    $result = $gameDB->fetch_all();
                    foreach($result as $r){
                        $sql = "SELECT register_type FROM xf_user WHERE user_id = ?";
                        $this->_xfDB->execute($sql,array($r['user_id']));
                        $user = $this->_xfDB->fetch();
                        if($user['register_type'] == $platform_type)
                            $today_vigorous_num++;
                    }

                    //最近7天有三天或者以上玩过游戏的用户数
                    //先查出7天内玩过游戏的总人数
                    $sql = "SELECT DISTINCT(user_id) as user_id FROM user_table_log WHERE table_begin_time > ? AND table_end_time < ?";
                    $gameDB->execute($sql,array($start_week_day_ago_unix_time,$end_unix_time));
                    $users = $gameDB->fetch_all();

                    //再查询这些人中每天有玩游戏的人
                    $week_vigorous_num = 0;
                    foreach($users as $user) {
                        $sql = "SELECT register_type FROM xf_user WHERE user_id = ?";
                        $this->_xfDB->execute($sql,array($user['user_id']));
                        $result = $this->_xfDB->fetch();

                        if($result['register_type'] == $platform_type) {
                            $sql = "SELECT count(*) as playNum FROM user_table_log WHERE table_begin_time > ? AND table_end_time < ? AND user_id = ?
                            GROUP BY LEFT(FROM_UNIXTIME(table_begin_time,'%Y-%m-%d %H:%i:%s'),10) ORDER BY null";
                            $gameDB->execute( $sql , array( $start_week_day_ago_unix_time , $end_unix_time , $user['user_id'] ) );
                            $playUsers = $gameDB->fetch_all();
                            $time = 0;//七天中玩游戏的天数
                            foreach ( $playUsers as $playUser ) {
                                if ( $playUser['playNum'] > 0 )
                                    $time ++;
                            }
                            if ( $time >= 3 )
                                $week_vigorous_num ++;
                        }
                    }


                    //最近30天有10或以上玩过游戏的用户数
                    //先查出30天内玩过游戏的总人数
                    $sql = "SELECT DISTINCT(user_id) as user_id FROM user_table_log WHERE table_begin_time > ? AND table_end_time < ?";
                    $gameDB->execute($sql,array($start_month_day_ago_unix_time,$end_unix_time));
                    $users = $gameDB->fetch_all();

                    //再查询这些人中每天有玩游戏的人
                    $month_vigorous_num = 0;
                    foreach($users as $user) {
                        $sql = "SELECT register_type FROM xf_user WHERE user_id = ?";
                        $this->_xfDB->execute($sql,array($user['user_id']));
                        $result = $this->_xfDB->fetch();
                        if($result['register_type'] == $platform_type){
                            $sql = "SELECT count(*) as playNum FROM user_table_log WHERE table_begin_time > ? AND table_end_time < ? AND user_id = ?
                            GROUP BY LEFT(FROM_UNIXTIME(table_begin_time,'%Y-%m-%d %H:%i:%s'),10) ORDER BY null";
                            $gameDB->execute($sql,array($start_month_day_ago_unix_time,$end_unix_time,$user['user_id']));
                            $playUsers = $gameDB->fetch_all();
                            $time = 0;//30天中玩游戏的天数
                            foreach($playUsers as $playUser){
                                if($playUser['playNum'] > 0)
                                    $time++;
                            }
                            if($time >= 10)
                                $month_vigorous_num++;
                        }
                    }

                    //当天在线的总时长
                    $sql = "SELECT SUM(off_line_time-on_line_time) as online_time FROM user_on_off_line WHERE on_line_time > ? AND off_line_time < ? AND user_id in (SELECT user_id FROM xinfeng.xf_user WHERE register_type = ?)";
                    $gameDB->execute($sql,array($start_unix_time,$end_unix_time,$platform_type));
                    $onlineTime = $gameDB->fetch()['online_time'];

                    //当天玩游戏的总时长
                    $sql = "SELECT SUM(table_end_time-table_begin_time) as play_time FROM user_table_log WHERE table_begin_time > ? AND table_end_time < ? AND user_id in (SELECT user_id FROM xinfeng.xf_user WHERE register_type = ?)";
                    $gameDB->execute($sql,array($start_unix_time,$end_unix_time,$platform_type));
                    $playTime = $gameDB->fetch()['play_time'];

                    $fields = array(
                        'play_double_time_num' => $playerNums,
                        'today_vigorous_num' => $today_vigorous_num,
                        'week_vigorous_num' => $week_vigorous_num,
                        'month_vigorous_num' => $month_vigorous_num,
                        'online_seconds' => $onlineTime,
                        'play_seconds' => $playTime,
                        'server_id' => $server_id,
                        'platform_type' => $platform_type,
                        'create_date' => $start_unix_time
                    );

                    $this->_pmsDB->save($fields,'pms_analysis_game_vigorous');
                    usleep(100);
                }
                $gameDB->close();
            }
        }
    }
