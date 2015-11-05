<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/18
     * Time: 上午11:35
     */

    namespace core;

    /**
     * redis缓存处理类
     */
    class RedisCache
    {

        private $_redis = null;

        private static $_instance = null;

        /**
         *
         * @param string $host
         * @param int    $port
         * @param int    $timeout
         * @return core\RedisCache
         */
        static function instance( $host , $port , $timeout = 0.0 )
        {
            if ( self::$_instance === null )
                self::$_instance = new self( $host , $port , $timeout );

            return self::$_instance;
        }

        /**
         *
         * @param string $host
         * @param int    $port
         * @param int    $timeout
         */
        function __construct( $host , $port , $timeout = 0.0 )
        {
            $this->_redis = new \Redis();
            $this->_redis->connect( $host , $port , $timeout );
        }

        /**
         * 选择数据索引
         * @param int $index
         */
        function select( $index )
        {
            $this->_redis->select( $index );
        }

        /**
         *
         * @param       $key
         * @param array $data
         * $data 格式:
         * //$data = array(
         * //    array('id'=>1,'name'=>'bh1'),
         * //    array('id'=>2,'name'=>'bh2'),
         * //    array('id'=>3,'name'=>'bh3'),
         * //    array('id'=>4,'name'=>'bh4'),
         * //    array('id'=>5,'name'=>'bh5'),
         * //);
         */
        function map( $key , Array $data )
        {
            for ( $i = 0 ; $i < count( $data ) ; $i ++ ) {
                $currentKey = $key . ':' . $i;
                $this->_redis->hMset( $currentKey , $data[ $i ] );
            }
        }

        /**
         * @param $key
         * @return array|bool
         * 成功返回格式:
         * //$data = array(
         * //    array('id'=>1,'name'=>'bh1'),
         * //    array('id'=>2,'name'=>'bh2'),
         * //    array('id'=>3,'name'=>'bh3'),
         * //    array('id'=>4,'name'=>'bh4'),
         * //    array('id'=>5,'name'=>'bh5'),
         * //);
         */
        function getMap( $key )
        {
            $keyPattern = $key . ':*';
            $keys = $this->_redis->keys( $keyPattern );
            $map = false;
            foreach ( $keys as $k ) {
                $data = $this->_redis->hGetAll( $k );
                $map[] = $data;
            }

            return $map;
        }


        /**
         * 模糊匹配清除
         * @param $key
         */
        function fuzzyClear( $key )
        {
            $keyPattern = $key . ':*';
            $keys = $this->_redis->keys( $keyPattern );
            foreach ( $keys as $k ) {
                $this->_redis->del( $k );
            }
        }

        /**
         * 精确清除
         * @param $key
         */
        function preciseClear( $key )
        {
            $this->_redis->del( $key );
        }

        function close()
        {
            $this->_redis->close();
        }
    }