<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/7/1
     * Time: 上午10:13
     */

    namespace interfaces;


    use core\Base;

    abstract class IExecutable extends Base
    {
        /**
         * 用来初始化一些必要事件和参数
         */
        protected function onBeforeRun(){}

        function execute()
        {
            $this->onBeforeRun();
            while ( 1 ) {
                $this->run();
            }
        }

        /**
         * 重复执行的任务
         * @return mixed
         */
        abstract protected function run();
    }