<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/6
     * Time: 下午2:05
     */

    namespace tasks\run;


    use core\DB;
    use core\Redis;
    use interfaces\IExecutable;

    /**
     * 武汉麻将
     * 宝箱统计任务
     * Class BaoxiangTables
     * @package run
     */
    class BaoxiangTables extends IExecutable
    {
        /**
         * @var \core\DB
         */
        private $_gmsDB = null;

        /**
         * @var \core\DB
         */
        private $_gameDB = null;

        function __destruct(){
            $this->redis->close();
            $this->_gmsDB->close();
            $this->_gameDB->close();
        }

        /**
         * 用来初始化一些必要事件和参数
         */
        protected function onBeforeRun()
        {
            $this->_gmsDB = new DB();
            $this->_gmsDB->init_db_from_config('gms');

            $this->_gameDB = new DB();
            $this->_gameDB->init_db_from_config('game');
        }


        /**
         * 重复执行的任务
         * @return mixed
         */
        protected function run()
        {
            $tableNum = $this->redis ->get('cheat_lv2_tables');//宝箱桌数
            $userNum = $this->redis->get('cheat_lv2_users');//用户人数
            $robotLoseAmount = empty($this->redis->get('cheat_lv2_user_lost_coins')) ? 0 : $this->redis->get('cheat_lv2_user_lost_coins') ;//机器人输金币数
            $robotWinAmount = empty($this->redis->get('cheat_lv2_user_win_coins')) ? 0 : $this->redis->get('cheat_lv2_user_win_coins');//机器人赢金币数
            $robotAmount = $robotWinAmount - $robotLoseAmount;
            //用户开宝箱的次数
            $sql = "SELECT COUNT(*) as num FROM baoxiang_history";
            $this->_gameDB -> execute($sql);
            $bxCount = $this->_gameDB->fetch()['num'];

            //发放的钻石和奖券总数
            $sql = "SELECT SUM(SUBSTRING(item_nums,9)) as item_num,RIGHT(item_nos,1) as item_no FROM baoxiang_history GROUP BY RIGHT(item_nos,1)";
            $this->_gameDB->execute($sql);
            $amount = $this->_gameDB->fetch_all();

            $couponAmount = 0;
            $diamondAmount = 0;
            foreach($amount as $a){
                if($a['item_no'] == 2)
                    $couponAmount = $a['item_num'];
                else if($a['item_no'] == 3)
                    $diamondAmount = $a['item_num'];
            }

            //写入统计数据
            $create_time = time();
            $sql = "INSERT INTO gms_analysis_baoxiang (table_num,user_num,robot_amount,bx_count,coupon_amount,diamond_amount,create_time)
                         VALUES ($tableNum,$userNum,$robotAmount,$bxCount,$couponAmount,$diamondAmount,$create_time)";
            $this->_gmsDB->execute($sql);

            sleep(60 * 30);
        }
    }