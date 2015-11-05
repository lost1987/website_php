<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/13
     * Time: 09:54
     */

    namespace api\controller;


    use api\core\LoginedController;
    use common\Account;
    use common\ItemsManager;
    use common\model\UserModel;
    use common\Response;
    use common\Error as CommonError;
    use utils\Arrays;
    use utils\Tools;

    class User extends LoginedController
    {

            function safeBox(){
                $chip = $this->input->post('chip');
                $user_id = $this->_session['user_id'];
                $user = UserModel::instance()->getUserByUid($user_id,array('items','items_num'));

                if($chip > 0){ //往保险箱放钱
                        ItemsManager::instance()->addItems(10001,$chip,$user['items'],$user['items_num']);
                        if(!ItemsManager::instance()->costItems(10000,$chip,$user['items'],$user['items_num']))
                            Response::instance()->say(CommonError::NOT_ENOUGH_ITEM);
                }else{//从保险箱取钱
                    ItemsManager::instance()->addItems(10000,abs($chip),$user['items'],$user['items_num']);
                    if(!ItemsManager::instance()->costItems(10001,abs($chip),$user['items'],$user['items_num']))
                        Response::instance()->say(CommonError::NOT_ENOUGH_ITEM);
                }

                if(!UserModel::instance()->updateUser($user,$user_id))
                    Response::instance()->say(CommonError::DB_UPDATE_ERROR);

                $items = ItemsManager::instance()->format($user['items'],$user['items_num']);
                $response['chip'] = intval($items['chip']);
                $response['chipbxx'] = intval($items['chipbxx']);
                Account::instance()->setUserId($user_id)->flush();
                Response::instance()->success($response);
            }

            /**
             * 意见反馈
             */
            function feedback(){
                    $content = $this->input->post('content');
                    if(strlen($content) > 500)
                        Response::instance()->say(CommonError::STRING_TOO_LONG);

                    $user = UserModel::instance()->getUserByUid($this->_session['user_id'],array('login_name'));

                    $fields = array(
                        'handler_type' => 0,
                        'reporter_name' => $user['login_name'],
                        'result' => 0,
                    );

                    $this->db->save($fields,'xf_index_handleresult');
                    $handler_id = $this->db->insert_id();

                    $fields = array(
                        'type' => 0,
                        'user_id' => $this->_session['user_id'],
                        'ip' => Tools::getip(),
                        'content' => $content,
                        'create_at' => date('Y-m-d H:i:s'),
                        'handler_id' => $handler_id
                    );

                    $this->db->save($fields,'xf_index_feedback');
                    Response::instance()->success();
            }


            /**
             * 用户在大厅获取所有拥有的物品
             */
            function hallItems(){
                $user_id = $this->_session['user_id'];
                $items = Account::instance()->setUserId($user_id)->publicItems();
                $items = Arrays::std_array_format($items);
                Response::instance()->success($items);
            }
    }