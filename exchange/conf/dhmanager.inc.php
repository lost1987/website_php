<?php

    return array(
        'admin_secrect'                      => '&^$##$#@@Tggsss!Q@WS' ,

        'entry_key'                          => 'q!w@e#r$' ,//加密可逆算法key

        /*自动初始化DB配置项 如果无需初始化DB 请留 '' **/
        'init_db'                            => 'dh' ,

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


        'geetest'                            => array(
            'key' => '6811d8acde7817b5f9fbee73abcb0c44' ,
            'id'  => 'ea7205c9dd731fca3e0a6c4985c1560a'
        ),

    );
