<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/30
     * Time: 下午3:36
     */

    namespace pms\controller;


    use pms\core\AdminController;
    use core\ReflectClass;

    /**
     * 错误页面处理
     * Class Error
     * @package pms\controller
     */
    class Error extends AdminController
    {

        function code()
        {
            $this->init_navigator();
            $this->output_data['error_code'] = $this->args[0];
            $this->output_data['error_name'] = \pms\libs\Error::transfer( $this->args[0] );
            $this->render( 'error.html' );
        }

        function showErrorCodes()
        {
            $e = new \pms\libs\Error();
            $reflect = new ReflectClass( $e );
            $codes = $reflect->getConstants();
            $errors = array();
            foreach ( $codes as $k => $code ) {
                $temp = array();
                $temp['code'] = $code;
                $temp['name'] = \pms\libs\Error::transfer( $code );
                $errors[] = $temp;
            }
            $this->response( $errors );
        }

    }