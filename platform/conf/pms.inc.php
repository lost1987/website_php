<?php

    return array(
        'admin_secrect'                      => '&^$##$#@@Tggsss!Q@WS' ,

        'entry_key'                          => 'q!w@e#r$' ,//加密可逆算法key

        /*自动初始化DB配置项 如果无需初始化DB 请留 '' **/
        'init_db'                            => 'pms' ,

        'init_redis'                       => 'true',

        'visit_mode'                         => 'normal' , /**pathinfo,normal**/

        /**
         * 在实例化controller之前需要运行的自定义类,方法
         * 类文件必须放在 BASE_PROJECT/hook/beforectl 下面
         */
        'hook_breforectl'                    => array(// array('clazz'=>'HookSample','method'=>'call1')
        ) ,

        /*memcache 配置项**/
        'memcache'                           => array(
            'enable' => false ,
            'host'   => '127.0.0.1' ,
            'port'   => '11211'
        ) ,

        /*html 模板设置 **/
        'twig'                               => array(
            'enable'       => true ,
            'cache_enable' => true ,
            'template_dir' => '/template' ,
            'cache_dir'    => '/template_c' ,
        ) ,

        'csrf'                               => array(
            'expire_time' => 7200 ,
            'token_name'  => 'csrf_token' ,
            'cookie_name' => 'csrf_token'
        ) ,

        /*订单状态值**/
        'order_status'                       => array(
            0 => '未处理' ,
            1 => '已指派' ,
            2 => '已处理' ,
            3 => '已回复' ,
            4 => '已发货'
        ) ,

        'handler_type'                       => array(//对应index_handleresult 的handler_type
            0 => 'feedback' , //用户反馈
            1 => 'tipoff' ,   //举报
            2 => 'usersuspend' ,//用户申述
        ) ,

        //用户反馈类型
        'feedback_type'                      => array(
            0 => '游戏bug' ,
            1 => '商城兑换错误' ,
            2 => '充值失败' ,
            3 => '游戏记录错误' ,
            4 => '处罚申诉' ,
            5 => '其他问题'
        ) ,

        /***
         * 上传定义
         */
        'upload'                             => array(
            'image_folder'           => 'upload/images/product' ,//存放上传图片的文件夹
            'image_max_size'         => 524288 , //512KB 文件最大限制
            'image_allowed_ext'      => array( 'jpg' , 'png' , 'gif' ) ,//允许的图片格式
            'image_product_max_size' => 802400 ,//商品图片大小100KB
        ) ,


        'pay_type'                           => array(
            0 => 'PayChinaBank' ,//'网银在线',
            1 => 'PayAliPay' ,//'支付宝',
            2 => 'PayMobile' ,//'手机支付'
        ) ,

        /**
         * 支付状态
         */
        'pay_status'                         => array(
            0 => '等待付款' ,
            1 => '已付款' ,
            2 => '已过期' ,
            3 => '已取消'
        ) ,

        /***
         * 公告state字段的含义
         */
        'system_message_state'               => array(
            0 => 'NOT_START' , // 未开始
            1 => 'ACTIVE' , //可见的
            2 => 'EXPIRED' //过期的
        ) ,

        /**
         * 发送邮件的相关设定
         */
        'email'                              => array(
            'protocol'    => 'smtp' ,
            'smtp_host'   => 'smtp.ym.163.com' ,
            'smtp_user'   => 'kf@16youxi.com' ,
            'smtp_pass'   => 'newbeeeee' ,
            'smtp_port'   => 25 ,
            'charset'     => 'utf-8' ,
            'wordwrap'    => TRUE ,
            'mailtype'    => 'html' ,
            'expire_time' => 60 * 60 * 12 //失效时间为12个小时
        ) ,

        'service_reply'                      => array(
            '您反馈的问题,我们核实后会立即处理,感谢您对游戏的支持' ,
            '自定义'
        ) ,
        //玩家资源消耗日志里的动作类型
        'user_resource_log_action_type'      => array(
            1  => '玩家兑换' ,
            2  => '玩家抽奖' ,
            3  => '玩家充值' ,
            4  => '玩家注册' ,
            5  => '设定手机号' ,
            6  => '创建包房' ,
            7  => '牌局结算' ,
            8  => '给予金币' ,
            9  => '领取奖励' ,
            10 => '淘汰赛报名' ,
            11 => '淘汰赛竞拍' ,
            12 => '包房续时' ,
            13 => '接受金币' ,
            14 => '获取系统奖励' ,
            15 => '门票退回' ,
            16 => '获取任务奖励' ,
            17 => '获取低保' ,
            18 => '签到' ,
            19 => '玩家升级' ,
            20 => '购买vip' ,
            21 => '邀请' ,
            22 => '新春红包' ,
            23 => '添加一个好友' ,
            24 => '添加十个好友' ,
            25 => '声望等级提升',
            26 => '膜拜',
            27 => '钻石场中奖',
            28 => '钻石场开始扣钻石',
            29 => '黄庄或者强退退钻石',
            30 => '钻石场赢家返还的钻石',
            31 => '开宝箱',
            32 => '被添加为扶持帐号',
            100=>'易瑞特广告平台货币充值'
        ) ,

        'geetest'                            => array(
            'key' => '6811d8acde7817b5f9fbee73abcb0c44' ,
            'id'  => 'ea7205c9dd731fca3e0a6c4985c1560a'
        ),

        'article_flags'                      => array(
            'j' => '焦点资讯' ,
            'i' => '首页资讯带图片'
        ) ,

        'notification_product_mode' => true
    );
