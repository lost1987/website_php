<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/8
     * Time: 下午4:08
     */

    namespace api\controller;


    use api\core\Baseapi;
    use api\libs\Error;
    use api\model\IMEIModel;

    /**
     * 处理设备方面的接口
     * Class Device
     * @package api\controller
     */
    class Device extends Baseapi
    {

        /**
         * 记录设备的IMEI号
         */
        function imei()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );
            $post = $this->input->post();
            IMEIModel::instance()->save( $session['login_name'] , $post['imei'],$post['type']);//type=1 安卓 type=2 苹果
            $this->response(null);
        }
    }