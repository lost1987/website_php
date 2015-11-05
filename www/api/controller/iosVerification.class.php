<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/6
     * Time: 下午2:27
     */

    namespace api\controller;


    use api\libs\Error;
    use api\core\Baseapi;

    /**
     * 苹果app送审
     * Class IosVerification
     * @package api\controller
     */
    class IosVerification extends Baseapi
    {

        /**
         *版本对比
         */
        function checkVer()
        {
            $currentVer = '1.4.3';
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( false == $session )
                $this->response( null , Error::USER_NOT_LOGIN );

            if ( $currentVer == $session['v'] )
                $this->response( 1 );
            $this->response( 0 );
        }

    }