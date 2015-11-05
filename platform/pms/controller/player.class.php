<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/5
     * Time: 下午2:22
     */

    namespace pms\controller;


    use common\model\GameAreaModel;
    use common\model\GamesModel;
    use common\model\UserModel_M;
    use common\Platform;
    use common\ResourceManager;
    use common\UserResource;
    use core\DB;
    use gamefactory\GameFactory;
    use pms\core\AdminController;
    use core\Cookie;
    use core\Encoder;
    use core\Permission;
    use core\Pusher;
    use core\Redirect;
    use pms\libs\AdminUtil;
    use pms\libs\Error;
    use pms\libs\ModuleDictionary;
    use pms\libs\PlayerUtil;
    use pms\libs\SystemLog;
    use pms\model\GameSummary_M;
    use pms\model\Player_M;
    use pms\model\Profile_M;
    use utils\Arrays;
    use utils\Das;
    use utils\Page;
    use utils\Tools;

    /**
     * 玩家管理
     * Class Player
     * @package pms\controller
     */
    class Player extends AdminController
    {

        function lists()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_PLAYERS );

            $page = empty( $this->args[1] ) ? 1 : $this->args[1];
            $count = 10;
            $start = ( $page - 1 ) * $count;

            //获取查询条件
            $search_params = $this->http_get_params();
            if ( !empty( $search_params['login_name'] ) ) {
                $user = UserModel_M::instance()->readByLoginName( $search_params['login_name'] );
                $search_params['user_id'] = $user['user_id'];
            }
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' )
                    $this->output_data[ 'search_' . $k ] = $v;
                else
                    unset( $search_params[ $k ] );
            }
            $query_string = http_build_query( $search_params );

            $this->init_navigator();
            $list = Player_M::instance()->set_condition( $search_params )->lists( $start , $count );
            $total = Player_M::instance()->set_condition( $search_params )->num_rows();

            $server = Encoder::instance()->decode( Cookie::instance()->userdata( 'server' ) );
            $area_id = $server['area_id'];
            $game = GameAreaModel::instance()->read( $area_id );
            $gameDB = $this->getGameDB();

            foreach ( $list as &$item ) {
                $item['area'] = $this->config->common['areas'][ $item['area'] ];
                $profile = GameFactory::invoke( $game['game_id'] , $gameDB )->readProfile( $item['user_id'] );
                $item['coins'] = $profile['coins'];
                $item['coupon'] = $profile['coupon'];
                $item['ticket'] = $profile['ticket'];
            }
            unset( $gameDB , $game , $server , $area_id );

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
                            if ( Permission::instance()->hasPermission( $p['admin_permission'] , 2 ) )
                                $this->output_data['btn_edit_permission'] = 1;
                        }
                    }
                }
            }

            //初始化分页
            $page_params = array(
                'total_rows'   => $total , #(必须)
                'method'       => 'html' , #(必须)
                'parameter'    => '/player/lists/' . ModuleDictionary::ROOT_MODULE_GAME . '/?' ,  #(必须)
                'now_page'     => $page ,  #(必须)
                'list_rows'    => $count , #(可选) 默认为15
                'use_tag_li'   => true ,
                'li_classname' => 'active' ,
                'query_string' => $query_string
            );

            $pagiation = new Page( $page_params );
            if ( $pagiation->getTotalPage() > 1 )
                $this->output_data['pagiation'] = $pagiation->show( 1 );

            //读取问卷调查
            $server = Encoder::instance()->decode( Cookie::instance()->userdata( 'server' ) );
            $game = GamesModel::instance()->read( $server['game_id'] );
            $this->output_data['surveyMethod'] = $game['api_path_name'];

            $userTypes = array(
                0 => '普通用户' ,
                1 => '测试用户' ,
                2 => '扶持用户'
            );

            $this->output_data['user_types'] = $userTypes;
            $this->output_data['list'] = $list;
            $this->output_data['total'] = $total;
            $this->render( 'player_list.html' );
        }

        function add()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_PLAYERS_ADD );
            $this->init_navigator();
            $this->output_data['uid'] = $this->args[2];
            $this->output_data['login_name'] = $this->args[3];
            $user = UserModel_M::instance()->read( $this->args[2] );
            $this->output_data['diamond'] = $user['diamond'];
            $this->output_data['action'] = '/player/update';
            $this->output_data['token'] = Cookie::instance()->get_csrf_cookie();
            $server = Encoder::instance()->decode( Cookie::instance()->userdata( 'server' ) );
            $area_id = $server['area_id'];
            $game = GameAreaModel::instance()->read( $area_id );
            $gameDB = $this->getGameDB();
            $profile = GameFactory::invoke( $game['game_id'] , $gameDB )->readProfile( $this->args[2] );
            $this->output_data['coins'] = $profile['coins'];
            $this->output_data['coupon'] = $profile['coupon'];
            $this->output_data['ticket'] = $profile['ticket'];
            $this->render( 'player_add.html' );
        }

        function update()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_PLAYERS_ADD );
            $this->csrf_token_validation();
            $fields = $this->input->post();
            $uid = $fields['id'];
            $user = UserModel_M::instance()->read( $uid );
            $diamond = $fields['diamond'];
            unset( $fields['id'] , $fields['diamond'] );

            if ( !UserModel_M::instance()->update( array( 'diamond' => $diamond ) , $uid ) )
                $this->set_error( Error::DATA_WRITE );

            $server = Encoder::instance()->decode( Cookie::instance()->userdata( 'server' ) );
            $area_id = $server['area_id'];
            $game = GameAreaModel::instance()->read( $area_id );
            $gameDB = $this->getGameDB();
            $sourceProfile = GameFactory::invoke( $game['game_id'] , $gameDB )->readProfileDirect( $uid );
            $oldProfile = ResourceManager::instance()->formatToArray( $sourceProfile['items'] , $sourceProfile['items_num'] );
            $items = array(
                'items'     => $sourceProfile['items'] ,
                'items_num' => $sourceProfile['items_num']
            );
            ResourceManager::instance()->setResource( 0 , $fields['coins'] , $items['items'] , $items['items_num'] );
            ResourceManager::instance()->setResource( 2 , $fields['coupon'] , $items['items'] , $items['items_num'] );
            ResourceManager::instance()->setResource( 1 , $fields['ticket'] , $items['items'] , $items['items_num'] );
            if ( !GameFactory::invoke( $game['game_id'] , $gameDB )->updateProfile( $uid , $items ) )
                $this->set_error( Error::DATA_WRITE );

            ResourceManager::instance()->refreshCache($uid);

            //分析资源变化 并且发给数据统计服务
            $coins = intval( $oldProfile['coins'] ) - intval( $fields['coins'] );
            $ticket = intval( $oldProfile['ticket'] ) - intval( $fields['ticket'] );
            $diamond = intval( $user['diamond'] ) - intval( $diamond );
            $coupon = intval( $oldProfile['oldCoupon'] ) - intval( $fields['coupon'] );

            $config = $this->config->common['go_das_server'];
            if ( $config['enable'] ) {
                $pusher = new Pusher( $config );
                $version = '1.001.22';
                if ( $coins > 0 ) {
                    $data = array(
                        's'  => 10001 ,
                        'pt' => Platform::CLIENT_ORIGIN_WEB ,
                        'v'  => $version ,
                        'w'  => Das::RESOURCE ,
                        'd'  => array(
                            't'   => 0 ,
                            't_t' => 0 ,
                            'p'   => $coins ,
                            'p_t' => 0
                        )
                    );
                    $data = Encoder::instance()->encode( Arrays::array_val_toString( $data ) , Encoder::MSGPACK );
                    $pusher->push( $data );
                } else if ( $coins < 0 ) {
                    $data = array(
                        's'  => 10001 ,
                        'pt' => Platform::CLIENT_ORIGIN_WEB ,
                        'v'  => $version ,
                        'w'  => Das::RESOURCE ,
                        'd'  => array(
                            't'   => $coins * - 1 ,
                            't_t' => 0 ,
                            'p'   => 0 ,
                            'p_t' => 0
                        )
                    );
                    $data = Encoder::instance()->encode( Arrays::array_val_toString( $data ) , Encoder::MSGPACK );
                    $pusher->push( $data );
                }

                if ( $ticket > 0 ) {
                    $data = array(
                        's'  => 10001 ,
                        'pt' => Platform::CLIENT_ORIGIN_WEB ,
                        'v'  => $version ,
                        'w'  => Das::RESOURCE ,
                        'd'  => array(
                            't'   => 0 ,
                            't_t' => 0 ,
                            'p'   => $ticket ,
                            'p_t' => 2
                        )
                    );
                    $data = Encoder::instance()->encode( Arrays::array_val_toString( $data ) , Encoder::MSGPACK );
                    $pusher->push( $data );
                } else if ( $ticket < 0 ) {
                    $data = array(
                        's'  => 10001 ,
                        'pt' => Platform::CLIENT_ORIGIN_WEB ,
                        'v'  => $version ,
                        'w'  => Das::RESOURCE ,
                        'd'  => array(
                            't'   => $ticket * - 1 ,
                            't_t' => 2 ,
                            'p'   => 0 ,
                            'p_t' => 0
                        )
                    );
                    $data = Encoder::instance()->encode( Arrays::array_val_toString( $data ) , Encoder::MSGPACK );
                    $pusher->push( $data );
                }

                if ( $diamond > 0 ) {
                    $data = array(
                        's'  => 10001 ,
                        'pt' => Platform::CLIENT_ORIGIN_WEB ,
                        'v'  => $version ,
                        'w'  => Das::RESOURCE ,
                        'd'  => array(
                            't'   => 0 ,
                            't_t' => 0 ,
                            'p'   => $diamond ,
                            'p_t' => 1
                        )
                    );
                    $data = Encoder::instance()->encode( Arrays::array_val_toString( $data ) , Encoder::MSGPACK );
                    $pusher->push( $data );
                } else if ( $diamond < 0 ) {
                    $data = array(
                        's'  => 10001 ,
                        'pt' => Platform::CLIENT_ORIGIN_WEB ,
                        'v'  => $version ,
                        'w'  => Das::RESOURCE ,
                        'd'  => array(
                            't'   => $diamond * - 1 ,
                            't_t' => 1 ,
                            'p'   => 0 ,
                            'p_t' => 0
                        )
                    );
                    $data = Encoder::instance()->encode( Arrays::array_val_toString( $data ) , Encoder::MSGPACK );
                    $pusher->push( $data );
                }

                if ( $coupon > 0 ) {
                    $data = array(
                        's'  => 10001 ,
                        'pt' => Platform::CLIENT_ORIGIN_WEB ,
                        'v'  => $version ,
                        'w'  => Das::RESOURCE ,
                        'd'  => array(
                            't'   => 0 ,
                            't_t' => 0 ,
                            'p'   => $coupon ,
                            'p_t' => 3
                        )
                    );
                    $data = Encoder::instance()->encode( Arrays::array_val_toString( $data ) , Encoder::MSGPACK );
                    $pusher->push( $data );
                } else if ( $coupon < 0 ) {
                    $data = array(
                        's'  => 10001 ,
                        'pt' => Platform::CLIENT_ORIGIN_WEB ,
                        'v'  => $version ,
                        'w'  => Das::RESOURCE ,
                        'd'  => array(
                            't'   => $coupon * - 1 ,
                            't_t' => 3 ,
                            'p'   => 0 ,
                            'p_t' => 0
                        )
                    );
                    $data = Encoder::instance()->encode( Arrays::array_val_toString( $data ) , Encoder::MSGPACK );
                    $pusher->push( $data );
                }
            }

            SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_PLAYERS_ADD , '编辑玩家#uid:' . $uid . '的资源属性' );
            Redirect::instance()->forward( '/player/lists/19' );
        }

        function detail()
        {
            AdminUtil::instance()->check_permission( 20 );
            $uid = $this->args[0];
            $profile = Profile_M::instance()->read( $uid );
            $profile['gender'] = empty( $profile['gender'] ) ? '男' : '女';
            $profile['real_name'] = empty( $profile['real_name'] ) ? '/' : $profile['real_name'];
            $profile['id_card'] = empty( $profile['id_card'] ) ? '/' : $profile['id_card'];

            $gamesummary = GameSummary_M::instance()->read( $uid );
            if ( false == $gamesummary )
                $data = $profile;
            else {
                $data = array_merge( $profile , $gamesummary );
            }
            $user = UserModel_M::instance()->read( $uid );
            $data['diamond'] = $user['diamond'];
            $data['area'] = $this->config->common['areas'][ $user['area'] ];
            $data['mobile'] = $user['mobile'];
            $data['email'] = $user['email'];
            $this->response( $data , 0 );
        }

        /**
         * 封停
         */
        function forbidden()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_PLAYERS_ADD );
            $player_id = $this->args[0];
            $login_name = $this->args[1];

            if ( !PlayerUtil::instance()->forbidden( PlayerUtil::FORBBIDEN , $player_id ) )
                $this->response( null , Error::DATA_WRITE );

            SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_PLAYERS , "封停玩家 $login_name " );
            $this->response( null );
        }

        /**
         * 解封
         */
        function unforbidden()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_PLAYERS_ADD );
            $player_id = $this->args[0];
            $login_name = $this->args[1];

            if ( !PlayerUtil::instance()->forbidden( PlayerUtil::UNFORBBIDEN , $player_id ) )
                $this->response( null , Error::DATA_WRITE );

            SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_PLAYERS , "解封玩家 $login_name " );
            $this->response( null );
        }


        /**
         * 重置密码
         */
        function reset_password()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_PLAYERS_ADD );
            $player_id = $this->args[0];
            $user_number = $this->args[1];
            $login_name = $this->args[2];

            if ( !$newpassword = PlayerUtil::instance()->reset_password( $player_id , $user_number ) )
                $this->response( null , Error::DATA_WRITE );

            SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_PLAYERS , "重置玩家 $login_name 的登陆密码为:$newpassword" );
            $this->response( $newpassword );
        }


        /**
         * 重置消费密码
         */
        function reset_purchase_password()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_PLAYERS_ADD );
            $player_id = $this->args[0];
            $user_number = $this->args[1];
            $login_name = $this->args[2];

            if ( !$newpassword = PlayerUtil::instance()->reset_purchase_password( $player_id , $user_number ) )
                $this->response( null , Error::DATA_WRITE );

            SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_PLAYERS , "重置玩家 $login_name 的消费密码为:$newpassword" );
            $this->response( $newpassword );
        }

        function userMessage()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_USER_MESSAGES );
            $this->init_navigator();
            $this->output_data['items'] = Arrays::array_fetch( 0 , 13 , $this->config->common['tool_type'] );
            $this->output_data['success'] = empty( $this->args[1] ) ? 0 : 1;
            $this->render( 'player_user_messages.html' );
        }

        function sendUserMessage()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_USER_MESSAGES );
            $this->init_navigator();
            $post = $this->input->post();
            $uids = explode( ',' , $post['players'] );
            $itemTypes = array();
            $itemAmounts = array();
            $itemNames = array();
            for ( $i = 0 ; $i < count( $post['item_id'] ) ; $i ++ ) {
                if ( !empty( $post['item_num'][ $i ] ) ) {
                    if ( $post['item_id'][ $i ] < 4 ) {
                        $itemTypes[] = intval( $this->config->common['price_type_relation_game'][ $post['item_id'][ $i ] ] );
                    } else {
                        $itemTypes[] = intval( $post['item_id'][ $i ] );
                    }

                    $itemAmounts[] = intval( $post['item_num'][ $i ] );
                    $itemNames[] = $this->config->common['tool_type'][ $post['item_id'][ $i ] ];
                }
            }
            if ( count( $itemTypes ) == 0 )
                $msg_type = 9;
            else {
                $msg_type = 8;
            }

            $json = array(
                'itemtypes'   => $itemTypes ,
                'itemamounts' => $itemAmounts ,
                'title'       => $post['title'] ,
                'content'     => $post['content'] ,
                'got'         => false
            );
            $json = Encoder::instance()->encode( $json );
            $params = array(
                'has_read'          => 0 ,
                'msg_type'          => $msg_type ,
                'sender'            => 'system' ,
                'msg_time'          => date( 'YmdHi' ) ,
                'msg_jsoned_params' => $json
            );

            //读取gamedb
            $server = Encoder::instance()->decode( Cookie::instance()->userdata( 'server' ) );
            $gamedb = new DB();
            $gamedb->init_db( $server );

            foreach ( $uids as $uid ) {
                $fields = $params;
                $fields['receiver_uid'] = $uid;
                $gamedb->save( $fields , 'user_messages' );
                usleep( 100 );
            }
            $gamedb->close();
            $uids = implode( ',' , $uids );
            $iteminfo = '';
            for ( $i = 0 ; $i < count( $itemNames ) ; $i ++ ) {
                $iteminfo .= $itemAmounts[ $i ] . $itemNames[ $i ] . ',';
            }
            SystemLog::instance()->save( ModuleDictionary::MODULE_GAME_USER_MESSAGES , "发放给#uid:$uids. 物品:$iteminfo" );
            Redirect::instance()->forward( '/player/userMessage/19/success' );
        }

        function addSupporter()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_PLAYERS_ADD );
            $this->init_navigator();

            $xfDB = new DB();
            $xfDB->init_db_from_config( 'xinfeng' );

            $gameDB = new DB();
            $gameDB->init_db_from_config( 'game' );

            $num = $this->input->post( 'supporter_num' );
            $nicknames = explode(',',$this->input->post('nicknames'));
            $diamond = $this->input->post('diamond');
            $coins = $this->input->post('coins');
            $time = time();
            $datetime = date('YmdHis');
            for ( $i = 0 ; $i < $num ; $i ++ ) {
                try {
                    $xfDB->begin();
                    $gameDB->begin();
                    $sql = "SELECT MAX(user_number) as uno FROM xf_user";
                    $xfDB->execute( $sql );
                    $result = $xfDB->fetch();
                    $user_number = intval( $result['uno'] ) + 1;

                    $nickname = $nicknames[$i];

                    $userFields = array(
                        'login_name'  => uniqid() ,
                        'user_number' => $user_number ,
                        'password'    => md5( md5( 'newbeesoft' ) . '#' . $user_number ) ,
                        'regist_time' => $datetime ,
                        'nickname'    => $nickname ,
                        'diamond'     => $diamond ,
                        'user_flag'   => 2
                    );

                    if ( !$xfDB->save( $userFields , 'xf_user' ) )
                        throw new \Exception( Error::DATA_WRITE );

                    $user_id = $xfDB->insert_id();

                    $purchaseFields = array(
                        'user_id'           => $user_id ,
                        'purchase_password' => '' ,
                        'confirmation_key'  => ''
                    );

                    if(!$xfDB->save($purchaseFields,'xf_purchaseprofile'))
                        throw new \Exception( Error::DATA_WRITE );

                    $profileFields = array(
                        'user_id'   => $user_id ,
                        'items'     => '0' ,
                        'items_num' => $coins
                    );

                    if ( !$gameDB->save( $profileFields , 'profile' ) )
                        throw new \Exception( Error::DATA_WRITE );

                    $userResourceLogFields = array(
                        'uid'         => $user_id ,
                        'tool_type'   => 0 ,
                        'price_type'  => 0 ,
                        'tool'        => $coins+1800 ,
                        'price'       => 0 ,
                        'action_type' => UserResource::ACTION_ADD_FUCHI,
                        'create_time' => $time
                    );

                    if ( !$gameDB->save( $userResourceLogFields , 'user_resource_log' ) )
                        throw new \Exception( Error::DATA_WRITE );

                    $userResourceLogFields = array(
                        'uid'         => $user_id ,
                        'tool_type'   => 1 ,
                        'price_type'  => 0 ,
                        'tool'        => $diamond ,
                        'price'       => 0 ,
                        'action_type' => UserResource::ACTION_ADD_FUCHI,
                        'create_time' => $time
                    );

                    if ( !$gameDB->save( $userResourceLogFields , 'user_resource_log' ) )
                        throw new \Exception( Error::DATA_WRITE );

                    $xfDB->commit();
                    $gameDB->commit();


                } catch (\Exception $e) {
                    $xfDB->rollback();
                    $gameDB->rollback();
                    Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , $e->getMessage() , $e );
                    $xfDB->close();
                    $gameDB->close();
                    $this->response( null , $e->getMessage() );
                    break;
                }
                usleep( 100 );
            }

            $xfDB->close();
            $gameDB->close();
            $this->response( null );
        }

    }