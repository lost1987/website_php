<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/16
     * Time: 下午4:52
     */

    namespace api\controller;

    use api\libs\Error;
    use api\core\Baseapi;
    use core\DB;
    use core\Router;
    use utils\Tools;
    use common\model\GameAreaModel;
    use common\model\GamesModel;

    /**
     * Class Gateway
     * @package api\controller
     *
     * requirements:
     *       HTTP POST:[
     *          会话id   session_id
     *          路由id   r
     *       ]
     */
    class Gateway extends Baseapi
    {

        public $_session = null;

        public $_gameDB = null;

        public $_game = null;

        function __construct()
        {

            parent::__construct();
            $this->_session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( false == $this->_session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $area_id = $this->_session['area_id'];
            $game_id = $this->_session['game_id'];
            if ( empty( $area_id ) || empty( $game_id ) ) {
                Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , '无法连接游戏数据库,area_id或game_id 为空' );
                $this->response( null , Error::ARGUMENTS_VALUE_ERROR );
            }

            $server = GameAreaModel::instance()->read( $area_id );
            $this->_gameDB = new DB();
            $this->_gameDB->init_db( $server );

            $this->_game = GamesModel::instance()->read( $game_id );
        }


        function index()
        {
            $router_id = $this->input->get_post( 'r' );
            $routerConfigFile = BASE_PATH .
                DIRECTORY_SEPARATOR .
                BASE_PROJECT .
                DIRECTORY_SEPARATOR .
                'router' .
                DIRECTORY_SEPARATOR .
                $this->_game['api_router_cfg_name'];
            Router::instance( $routerConfigFile )->invoke( $router_id , $this );
        }

    }