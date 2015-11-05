<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/9
     * Time: 10:26
     */

    namespace api\controller;

    use api\core\LoginedController;
    use common\Account;
    use common\ItemsManager;
    use common\model\PlatformUserMessage;
    use common\Response;
    use core\Encoder;
    use utils\Arrays;
    use common\Error as CommonError;

    class Messages extends LoginedController
    {

        const MSG_ACTION_UNREAD = 0;//用户未操作

        const MSG_ACTION_READ = 1;//已读

        const MSG_ACTION_FETCHED = 2;//已领取

        const MSG_ACTION_DELETED = 3;//已删除

        const MSG_TYPE_NORMAL = 0;//普通文本消息

        const MSG_TYPE_ITEMS = 1;//带物品的消息

        function lists(){
            $user_id = $this->_session['user_id'];
            $list = PlatformUserMessage::instance()->lists($user_id);
            foreach($list as &$item){
                $item['msg_body_json'] =  Encoder::instance()->decode ($item['msg_body_json']);
                if(!empty($item['items']))
                    $item['items'] = ItemsManager::instance()->format($item['items'],$item['items_num']);
            }
            $list = Arrays::std_multi_array_format($list);
            Response::instance()->success($list);
        }

        function read(){
            $msg_id = $this->input->post('msg_id');
            if(!$this->db->update(array('action' => self::MSG_ACTION_READ),'xf_platform_user_message',' WHERE msg_id = '.$msg_id))
                Response::instance()->say(CommonError::DB_UPDATE_ERROR);
            Response::instance()->success($msg_id);
        }

        function fetch(){
            $msg_id = $this->input->post('msg_id');
            $msg = PlatformUserMessage::instance()->read($msg_id);
            if(empty($msg))
                    Response::instance()->say(CommonError::USER_MSG_NOT_EXSIT);

            if($msg['msg_type'] != self::MSG_TYPE_ITEMS)
                Response::instance()->say(CommonError::USER_MSG_FETCH_TYPE_ERROR);

            //TODO 开始领取流程
            //开始领取流程
            $msgItems = Encoder::instance()->decode($msg['msg_body_json']);
            if(!is_array($msgItems))
                    Response::instance()->say(CommonError::USER_MSG_ITEMS_NOT_EXSIT);

            $fields = array('action' => self::MSG_ACTION_FETCHED);
            if(!$this->db->update($fields,'xf_platform_user_message','WHERE msg_id = '.$msg_id))
                        Response::instance()->say(CommonError::DB_UPDATE_ERROR);

            //给用户增加物品
            Account::instance()->setUserId($this->_session['user_id'])->addItems($msgItems['items'],$msgItems['items_num']);
            Response::instance()->success($msg_id);
        }

        function del(){
            $msg_id = $this->input->post('msg_id');
            $fields = array('action' => self::MSG_ACTION_DELETED);
            if(!$this->db->update($fields,'xf_platform_user_message','WHERE msg_id = '.$msg_id))
                Response::instance()->say(CommonError::DB_UPDATE_ERROR);
            Response::instance()->success($msg_id);
        }
    }