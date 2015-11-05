<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/12/1
     * Time: 下午12:37
     */

    namespace pms\controller;

    use core\Configure;
    use core\Encoder;
    use core\Pusher;
    use core\Redis;
    use pms\libs\Error;
    use pms\model\WhiteList;
    use utils\Arrays;
    use utils\Tools;

    /**
     * 转发统计数据给GO消息队列
     * Class go
     * @package pms\controller
     */
    class Go
    {

        function index()
        {
            $config = Configure::instance();
            //检查白名单
//            $ip = Tools::getip();
//            $r = new Redis( $config->common['redis']['host'] , $config->common['redis']['port'] );
//            $redis = $r->getResource();
//            $redis->select(2);
//            $ips = $redis->hGetAll( 'gms_ip_white_list' );
//            if ( false == $ips ) {
//                //去数据库取数据 并写入redis
//                $list = WhiteList::instance()->lists();
//                if ( false == $list )
//                    die( Error::OUT_OF_IP_WHITE_LIST );
//                $ips = array();
//                foreach ( $list as $w ) {
//                    $ips[] = $w['ip'];
//                }
//                $redis->hMset( 'gms_ip_white_list' , $ips );
//                $redis->close();
//            }
//            if ( !in_array( $ip , $ips ) )
//                die( Error::OUT_OF_IP_WHITE_LIST );
//            unset($ip,$ips,$redis,$list);

            //发送数据
            $pusher = new Pusher( $config->common['go_das_server'] );

            if ( empty( $_POST ) )
                die( Error::ARGUMENTS );

            if ( !empty( $_POST['d'] ) )
                $json_data = Arrays::array_val_toString( Encoder::instance()->decode( $_POST['d'] ) );
            else
                $json_data = null;
            unset( $_POST['d'] );
            $data = Arrays::array_val_toString( $_POST );
            $data['d'] = $json_data;
            $data['v'] = "1.001.22";
            $data = Encoder::instance()->encode( $data , Encoder::MSGPACK );
            $pusher->push( $data )->kill();
        }
    }