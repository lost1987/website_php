<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/2/28
     * Time: 上午11:12
     */

    namespace gms\controller;


    use common\model\UserModel_M;
    use common\model\VisitHistory;
    use common\Platform;
    use core\Redis;
    use gms\core\AdminController;
    use core\Encoder;
    use gms\libs\AdminUtil;
    use gms\libs\ModuleDictionary;
    use gms\model\DataRobotCheat_M;
    use gms\model\DatasDiamondCost_M;
    use gms\model\DatasDiamondGet_M;
    use gms\model\DatasDiamondTable_M;
    use gms\model\DatasLoginCount_M;
    use gms\model\DatasLoginNum_M;
    use gms\model\DatasMonetary_M;
    use gms\model\DatasRecharge_M;
    use gms\model\DatasRegister_M;
    use gms\model\DatasUserRemain_M;
    use gms\model\DatasVigorous_M;
    use gms\model\PayMentOrder_M;
    use gms\model\UserCoujiangData_M;
    use utils\Date;
    use utils\ECharts;
    use utils\Page;

    class Datas extends AdminController
    {
        /**
         * 数据概览
         */
        function total()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_TOTAL );
            $this->init_navigator();

            //数据总览
            $total['register'] = UserModel_M::instance()->total();
            $total['rechargeNum'] = PayMentOrder_M::instance()->rechargeNum();
            $total['rechargeTotal'] = PayMentOrder_M::instance()->rechargeTotal();
            $total['payRatio'] = empty( $total['register'] ) ? '0.00%' : number_format( $total['rechargeNum'] / $total['register'] , 3 ) * 100 . '%';
            $total['ARPU'] = empty( $total['register'] ) ? '0.00%' : number_format( $total['rechargeTotal'] / $total['register'] , 3 );
            $total['ARPPU'] = empty( $total['rechargeNum'] ) ? '0.00%' : number_format( $total['rechargeTotal'] / $total['rechargeNum'] , 3 );
            $this->output_data['total'] = $total;

            //今日数据
            $today['newUsers'] = DatasRegister_M::instance()->todayNum();
            $today['vigorous'] = DatasVigorous_M::instance()->todayNum();
            $today['newUsersRatio'] = empty( $today['vigorous'] ) ? '0.00%' : number_format( $today['newUsers'] / $today['vigorous'] , 3 ) * 100 . '%';
            $today['loginCount'] = DatasLoginCount_M::instance()->todayNum();
            $this->output_data['today'] = $today;

            $end_time = strtotime( date( 'Y-m-d' ) );
            //时段分析 以图表（折线图）显示新增用户、活跃用户、付费用户、付费金额、新增付费用户、启动次数 单位范围小时 显示今日与昨日的数据
            $condition['start_time'] = $end_time - 24 * 60 * 60;
            $condition['end_time'] = $end_time;
            $tNewUsersList = DatasRegister_M::instance()->set_condition( $condition )->listsByHours();
            $tVigorousList = DatasVigorous_M::instance()->set_condition( $condition )->listsByHours();
            $tRechargeList = DatasRecharge_M::instance()->set_condition( $condition )->listsByHours();
            $tLoginCountList = DatasLoginCount_M::instance()->set_condition( $condition )->listsByHours();
            list( $t['timeLine'] , $t['newUsers'] , $t['vigorous'] , $t['recharge'] , $t['loginCount'] ) = ECharts::instance()->mergeDataByTimeLineInRectangular(
                'hour' ,
                $condition['start_time'] ,
                $condition['end_time'] ,
                'createDate' ,
                $tNewUsersList ,
                $tVigorousList ,
                $tRechargeList ,
                $tLoginCountList
            );
            $this->output_data['t'] = Encoder::instance()->encode( $t );

            //整体趋势 whole 以图表显示新增用户、活跃用户、活跃用户构成（新用户/老用户）、启动次数、平均单次使用时长,默认显示过去30天的数据
            $condition['start_time'] = $end_time - 24 * 60 * 60 * 30;
            $wNewUsersList = DatasRegister_M::instance()->set_condition( $condition )->listsByDays();
            $wVigorous = DatasVigorous_M::instance()->set_condition( $condition )->listsByDays();
            foreach ( $wVigorous as &$v ) {
                //活跃用户构成
                $v['struct'] = empty( $v['oldVigorousNum'] ) ? 0 : number_format( $v['newVigorousNum'] / $v['oldVigorousNum'] , 3 );
            }
            $wLoginCount = DatasLoginCount_M::instance()->set_condition( $condition )->listsByDays();
            list( $w['timeLine'] , $w['newUsers'] , $w['vigorous'] , $w['loginCount'] ) = ECharts::instance()->mergeDataByTimeLineInRectangular(
                'day' ,
                $condition['start_time'] ,
                $condition['end_time'] ,
                'createDate' ,
                $wNewUsersList ,
                $wVigorous ,
                $wLoginCount );
            $this->output_data['w'] = Encoder::instance()->encode( $w );

            //付费分析 以图表显示付费用户、新增付费用户、付费金额、付费率 默认显示过去30天的数据
            $pRechargeList = DatasRecharge_M::instance()->set_condition( $condition )->listsByDays();
            foreach ( $pRechargeList as &$v ) {
                $vigorous = DatasVigorous_M::instance()->set_condition( array( 'start_time' => $v['createDate'] , 'end_time' => $v['createDate'] ) )->listsByDays( 0 , 1 );
                $v['ratio'] = empty( $vigorous[0]['vigorousNum'] ) ? 0 : number_format( $v['rechargeNum'] / $vigorous[0]['vigorousNum'] , 3 );
            }
            list( $p['timeLine'] , $p['recharge'] ) = ECharts::instance()->mergeDataByTimeLineInRectangular(
                'day' ,
                $condition['start_time'] ,
                $condition['end_time'] ,
                'createDate' ,
                $pRechargeList
            );
            $this->output_data['p'] = Encoder::instance()->encode( $p );


            //留存分析
            $remainList = DatasUserRemain_M::instance()->set_condition( $condition )->listsByDays();
            foreach ( $remainList as &$rl ) {
                if ( $rl['registerNum'] == 0 ) {
                    $rl['secondDayRatio'] = '0.00';
                    $rl['weekDayRatio'] = '0.00';
                    $rl['monthDayRatio'] = '0.00';
                } else {
                    $rl['secondDayRatio'] = number_format( $rl['secondDayNum'] / $rl['registerNum'] , 3 );
                    $rl['weekDayRatio'] = number_format( $rl['weekDayNum'] / $rl['registerNum'] , 3 );
                    $rl['monthDayRatio'] = number_format( $rl['monthDayNum'] / $rl['registerNum'] , 3 );
                }
            }

            list( $r['timeLine'] , $r['remain'] ) = ECharts::instance()->mergeDataByTimeLineInRectangular(
                'day' ,
                $condition['start_time'] ,
                $condition['end_time'] ,
                'createDate' ,
                $remainList
            );
            $this->output_data['r'] = Encoder::instance()->encode( $r );

            //游戏规模 extent
            $startWeekDay = $end_time - 7 * 60 * 60 * 24;
            $startMonthDay = $end_time - 30 * 60 * 60 * 24;
            $e['register'] = $total['register'];
            $weekVigorous = VisitHistory::instance()->vigorousNum( $startWeekDay , $end_time );
            $monthVigorous = VisitHistory::instance()->vigorousNum( $startMonthDay , $end_time );
            $e['weekVigorousRatio'] = empty( $e['register'] ) ? '0.00%' : number_format( $weekVigorous / $e['register'] , 3 ) * 100 . '%';
            $e['monthVigorousRatio'] = empty( $e['register'] ) ? '0.00%' : number_format( $monthVigorous / $e['register'] , 3 ) * 100 . '%';
            $this->output_data['e'] = $e;

            /*
             *  10. 渠道
                10.1 以图表显示web端及移动段的新增用户、活跃用户
                10.2 Y轴为渠道，X轴为0-相应数据的最大值
                10.3 显示今日及昨日的数据
             */
            $condition['start_time'] = $end_time - 24 * 60 * 60;
            $platforms = Platform::instance()->getClientPlatforms();
            $pt = array();
            $flag = 0;

            foreach ( $platforms as $platform => $platformName ) {
                $pt['platforms'][] = str_replace( '手机客户端' , '' , $platformName );
                $pt['register'][] = DatasRegister_M::instance()->NumByPlatform( $condition['start_time'] , $condition['end_time'] , $platform );
                $pt['registerTotal'][] = DatasRegister_M::instance()->NumTotalByPlatform( $platform );
                $pt['vigorous'][] = DatasVigorous_M::instance()->NumByPlatform( $condition['start_time'] , $condition['end_time'] , $platform );
                $flag ++;
            }
            $this->output_data['pt'] = Encoder::instance()->encode( $pt );

