<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-10-16
     * Time: 上午9:28
     */

    namespace web\controller;


    use core\DB;
    use gamefactory\GameFactory;
    use web\libs\DataUtil;
    use web\libs\Error;
    use core\Controller;
    use core\Cookie;
    use core\Redirect;
    use common\Platform;
    use web\libs\UserUtil;
    use common\model\GameAreaModel;
    use common\model\UserModel;

    class Game extends Controller
    {

        function index()
        {
            $output_data['token'] = Cookie::instance()->get_csrf_cookie();
            $output_data['errcode'] = empty( $this->args[0] ) ? 0 : $this->args[0];
            if ( !UserUtil::instance()->isLogin() ) {
                $this->tpl->display( 'game_login.html' , $output_data );
            } else {
                Redirect::instance()->forward( '/game/enter' );
            }
        }

        /**
         * 加载游戏页面
         */
        function enter()
        {
	        $output_data['token'] = Cookie::instance()->get_csrf_cookie();
            $output_data['errcode'] = empty( $this->args[0] ) ? 0 : $this->args[0];
	        if ( !UserUtil::instance()->isLogin() ) {
                $this->tpl->display( 'game_login.html' , $output_data );
				exit;
             }
	        
            $uid = Cookie::instance()->userdata( 'uid' );
            $user = UserModel::instance()->getUserByUid( $uid );
            $area_id = 1;
            $game_id = 1;

            $expire_time = $this->config->common['cookie']['timeout'];
            UserUtil::instance()->createSessionId( $expire_time , $user , $area_id , $game_id , $this->db );

            //TODO 读取游戏分区
            DataUtil::instance()->doAfterLogin( Platform::CLIENT_ORIGIN_WEB , $user , $game_id );
            //读取游戏库profile里有没有数据
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );
            $gameFunc = GameFactory::invoke( $game_id , $gameDB );
            $profile = $gameFunc->readProfile( $uid );

            if ( empty( $profile ) ) {
                //如果profile是empty 则是注册
                $gameFunc->initProfile( $uid );
                DataUtil::instance()->doAfterRegister( Platform::CLIENT_ORIGIN_WEB , $uid , 1 , 1 );
            }
            unset( $user , $uid );

            $file_path = BASE_PATH . '/' . BASE_PROJECT . '/media/bin/Main.swf';
            if ( !file_exists( $file_path ) )
                Redirect::instance()->forward( '/error/index/' . Error::ERROR_FILE_NOT_EXIST );
            $version = filemtime( $file_path );
            $output_data = array(
                'version' => $version
            );
            $this->tpl->display( 'game.html' , $output_data );
        }


        function lists()
        {

        }

    }