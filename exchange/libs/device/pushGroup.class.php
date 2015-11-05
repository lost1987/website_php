<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/6/30
 * Time: 上午11:08
 */

namespace libs\device;


class PushGroup {

    static $tags = array(
        'broadcast' => '广播',
        'push:group:mobile:auth' => '手机认证过的玩家',
        'push:group:payers:100' => '付费小于100的玩家',
        'push:group:payers:100_1000' => '付费100-1000的玩家',
        'push:group:payers:1000' => '付费大于1000的玩家',
        'push:group:exchange:physical'=>'兑换过奖品的玩家',
        'push:group:unlogin:day:3' => '3天未登录的玩家',
        'push:group:unlogin:day:7' => '7天未登录的玩家',
        'push:group:unlogin:day:14' => '14天未登录的玩家',
        'push:group:rounds_day:3'=>'今天打牌局数3以下的玩家',
        'push:group:rounds_day:3_10'=>'今天打牌局数3-10的玩家',
        'push:group:rounds_day:10'=>'今天打牌局数10以上的玩家',
        'push:group:sign6' => '连续签到6天的玩家',
        'push:group:area:0' => '区域:江岸的玩家',
        'push:group:area:1' => '区域:江汉的玩家',
        'push:group:area:2' => '区域:硚口的玩家',
        'push:group:area:3' => '区域:武昌的玩家',
        'push:group:area:4' => '区域:青山的玩家',
        'push:group:area:5' => '区域:洪山的玩家',
        'push:group:area:6' => '区域:东西湖的玩家',
        'push:group:area:7' => '区域:汉南的玩家',
        'push:group:area:8' => '区域:蔡甸的玩家',
        'push:group:area:9' => '区域:江夏的玩家',
        'push:group:area:10' => '区域:黄陂的玩家',
        'push:group:area:11' => '区域:新洲的玩家',
        'push:group:area:12' => '区域:汉阳的玩家',
        'push:group:area:13' => '区域:火星的玩家',
        'push:group:platform:1'=>'渠道:原手机端',
        'push:group:platform:2'=>'渠道:原web端',
        'push:group:platform:3'=>'渠道:微博端',
        'push:group:platform:4'=>'渠道:360',
        'push:group:platform:5'=>'渠道:百度',
        'push:group:platform:6'=>'渠道:华为',
        'push:group:platform:7'=>'渠道:小米',
        'push:group:platform:8'=>'渠道:魅族',
        'push:group:platform:9'=>'渠道:联想',
        'push:group:platform:10'=>'渠道:OPPO',
        'push:group:platform:11'=>'渠道:酷派',
        'push:group:platform:12'=>'渠道:微信',
        'push:group:platform:13'=>'渠道:应用猫'
    );

} 