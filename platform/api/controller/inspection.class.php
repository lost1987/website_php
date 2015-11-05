<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/13
     * Time: 09:34
     */

    namespace api\controller;
    use api\core\BaseApi;
    use common\base\BaseItems;
    use common\Error;
    use common\Response;
    use utils\StreamImage;
    use utils\Tools;

    /**
     * 检查 执行各种检查
     * Class Inspection
     * @package api\controller
     */
    class Inspection extends BaseApi
    {

        /**
         * 检测用户的session 是否过期和有效并返回相应信息
         */
        function session()
        {
            $sessionid = $this->input->post( 'sessionid' );
            $session = $this->checkSession( $sessionid );
            $data = array(
                'username'    => null ,
                'user_number' => 0
            );

            //非法登入
            $data['username'] = $session['login_name'];
            $data['user_number'] = intval( $session['user_id'] );
            $response = json_encode( $data );
            die( $response );
        }

        /**
         *flash端 炫耀
         */
        function peacock()
        {
            $session = $this->checkSession( $_SERVER['HTTP_SESSIONID'] );
            if(false == $session)
                Response::instance()->say(Error::LOGIN_NEEDED);                            
            $s = StreamImage::instance( BASE_PATH . '/web/upload/peacock' );
            $image_name = $s->stream2Image();
            $url = 'http://v.t.sina.com.cn/share/share.php?url=' . BASE_HOST . '&title=我在武汉新蜂平台,约吗?&pic=' . STATIC_HOST . '/upload/peacock/' . $image_name;
            Response::instance()->success($url);
        }

        function testSession(){
                BaseItems::instance()->lists();
        }
    }