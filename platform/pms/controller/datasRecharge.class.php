<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/10
     * Time: 下午3:44
     */

    namespace pms\controller;

    use common\model\UserModel_M;
    use common\Platform;
    use pms\core\AdminController;
    use core\Encoder;
    use pms\libs\AdminUtil;
    use pms\libs\ModuleDictionary;
    use pms\model\DatasRecharge_M;
    use pms\model\DatasVigorous_M;
    use pms\model\Player_M;
    use utils\Date;
    use utils\ECharts;
    use utils\Tools;

    class DatasRecharge extends AdminController
    {

        function recharge()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATASRECHARGE_RECHARGE );
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
                    $rechargeList = DatasRecharge_M::instance()->set_condition( $search_params )->listsByHours();
                    break;
                case 'day' :
                    $rechargeList = DatasRecharge_M::instance()->set_condition( $search_params )->listsByDays();
                    break;
                case 'month':
                    $rechargeList = DatasRecharge_M::instance()->set_condition( $search_params )->listsByMonths();
                    break;
            }

            list( $dateLine , $recharge ) = ECharts::instance()
                ->mergeDataByTimeLineInRectangular(
                    $precision ,
                    $search_params['start_time'] ,
                    $search_params['end_time'] ,
                    'createDate' ,
                    $rechargeList );

            $this->output_data['precisionlist'] = array(
                'month' => '月' ,
                'day'   => '天' ,
                'hour'  => '小时'
            );
            $this->output_data['see_types'] = array(
                'count' => '付费次数' ,
                'num'   => '付费人数' ,
                'money' => '付费金额'
            );

            $this->output_data['recharge_platforms'] = Platform::instance()->getRechargePlatforms();
            $this->output_data['platformlist'] = Platform::instance()->getClientPlatforms();
            $this->output_data['dateLineJson'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['rechargeJson'] = Encoder::instance()->encode( $recharge );
            $this->output_data['dateLine'] = $dateLine;
            $this->output_data['recharge'] = $recharge;
            $this->tpl->display( 'chart_datas_recharge.html' , $this->output_data );
        }

        /**
         * 充值排名
         */
        function rechargeOrder()
        {
            //检查权限
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATASRECHARGE_RECHARGE_ORDER );
            $this->init_navigator();
            $list = UserModel_M::instance()->listsByConsume( 0 , 50 );
            $this->output_data['list'] = $list;
            $this->render( 'chart_datas_recharge_order.html' );
        }

        /**
         * 付费渗透
         */
        function rechargeThrough()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_DATASRECHARGE_RECHARGE_THROUTH );
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
                    $rechargeList = DatasRecharge_M::instance()->set_condition( $search_params )->listsByDays();
                    $vigorousList = DatasVigorous_M::instance()->set_condition( $search_params )->listsByDays();
                    break;
                case 'month':
                    $rechargeList = DatasRecharge_M::instance()->set_condition( $search_params )->listsByMonths();
                    $vigorousList = DatasVigorous_M::instance()->set_condition( $search_params )->listsByMonths();
                    break;
            }

            list( $dateLine , $recharge , $vigorous ) = ECharts::instance()
                ->mergeDataByTimeLineInRectangular(
                    $precision ,
                    $search_params['start_time'] ,
                    $search_params['end_time'] ,
                    'createDate' ,
                    $rechargeList , $vigorousList );

            $this->output_data['precisionlist'] = array(
                'month' => '月' ,
                'day'   => '天'
            );

            $arpus = array();
            for ( $i = 0 ; $i < count( $dateLine ) ; $i ++ ) {
                //ARPU
                $vigorousNum = $vigorous[ $i ]['vigorousNum'];
                if ( empty( $vigorousNum ) )
                    $arpus[ $i ]['arpu'] = 0;
                else
                    $arpus[ $i ]['arpu'] = floor( $recharge[ $i ]['rechargeMoney'] / $vigorousNum );

                $rechargeNum = $recharge[ $i ]['rechargeNum'];
                if ( empty( $rechargeNum ) )
                    $arpus[ $i ]['arppu'] = 0;
                else
                    $arpus[ $i ]['arppu'] = floor( $recharge[ $i ]['rechargeMoney'] / $rechargeNum );
            }
            unset( $recharge , $vigorous );

            $this->output_data['platformlist'] = Platform::instance()->getClientPlatforms();
            $this->output_data['dateLineJson'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['arpusJson'] = Encoder::instance()->encode( $arpus );
            $this->output_data['dateLine'] = $dateLine;
            $this->output_data['arpus'] = $arpus;
            $this->tpl->display( 'chart_datas_recharge_through.html' , $this->output_data );
        }
    }