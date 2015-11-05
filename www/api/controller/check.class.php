<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14/10/17
     * Time: 下午4:42
     */

    namespace api\controller;


    use api\core\Baseapi;
    use api\libs\Error;
    use common\model\GuideModel;
    use core\Encoder;

    /**
     * 提供各种检测服务的接口
     * Class Check
     * @package api\controller
     */
    class Check extends Baseapi
    {

        /**
         * 检测用户的session 是否过期和有效并返回相应信息
         * url : /check/session?sessionid=$sessionid
         */
        function session()
        {
            $session_key = $this->input->get( 'sessionid' );
            $session = $this->check_session( $session_key );
            $data = array(
                'username'    => null ,
                'user_number' => 0
            );

            //非法登入
            $data['username'] = $session['login_name'];
            $data['user_number'] = intval( $session['uid'] );
            $response = json_encode( $data );
            die( $response );
        }


        /**
         * 引导公告
         */
        function guide()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            $game_id = isset( $_POST['game_id'] ) ? $this->input->post( 'game_id' ) : 1;
           if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $list = GuideModel::instance()->lists( null , null , $game_id );
            foreach ( $list as &$item ) {
                 $item['images'] = Encoder::instance()->decode($item['images']);
            }
            $this->response( $list );
        }
    }