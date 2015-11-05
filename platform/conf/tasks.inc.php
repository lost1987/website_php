<?php
return array(
    'daemons' => array(
        'deviceMsgPush', //设备推送
        'diamondTables',//钻石场统计数据,
        'robotCheat',
        'baoxiangTables',
        'eventHandle',
        'dayTask',
        'hourTask'
    ),

    'init_db' => '',

    'init_redis'   => true,

    'daemon_prefix' => 'php:task:daemon:pid:',
//    'bin' => 'nohup /Users/shameless/dev/php5.6/bin/php -c /etc/php.ini '
//    'bin' => 'nohup  /home/newbee/php/bin/php  -c /etc/php.ini '
    'bin' => 'nohup /data/opt/php5/bin/php -c /etc/php.ini'
);