//        Tools::dump($this->output_data);


            //使用摘要  以表格显示：累计启动（人均）、过去7天的平均单次使用时长、过去7天的平均日使用时长
            //TODO : 暂时无此数据

            /*
             * 版本
                9.1 以图表显示各个版本的新增用户、活跃用户、累计用户
                9.2 Y轴为版本，X轴为0-相应数据的最大值
                9.3 显示今日及昨日的数据
             */
            //TODO:暂时无此数据
            $this->tpl->display( 'chart_datas_total.html' , $this->output_data );
        }

        /**
         * 注册
         * @throws \Exception
         */
        function register()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_REGISTER );
            $this->init_navigator();

            //获取查询条件
            $search_params = $this->http_get_params();
            //默认精度为天
            if ( !isset( $search_params['precision'] ) ) $search_params['precision'] = 'day';
            if ( empty( $search_params['start_time'] ) || empty( $search_params['end_time'] ) ) {
                list( $search_params['start_time'] , $search_params['end_time'] ) = Date::instance()->recentSevenDaysSE();
            } else {
                $search_params['start_time'] = strtotime( $search_params['start_time'] );
                $search_params['end_time'] = strtotime( $search_params['end_time'] );
            }
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' ) {
                    $this->output_data[ 'search_' . $k ] = $v;
                } else
                    unset( $search_params[ $k ] );
            }

            //时间精度
            $precision = $search_params['precision'];
            switch ($precision) {
                case 'hour':
                    $loginCountList = DatasLoginCount_M::instance()->set_condition( $search_params )->listsByHours();
                    $loginNumList = DatasLoginNum_M::instance()->set_condition( $search_params )->listsByHours();
                    $registerList = DatasRegister_M::instance()->set_condition( $search_params )->listsByHours();
                    break;
                case 'day' :
                    $loginCountList = DatasLoginCount_M::instance()->set_condition( $search_params )->listsByDays();
                    $loginNumList = DatasLoginNum_M::instance()->set_condition( $search_params )->listsByDays();
                    $registerList = DatasRegister_M::instance()->set_condition( $search_params )->listsByDays();
                    break;
                case 'month':
                    $loginCountList = DatasLoginCount_M::instance()->set_condition( $search_params )->listsByMonths();
                    $loginNumList = DatasLoginNum_M::instance()->set_condition( $search_params )->listsByMonths();
                    $registerList = DatasRegister_M::instance()->set_condition( $search_params )->listsByMonths();
                    break;
            }

            list( $dateLine , $loginCount , $loginNum , $register ) = ECharts::instance()
                ->mergeDataByTimeLineInRectangular(
                    $precision ,
                    $search_params['start_time'] ,
                    $search_params['end_time'] ,
                    'createDate' ,
                    $loginCountList ,
                    $loginNumList ,
                    $registerList );

            $this->output_data['precisionlist'] = array(
                'month' => '月' ,
                'day'   => '天' ,
                'hour'  => '小时'
            );
            $this->output_data['platformlist'] = Platform::instance()->getClientPlatforms();
            $this->output_data['dateLineJson'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['loginCountJson'] = Encoder::instance()->encode( $loginCount );
            $this->output_data['loginNumJson'] = Encoder::instance()->encode( $loginNum );
            $this->output_data['registerJson'] = Encoder::instance()->encode( $register );
            $this->output_data['dateLine'] = $dateLine;
            $this->output_data['loginCount'] = $loginCount;
            $this->output_data['loginNum'] = $loginNum;
            $this->output_data['register'] = $register;
            $this->tpl->display( 'chart_datas_register.html' , $this->output_data );
        }

        /**
         * 登录人数
         */
        function loginNum()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_LOGIN_NUM );
            $this->init_navigator();

            //获取查询条件
            $search_params = $this->http_get_params();
            //默认精度为天
            if ( !isset( $search_params['precision'] ) ) $search_params['precision'] = 'day';
            if ( empty( $search_params['start_time'] ) || empty( $search_params['end_time'] ) ) {
                list( $search_params['start_time'] , $search_params['end_time'] ) = Date::instance()->recentSevenDaysSE();
            } else {
                $search_params['start_time'] = strtotime( $search_params['start_time'] );
                $search_params['end_time'] = strtotime( $search_params['end_time'] );
            }
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' ) {
                    $this->output_data[ 'search_' . $k ] = $v;
                } else
                    unset( $search_params[ $k ] );
            }

            //时间精度
            $precision = $search_params['precision'];
            switch ($precision) {
                case 'hour':
                    $loginNumList = DatasLoginNum_M::instance()->set_condition( $search_params )->listsByHours();
                    break;
                case 'day' :
                    $loginNumList = DatasLoginNum_M::instance()->set_condition( $search_params )->listsByDays();
                    break;
                case 'month':
                    $loginNumList = DatasLoginNum_M::instance()->set_condition( $search_params )->listsByMonths();
                    break;
            }

            list( $dateLine , $loginNum ) = ECharts::instance()
                ->mergeDataByTimeLineInRectangular(
                    $precision ,
                    $search_params['start_time'] ,
                    $search_params['end_time'] ,
                    'createDate' ,
                    $loginNumList );

            $this->output_data['precisionlist'] = array(
                'month' => '月' ,
                'day'   => '天' ,
                'hour'  => '小时'
            );
            $this->output_data['platformlist'] = Platform::instance()->getClientPlatforms();
            $this->output_data['dateLineJson'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['loginNumJson'] = Encoder::instance()->encode( $loginNum );
            $this->output_data['dateLine'] = $dateLine;
            $this->output_data['loginNum'] = $loginNum;
            $this->tpl->display( 'chart_datas_login_num.html' , $this->output_data );
        }

        /**
         * 启动次数
         */
        function loginCount()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_LOGIN_COUNT );
            $this->init_navigator();

            //获取查询条件
            $search_params = $this->http_get_params();
            //默认精度为天
            if ( !isset( $search_params['precision'] ) ) $search_params['precision'] = 'day';
            if ( empty( $search_params['start_time'] ) || empty( $search_params['end_time'] ) ) {
                list( $search_params['start_time'] , $search_params['end_time'] ) = Date::instance()->recentSevenDaysSE();
            } else {
                $search_params['start_time'] = strtotime( $search_params['start_time'] );
                $search_params['end_time'] = strtotime( $search_params['end_time'] );
            }
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' ) {
                    $this->output_data[ 'search_' . $k ] = $v;
                } else
                    unset( $search_params[ $k ] );
            }

            //时间精度
            $precision = $search_params['precision'];
            switch ($precision) {
                case 'hour':
                    $loginCountList = DatasLoginCount_M::instance()->set_condition( $search_params )->listsByHours();
                    break;
                case 'day' :
                    $loginCountList = DatasLoginCount_M::instance()->set_condition( $search_params )->listsByDays();
                    break;
                case 'month':
                    $loginCountList = DatasLoginCount_M::instance()->set_condition( $search_params )->listsByMonths();
                    break;
            }

            list( $dateLine , $loginCount ) = ECharts::instance()
                ->mergeDataByTimeLineInRectangular(
                    $precision ,
                    $search_params['start_time'] ,
                    $search_params['end_time'] ,
                    'createDate' ,
                    $loginCountList );

            $this->output_data['precisionlist'] = array(
                'month' => '月' ,
                'day'   => '天' ,
                'hour'  => '小时'
            );
            $this->output_data['platformlist'] = Platform::instance()->getClientPlatforms();
            $this->output_data['dateLineJson'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['loginCountJson'] = Encoder::instance()->encode( $loginCount );
            $this->output_data['dateLine'] = $dateLine;
            $this->output_data['loginCount'] = $loginCount;
            $this->tpl->display( 'chart_datas_login_count.html' , $this->output_data );
        }

        /**
         * 活跃度
         */
        function vigorous()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_VIGOROUS );
            $this->init_navigator();

            //获取查询条件
            $search_params = $this->http_get_params();
            //默认精度为天
            if ( !isset( $search_params['precision'] ) ) $search_params['precision'] = 'day';
            if ( empty( $search_params['start_time'] ) || empty( $search_params['end_time'] ) ) {
                list( $search_params['start_time'] , $search_params['end_time'] ) = Date::instance()->recentSevenDaysSE();
            } else {
                $search_params['start_time'] = strtotime( $search_params['start_time'] );
                $search_params['end_time'] = strtotime( $search_params['end_time'] );
            }
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' ) {
                    $this->output_data[ 'search_' . $k ] = $v;
                } else
                    unset( $search_params[ $k ] );
            }

            //时间精度
            $precision = $search_params['precision'];
            switch ($precision) {
                case 'hour':
                    $vigorousList = DatasVigorous_M::instance()->set_condition( $search_params )->listsByHours();
                    break;
                case 'day' :
                    $vigorousList = DatasVigorous_M::instance()->set_condition( $search_params )->listsByDays();
                    break;
                case 'month':
                    $vigorousList = DatasVigorous_M::instance()->set_condition( $search_params )->listsByMonths();
                    break;
            }

            list( $dateLine , $vigorous ) = ECharts::instance()
                ->mergeDataByTimeLineInRectangular(
                    $precision ,
                    $search_params['start_time'] ,
                    $search_params['end_time'] ,
                    'createDate' ,
                    $vigorousList );

            $this->output_data['precisionlist'] = array(
                'month' => '月' ,
                'day'   => '天' ,
                'hour'  => '小时'
            );
            $this->output_data['platformlist'] = Platform::instance()->getClientPlatforms();
            $this->output_data['dateLineJson'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['vigorousJson'] = Encoder::instance()->encode( $vigorous );
            $this->output_data['dateLine'] = $dateLine;
            $this->output_data['vigorous'] = $vigorous;
            $this->tpl->display( 'chart_datas_vigorous.html' , $this->output_data );
        }


        function userRemain()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_USER_REMAIN );
            $this->init_navigator();

            //获取查询条件
            $search_params = $this->http_get_params();
            //默认精度为天
            if ( !isset( $search_params['precision'] ) ) $search_params['precision'] = 'day';
            if ( empty( $search_params['start_time'] ) || empty( $search_params['end_time'] ) ) {
                list( $search_params['start_time'] , $search_params['end_time'] ) = Date::instance()->recentSevenDaysSE();
            } else {
                $search_params['start_time'] = strtotime( $search_params['start_time'] );
                $search_params['end_time'] = strtotime( $search_params['end_time'] );
            }
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' ) {
                    $this->output_data[ 'search_' . $k ] = $v;
                } else
                    unset( $search_params[ $k ] );
            }

            //时间精度
            $precision = $search_params['precision'];
            switch ($precision) {
                case 'day' :
                    $remainList = DatasUserRemain_M::instance()->set_condition( $search_params )->listsByDays();
                    break;
                case 'month':
                    $remainList = DatasUserRemain_M::instance()->set_condition( $search_params )->listsByMonths();
                    break;
            }

            foreach ( $remainList as &$rl ) {
                if ( $rl['registerNum'] == 0 ) {
                    $rl['secondDayRatio'] = '0.00';
                    $rl['weekDayRatio'] = '0.00';
                    $rl['monthDayRatio'] = '0.00';
                } else {
                    $rl['secondDayRatio'] = number_format( $rl['secondDayNum'] / $rl['registerNum'] , 3 );
                    $rl['weekDayRatio'] = number_format( $rl['weekDayNum'] / $rl['registerNum'] , 3 );
                    $rl['monthDayRatio'] = number_format( $rl['monthDayNum'] / $rl['registerNum'] , 3 );
                }
            }

            list( $dateLine , $remain ) = ECharts::instance()
                ->mergeDataByTimeLineInRectangular(
                    $precision ,
                    $search_params['start_time'] ,
                    $search_params['end_time'] ,
                    'createDate' ,
                    $remainList );

            $this->output_data['precisionlist'] = array(
                'month' => '月' ,
                'day'   => '天'
            );
            $this->output_data['platformlist'] = Platform::instance()->getClientPlatforms();
            $this->output_data['dateLineJson'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['remainJson'] = Encoder::instance()->encode( $remain );
            $this->output_data['dateLine'] = $dateLine;
            $this->output_data['remain'] = $remain;
            $this->tpl->display( 'chart_datas_remain.html' , $this->output_data );
        }

        /**
         * 货币统计
         */
        function monetary()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_MONETARY );
            $this->init_navigator();

            //获取查询条件
            $search_params = $this->http_get_params();
            //默认精度为天
            if ( !isset( $search_params['precision'] ) ) $search_params['precision'] = 'day';
            //默认货币为金币
            if ( !isset( $search_params['monetary'] ) ) $search_params['monetary'] = 'coins_num';
            if ( empty( $search_params['start_time'] ) || empty( $search_params['end_time'] ) ) {
                list( $search_params['start_time'] , $search_params['end_time'] ) = Date::instance()->recentSevenDaysSE();
            } else {
                $search_params['start_time'] = strtotime( $search_params['start_time'] );
                $search_params['end_time'] = strtotime( $search_params['end_time'] );
            }
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' ) {
                    $this->output_data[ 'search_' . $k ] = $v;
                } else
                    unset( $search_params[ $k ] );
            }

            //时间精度
            $precision = $search_params['precision'];
            switch ($precision) {
                case 'hour':
                    $params = array_merge( $search_params , array( 'resource_type' => 1 ) );
                    $resourceOutList = DatasMonetary_M::instance()->set_condition( $params )->listsByHours();
                    $params = array_merge( $search_params , array( 'resource_type' => 2 ) );
                    $resourceInList = DatasMonetary_M::instance()->set_condition( $params )->listsByHours();
                    break;
                case 'day' :
                    $params = array_merge( $search_params , array( 'resource_type' => 1 ) );
                    $resourceOutList = DatasMonetary_M::instance()->set_condition( $params )->listsByDays();
                    $params = array_merge( $search_params , array( 'resource_type' => 2 ) );
                    $resourceInList = DatasMonetary_M::instance()->set_condition( $params )->listsByDays();
                    break;
                case 'month':
                    $params = array_merge( $search_params , array( 'resource_type' => 1 ) );
                    $resourceOutList = DatasMonetary_M::instance()->set_condition( $params )->listsByMonths();
                    $params = array_merge( $search_params , array( 'resource_type' => 2 ) );
                    $resourceInList = DatasMonetary_M::instance()->set_condition( $params )->listsByMonths();
                    break;
            }

            list( $dateLine , $resourceOut , $resourceIn ) = ECharts::instance()
                ->mergeDataByTimeLineInRectangular(
                    $precision ,
                    $search_params['start_time'] ,
                    $search_params['end_time'] ,
                    'createDate' ,
                    $resourceOutList , $resourceInList );


            $this->output_data['precisionlist'] = array(
                'month' => '月' ,
                'day'   => '天' ,
                'hour'  => '小时'
            );
            $this->output_data['monetaryList'] = array(
                'coins_num'   => '金币' ,
                'diamond_num' => '钻石' ,
                'coupon_num'  => '奖券' ,
                'ticket_num'  => '门票'
            );
            $this->output_data['dateLineJson'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['resourceOutJson'] = Encoder::instance()->encode( $resourceOut );
            $this->output_data['resourceInJson'] = Encoder::instance()->encode( $resourceIn );
            $this->output_data['dateLine'] = $dateLine;
            $this->output_data['resourceOut'] = $resourceOut;
            $this->output_data['resourceIn'] = $resourceIn;
            $this->tpl->display( 'chart_datas_monetary.html' , $this->output_data );
        }

        /**
         * 钻石消耗
         */
        function diamondCost()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_DIAMOND_COST );
            $this->init_navigator();

            //获取查询条件
            $search_params = $this->http_get_params();
            //默认精度为天
            if ( !isset( $search_params['precision'] ) ) $search_params['precision'] = 'day';
            //默认货币为金币
            if ( !isset( $search_params['monetary'] ) ) $search_params['monetary'] = 'coins_num';
            if ( empty( $search_params['start_time'] ) || empty( $search_params['end_time'] ) ) {
                list( $search_params['start_time'] , $search_params['end_time'] ) = Date::instance()->recentSevenDaysSE();
            } else {
                $search_params['start_time'] = strtotime( $search_params['start_time'] );
                $search_params['end_time'] = strtotime( $search_params['end_time'] );
            }
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' ) {
                    $this->output_data[ 'search_' . $k ] = $v;
                } else
                    unset( $search_params[ $k ] );
            }

            //时间精度
            $precision = $search_params['precision'];
            switch ($precision) {
                case 'day' :
                    $costList = DatasDiamondCost_M::instance()->set_condition( $search_params )->listsByDays();
                    $getList = DatasDiamondGet_M::instance()->set_condition( $search_params )->listsByDays();
                    break;
                case 'month':
                    $costList = DatasDiamondCost_M::instance()->set_condition( $search_params )->listsByMonths();
                    $getList = DatasDiamondGet_M::instance()->set_condition( $search_params )->listsByMonths();
                    break;
            }

            list( $dateLine , $costList , $getList ) = ECharts::instance()
                ->mergeDataByTimeLineInRectangular(
                    $precision ,
                    $search_params['start_time'] ,
                    $search_params['end_time'] ,
                    'createDate' ,
                    $costList , $getList );

            $this->output_data['precisionlist'] = array(
                'month' => '月' ,
                'day'   => '天'
            );
            $this->output_data['dateLineJson'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['costJson'] = Encoder::instance()->encode( $costList );
            $this->output_data['getJson'] = Encoder::instance()->encode( $getList );
            $this->output_data['dateLine'] = $dateLine;
            $this->output_data['cost'] = $costList;
            $this->output_data['get'] = $getList;
            $this->tpl->display( 'chart_datas_diamond_cost.html' , $this->output_data );
        }

        /**
         * 回归用户
         * @throws \Exception
         */
        function userRegress()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_USER_REGRESS );
            $this->init_navigator();

            //获取查询条件
            $search_params = $this->http_get_params();
            //默认精度为天
            if ( !isset( $search_params['precision'] ) ) $search_params['precision'] = 'day';
            //默认货币为金币
            if ( !isset( $search_params['monetary'] ) ) $search_params['monetary'] = 'coins_num';
            if ( empty( $search_params['start_time'] ) || empty( $search_params['end_time'] ) ) {
                list( $search_params['start_time'] , $search_params['end_time'] ) = Date::instance()->recentSevenDaysSE();
            } else {
                $search_params['start_time'] = strtotime( $search_params['start_time'] );
                $search_params['end_time'] = strtotime( $search_params['end_time'] );
            }
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' ) {
                    $this->output_data[ 'search_' . $k ] = $v;
                } else
                    unset( $search_params[ $k ] );
            }

            //时间精度
            $precision = $search_params['precision'];
            switch ($precision) {
                case 'day' :
                    $loginNumList = DatasLoginNum_M::instance()->set_condition( $search_params )->listsByDays();
                    $vigorousList = DatasVigorous_M::instance()->set_condition( $search_params )->listsByDays();
                    break;
                case 'month':
                    $loginNumList = DatasLoginNum_M::instance()->set_condition( $search_params )->listsByMonths();
                    $vigorousList = DatasVigorous_M::instance()->set_condition( $search_params )->listsByMonths();
                    break;
            }

            list( $dateLine , $loginNumList , $vigorousList ) = ECharts::instance()
                ->mergeDataByTimeLineInRectangular(
                    $precision ,
                    $search_params['start_time'] ,
                    $search_params['end_time'] ,
                    'createDate' ,
                    $loginNumList , $vigorousList );

            $this->output_data['precisionlist'] = array(
                'month' => '月' ,
                'day'   => '天'
            );
            $this->output_data['dateLineJson'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['loginNumJson'] = Encoder::instance()->encode( $loginNumList );
            $this->output_data['vigorousJson'] = Encoder::instance()->encode( $vigorousList );
            $this->output_data['dateLine'] = $dateLine;
            $this->output_data['loginNumList'] = $loginNumList;
            $this->output_data['vigorousList'] = $vigorousList;
            $this->tpl->display( 'chart_datas_user_regress.html' , $this->output_data );
        }

        function robotCheat()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_ROBOT_CHEAT );
            $this->init_navigator();

            //获取查询条件
            $search_params = $this->http_get_params();
            //默认精度为天
            if ( !isset( $search_params['precision'] ) ) $search_params['precision'] = 'minute';
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' ) {
                    $this->output_data[ 'search_' . $k ] = $v;
                } else
                    unset( $search_params[ $k ] );
            }

            if ( $search_params['precision'] == 'hour' ) {
                $fields = array(
                    'SUM(coins) as coins ' ,
                    'SUM(nums) as nums ' ,
                    'SUM(tablelv1) as tablelv1 ' ,
                    'SUM(tablelv2) as tablelv2 ' ,
                    'SUM(cheat_rate_lv1) as cheat_rate_lv1' ,
                    'SUM(cheat_rate_lv2) as cheat_rate_lv2' ,
                );
                $robotCheatsList = DataRobotCheat_M::instance()->set_condition( $search_params['precision'] )->listsByHour( $fields );
            }
        else {
            $fields = array( 'coins' , 'nums' , 'online' , 'tablelv1' , 'tablelv2' , 'cheat_rate_lv1' , 'cheat_rate_lv2'  );
            $robotCheatsList = DataRobotCheat_M::instance()->set_condition( $search_params['precision'] )->lists( $fields );
        }

            $this->output_data['data'] = Encoder::instance()->encode( $robotCheatsList );
            $r = new Redis( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
            $redis = $r->getResource();
            $redis->select( 0 );
            $cheat = $redis->get( 'cheat_state' );
            $cheat = $cheat == 0 ? '未开启' : '开启';
            $this->output_data['cheat'] = $cheat;
            $this->output_data['precisionlist'] = array(
                'minute' => '5分钟' ,
                'hour'   => '小时'
            );
            $this->render( 'chart_datas_robot_cheat.html' );
        }

        /**
         * 钻石场统计数据
         */
        function diamondTable()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_DIAMOND_TABLE );
            $this->init_navigator();

            $gameDB = $this->getGameDB();
            $sql = "SELECT count(*) as num FROM user_coujiang_data ";
            $gameDB->execute( $sql );
            $totalNum = $gameDB->fetch()['num'];

            //计算中大奖几率
            $sql = "SELECT count(*) as num FROM user_coujiang_data WHERE zj_type = 3";
            $gameDB->execute( $sql );
            $bigLotteryNum = $gameDB->fetch()['num'];
            $bigLotteryRatio = number_format( $bigLotteryNum / $totalNum , 2 ) * 100 . '%';

            //计算中小奖的几率
            $sql = "SELECT count(*) as num FROM user_coujiang_data WHERE zj_type = 2";
            $gameDB->execute( $sql );
            $smallLotteryNum = $gameDB->fetch()['num'];
            $smallLotteryRatio = number_format( $smallLotteryNum / $totalNum , 2 ) * 100 . '%';

            $sql = "SELECT SUM(amount) as amount,flag FROM diamond_table_summary GROUP BY flag";
            $gameDB->execute( $sql );
            $amounts = $gameDB->fetch_all();
            //钻石场奖券总支出
            $total_out = 0;
            //钻石场收入
            $total_in = 0;
            //钻石场台位费
            $total_table_in = 0;

            foreach ( $amounts as $am ) {
                if ( $am['flag'] == 1 )
                    $total_in = $am['amount'];
                else if ( $am['flag'] == 2 )
                    $total_out = $am['amount'];
                else if ( $am['flag'] == 3 )
                    $total_table_in = $am['amount'];
            }

            $total = array(
                'bigLotteryRatio'   => $bigLotteryRatio ,
                'smallLotteryRatio' => $smallLotteryRatio ,
                'total_out'         => $total_out ,
                'total_in'          => $total_in ,
                'total_table_in'    => $total_table_in
            );

            $this->output_data['total'] = $total;

            //开始读取图表
            $precision = $this->input->post( 'precision' );
            if ( empty( $precision ) ) $precision = 'minute';


            if ( $precision == 'minute' ) {
                $end_time = time();
                $start_time = $end_time - 60 * 60 * 12;
            } else {
                $end_time = time() + 24 * 60 * 60;
                $start_time = $end_time - 60 * 60 * 24 * 7;
            }

            if ( $precision == 'minute' ) {
                $list = DatasDiamondTable_M::instance()->set_condition( $start_time , $end_time )->lists();
                $dateLine = array();
                foreach ( $list as $item ) {
                    $dateLine[] = date( 'Y/m/d H:i' , $item['createDate'] );
                }
                $diamondTable = $list;
            } else {
                $list = DatasDiamondTable_M::instance()->set_condition( $start_time , $end_time )->listsByDays();
                list( $dateLine , $diamondTable ) = ECharts::instance()->mergeDataByTimeLineInRectangular( 'day' , strtotime( date( 'Y-m-d' , $start_time ) ) , strtotime( date( 'Y-m-d' , $end_time ) ) , 'createDate' , $list );
            }

            //当前奖券数量
            $r = new Redis( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
            $redis = $r->getResource();
            $zj =  $redis->get( 'zjprefit:' );
            if ( !empty($zj ) ) {
                $z = Encoder::instance()->decode($zj);
                $this->output_data['coupon'] = empty( $z['now_amout'] ) ? 0 : $z['now_amout'];
            }
            $this->output_data['dateLine'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['diamondTable'] = Encoder::instance()->encode( $diamondTable );
            $this->output_data['precision'] = $precision;

            $this->render( 'chart_datas_diamond_table.html' );
        }

        /**
         * 开奖明细
         */
        function diamondTableDetail()
        {
            $page = empty( $this->args[0] ) ? 1 : $this->args[0];
            $count = 10;
            $start = ( $page - 1 ) * $count;

            //获取查询条件
            $search_params = $this->input->get();
            $query_string = http_build_query( $search_params );

            $list = UserCoujiangData_M::instance()->set_condition( $search_params )->lists( $start , $count );
            $total = UserCoujiangData_M::instance()->set_condition( $search_params )->num_rows();

            foreach ( $list as &$item ) {
                $item['begin_time'] = date( 'Y-m-d H:i:s' , $item['begin_time'] );
            }

            //初始化分页
            $page_params = array(
                'total_rows'     => $total , #(必须)
                'method'         => 'ajax' , #(必须)
                'parameter'      => $search_params['search_type'] ,  #(必须)
                'now_page'       => $page ,  #(必须)
                'list_rows'      => $count , #(可选) 默认为15
                'use_tag_li'     => true ,
                'li_classname'   => 'active' ,
                'query_string'   => $query_string ,
                'ajax_func_name' => 'nextPage'
            );

            $pagiation = new Page( $page_params );
            if ( $pagiation->getTotalPage() > 1 )
                $pagiation = $pagiation->show( 1 );

            $data = array(
                'list'      => $list ,
                'pagiation' => $pagiation
            );

            $this->response( $data );
        }


        function robotCheatDiamondTable(){
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATAS_ROBOT_CHEAT_DIAMOND );
            $this->init_navigator();

            //获取查询条件
            $search_params = $this->http_get_params();
            //默认精度为天
            if ( !isset( $search_params['precision'] ) ) $search_params['precision'] = 'minute';
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' ) {
                    $this->output_data[ 'search_' . $k ] = $v;
                } else
                    unset( $search_params[ $k ] );
            }

            if ( $search_params['precision'] == 'hour' ) {
                $fields = array(
                    'SUM(yellow_diamonds) as yellow_diamonds ' ,
                    'SUM(nums) as nums ' ,
                    'SUM(tablelv3) as tablelv3 ' ,
                    'SUM(cheat_rate_lv3) as cheat_rate_lv3' ,
                );
                $robotCheatsList = DataRobotCheat_M::instance()->set_condition( $search_params['precision'] )->listsByHour( $fields );
            }
            else {
                $fields = array( 'yellow_diamonds' , 'nums' , 'online' , 'tablelv3' , 'cheat_rate_lv3'  );
                $robotCheatsList = DataRobotCheat_M::instance()->set_condition( $search_params['precision'] )->lists( $fields );
            }

            $this->output_data['data'] = Encoder::instance()->encode( $robotCheatsList );
            $r = new Redis( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
            $redis = $r->getResource();
            $redis->select( 0 );
            $cheat = $redis->get( 'cheat_state_dia' );
            $cheat = $cheat == 0 ? '未开启' : '开启';
            $this->output_data['cheat'] = $cheat;
            $this->output_data['precisionlist'] = array(
                'minute' => '5分钟' ,
                'hour'   => '小时'
            );
            $this->render( 'chart_datas_robot_cheat_diamond.html' );
        }
    }
