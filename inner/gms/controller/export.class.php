<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/4
     * Time: 下午3:24
     */

    namespace gms\controller;

    use core\Base;
    use excelfactory\FactoryExcelExport;

    /**
     * 负责所有导出性功能的控制器
     * Class Export
     * @package gms\controller
     */
    class Export extends Base
    {

        /**
         * 导出excel
         */
        function excel()
        {
            $request = $this->input->get();
            $classname = $request['name'];
            unset( $request['name'] );
            FactoryExcelExport::create( $classname )->export( $request );
        }

    }