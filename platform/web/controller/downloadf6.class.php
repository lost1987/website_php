<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/11
     * Time: 下午3:37
     */

    namespace web\controller;


    use core\Controller;
    use core\Redis;

    class Downloadf6 extends Controller
    {

        function index()
        {
            $is_wx = false;
            $is_android = false;
            $is_ios = false;

            $r = new Redis($this->config->common['redis']['host'],$this->config->common['redis']['port']);
            $redis = $r->getResource();
            $redis->select(2);

            if ( strpos( $_SERVER['HTTP_USER_AGENT'] , 'iPhone' ) > - 1 ) {
                $is_ios = true;
                $num = $redis->get('visit:ios');
                if(empty($num))
                    $num = 0;
                $num++;
                $redis->set('visit:ios',$num);
            } else if ( strpos( $_SERVER['HTTP_USER_AGENT'] , 'MicroMessenger' ) > - 1 ) {
                $is_wx = true;
                $num = $redis->get('visit:wx');
                if(empty($num))
                    $num = 0;
                $num++;
                $redis->set('visit:wx',$num);
            } else if ( strpos( $_SERVER['HTTP_USER_AGENT'] , 'Android' ) > - 1 ) {
                $is_android = true;
                $num = $redis->get('visit:android');
                if(empty($num))
                    $num = 0;
                $num++;
                $redis->set('visit:android',$num);
            }else{
                $is_android = true;
                $num = $redis->get('visit:android');
                if(empty($num))
                    $num = 0;
                $num++;
                $redis->set('visit:android',$num);
            }

            $redis->close();
            $output['is_wx'] = $is_wx;
            $output['is_android'] = $is_android;
            $output['is_ios'] = $is_ios;

            $this->tpl->display( "downloadf6.html" , $output );
        }
    }