<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-10-16
     * Time: 下午1:19
     */

    namespace api\core;


    use core\Base;
    use core\Encoder;
    use utils\Tools;
    use common\model\SessionModel;

    class Baseapi extends Base
    {

        function __construct()
        {
            if ( empty( $this->config->web ) )
                $this->config->load( 'web' );
        }

        /**
         * @param      $data   返回的数据
         * @param int  $error  错误代码
         * @param bool $end    是否输出后终止程序
         * @param int  $encode 编码方式
         * @throws \Exception
         */
        protected function response( $data , $error = 0 , $end = true , $encode = Encoder::JSON )
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
         * 检查session 时效是否过期[django_session表]
         * @param $sessionid
         * @return mixed  $session:array 有效,未过期 false:bool 失效,已过期
         */
        protected function check_session( $sessionid )
        {
            $session = SessionModel::instance()->read( $sessionid );
            if ( false == $session )
                return false;
            $now = time();
            $expire_time = strtotime( $session['expire_date'] );
            if ( $now < $expire_time ) {
                $session = Tools::authcode( $session['session_data'] , 'DECODE' , $this->config->web['entry_key'] );

                return unserialize( $session );
            }

            return false;
        }

    }