<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/16
     * Time: 下午5:17
     */

    namespace api\core;

    use core\Base;
    use core\Encoder;

    abstract class GameBase extends Base
    {

        /**
         * @var \api\controller\Gateway $_context
         */
        protected $_context = null;

        function setContext( $context )
        {
            $this->_context = $context;

            return $this;
        }

        /**
         * @param      $data   返回的数据
         * @param int  $error  错误代码
         * @param bool $end    是否输出后终止程序
         * @param int  $encode 编码方式
         * @throws \Exception
         */
        function response( $data , $error = 0 , $end = true , $encode = Encoder::JSON )
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
    }