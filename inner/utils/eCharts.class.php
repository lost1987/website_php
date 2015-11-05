<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/2
     * Time: 上午10:21
     */

    namespace utils;

    /**
     * echarts 图表数据辅助类
     * Class ECharts
     * @package utils
     */
    class ECharts
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * [直角系]按时间线合并 图表需要的series数据
         * @param string $precision   时间精度 可选['hour','day','month']
         * @param int    $startDate   必要参数 时间点开始
         * @param int    $endDate     必要参数 时间点结束
         * @param string $dateColName 数组中日期字段的key 多个数据数组必须结构和key一样
         * @param        $data1       $data1数组
         * @param        $data2
         *                            ...
         * @return array(日期线数组,数据1,数据2....) 请用list(arg1,arg2...)来接收该函数的返回值
         *                            日期时间线的格式为 Y/m/d
         */
        function mergeDataByTimeLineInRectangular( $precision = 'day' , $startDate , $endDate , $dateColName , $data )
        {
            $argsNum = func_num_args();
            $args = func_get_args();
            $datas = array_slice( $args , 4 , $argsNum );

            switch ($precision) {
                case 'hour':
                    $diff = 60 * 60;
                    $dateFormat = 'Y/m/d H:i';
                    break;
                case 'day' :
                    $diff = 24 * 60 * 60;
                    $dateFormat = 'Y/m/d';
                    break;
                case 'month':
                    $diff = 31 * 24 * 60 * 60;
                    $dateFormat = 'Y/m';
                    $startDate = strtotime( date( 'Y-m-01' , $startDate ) );
                    break;
            }

            //制作时间线
            $timeLine = array( $startDate );
            while ( $startDate < $endDate ) {
                $startDate += $diff;
                $timeLine[] = $startDate;
            }

            $newData = array();
            foreach ( $timeLine as &$time ) {
                for ( $k = 0 ; $k < count( $datas ) ; $k ++ ) {
                    $DataOnDate = false; //当前日期是否有数据
                    for ( $i = 0 ; $i < count( $datas[ $k ] ) ; $i ++ ) {
                        if ( strcmp( strval( $time ) , $datas[ $k ][ $i ][ $dateColName ] ) == 0 ) {
                            $newData[ $k ][] = $datas[ $k ][ $i ];
                            $DataOnDate = true;
                            break 1;
                        }
                    }
                    if ( !$DataOnDate )
                        $newData[ $k ][] = 0;//数据不存在给0
                }
                $time = date( $dateFormat , $time );
            }

            array_unshift( $newData , $timeLine );

            return $newData;
        }
    }