<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/8
     * Time: 16:04
     */

    return array(
        //命令协议号=>控制器名,方法名

        //===========================注册相关==========================
        1001 => array( '\api\controller\Register' , 'originSms' ) , //原版注册请求短信
        1002 => array( '\api\controller\Register' , 'originValid' ) ,//原版注册短信验证
        1003 => array( '\api\controller\Register' , 'originDone' ) ,//原版注册
        1004 => array( '\api\controller\Register' , 'originQuick' ) ,//原版快速注册
        1005 => array( '\api\controller\Register' , 'randName' ) ,//随机昵称

        //===========================登录相关==========================
        1030 => array( '\api\controller\Login' , 'origin' ) ,//原版登录


        //===========================检查相关==========================
        1050 => array( '\api\controller\Inspection' , 'session' ),//提供给游戏服务器来效验session是否有效
        1051 => array( '\api\controller\Inspection' , 'peacock' ),//炫耀


        //===========================用户相关==========================
        1080 => array( '\api\controller\Password' , 'login_1' ),//忘记登录密码1
        1081 => array( '\api\controller\Password' , 'login_2' ),//忘记登录密码2
        1082 => array( '\api\controller\Password' , 'login_3' ),//忘记登录密码3

        1090 => array('\api\controller\Messages','lists'),//用户消息列表
        1091 => array('\api\controller\Messages','read'),//用户消息设为已读
        1092 => array('\api\controller\Messages','fetch'),//用户消息物品领取
        1093 => array('\api\controller\Messages','del'),//删除用户消息(安全删除)

        1100 => array('\api\controller\User','safeBox'),//保险箱操作
        1101=>array('\api\controller\User','feedback'),//意见反馈
        1102=>array('\api\controller\User','hallItems'),//用户在大厅获取所有拥有的物品

        //===========================游戏公告==========================
        1300 => array('\api\controller\AnnounceMent','game'),
        1301 => array('\api\controller\AnnounceMent','hall'),

        //===========================游戏帮助==========================
        1330 => array('\api\controller\Help','game'),

        //==========================商城===============================
        1340 => array('\api\controller\StoreProducts','lists'),
        1341 => array('\api\controller\StoreProducts','exchange'),

        //===========================充值相关==========================
        1361 => array('\api\controller\Payment','chinabank'),//银联支付回调加钱
        1362 => array('\api\controller\Payment','alipay'),//支付宝回调加钱
        1363 => array('\api\controller\Payment','pay_order'),//生成订单号
        1364 => array('\api\controller\Payment','appstore'),//appstore回调

        9999 =>  array('\api\controller\Inspection','testSession'),
    );