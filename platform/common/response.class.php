<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/29
     * Time: 下午4:44
     */

    namespace common;


    use core\Encoder;
    use core\Singleton;

    class Response extends Singleton
    {

        protected static $_instance = null;

        /**
         * @param      $data   返回的数据
         * @param int  $error  错误代码
         * @param bool $end    是否输出后终止程序
         * @param int  $encode 编码方式
         * @throws \Exception
         */
        public function say( $error = 0 ,$data = null,  $end = true , $encode = Encoder::JSON )
        {
            $response = array(
                'error' => intval( $error ) ,
                'data'  => $data
            );
            if ( $end )
                die( Encoder::instance()->encode( $response , $encode ) );
            else
                echo Encoder::instance()->encode( $response , $encode );
        }

        /**
         * @param           $data
         * @param bool|true $end
         * @param int       $encode
         * @throws \Exception
         */
        public function success($data = null,$end = true, $encode = Encoder::JSON){
            $response = array(
                'error' => 0,
                'data'  => $data
            );
            if ( $end )
                die( Encoder::instance()->encode( $response , $encode ) );
            else
                echo Encoder::instance()->encode( $response , $encode );
        }


    }