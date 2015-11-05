<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/20
     * Time: 15:47
     */

    namespace tasks\run;


    use common\base\BaseServers;
    use core\DB;
    use core\ReflectClass;
    use interfaces\IExecutable;

    /**
     * 小时任务
     * Class HourTask
     * @package run
     */
    class HourTask extends IExecutable
    {
        private $_functions = array('userVigorous','userOnline');

        /**
         * 重复执行的任务
         * @return mixed
         */
        protected function run()
        {
            $minute = date('i');
            if($minute == 59){//定在每小时59分执行
                //fork两次保证不会WNOHANG产生僵尸进程
                $pid = pcntl_fork();

                if($pid){//父进程 等待子进程销毁
                    pcntl_wait($status);
                }else{//子进程
                    //在子进程中产生孙进程 并且无需管理,孙进程退出后 会直接托管给init(linux系统进程)
                    for($i=0 ;$i < count($this->_functions); $i++){
                        $cpid = pcntl_fork();//再次fork
                        switch($cpid){
                            case 0://孙进程
                                call_user_func(array($this,$this->_functions[$i]));
                                //孙进程执行完毕 直接退出 托管给init
                                posix_kill(getmypid(),SIGTERM);
                                break;
                            case -1://创建孙进程失败
                                break;
                            default ://在子进程里
                                pcntl_wait($status,WNOHANG);//不等待孙进程,并行执行
                        }
                    }
                   //不要使用exit(0)会产生socket警告,直接用posix信号控制就可以了
                   posix_kill(getmypid(),SIGTERM);//退出子进程
                }
            }
            sleep(60);
        }

        /**
         * 平台活跃度
         */
        function userVigorous(){
            $reflect = new ReflectClass('common\Platform');
            $platforms = $reflect->getConstants();

            $create_time = strtotime(date('Y-m-d H:00:00'));
            $create_date = strtotime(date('Y-m-d'));

            $gmsDB = new DB();
            $gmsDB->init_db_from_config('gms');

            foreach($platforms as $platformName => $platform_type){
                $vigorousNum = 0;
                $newVigorousNum = 0;
                $oldVigorousNum = 0;

                $sql = "SELECT SUM(login_num) as login_num,SUM(new_login_num) as new_login_num,SUM(old_login_num) as old_login_num FROM  gms_analysis_login_num WHERE sid = 1 AND platform_type = ? AND game_version = '1.001.22' AND create_time = ? AND game_id = 1";
                $gmsDB->execute($sql,array($platform_type,$create_time));
                $result = $gmsDB->fetch();

                if(!empty($result)){
                    $vigorousNum = $result["login_num"];
                    $newVigorousNum = $result["new_login_num"];
                    $oldVigorousNum = $result["old_login_num"];
                }

                $fields = array(
                    "vigorous_num"=>     $vigorousNum,
                    "new_vigorous_num" =>  $newVigorousNum,
                    "old_vigorous_num"=> $oldVigorousNum,
                    "sid" =>              1,
                    "platform_type" =>    $platform_type,
                    "game_version" =>     '1.001.22',
                    "create_date" =>       $create_date,
                    "create_time" =>      $create_time,
                    "game_id" =>           1,
                );

                $gmsDB->save($fields,'gms_analysis_vigorous');
                usleep(100);
            }
            $gmsDB->close();
            error_log('平台活躍度統計執行完畢');
        }

        function userOnline(){//由於效率問題(每小時統計) 所以暫時不加入渠道的統計
            $create_time = strtotime(date('Y-m-d H:00:00'));
            $create_date = strtotime(date('Y-m-d'));
            $servers = BaseServers::instance()->lists();
            $pmsDB = new DB();
            $pmsDB->init_db_from_config('pms');

            foreach($servers as $server_id => $server){

                if(empty($server['server_db_name']))
                    continue;

                $gameDB = new DB();
                $gameDB->init_db($server);

                //查詢前一條記錄
                $sql = "SELECT max_online FROM pms_analysis_game_online WHERE server_id = ? AND create_date = ? AND create_time < ? limit 1";
                $pmsDB->execute($sql,array($server_id,$create_date,$create_time));
                $result = $pmsDB->fetch();
                $lastMaxOnline = 0;
                if(!empty($result['max_online']))
                    $lastMaxOnline = intval($result['max_online']);

                $online = intval($this->redis->get($server['user_info_rkey']).'onLineNums');
                $maxonline = $online;


                if($maxonline < $lastMaxOnline)
                    $maxonline = $lastMaxOnline;

                $fields = array(
                    'online' => $online,
                    'max_online' => $maxonline,
                    'server_id' => $server_id,
                    'create_time' => $create_time,
                    'create_date' => $create_date
                );

                $pmsDB->save($fields,'pms_analysis_game_online');
                $gameDB->close();
                usleep(100);
            }
            $pmsDB->close();
            error_log('遊戲在線人數統計執行完畢');
        }
    }