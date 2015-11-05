<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/2/28
     * Time: 上午11:12
     */

    namespace pms\controller;


    use common\model\UserModel;
    use common\model\VisitHistoryModel;
    use common\Platform;
    use pms\core\AdminController;
    use core\Encoder;
    use pms\libs\AdminUtil;
    use pms\libs\ModuleDictionary;
    use pms\model\DatasLoginCount_M;
    use pms\model\DatasLoginNum_M;
    use pms\model\DatasRecharge_M;
    use pms\model\DatasRegister_M;
    use pms\model\DatasUserRemain_M;
    use pms\model\DatasVigorous_M;
    use pms\model\PayMentOrder_M;
    use utils\Date;
    use utils\ECharts;

    class Datas extends AdminController
    {
        /**
         * 数据概览
         */
        function total()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATA_ANALYSIS_TOTAL );
            $this->init_navigator();

            //数据总览
            $total['register'] = UserModel::instance()->total();
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
            $weekVigorous = VisitHistoryModel::instance()->vigorousNum( $startWeekDay , $end_time );
            $monthVigorous = VisitHistoryModel::instance()->vigorousNum( $startMonthDay , $end_time );
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
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATA_ANALYSIS_REGISTER );
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
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATA_ANALYSIS_LOGIN_NUM );
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
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATA_ANALYSIS_LOGIN_COUNT );
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
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATA_ANALYSIS_VIGOROUS );
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
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATA_ANALYSIS_REMAIN );
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
         * 回归用户
         * @throws \Exception
         */
        function userRegress()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATA_ANALYSIS_REGRESS );
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

    }
