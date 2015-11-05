<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/29
     * Time: 上午11:50
     */

    namespace gms\controller;


    use core\Encoder;
    use core\Permission;
    use core\Redis;
    use gms\core\AdminController;
    use core\Cookie;
    use core\Redirect;
    use gms\libs\AdminUtil;
    use gms\libs\Error;
    use gms\libs\ModuleDictionary;
    use gms\model\Guide_M;
    use gms\model\Module_M;
    use common\model\GameAreaModel;
    use common\model\GamesModel;
    use gms\model\SystemMessage_M;
    use gms\model\SystemMonitor_M;
    use utils\Page;
    use utils\Upload;

    /**
     * 系统功能控制器
     * Class System
     * @package gms\controller
     */
    class System extends AdminController
    {

        /**
         * 清除缓存:
         * 1.redis导航缓存
         */
        function ajax_clear_cache()
        {
            Module_M::instance( true )->clearCache();
            GamesModel::instance()->clearCache();
            GameAreaModel::instance()->clearCache();
            Redirect::instance()->forward();
        }


        function php_info()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_INFO_PHP );
            $this->init_navigator();
            $list = SystemMonitor_M::instance()->lists();
            $dateLine = array();
            $data = array();
            foreach ( $list as $item ) {
                $dateLine[] = date( 'H:i:s' , $item['create_time'] );
                unset( $item['create_time'] );
                $item['memUsage'] = number_format( $item['memUsage'] / ( 1024 * 1024 ) , 2 );
                $item['memFree'] = number_format( $item['memFree'] / ( 1024 * 1024 ) , 2 );
                $data[] = $item;
            }
            unset( $list );

            $this->output_data['data'] = Encoder::instance()->encode( $data );
            $this->output_data['dateLine'] = Encoder::instance()->encode( $dateLine );
            $this->output_data['total'] = SystemMonitor_M::instance()->maxLoad();
            $this->output_data['obj'] = $this;
            $this->render( 'php_env.html' );
        }

        function twig_info()
        {
            if ( function_exists( 'phpinfo' ) )
                phpinfo();
        }

        function selectServer()
        {
            $area_id = $this->input->post( 'area_id' );
            $server = GameAreaModel::instance()->read( $area_id );
            Cookie::instance()->set_userdata( 'server' , Encoder::instance()->encode( $server ) );
            AdminUtil::instance()->setSelectedServer( $area_id );
            $this->response( $server['name'] );
        }

        /**
         * 机器人作弊显示
         */
        function robotCheat()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_ROBOT_CHEAT );
            $this->init_navigator();
            $server = Encoder::instance()->decode( Cookie::instance()->userdata( 'server' ) );
            $r = new Redis( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
            $redis = $r->getResource();
            $redis->select( $server['redis_idx'] );

            $robotSet['cheat_state'] = $redis->get( 'cheat_state' );
            $robotSet['cheat_lv1_rate'] = $redis->get( 'cheat_lv1_rate' );
            $robotSet['cheat_lv2_rate'] = $redis->get( 'cheat_lv2_rate' );
            $robotSet['cheat_lv3_rate'] = $redis->get( 'cheat_lv3_rate' );
            $robotSet['cheat_step_begin'] = $redis->get( 'cheat_step_begin' );
            $robotSet['cheat_step_end'] = $redis->get( 'cheat_step_end' );
            $robotSet['cheat_value_begin'] = $redis->get( 'cheat_value_begin' );
            $robotSet['cheat_value_end'] = $redis->get( 'cheat_value_end' );
            $robotSet['cheat_increase_rate'] = $redis->get( 'cheat_increase_rate' );
            $robotSet['cheat_user_laizis_rate'] = $redis->get( 'cheat_user_laizis_rate' );
            $robotSet['cheat_free_lv1_rate'] = $redis->get( 'cheat_free_lv1_rate' );
            $robotSet['cheat_free_lv2_rate'] = $redis->get( 'cheat_free_lv2_rate' );
            $robotSet['cheat_free_lv3_rate'] = $redis->get( 'cheat_free_lv3_rate' );
            $robotSet['cheat_lv1_tables'] = $redis->get( 'cheat_lv1_tables' );
            $robotSet['cheat_lv2_tables'] = $redis->get( 'cheat_lv2_tables' );
            $robotSet['cheat_lv3_tables'] = $redis->get( 'cheat_lv3_tables' );
            $robotSet['RTC_BlackList_Begin_Value'] = $redis->get( 'RTC_BlackList_Begin_Value' );
            $robotSet['RTC_BlackList_End_Value'] = $redis->get( 'RTC_BlackList_End_Value' );
            $robotSet['RTC_BlackList_Work_Interval'] = $redis->get( 'RTC_BlackList_Work_Interval' );
            $robotSet['RTC_BlackList_Laizi_Rate'] = $redis->get( 'RTC_BlackList_Laizi_Rate' );
            $robotSet['RTC_BlackList_Win_Rate'] = $redis->get( 'RTC_BlackList_Win_Rate' );

            $redis->close();
            $this->output_data['robotSet'] = $robotSet;
            $this->render( 'system_robot_cheat.html' );
        }

        /**
         * * 机器人作弊设置
         *    cheat_robot_lost_coins int//输给用户的金币总数
         *  cheat_robot_win_coins int //赢的用户的金币总数
         *    cheat_current_robot_num int//当前所有的机器人输钱次数 抓取数据后清空
         *   cheat_state int 作弊状态：0：没有开始，1：正在作弊 用作显示 无需设置到redis
         * cheat_lv1_rate int//低级场作弊几率 0～100
         * cheat_lv2_rate int//中级场作弊几率 0～100
         *    cheat_lv3_rate int//高级场作弊几率 0～100
         *    cheat_step_begin int//最低作弊圈数
         *    cheat_step_end int//最高作弊圈数
         *    cheat_value_begin int//作弊开始阀值
         *    cheat_value_end int
         * cheat_increase_rate int 0-100 作弊几率自动增长率
         *  RTC_BlackList_Begin_Value          int //黑名单启动值
         *  RTC_BlackList_End_Value            int //黑名单结束值
         *  RTC_BlackList_Work_Interval        int //黑名单作用间隔
         *RTC_BlackList_Laizi_Rate           int //黑名单遇到赖子的时候，给玩家的几率 1～100
         *RTC_BlackList_Win_Rate             int //黑名单玩家听牌的时候，遇到可以胡的牌，给玩家的几率 1～100
         * @throws \Exception
         */
        function saveRobotCheat()
        {
            $post = $this->input->post();

            $server = Encoder::instance()->decode( Cookie::instance()->userdata( 'server' ) );
            $r = new Redis( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
            $redis = $r->getResource();
            $redis->select( $server['redis_idx'] );

            $redis->set( 'cheat_lv1_rate' , $post['cheat_lv1_rate'] );
            $redis->set( 'cheat_lv2_rate' , $post['cheat_lv2_rate'] );
            $redis->set( 'cheat_lv3_rate' , $post['cheat_lv3_rate'] );
            $redis->set( 'cheat_step_begin' , $post['cheat_step_begin'] );
            $redis->set( 'cheat_step_end' , $post['cheat_step_end'] );
            $redis->set( 'cheat_value_begin' , $post['cheat_value_begin'] );
            $redis->set( 'cheat_value_end' , $post['cheat_value_end'] );
            $redis->set( 'cheat_increase_rate' , $post['cheat_increase_rate'] );
            $redis->set( 'cheat_user_laizis_rate' , $post['cheat_user_laizis_rate'] );
            $redis->set( 'cheat_free_lv1_rate' , $post['cheat_free_lv1_rate'] );
            $redis->set( 'cheat_free_lv2_rate' , $post['cheat_free_lv2_rate'] );
            $redis->set( 'cheat_free_lv3_rate' , $post['cheat_free_lv3_rate'] );
            $redis->set( 'RTC_BlackList_Begin_Value' , $post['RTC_BlackList_Begin_Value'] );
            $redis->set( 'RTC_BlackList_End_Value' , $post['RTC_BlackList_End_Value'] );
            $redis->set( 'RTC_BlackList_Work_Interval' , $post['RTC_BlackList_Work_Interval'] );
            $redis->set( 'RTC_BlackList_Laizi_Rate' , $post['RTC_BlackList_Laizi_Rate'] );
            $redis->set( 'RTC_BlackList_Win_Rate' , $post['RTC_BlackList_Win_Rate'] );

            $redis->close();
            Redirect::instance()->forward( '/system/robotCheat/' . ModuleDictionary::ROOT_MODULE_SYSTEM_INFO . '/success' );
        }

        function guideList()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_GUIDE_LIST );

            $page = empty( $this->args[1] ) ? 1 : $this->args[1];
            $count = 10;
            $start = ( $page - 1 ) * $count;


            $this->init_navigator();
            $server = Encoder::instance()->decode( Cookie::instance()->userdata( 'server' ) );
            $game_id = $server['game_id'];
            $list = Guide_M::instance()->lists( $start , $count , $game_id );
            $total = Guide_M::instance()->num_rows( $game_id );

            foreach ( $list as &$item ) {
                $item['area'] = $this->config->common['areas'][ $item['area'] ];
            }

            $this->output_data['btn_edit_permission'] = 0;

            //检查按钮权限
            if ( Cookie::instance()->userdata( 'is_administrator' ) ) {
                $this->output_data['btn_edit_permission'] = 1;
            } else {
                $session_p = Cookie::instance()->userdata( 'session_p' );
                if ( !empty( $session_p ) ) {
                    $session_p = Encoder::instance()->decode( $session_p );
                    foreach ( $session_p as $p ) {
                        if ( $p['module_id'] == ModuleDictionary::ROOT_MODULE_GAME ) {
                            if ( Permission::instance()->hasPermission( $p['admin_permission'] , ModuleDictionary::MODULE_SYSTEM_GUIDE_ADD ) )
                                $this->output_data['btn_edit_permission'] = 1;
                        }
                    }
                }
            }

            //初始化分页
            $page_params = array(
                'total_rows'   => $total , #(必须)
                'method'       => 'html' , #(必须)
                'parameter'    => '/system/guideList/' . ModuleDictionary::ROOT_MODULE_SYSTEM_INFO . '/?' ,  #(必须)
                'now_page'     => $page ,  #(必须)
                'list_rows'    => $count , #(可选) 默认为15
                'use_tag_li'   => true ,
                'li_classname' => 'active'
            );

            $pagiation = new Page( $page_params );
            if ( $pagiation->getTotalPage() > 1 )
                $this->output_data['pagiation'] = $pagiation->show( 1 );

            $this->output_data['list'] = $list;
            $this->output_data['total'] = $total;
            $this->render( 'system_guide_list.html' );
        }

        function guideAdd()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_GUIDE_ADD );
            $this->init_navigator();

            if ( $this->args[1] == 'success' )
                $this->output_data['success'] = 1;

            $this->output_data['action_name'] = '添加';
            $this->output_data['action'] = '/system/guideSave';
            $this->render( 'system_guide_add.html' );
        }

        function guideSave()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_GUIDE_ADD );
            $images = $_FILES['image'];
            $post = $this->input->post();
            $post['expired_time'] = strtotime( $post['expired_time'] );
            $urls = $post['url'];

            $upload = new Upload();
            $upload->set_allowed_ext( $this->config->gms['upload']['image_allowed_ext'] );
            $upload->set_max_size();
            $upload->set_upload_folder( 'upload/images/guide' );

            for ( $i = 0 ; $i < count( $images['name'] ) ; $i ++ ) {
                $file = array();
                $file['size'] = $images['size'][ $i ];
                $file['type'] = $images['type'][ $i ];
                $file['name'] = $images['name'][ $i ];
                $file['tmp_name'] = $images['tmp_name'][ $i ];

                $img = $upload->upload( $file );
                $image = array(
                    'image' => $img['url'] ,
                    'url'   => empty( $urls[ $i ] ) ? '' : $urls[ $i ]
                );
                $post['images'][] = $image;
            }

            unset( $post['url'] );
            $post['images'] = Encoder::instance()->encode( $post['images'] );
            $post['create_time'] = time();
            $server = Cookie::instance()->userdata( 'server' );
            $post['game_id'] = Encoder::instance()->decode( $server )['game_id'];

            if ( !Guide_M::instance()->save( $post ) )
                $this->set_error( Error::DATA_WRITE );

            Redirect::instance()->forward( '/system/guideAdd/' . ModuleDictionary::ROOT_MODULE_SYSTEM_INFO . '/success' );
        }

        function guideDel()
        {
            $id = $this->args[1];
            if ( !Guide_M::instance()->del( $id ) )
                $this->set_error( Error::DATA_DELETE );
            Redirect::instance()->forward( '/system/guideList/' . ModuleDictionary::ROOT_MODULE_SYSTEM_INFO );
        }

        function showGuideImages()
        {
            $id = $this->args[0];
            $guide = Guide_M::instance()->read( $id );
            $images = Encoder::instance()->decode( $guide['images'] );
            foreach ( $images as $src ) {
                echo '<a href="' . $src['url'] . '" target="_blank" ><img src = ' . $src['image'] . '  /></a><br/>';
            }
        }


        function clearRedis()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_CLEAR_REDIS );
            $this->init_navigator();
            $this->render( 'system_clear_redis.html' );
        }

        function doClearRedis()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_CLEAR_REDIS );
            $keys = explode( ',' , $this->input->post( 'keys' ) );
            $idx = $this->input->post( 'idx' );
            $r = new Redis( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
            $redis = $r->getResource();
            $redis->select( $idx );

            foreach ( $keys as $key ) {
                if ( strpos( $key , '*' ) > - 1 ) {
                    $tempKeys = $redis->keys( $key );
                    foreach ( $tempKeys as $tkey ) {
                        $redis->del( $tkey );
                    }
                } else {
                    $redis->del( $key );
                }
            }
            $redis->close();
            $this->response( null );
        }


        function server()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_SERVER );
            $this->init_navigator();
            $server = Encoder::instance()->decode( Cookie::instance()->userdata( 'server' ) );
            $r = new Redis( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
            $redis = $r->getResource();
            $redis->select( $server['redis_idx'] );
            $runtimeConfig['RTC_tutorialBonus'] = $redis->get( 'RTC_tutorialBonus' );//新手引导得到的金币
            $runtimeConfig['RTC_coinsGivenPerTime'] = $redis->get( 'RTC_coinsGivenPerTime' );//每次给好友的金币
            $runtimeConfig['RTC_MinRoomDur'] = $redis->get( 'RTC_MinRoomDur' );//包房最小时间分钟
            $runtimeConfig['RTC_MaxRoomDur'] = $redis->get( 'RTC_MaxRoomDur' );//包房最大时间分钟
            $runtimeConfig['RTC_pointMatchRanksTotal'] = $redis->get( 'RTC_pointMatchRanksTotal' );//积分赛默认排名个数
            $runtimeConfig['RTC_PointTOP'] = $redis->get( 'RTC_PointTOP' );//积分赛积分封顶值
            $runtimeConfig['RTC_MaxRoomUsers'] = $redis->get( 'RTC_MaxRoomUsers' );//房间最大容纳的人数
            $runtimeConfig['RTC_MaxMinutesLeft'] = $redis->get( 'RTC_MaxMinutesLeft' );//房间最大的剩余时间
            $runtimeConfig['RTC_MinutesAlert'] = $redis->get( 'RTC_MinutesAlert' );//房间报警时间
            $runtimeConfig['RTC_MinAddMinutes'] = $redis->get( 'RTC_MinAddMinutes' );//包房最小续时
            $runtimeConfig['RTC_BasicLivingCoins'] = $redis->get( 'RTC_BasicLivingCoins' );//基本低保金币
            $runtimeConfig['RTC_BasicLivingCount'] = $redis->get( 'RTC_BasicLivingCount' );//每日基本低保次数
            $runtimeConfig['RTC_Junior_Rate'] = $redis->get( 'RTC_Junior_Rate' );//低级场倍率参数，默认1
            $runtimeConfig['RTC_Medium_Rate'] = $redis->get( 'RTC_Medium_Rate' );//中级场倍率参数，默认4
            $runtimeConfig['RTC_Junior_Prize_Type'] = $redis->get( 'RTC_Junior_Prize_Type' );///初级场赢牌到达一定数量的礼品的类型 ，默认52
            $runtimeConfig['RTC_Junior_Prize_Num'] = $redis->get( 'RTC_Junior_Prize_Num' );//初级场赢牌到达一定数量的礼品的数量 默认1
            $runtimeConfig['RTC_Junior_Prize_Begin_Min'] = $redis->get( 'RTC_Junior_Prize_Begin_Min' );//初级场领取奖品赢盘数最小值 默认3
            $runtimeConfig['RTC_Junior_Prize_Begin_MAX'] = $redis->get( 'RTC_Junior_Prize_Begin_MAX' );//级场领取奖品赢盘数最大值 默认17
            $runtimeConfig['RTC_Medium_Prize_Type'] = $redis->get( 'RTC_Medium_Prize_Type' );//中级场赢牌到达一定数量的礼品的类型 默认
            $runtimeConfig['RTC_Medium_Prize_Num'] = $redis->get( 'RTC_Medium_Prize_Num' );//中级场赢牌到达一定数量的礼品的数量 默认1
            $runtimeConfig['RTC_Medium_Prize_Begin_Min'] = $redis->get( 'RTC_Medium_Prize_Begin_Min' );//中级场领取奖品赢盘数最小值 默认15
            $runtimeConfig['RTC_Medium_Prize_Begin_MAX'] = $redis->get( 'RTC_Medium_Prize_Begin_MAX' );///中级场领取奖品赢盘数最大值 默认15
            $runtimeConfig['RTC_Medium_Force_Enter_Min'] = $redis->get( 'RTC_Medium_Force_Enter_Min' );///中级场强制进入门槛 默认500000
            $runtimeConfig['RTC_DidTable_Enter_Diamonds'] = $redis->get( 'RTC_DidTable_Enter_Diamonds' );//	RTC_DidTable_Enter_Diamonds        int //钻石场准入数量 800
            $runtimeConfig['RTC_DiaTable_CanWin_Double'] = $redis->get( 'RTC_DiaTable_CanWin_Double' );//RTC_DiaTable_CanWin_Double         int //钻石场起胡番数
            $runtimeConfig['RTC_Junior_Prize_Begin_INC'] = $redis->get( 'RTC_Junior_Prize_Begin_INC' );//	 int //初级场领取奖品赢盘数间隔值 默认1
            $runtimeConfig['RTC_Medium_Prize_Begin_INC'] = $redis->get( 'RTC_Medium_Prize_Begin_INC' );//int //中级场领取奖品赢盘数间隔值 默认1
            $runtimeConfig['RTC_DiaTable_Rate'] = $redis->get( 'RTC_DiaTable_Rate' );//RTC_DiaTable_Rate                  int //钻石场倍数1
            $runtimeConfig['RTC_DiaTable_BasePoint'] = $redis->get( 'RTC_DiaTable_BasePoint' );//  RTC_DiaTable_BasePoint             int //钻石场底 1
            $runtimeConfig['RTC_DiaTable_WinTop'] = $redis->get( 'RTC_DiaTable_WinTop' );// RTC_DiaTable_WinTop                int //钻石场封顶 400
            $runtimeConfig['RTC_Send_TelCard_OnOff'] = $redis->get( 'RTC_Send_TelCard_OnOff' );//赢牌送电话卡道具活动开关 1：开 0：关又要加上这个，用于开关活动
            $runtimeConfig['RTC_MinCoinsJunior'] = $redis->get( 'RTC_MinCoinsJunior' );//初级场金币数准入
            $runtimeConfig['RTC_MinCoinsMedium'] = $redis->get( 'RTC_MinCoinsMedium' );//中级场最小金币准入
            $runtimeConfig['cheat_value_begin_dia'] = $redis->get( 'cheat_value_begin_dia' ); //钻石场作弊开始阀值
            $runtimeConfig['cheat_value_end_dia'] = $redis->get( 'cheat_value_end_dia' );  //钻石场作弊停止阀值
            $runtimeConfig['RTC_DiaTable_TaxRate'] = $redis->get( 'RTC_DiaTable_TaxRate' );
            $runtimeConfig['RTC_Junior_TaxRate'] = $redis->get( 'RTC_Junior_TaxRate' );
            $runtimeConfig['RTC_Medium_TaxRate'] = $redis->get( 'RTC_Medium_TaxRate' );

            $runtimeConfig['now_amount'] = 0;
            $redis->close();

            $this->output_data['runtimeConfig'] = $runtimeConfig;
            $this->output_data['token'] = Cookie::instance()->get_csrf_cookie();
            $this->output_data['tool_type'] = $this->config->common['tool_type'];

            $this->render( 'game_server.html' );
        }


        function save_server()
        {
            $this->csrf_token_validation();
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_SERVER );
            $this->init_navigator();
            $post = $this->input->post();
            $server = Encoder::instance()->decode( Cookie::instance()->userdata( 'server' ) );
            $r = new Redis( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
            $redis = $r->getResource();
            $redis->select( $server['redis_idx'] );

            if ( $post['RTC_Junior_Prize_Begin_Min'] != '' )
                $redis->set( 'RTC_Junior_Prize_Begin_Min' , $post['RTC_Junior_Prize_Begin_Min'] );

            if ( $post['RTC_Junior_Prize_Begin_MAX'] != '' )
                $redis->set( 'RTC_Junior_Prize_Begin_MAX' , $post['RTC_Junior_Prize_Begin_MAX'] );

            if ( $post['RTC_Junior_Prize_Type'] != '' )
                $redis->set( 'RTC_Junior_Prize_Type' , $post['RTC_Junior_Prize_Type'] );

            if ( $post['RTC_Junior_Prize_Num'] != '' )
                $redis->set( 'RTC_Junior_Prize_Num' , $post['RTC_Junior_Prize_Num'] );

            if ( $post['RTC_Medium_Prize_Begin_Min'] != '' )
                $redis->set( 'RTC_Medium_Prize_Begin_Min' , $post['RTC_Medium_Prize_Begin_Min'] );

            if ( $post['RTC_Medium_Prize_Begin_MAX'] != '' )
                $redis->set( 'RTC_Medium_Prize_Begin_MAX' , $post['RTC_Medium_Prize_Begin_MAX'] );

            if ( $post['RTC_Medium_Prize_Type'] != '' )
                $redis->set( 'RTC_Medium_Prize_Type' , $post['RTC_Medium_Prize_Type'] );

            if ( $post['RTC_Medium_Prize_Num'] != '' )
                $redis->set( 'RTC_Medium_Prize_Num' , $post['RTC_Medium_Prize_Num'] );

            if ( $post['RTC_Junior_TaxRate'] != '' )
                $redis->set( 'RTC_Junior_TaxRate' , $post['RTC_Junior_TaxRate'] );

            if ( $post['RTC_Medium_TaxRate'] != '' )
                $redis->set( 'RTC_Medium_TaxRate' , $post['RTC_Medium_TaxRate'] );

            if ( $post['RTC_DiaTable_TaxRate'] != '' )
                $redis->set( 'RTC_DiaTable_TaxRate' , $post['RTC_DiaTable_TaxRate'] );

            if ( $post['RTC_tutorialBonus'] != '' )
                $redis->set( 'RTC_tutorialBonus' , $post['RTC_tutorialBonus'] );

            if ( $post['RTC_coinsGivenPerTime'] != '' )
                $redis->set( 'RTC_coinsGivenPerTime' , $post['RTC_coinsGivenPerTime'] );

            if ( $post['RTC_MinRoomDur'] != '' )
                $redis->set( 'RTC_MinRoomDur' , $post['RTC_MinRoomDur'] );

            if ( $post['RTC_MaxRoomDur'] != '' )
                $redis->set( 'RTC_MaxRoomDur' , $post['RTC_MaxRoomDur'] );

            if ( $post['RTC_pointMatchRanksTotal'] != '' )
                $redis->set( 'RTC_pointMatchRanksTotal' , $post['RTC_pointMatchRanksTotal'] );

            if ( $post['RTC_PointTOP'] != '' )
                $redis->set( 'RTC_PointTOP' , $post['RTC_PointTOP'] );

            if ( $post['RTC_MaxRoomUsers'] != '' )
                $redis->set( 'RTC_MaxRoomUsers' , $post['RTC_MaxRoomUsers'] );

            if ( $post['RTC_MaxMinutesLeft'] != '' )
                $redis->set( 'RTC_MaxMinutesLeft' , $post['RTC_MaxMinutesLeft'] );

            if ( $post['RTC_MinutesAlert'] != '' )
                $redis->set( 'RTC_MinutesAlert' , $post['RTC_MinutesAlert'] );

            if ( $post['RTC_MinAddMinutes'] != '' )
                $redis->set( 'RTC_MinAddMinutes' , $post['RTC_MinAddMinutes'] );

            if ( $post['RTC_BasicLivingCoins'] != '' )
                $redis->set( 'RTC_BasicLivingCoins' , $post['RTC_BasicLivingCoins'] );

            if ( $post['RTC_BasicLivingCount'] != '' )
                $redis->set( 'RTC_BasicLivingCount' , $post['RTC_BasicLivingCount'] );

            if ( $post['RTC_Junior_Rate'] != '' )
                $redis->set( 'RTC_Junior_Rate' , $post['RTC_Junior_Rate'] );

            if ( $post['RTC_Medium_Rate'] != '' )
                $redis->set( 'RTC_Medium_Rate' , $post['RTC_Medium_Rate'] );


            if ( $post['RTC_DidTable_Enter_Diamonds'] != '' )
                $redis->set( 'RTC_DidTable_Enter_Diamonds' , $post['RTC_DidTable_Enter_Diamonds'] );

            if ( $post['RTC_DiaTable_CanWin_Double'] != '' )
                $redis->set( 'RTC_DiaTable_CanWin_Double' , $post['RTC_DiaTable_CanWin_Double'] );

            if ( $post['RTC_DiaTable_Rate'] != '' )
                $redis->set( 'RTC_DiaTable_Rate' , $post['RTC_DiaTable_Rate'] );

            if ( $post['RTC_DiaTable_BasePoint'] != '' )
                $redis->set( 'RTC_DiaTable_BasePoint' , $post['RTC_DiaTable_BasePoint'] );

            if ( $post['RTC_DiaTable_WinTop'] != '' )
                $redis->set( 'RTC_DiaTable_WinTop' , $post['RTC_DiaTable_WinTop'] );

            if ( $post['RTC_Junior_Prize_Begin_INC'] != '' )
                $redis->set( 'RTC_Junior_Prize_Begin_INC' , $post['RTC_Junior_Prize_Begin_INC'] );

            if ( $post['RTC_Medium_Prize_Begin_INC'] != '' )
                $redis->set( 'RTC_Medium_Prize_Begin_INC' , $post['RTC_Medium_Prize_Begin_INC'] );

            if ( $post['RTC_MinCoinsJunior'] != '' )
                $redis->set( 'RTC_MinCoinsJunior' , $post['RTC_MinCoinsJunior'] );

            if ( $post['RTC_MinCoinsMedium'] != '' )
                $redis->set( 'RTC_MinCoinsMedium' , $post['RTC_MinCoinsMedium'] );

            if ( $post['cheat_value_end_dia'] != '' )
                $redis->set( 'cheat_value_end_dia' , $post['cheat_value_end_dia'] );

            if ( $post['cheat_value_begin_dia'] != '' )
                $redis->set( 'cheat_value_begin_dia' , $post['cheat_value_begin_dia'] );

            if ( $post['RTC_Send_TelCard_OnOff'] )
                $redis->set( 'RTC_Send_TelCard_OnOff' , $post['RTC_Send_TelCard_OnOff'] );

            $redis->close();
            Redirect::instance()->forward( '/system/server/' . ModuleDictionary::ROOT_MODULE_SYSTEM_INFO . '/success' );
        }


    }