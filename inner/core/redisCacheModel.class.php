<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/18
     * Time: 下午2:56
     */

    namespace core;

    /**
     * redis缓存模型抽象类
     */
    abstract class RedisCacheModel extends Base
    {

        /**
         * @var $_redisCache RedisCache
         */
        protected $_redisCache = null;

        protected $_useCache = null;

        /**
         * 初始化cache
         * @param $redisHost
         * @param $redisPort
         * @param $redisTimeout
         */
        function initCache( $redisHost , $redisPort , $redisTimeout = 0.0 )
        {
            $this->_redisCache = RedisCache::instance( $redisHost , $redisPort , $redisTimeout );
        }

        protected function createKey( $className , $funcName )
        {
            $className = str_replace( '\\' , ':' , $className );

            return $className . ':' . $funcName;
        }

        abstract function listCache();

        /**
         * 清理cache
         * @return mixed
         */
        abstract function clearCache( $key = null );
    }