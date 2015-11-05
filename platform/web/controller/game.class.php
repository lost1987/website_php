<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-10-16
     * Time: 上午9:28
     */

    namespace web\controller;


    use common\base\BaseServers;
    use common\Event;
    use common\GameMsg;
    use common\GameSession;
    use common\Platform;
    use core\Controller;
    use core\Cookie;
    use core\Redirect;
    use web\libs\UserUtil;
    use common\EventDispatcher;

    class Game extends Controller
    {

        function index()
        {
            if(UserUtil::instance()->isLogin())
                Redirect::instance()->forward();
            $output_data['token'] = Cookie::instance()->get_csrf_cookie();
            $output_data['errcode'] = empty( $this->args[0] ) ? 0 : $this->args[0];
            $output_data['server_id'] = $this->args[0];
            if(empty($output_data['server_id']))
                die('非法请求页面');
            $this->tpl->display('game_login.html',$output_data);
        }

        /**
         * 加载游戏页面
         */
        function enter()
        {
            $server_id = $this->input->get_post('server_id');
            $server = BaseServers::instance()->read($server_id);
            if(PROJECT_MODE == 'develop') {
                $data = @get_headers( $server['flash_swf_path'] . 'beta/Main.swf' , true );
                $swfUri = $server['flash_swf_path'] . 'beta/Main.swf';
            }
            else if(PROJECT_MODE == 'product') {
                $data = @get_headers( $server['flash_swf_path'] . 'release/Main.swf' , true );
                $swfUri = $server['flash_swf_path'] . 'release/Main.swf';
            }

            $user['user_id'] = Cookie::instance()->userdata('uid');
            $user['user_number'] = Cookie::instance()->userdata('user_number');
            $user['login_name'] = Cookie::instance()->userdata('login_name');

            //发送消息给服务器 验证是否卡号
            $result = GameMsg::instance()->pushLoginCheckedPack($user['user_id']);
            if($result != 0)//TODO
               die('该账号正在牌局上,请稍后再登陆!');

            if(empty($user['user_id'])){
                    $output_data['token'] = Cookie::instance()->get_csrf_cookie();
                    $output_data['errcode'] = empty( $this->args[0] ) ? 0 : $this->args[0];
                    $this->tpl->display( 'game_login.html' , $output_data );
                    exit;
            }

            GameSession::instance()->clean($user['user_id']);
            $sessionid = GameSession::instance()->create($user);
            $output_data['sessionid'] = $sessionid;
            $output_data['domain'] = DOMAIN;
            $version = md5($data['Last-Modified']);
            $output_data['swfUri'] = $swfUri.'?version='.$version;

            //TODO 读取游戏分区
            $eventData = array(
                'user_id' => $user['user_id'],
                'platform_id' => Platform::CLIENT_ORIGIN_WEB_PLATFORM
            );
            @EventDispatcher::instance()->dispatch(Event::DO_AFTER_LOGIN,$eventData);

            $this->tpl->display( 'game.html' , $output_data );
        }

        function logout(){
            UserUtil::instance()->createLogoutHistory( Cookie::instance()->userdata( 'uid' ) );
            Cookie::instance()->sess_destroy();
            unset( $_SESSION );
            if ( isset( $this->args[0] ) ) {//args[0]为server_id
                Redirect::instance()->forward( '/game/index/' . $this->args[0] );
            }
        }
    }