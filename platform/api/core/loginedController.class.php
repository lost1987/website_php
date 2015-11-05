<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/13
     * Time: 09:12
     */

    namespace api\core;


    use common\Response;
    use common\Error as CommonError;

    class LoginedController extends BaseApi
    {
            protected $_session = null;

            function __construct(){
                $this->_session = $this->checkSession($this->input->post('sessionid'));
                if(empty($this->_session))
                    Response::instance()->say(CommonError::LOGIN_NEEDED);
            }
    }