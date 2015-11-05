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

        'redis'                     => array(
            'host' => '127.0.0.1' ,
            'port' => 6379
        ) ,

        /*cookie设置**/
        'cookie'                    => array(
            'secret'  => 'web_newbee' ,
            'timeout' => 3600 * 48 ,
            'path'    => '/' ,
            'domain'  => DOMAIN
        ) ,

        //数据统计开关
        'das'                       => array(
            'enable' => true
        ) ,

        'tool_type'                 => array(
            0  => '金币' ,
            1  => '钻石' ,
            2  => '门票' ,
            3  => '奖券' ,
            4  => '鲜花' ,
            5  => '鸡蛋' ,
            6  => '喇叭' ,
            7  => '包房卡' ,
            8  => '收到的鲜花' ,
            9  => '收到的鸡蛋' ,
            10 => '赢牌双倍金币卡' ,
            11 => '输牌金币减半卡' ,
            12 => '经验加倍卡' ,
            52 => '一元电话充值卡',
            60=>'黄钻',
            501 => 'vip1卡' ,//隐藏
            502 => 'vip2卡' ,//隐藏
            503 => 'vip3卡' ,//隐藏
            504 => 'vip4卡' ,//隐藏
            505 => 'vip5卡' ,//隐藏
            506 => 'vip6卡' ,//隐藏
            521 => '牌背1' ,
            522 => '牌背2' ,
            523 => '牌背3' ,
            524 => '牌背4' ,
            525 => '牌背5' ,
            526 => '牌背6' ,
            541 => '骰子1' ,
            542 => '骰子2' ,
            543 => '骰子3' ,
            544 => '骰子4' ,
            545 => '骰子5' ,
            546 => '骰子6' ,
        ) ,

        'tool_type_columns'         => array(
            0  => 'coins' ,
            1  => 'diamond' ,
            2  => 'ticket' ,
            3  => 'coupon' ,
            4  => 'flower' ,
            5  => 'egg' ,
            6  => 'horn' ,
            7  => 'private_room_card' ,
            8  => 'flower_recv' ,
            9  => 'egg_recv' ,
            10 => 'card_win_double' ,
            11 => 'card_lost_half' ,
            12 => 'card_exp_double'
        ) ,

        'price_type'                => array(
            0 => '金币' ,
            1 => '钻石' ,
            2 => '门票' ,
            3 => '奖券',
            52=>'一元电话充值卡',
            60=>'黄钻'
        ) ,

        'price_type_columns'        => array(
            0 => 'coins' ,
            1 => 'diamond' ,
            2 => 'ticket' ,
            3 => 'coupon'
        ) ,

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

        /**新蜂币提现比例*/
        'deposit_ratio'             => 10000 ,


        //映射游戏项目的资源类型变化 索引对应price_types的索引
        'game_resource_changetypes' => array(
            0  => 0 ,
            1  => 3 ,
            2  => 1 ,
            3  => 2 ,
            4  => 4 ,
            5  => 5 ,
            6  => 6 ,
            7  => 7 ,
            8  => 8 ,
            9  => 9 ,
            10 => 10 ,
            11 => 11 ,
            12 => 12 ,
            52=>52,
            60=>60,
            501 => 501 ,//隐藏
            502 => 502 ,//隐藏
            503 => 503 ,//隐藏
            504 => 504 ,//隐藏
            505 => 505 ,//隐藏
            506 => 506 ,//隐藏
            521 => 521 ,
            522 => 522 ,
            523 => 523 ,
            524 => 524 ,
            525 => 525 ,
            526 => 526 ,
            541 => 541 ,
            542 => 542 ,
            543 => 543 ,
            544 => 544 ,
            545 => 545,
            546 => 546 ,
        ),
    );