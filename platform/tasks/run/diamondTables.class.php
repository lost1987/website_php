<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/4
     * Time: 上午10:09
     */

    namespace tasks\run;


    use core\DB;
    use core\Encoder;
    use core\Redis;
    use interfaces\IExecutable;

    /**
     * 武汉麻将
     * 钻石场 资源统计
     * Class DiamondTables
     * @package run
     */
    class DiamondTables extends IExecutable
    {
        /**
         * @var \core\DB
         */
        private $_gmsDB = null;

         function __destruct(){
            $this->redis->close();
            $this->_gmsDB->close();
        }

        /**
         * 用来初始化一些必要事件和参数
         */
        protected function onBeforeRun()
        {
            $this->_gmsDB = new DB();
            $this->_gmsDB->init_db_from_config('gms');
            $this->_gmsDB->setSessionWaitTimeOut(86400);
        }


        /**
         * 重复执行的任务
         * @return mixed
         */
        protected function run()
        {
            $tableNums = $this->redis->get('cheat_lv4_tables');
            $tableAmount = $this->redis->get('zjprefit:');
            if(!empty($tableAmount))
                $tableAmount = Encoder::instance()->decode($tableAmount);
            $tableNums = empty($tableNums) ? 0 : $tableNums;
            $nowAmount = empty($tableAmount['now_amout']) ? 0 : $tableAmount['now_amout'];
            $sql = "SELECT source_amount FROM gms_analysis_diamond_table ORDER BY create_time DESC limit 1";
            $this->_gmsDB->execute($sql);
            $source_amount = $this->_gmsDB->fetch()['source_amount'];
            if(empty($source_amount))
                $source_amount = 0;
            $create_time = time();
            $create_date = strtotime(date('Y-m-d'));
            $changeAmount = $nowAmount - $source_amount;
            $sql = "INSERT INTO gms_analysis_diamond_table (table_num,chi_change,create_time,create_date,source_amount) VALUES ($tableNums,$changeAmount,$create_time,$create_date,$nowAmount)";
            $this->_gmsDB->execute($sql);
            sleep(300);
        }

    }