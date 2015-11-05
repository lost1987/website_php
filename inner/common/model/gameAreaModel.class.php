<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/18
     * Time: 下午2:54
     */

    namespace common\model;


    use core\DB;
    use core\RedisCacheModel;

    class GameAreaModel extends RedisCacheModel
    {

        private static $_instance = null;

        static function instance( $useCache = true )
        {
            if ( self::$_instance == null )
                self::$_instance = new self( $useCache );

            return self::$_instance;
        }

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
            if ( $this->_useCache ) {
                $this->_redisCache->close();
            }
        }

        function read( $area_id )
        {
            $gameAreas = $this->listCache();

            return $gameAreas[ $area_id ];
        }

        function servers( $game_id )
        {
            $gameAreas = $this->listCache();
            $servers = array();
            foreach ( $gameAreas as $ga ) {
                if ( $ga['game_id'] == $game_id )
                    $servers[] = $ga;
            }

            return $servers;
        }

        function listCache()
        {
            $key = $this->createKey( __CLASS__ , __FUNCTION__ );
            $list = $this->_redisCache->getMap( $key );
            if ( false == $list ) {
                $xfDB = new DB();
                $xfDB->init_db_from_config( 'xinfeng' );
                $sql = "SELECT  * FROM xf_game_area";
                $xfDB->execute( $sql );
                $list = $xfDB->fetch_all();
                $this->_redisCache->map( $key , $list );
            }

            $returnList = array();
            foreach ( $list as $item ) {
                $returnList[ $item['area_id'] ] = $item;
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