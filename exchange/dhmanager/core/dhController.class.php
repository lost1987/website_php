<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/11
     * Time: 上午9:36
     */

    namespace dhmanager\core;


    use core\Base;
    use core\Cookie;
    use core\Encoder;
    use core\Redirect;

    class DhController extends Base
    {

            protected $_output_data = null;

            function __construct(){
                $this->checkLogin();
            }

            protected  function checkLogin(){
                    if(false == Cookie::instance()->userdata('is_login'))
                        die('<script>window.parent.location="/login";</script>');
            }

           protected  function response($errCode = 0,$data = null){
                    $response = array(
                        'errCode' => $errCode,
                        'data' => $data
                    );

                  die(Encoder::instance()->encode($response));
           }

            protected  function render($template){
                    $this->tpl->display($template,$this->_output_data);
            }
    }