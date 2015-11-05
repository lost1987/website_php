<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/4/24
     * Time: 下午4:46
     */

    namespace api\controller;


    use api\core\Baseapi;

    /**
     * Class S
     * @package api\controller
     * 在登陆的时候相应客户端请求，发布游戏服务器状态信息：
     * 包含状态码（服务器能否连接），
     * 游戏最低可以运行版本号
     * ios审核版本号，
     * 公告信息。
     */
    class S extends Baseapi
    {

        function index()
        {

//        define('STAT','STOP');
            define( 'STAT' , 'RUNNING' );

            $lowerVersion = '1.4.4';
            $iosVersion = '1.4.5';

            if ( STAT == 'STOP' ) {
                $response = array(
                    'code'         => 1 ,
                    'lowerVersion' => $lowerVersion ,
                    'iosVersion'   => $iosVersion ,
                    'msg'          => '服务器正在维护,请稍后再登陆',
                    'host'			=> '115.29.41.27'
                );
                $this->response( $response );
            } else if ( STAT == 'RUNNING' ) {
                $response = array(
                    'code'         => 0 ,
                    'lowerVersion' => $lowerVersion ,
                    'iosVersion'   => $iosVersion ,
                    'msg'          => '',
                    'host'			=> '115.29.41.27'
                );
                $this->response( $response );
            }
        }

        function logs(){
                    $log = $this->input->post('log');
                    $fileName = date('Y-m-d').'.crash.log';
                    $filepath = BASE_PATH.'/'.BASE_PROJECT.'/client_logs/'.$fileName;
                    $myfile = fopen($filepath, 'a');
                    fwrite($myfile, $log);
                    fclose($myfile);
        }
    }