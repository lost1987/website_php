<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/16
     * Time: 下午5:15
     */

    namespace api\games\whmj\controller;

    use api\core\GameBase;
    use common\Platform;
    use core\Redis;
    use utils\Arrays;
    use utils\Strings;
    use api\libs\Error;
    use web\libs\DataUtil;
    use web\libs\UserUtil;
    use common\model\UserModel;

    class Player extends GameBase
    {

        /**
         * @var \Redis
         */
        private $redis = null;

        private function initRedis()
        {
            $redis = new Redis( $this->_context->config->common['redis']['host'] , $this->_context->config->common['redis']['port'] );
            $this->redis = $redis->getResource();
            $this->redis->select( 2 );
        }

        function global_rank()
        {
            $this->initRedis();
            $user = null;
            $session = $this->_context->_session;
            if ( false != $session ) {
                $userObject = UserModel::instance()->getUserByUid( $session['uid'] );
                $today = date( 'YmdHis' );
                if ( !strcmp( $userObject['regist_time'] , $today ) ) {
                    $user = null;
                } else {
                    $user_number = $session['user_number'];
                    $info = $this->redis->hMGet( 'global:rank_info:user:' . $user_number , array( 'nickname' , 'area' , 'coins' , 'win_rate' , 'coins_rank' ) );
                    $info = Arrays::std_array_format( $info );
                    $user_rank = intval( $info['coins_rank'] );
                    unset( $info['coins_rank'] );
                    $user = array(
                        'info' => $info ,
                        'rank' => $user_rank
                    );
                }
            }

            $list = $this->redis->lRange( 'global:rank_info:coins' , 0 , 19 );
            $data = array();
            foreach ( $list as $user_number ) {
                $temp = $this->redis->hMGet( 'global:rank_info:user:' . $user_number , array( 'nickname' , 'area' , 'coins' , 'win_rate' ) );
                $data[] = $temp;
            }

            $rank = Arrays::std_multi_array_format( $data );

            $response = array(
                'rank' => $rank ,
                'user' => $user
            );

            $this->response( $response );
        }


        function info()
        {
            $session = $this->_context->_session;
            $uid = $session['uid'];

            $sql = "SELECT user_id,login_name,mobile,nickname,user_number,email,gender,avatar,area,realname,diamond FROM xf_user WHERE user_id = ?";
            $this->db->execute( $sql , array( $uid ) );
            $user = $this->db->fetch();
            if ( false == $user )
                $this->response( null , Error::USER_NOT_EXSIT );

            //DataUtil::instance()->doAfterLogin( Platform::CLIENT_ORIGIN_MOBILE , $user , $this->_context->_game['game_id'] );
            $user['mobile'] = Strings::entry_string( $user['mobile'] , '*' );
            $user['email'] = Strings::entry_email( $user['email'] );
            $user = Arrays::std_array_format( $user );

            $sql = "SELECT vip_level,title,avail_titles,fame_level,items,items_num FROM profile WHERE user_id = ?";
            $this->_context->_gameDB->execute( $sql , array( $uid ) );
            $profile = $this->_context->_gameDB->fetch();
            $profile = Arrays::std_array_format( $profile );

            $sql = "SELECT purchase_password FROM xf_purchaseprofile WHERE user_id = ?";
            $this->db->execute( $sql , array( $uid ) );
            $purchase_profile = $this->db->fetch();
            $profile['purchase_password'] = $purchase_profile['purchase_password'];
            unset( $purchase_profile );

            $profile['purchase_password'] = empty( $profile['purchase_password'] ) ? 0 : 1;
            $profile['area'] = $this->config->common['areas'][ $user['area'] ];
            $profile['avatar'] = $user['gender'] . '_' . $user['avatar'];
            $profile['diamond'] = $user['diamond'];
            $user['shiming'] = empty( $profile['real_name'] ) ? 1 : 0;//是否需要填写真实姓名
            $user['vip_level'] = $profile['vip_level'];
            unset( $profile['realname'] , $profile['vip_level'] , $user['diamond'] );

            //取缓存数据
            $user_cache = UserModel::instance()->getGlobalCache( 'global' , $user['user_number'] );
            $sql = "SELECT * FROM gamesummary WHERE player_id = ?";
            $this->_context->_gameDB->execute( $sql , array( $uid ) );
            $game_summary = $this->_context->_gameDB->fetch();
            if ( false == $game_summary ) {
                $game_summary['id'] = 0;
                $game_summary['wins'] = 0;
                $game_summary['fengs'] = 0;
                $game_summary['total'] = 0;
                $game_summary['littlewin'] = 0;
                $game_summary['allwind'] = 0;
                $game_summary['all258'] = 0;
                $game_summary['allonesuite'] = 0;
                $game_summary['alltriples'] = 0;
                $game_summary['allothers'] = 0;
                $game_summary['lastdrawablecard'] = 0;
                $game_summary['quadruplerobbery'] = 0;
                $game_summary['winquadruplecard'] = 0;
                $game_summary['topgold'] = 0;
                $game_summary['topdiamond'] = 0;
                $game_summary['fangchong'] = 0;
                $game_summary['zimo'] = 0;
                $game_summary['baohu'] = 0;
            } else {
                unset( $game_summary['player_id'] , $game_summary['last_refresh_time'] );
            }
            $game_summary['coins_rank'] = empty( $user_cache['coins_rank'] ) ? 0 : $user_cache['coins_rank'];
            $game_summary['win_rank'] = empty( $user_cache['win_rank'] ) ? 0 : $user_cache['win_rank'];
            $game_summary['win_rate_rank'] = empty( $user_cache['win_rate_rank'] ) ? 0 : $user_cache['win_rate_rank'];
            $game_summary = Arrays::std_array_format( $game_summary );

            $user['game_summary'] = $game_summary;
            $user['profile'] = $profile;

            $auth = UserUtil::instance()->get_auth( $uid );
            $user['auth']['idcard'] = $auth[ UserUtil::USER_AUTH_IDCARD ];
            $user['auth']['sms'] = $auth[ UserUtil::USER_AUTH_SMS ];
            $user['auth']['mail'] = $auth[ UserUtil::USER_AUTH_MAIL ];

            //读取游戏头衔 HMGET
//        key: district_richrank
//        value:"hankou" -> uid
//            "wuchang" -> uid
//            "hanyang" -> uid
//            1001 汉口第一
//            1002 武昌第一
//            1003 汉阳第一
            $titleIds = array(
                'hankou'  => 1001 ,
                'wuchang' => 1002 ,
                'hanyang' => 1003
            );
            $user['profile']['rank_title'] = 0;

            $this->initRedis();
            $this->redis->select( 0 );
            $titles = $this->redis->hGetAll( 'district_richrank' );
            foreach ( $titles as $k => $v ) {
                if ( $uid == $v ) {
                    $user['profile']['rank_title'] = intval( $titleIds[ $k ] );
                    break;
                }
            }

            //开始计算比赛排名  item_nums
            //ItemPointMaxRank 15   //积分赛
            //ItemDayMaxRank 19     //金英赛
            //ItemWeekMaxRank 17  //大师赛
            //ItemMonthMaxRank 21 //争霸赛
            $items = explode(',',$profile['items']);
            $items_num = explode(',',$profile['items_num']);
            $flag = 0;
            foreach($items as $item_no){
                if($item_no == 15){
                    $user['orders']['jifen'] = $items_num[$flag];
                }else if($item_no == 19){
                    $user['orders']['jinying'] = $items_num[$flag];
                }else if($item_no == 17){
                    $user['orders']['dashi'] = $items_num[$flag];
                }else if($item_no == 21){
                    $user['orders']['zhengba'] = $items_num[$flag];
                }
                $flag++;
            }

            $user['orders']['zhanli'] = $this->redis->zRevRank('CoinRankWinDay',$uid);//战力
            $user['orders']['caifu'] = $this->redis->zRevRank('AllRank',$uid);//财富
            $user['orders']['meili'] = $this->redis->zRevRank('MeiLiRankAll',$uid);//魅力
            $user['orders'] = Arrays::std_array_format($user['orders']);

            $this->response( $user );
        }

    }