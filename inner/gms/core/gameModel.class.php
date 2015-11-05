<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/18
     * Time: 上午10:26
     */
    namespace gms\core;


    use core\Base;
    use core\Cookie;
    use core\DB;
    use core\Encoder;
    use core\Redis;

    /**
     * 供需要单服操作游戏服务器数据的类使用
     * Class AdminModel
     * @package core
     */
    class GameModel extends Base
    {

        /**
         * 游戏服务器信息数组/单服
         * @var GameServer
         */
        protected $_game_server;
        protected $_redis;

        function __construct()
        {
            $server_data = Cookie::instance()->userdata( 'server' );
            if ( empty( $server_data ) )
                throw new \Exception( '您未选择游戏服务器' );
            if ( empty( $this->_game_server ) ) {
                $server = Encoder::instance()->decode( $server_data );
                $this->_game_server = new DB();
                $this->_game_server->init_db( $server );
                $this->bindProperty( '_game_server' , $this->_game_server );
            }

            return $this->_game_server;
        }

        function initRedis()
        {
            $config = $this->config->common['redis'];
            $r = new Redis( $config['host'] , $config['port'] );
            $this->_redis = $r->getResource();
        }

    }