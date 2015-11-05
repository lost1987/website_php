<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/14
     * Time: 下午2:11
     */

    namespace gms\controller;


    use gms\core\AdminController;
    use core\Cookie;
    use core\Encoder;
    use core\Permission;
    use core\Redirect;
    use gms\libs\AdminUtil;
    use gms\libs\Error;
    use gms\libs\Helper;
    use gms\libs\ModuleDictionary;
    use gms\libs\SystemLog;
    use gms\libs\VerifyUtil;
    use gms\model\Admin_M;
    use gms\model\DailyMatch_M;
    use gms\model\MatchPrize_M;
    use utils\Curl;

    /**
     * 积分赛
     * Class DailyMatch
     * @package gms\controller
     */
    class DailyMatch extends AdminController
    {

        function lists()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_DAILY_MATCH_LIST );
            $this->init_navigator();
            $this->output_data['btn_edit_permission'] = 0;
            $this->output_data['btn_prize_permission'] = 0;
            $this->output_data['btn_verify_permission'] = 0;

            //检查按钮权限
            if ( Cookie::instance()->userdata( 'is_administrator' ) ) {
                $this->output_data['btn_edit_permission'] = 1;
                $this->output_data['btn_prize_permission'] = 1;
                $this->output_data['btn_verify_permission'] = 1;
            } else {
                $session_p = Cookie::instance()->userdata( 'session_p' );
                if ( !empty( $session_p ) ) {
                    $session_p = Encoder::instance()->decode( $session_p );
                    foreach ( $session_p as $p ) {
                        if ( $p['module_id'] == ModuleDictionary::ROOT_MODULE_GAME ) {
                            if ( Permission::instance()->hasPermission( $p['admin_permission'] , 16 ) ) {
                                $this->output_data['btn_edit_permission'] = 1;
                                $this->output_data['btn_prize_permission'] = 1;
                            } else if ( Permission::instance()->hasPermission( $p['admin_permission'] , 64 ) ) {
                                $this->output_data['btn_verify_permission'] = 1;
                            }
                        }
                    }
                }
            }

            $list = DailyMatch_M::instance()->lists();
            $match_type = 0;
            foreach ( $list as &$item ) {
                $match_verify_counts = VerifyUtil::instance()->unverified_nums( VerifyUtil::TYPE_DAILY_MATCH , $item['match_id'] );
                $match_prize_verify_counts = VerifyUtil::instance()->unverified_nums( VerifyUtil::TYPE_MATCH_PRIZE , $item['match_id'] * 10000 + $match_type );
                //检查是否需要审核
                if ( $match_verify_counts > 0 ) {
                    $item['verify_match'] = 0;//未审核
                } else
                    $item['verify_match'] = 1;//已审核

                if ( $match_prize_verify_counts > 0 ) {
                    $item['verify_match_prize'] = 0;//未审核
                } else
                    $item['verify_match_prize'] = 1;//已审核
            }

            $this->output_data['list'] = $list;
            $this->render( 'daily_match_list.html' );
        }

        function add()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_DAILY_MATCH_EDIT );
            $this->output_data['success'] = $this->args[1] == 'success' ? 1 : 0;
            $this->init_navigator();
            $this->output_data['token'] = Cookie::instance()->get_csrf_cookie();

            if ( $this->args[1] == 'edit' ) {
                $id = $this->args[2];
                $this->output_data['item'] = DailyMatch_M::instance()->read( $id );
                $this->output_data['action'] = '/dailyMatch/cacheMatch/' . $id;
                $this->output_data['action_name'] = '编辑';
            }

            $this->render( 'daily_match_add.html' );
        }

        /**
         * 缓存需要审核的数据到gms审核表
         * @throws \gms\libs\Exception
         */
        function cacheMatch()
        {
            $this->csrf_token_validation();
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_DAILY_MATCH_EDIT );
            $fields = $this->input->post();
            $id = $this->args[0];

            if ( !VerifyUtil::instance()->add_verify( $id , $fields , VerifyUtil::TYPE_DAILY_MATCH ) )
                $this->set_error( Error::DATA_WRITE );
            $verify_id = $this->db->insert_id();
            SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_DAILY_MATCH_EDIT , "提交更改积分赛请求 积分赛id#$id 审核id#$verify_id" );

            Redirect::instance()->forward( '/dailyMatch/lists/19' );
        }

        /**
         * 跳转审核页面
         * @throws \Exception
         */
        function verifyList()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_MATCH_VERIFY );
            $this->init_navigator();
            $match_id = $this->args[1];
            $this->output_data['list'] = VerifyUtil::instance()->read_verify( $match_id , VerifyUtil::TYPE_DAILY_MATCH );
            foreach ( $this->output_data['list'] as &$item ) {
                $item['create_time'] = date( 'Y-m-d H:i:s' , $item['create_time'] );
                $item['source_admin_name'] = Admin_M::instance()->read( $item['source_admin_id'] )['account'];
                $item['type_name'] = $this->config->gms['verify_types'][ $item['type'] ];
                $item['match'] = Encoder::instance()->decode( $item['json_content'] );
            }
            $this->render( 'daily_match_verify.html' );
        }

        /**
         * 审核比赛
         * @throws \Exception
         * @throws \gms\libs\Exception
         */
        function verifyMatch()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_MATCH_VERIFY );
            $match_id = $this->input->post( 'match_id' );
            $verify_id = $this->input->post( 'verify_id' );
            $remark = $this->input->post( 'remark' );
            $verify = $this->input->post( 'verify' );
            if ( $verify == 0 ) {//审核不通过
                if ( !VerifyUtil::instance()->unpass( $verify_id , $remark ) )
                    $this->set_error( Error::DATA_WRITE );
                SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_MATCH_VERIFY , "审核积分赛id#$match_id 审核id#$verify_id 为不通过" );
            } else {//审核通过
                $json_content = $this->input->post( 'json_content' );
                $gamedb = $this->getGameDB();
                try {
                    $gamedb->begin();
                    $this->db->begin();

                    if ( !VerifyUtil::instance()->pass( $verify_id , $remark ) )
                        throw new \Exception( Error::DATA_WRITE );

                    $fields = Encoder::instance()->decode( $json_content );
                    if ( !DailyMatch_M::instance()->update( $fields , $match_id ) )
                        throw new \Exception( Error::DATA_WRITE );

                    $gamedb->commit();
                    $this->db->commit();
                } catch (\Exception $e) {
                    $gamedb->rollback();
                    $this->db->rollback();
                    $this->set_error( $e->getMessage() );
                }
                $c = new Curl();
                $c->setOpt( CURLOPT_CONNECTTIMEOUT , 1 );
                $c->get( $this->config->gms['notify_server_match_update_address'] );
                $c->close();
                SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_MATCH_VERIFY , "审核积分赛id#$match_id 审核id#$verify_id 为通过" );
            }
            Redirect::instance()->forward( '/dailyMatch/lists/19' );
        }


        function editPrize()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_DAILY_MATCH_EDIT );
            $this->init_navigator();
            $match_id = $this->args[1];
            $match_type = 0;
            $match_prize_redis_key = Helper::instance()->get_match_prize_key( $match_type , $match_id );

            $json_str = MatchPrize_M::instance()->list_prize_struct( $match_prize_redis_key );

            $this->output_data['action'] = '/dailyMatch/cachePrize/';
            $this->output_data['action_name'] = '编辑';
            $this->output_data['match_id'] = $match_id;
            $this->output_data['prize_types'] = Encoder::instance()->encode( $this->config->gms['prize_types'] );
            $this->output_data['list'] = $json_str;

            $this->render( "daily_match_prize.html" );
        }

        function cachePrize()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_DAILY_MATCH_EDIT );
            $prize_data = $this->input->post( 'match_prize_info' );
            $match_id = $this->input->post( 'match_id' );
            $match_type = 0;
            $abstract_id = $match_id * 10000 + $match_type;

            if ( !VerifyUtil::instance()->add_verify( $abstract_id , $prize_data , VerifyUtil::TYPE_MATCH_PRIZE ) )
                $this->set_error( Error::DATA_WRITE );
            $verify_id = $this->db->insert_id();
            SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_DAILY_MATCH_EDIT , "提交更改积分赛奖励请求 积分赛id#$match_id 审核id#$verify_id" );
            Redirect::instance()->forward( '/dailyMatch/lists/19' );
        }

        function verifyPrizeList()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_MATCH_VERIFY );
            $this->init_navigator();
            $match_id = $this->args[1];
            $match_type = 0;
            $abstract_id = $match_id * 10000 + $match_type;
            $this->output_data['list'] = VerifyUtil::instance()->read_verify( $abstract_id , VerifyUtil::TYPE_MATCH_PRIZE );
            $this->output_data['action'] = "/dailyMatch/verifyPrize";
            foreach ( $this->output_data['list'] as &$item ) {
                $match_type = $item['abstract_id'] % 10000;
                $match_id = ( $item['abstract_id'] / 10000 ) >> 0;
                $item['create_time'] = date( 'Y-m-d H:i:s' , $item['create_time'] );
                $item['source_admin_name'] = Admin_M::instance()->read( $item['source_admin_id'] )['account'];
                $item['type_name'] = $this->config->gms['verify_types'][ $item['type'] ];
                $item['prizes_content'] = Encoder::instance()->decode( $item['json_content'] );
                $item['match_type_name'] = $this->config->gms['match_types'][ $match_type ];
                $item['match_id'] = $match_id;

                foreach ( $item['prizes_content'] as &$prize ) {
                    $prize_temp = array();
                    foreach ( $prize['prizes'] as $p ) {
                        $prize_temp[] = $p['prize_amount'] . $this->config->gms['prize_types'][ $p['prize_type'] ]['name'];
                    }
                    $prize['content'] = implode( ',' , $prize_temp );
                }
            }
            $this->render( 'match_prize_verify.html' );
        }

        function verifyPrize()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_MATCH_VERIFY );
            $abstract_id = $this->input->post( 'abstract_id' );
            $match_type = $abstract_id % 10000;
            $match_id = ( $abstract_id / 10000 ) >> 0;
            $key = Helper::instance()->get_match_prize_key( $match_type , $match_id );
            $verify = $this->input->post( 'verify' );
            $verify_id = $this->input->post( 'verify_id' );
            $remark = $this->input->post( 'remark' );

            if ( $verify == 0 ) {//不通过
                if ( !VerifyUtil::instance()->unpass( $verify_id , $remark ) )
                    $this->set_error( Error::DATA_WRITE );
                SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_MATCH_VERIFY , "审核比赛奖励 比赛id#$match_id 审核id#$verify_id 为不通过" );
            } else {
                $prize_data = $this->input->post( 'json_content' );
                $gamedb = $this->getGameDB();
                try {
                    $gamedb->begin();
                    $this->db->begin();
                    //删除原有数据
                    if ( !MatchPrize_M::instance()->del( $match_id , $match_type ) )
                        throw new \Exception( Error::DATA_DELETE );

                    $match_data_array = Encoder::instance()->decode( $prize_data );
                    $sqls = array();
                    $sql = "INSERT INTO match_prize (match_id,match_type,rank,prize_type,prize_amount) VALUES ";
                    foreach ( $match_data_array as $data ) {
                        if ( strpos( $data['rank'] , '-' ) > - 1 ) {//批量写入
                            list( $start , $end ) = explode( '-' , $data['rank'] );
                            for ( $i = $start ; $i < $end + 1 ; $i ++ ) {
                                foreach ( $data['prizes'] as $prize ) {
                                    $tempsql = " ($match_id,$match_type,$i,{$prize['prize_type']},{$prize['prize_amount']})";
                                    echo $tempsql . '<br/>';
                                    $sqls[] = $tempsql;
                                }
                            }
                        } else {//单个写入
                            foreach ( $data['prizes'] as $prize ) {
                                $tempsql = " ($match_id,$match_type,{$data['rank']},{$prize['prize_type']},{$prize['prize_amount']})";
                                $sqls[] = $tempsql;
                            }
                        }
                    }
                    $sqls = $sql . implode( ',' , $sqls );

                    if ( !$gamedb->execute( $sqls ) )
                        throw new \Exception( Error::DATA_WRITE );

                    if ( !VerifyUtil::instance()->pass( $verify_id , $remark ) )
                        throw new \Exception( Error::DATA_WRITE );

                    $gamedb->commit();
                    $this->db->commit();
                    $c = new Curl();
                    $c->setOpt( CURLOPT_CONNECTTIMEOUT , 1 );
                    $c->get( $this->config->gms['notify_server_match_update_address'] );
                    $c->close();
                    //将结构 写入redis缓存
                    MatchPrize_M::instance()->save_prize_struct( $key , $prize_data );
                    SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_MATCH_VERIFY , "审核比赛奖励 比赛id#$match_id 审核id#$verify_id 为通过" );
                } catch (\Exception $e) {
                    $gamedb->rollback();
                    $this->db->rollback();
                    $this->set_error( $e->getMessage() );
                }
            }
            Redirect::instance()->forward( '/dailyMatch/lists/19' );
        }

        function match_info()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_DAILY_MATCH_LIST );
            $match_id = $this->args[0];
            $match_type = 0;
            $match_prize = MatchPrize_M::instance()->list_prize( $match_id , $match_type );
            if ( $match_prize ) {
                $ranks = array();
                foreach ( $match_prize as $p ) {
                    $myrank = $p['rank'];
                    if ( !in_array( $myrank , $ranks ) )
                        $ranks[] = array( 'rank' => $myrank );
                }

                foreach ( $ranks as &$r ) {
                    foreach ( $match_prize as $prize ) {
                        if ( $r['rank'] == $prize['rank'] ) {
                            $r['prizes'][] = array(
                                'prize_amount'    => $prize['prize_amount'] ,
                                'prize_type'      => $prize['prize_type'] ,
                                'prize_type_name' => $this->config->gms['prize_types'][ $prize['prize_type'] ]['name'] ,
                            );
                        }
                    }
                }
            }
            $data = array(
                'match_prize' => $ranks
            );
            $this->response( $data );
        }
    }