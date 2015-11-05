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
        'message_queue_keys'        => array(
            1000 , //测试队列key  key
        ) ,

        'session_entry_key'   => '0035531f9c428d7add0c246d1bbe6273',

        'session_time_out' => 86400,

        'redis'                     => array(
            'host' => '127.0.0.1' ,
            'port' => 6379,
            'idx' => 2
        ) ,

        /*cookie设置**/
        'cookie'                    => array(
            'secret'  => 'web_newbee' ,
            'timeout' => 3600 * 48 ,
            'path'    => '/' ,
            'domain'  => DOMAIN
        ) ,

        'zmq_socket' =>array(
            'host' => 'tcp://127.0.0.1',
            'port' => 9002,
            'method' => \ZMQ::SOCKET_PUSH
        ),

        /**
         * 网页端网银支付 的rmb:diamond的比例 例如 6元=60钻石
         */
        'pay_amount_ratio'          => array(
            20   => 200 ,
            50  => 500 ,
            100  => 1000 ,
            200  => 2000 ,
            500  => 5000
        ) ,

        /**
         * 手机端充值金额列表
         */
        'mobile_amount_ratio' => array(
            6 => 60,
            8=>18,
            20=>200,
            30=>300,
            50=>500,
            98=>980,
            100=>1000,
            200=>2000,
            208=>2080,
            500=>5000
        ),

        /**
         * 手机充值卡支付 rmb:diamond的比例
         */
        'pay_amount_ratio_mobile'   => array(
            20  => 200 ,
            30  => 310 ,
            50  => 530 ,
            100 => 1000
        ) ,

        'areas'                     => array(
            0  => '江岸' ,
            1  => '江汉' ,
            2  => '硚口' ,
            3  => '武昌' ,
            4  => '青山' ,
            5  => '洪山' ,
            6  => '东西湖' ,
            7  => '汉南' ,
            8  => '蔡甸' ,
            9  => '江夏' ,
            10 => '黄陂' ,
            11 => '新洲' ,
            12 => '汉阳' ,
            13 => '火星'
        ) ,

        /*订单状态值**/
        'order_status'              => array(
            0 => '未处理' ,
            1 => '已指派' ,
            2 => '已处理' ,
            3 => '已回复' ,
            4 => '已发货',
            5=>'玩家已认证'
        ) ,

        /**
         * 兑换,充值,购买 消耗了金币和金钻 通知服务器更新资源数的地址
         */
//    'http_monitor' => 'http://127.0.0.1:6626',
        'http_monitor'              => 'http://10.144.181.190:6626' ,
    );