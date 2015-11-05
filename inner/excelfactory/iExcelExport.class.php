<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/4
     * Time: 上午9:44
     */
    namespace excelfactory;

    interface IExcelExport
    {

        /**
         * @return \excelfactory\IExcelExport
         */
        static function instance();

        /**
         * 数据抓取类
         * @param httpRequest $request
         * @return array(Array $data ,Array $columnNames,Array $columnKeys)
         * 返回 (原数据数组$data,列中文名数组,列键名数组)
         */
        public function fetchData( Array $request );

    }