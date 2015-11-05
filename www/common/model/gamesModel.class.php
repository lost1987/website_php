<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/16
     * Time: 下午5:03
     */

    namespace common\model;


    use core\RedisCacheModel;

    class GamesModel extends RedisCacheModel
    {

        private static $_instance = null;

        function __construct( $useCache )
        {
            $this->_useCache = $useCache;
            if ( $this->_useCache ) {
                $this->initCache( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
                $this->_redisCache->select( 2 );
            }
        }

        function __destruct()
        {
            if ( $this->_useCache )
                $this->_redisCache->close();
        }

        static function instance( $useCache = true )
        {
            if ( self::$_instance == null )
                self::$_instance = new self( $useCache );

            return self::$_instance;
        }

        function read( $game_id )
        {
            $games = $this->listCache();

            return $games[ $game_id ];
        }

        function listCache()
        {
            $key = $this->createKey( __CLASS__ , __FUNCTION__ );
            $list = $this->_redisCache->getMap( $key );
            if ( false == $list ) {
                $sql = "SELECT  * FROM xf_games";
                $this->db->execute( $sql );
                $list = $this->db->fetch_all();
                $this->_redisCache->map( $key , $list );
            }

            $returnList = array();
            foreach ( $list as $item ) {
                $returnList[ $item['game_id'] ] = $item;
            }
            unset( $list );

            return $returnList;
        }

        /**
         * 清理cache
         * @return mixed
         */
        function clearCache( $key = null )
        {
            $this->_redisCache->fuzzyClear( $this->createKey( __CLASS__ , 'listCache' ) );
        }
    }