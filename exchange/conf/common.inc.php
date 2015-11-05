<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-8-4
     * Time: 下午2:13
     * 通用配置项
     */

    return array(
        /***memcache 里存储的队列key*/
        'message_queue_keys' => array(
            1000 , //测试队列key  key
        ) ,

        'redis'              => array(
            'host' => '127.0.0.1' ,
            'port' => 6379,
            'idx' => 10
        ) ,


        /*cookie设置**/
        'cookie'             => array(
            'secret'  => 'web_newbee' ,
            'timeout' => 3600 * 3 ,
            'path'    => '/' ,
            'domain'  => DOMAIN
        ) ,
    );