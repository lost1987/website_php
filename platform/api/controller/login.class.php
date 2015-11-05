<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/9
     * Time: 10:24
     */

    namespace api\controller;

    use api\core\BaseApi;
    use common\Account;
    use common\Error as CommonError;
    use common\Event;
    use common\EventDispatcher;
    use common\GameMsg;
    use common\GamePack;
    use common\GameSession;
    use common\ItemsManager;
    use common\model\UserModel;
    use common\Platform;
    use common\Response;
    use utils\Arrays;

    class Login extends BaseApi
    {
            function origin(){
                $login_name = $this->input->post( 'login_name' );
                //MD5后的密码
                $password = $this->input->post( 'password' );
                $pt =$this->input->post('pt');
                if(empty($pt))
                    $pt = Platform::CLIENT_ORIGIN_MOBILE_PLATFORM;

                $fields = array(
                    'user_id',
                    'login_name',
                    'password',
                    'user_number',
                    'nickname',
                    'mobile',
                    'email',
                    'id_card',
                    'gender',
                    'avatar',
                    'diamond',
                    'vip_level',
                    'items',
                    'items_num'
                );
                //检测登陆用户名是否正确
                $user = UserModel::instance()->getUserByLoginName( $login_name,$fields );
                if ( false == $user ) {//如果用户名不存在 则尝试用手机号登录
                    $user = UserModel::instance()->getUserByMobile( $login_name ,$fields);
                    if ( false == $user ) {//如果手机号登录失败 则尝试用邮箱登录
                        $user = UserModel::instance()->getUserByMail( $login_name ,$fields);
                        if ( false == $user )
                            Response::instance()->say(CommonError::USER_NOT_EXSIT);
                        else {
                            //判断邮箱是否认证过
                            $auth = Account::instance()->getAuth( $user['user_id'] );
                            if ( !$auth[ Account::USER_AUTH_MAIL ] )
                                Response::instance()->say(CommonError::USER_NOT_EXSIT);
                        }
                    } else {
                        //判断手机号是否认证过
                        $auth = Account::instance()->getAuth( $user['user_id'] );
                        if ( !$auth[ Account::USER_AUTH_SMS ] )
                            Response::instance()->say(CommonError::USER_NOT_EXSIT);
                    }
                }

                //验证密码
                if ( !Account::instance()->isValidPassword( $password , $user['user_number'] ,$user['password'] ) )
                    Response::instance()->say(CommonError::PASSWORD_ERROR);

                //发送消息给服务器 验证是否卡号
                $result = GameMsg::instance()->pushLoginCheckedPack($user['user_id']);
                if($result != 0)//TODO
                    Response::instance()->say(CommonError::USER_STATUS_NEED_WAIT);

                //解包items,items_num
               $items = ItemsManager::instance()->format($user['items'],$user['items_num']);
                unset($user['items'],$user['items_num']);

                GameSession::instance()->clean($user['user_id']);
                $sessionid = GameSession::instance()->create($user);
                $response = array(
                    'sessionid'  => $sessionid ,
                    'user' =>  Arrays::std_array_format( $user)
                );
                if(count($items) > 0){
                    $items = Arrays::std_array_format($items);
                    $response['user']['items'] = $items;
                }else
                    $response['user']['items'] = null;

                //发送事件
                $data = array(
                    'user_id' => $user['user_id'],
                    'platform_id' => $pt
                );
                @EventDispatcher::instance()->dispatch(Event::DO_AFTER_LOGIN,$data);
                Response::instance()->success($response);
            }
    }