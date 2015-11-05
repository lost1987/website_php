<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/4
     * Time: 下午3:41
     */

    namespace excelfactory;


    class FactoryExcelExport
    {

        /**
         * 创建并返回IExcelExport的实例
         * @param string $classname 实现IExcelExport接口的类名
         * @return \excelfactory\IExcelExport
         */
        final static function create( $classname )
        {
            require_once BASE_PATH . '/libs/excel/PHPExcel.php';

            return call_user_func( array( __NAMESPACE__ . '\\' . $classname , 'instance' ) );
        }
    }