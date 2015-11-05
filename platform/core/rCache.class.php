<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/17
     * Time: 上午10:12
     */

    namespace core;


    class RCache
    {

        private $_redis = null;

        private static $_instance = null;

        /**
         *
         * @param string $host
         * @param int    $port
         * @param int    $idx
         * @param int    $timeout
         * @return \core\RCache
         */
        static function instance(\Redis $redisInstance )
        {
            if ( self::$_instance === null )
                self::$_instance = new self( $redisInstance );

            return self::$_instance;
        }

        /**
         *
         * @param string $host
         * @param int    $port
         * @param int   $idx
         * @param int    $timeout
         */
        function __construct(\Redis $redisInstance )
        {
            $this->_redis = $redisInstance;
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
        function map( $key , Array $data)
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
        function getMap( $key ,$dataKey = null)
        {
            $keyPattern = $key . ':*';
            $keys = $this->_redis->keys( $keyPattern );
            $map = false;
            $sortedKeys = array();
            foreach ( $keys as $k ) {//排序
                    $squeues = explode(':',$k);
                    $squeue = $squeues[count($squeues)-1];
                    $sortedKeys[$squeue] = $k;
            }
            ksort($sortedKeys);

            foreach($sortedKeys as $k){
                $data = $this->_redis->hGetAll( $k );
                if(!empty($dataKey))
                    $map[$data[$dataKey]] = $data;
                else
                    $map[] = $data;
            }

            return $map;
        }

        function createKey($className,$functionName){
            return str_replace('\\',':',$className.':'.$functionName);
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