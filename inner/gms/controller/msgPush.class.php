<?php


    namespace gms\controller;


    use common\model\ImeiModel;
    use core\Cookie;
    use core\Encoder;
    use core\Redirect;
    use gms\core\AdminController;
    use gms\libs\AdminUtil;
    use gms\libs\Error;
    use gms\libs\ModuleDictionary;
    use gms\libs\SystemLog;
    use gms\model\MsgPushTask_M;
    use libs\device\AndroidPusher;
    use libs\device\IosPusher;
    use libs\device\PushGroup;
    use utils\Page;

    /**
     * 负责消息推送,任务等等
     * Class MsgPush
     * @package gms\controller
     */
    class MsgPush extends AdminController
    {

        function push()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_MSG_PUSH );
            $this->init_navigator();
            $this->render( 'service_push.html' );
        }

        function goPush()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_MSG_PUSH );
            $post = $this->input->post();

            $result = 0;
            switch ($post['device_type']) {
                case 0:      AndroidPusher::instance()->send( $post['title'] , $post['content'] , $post['msg_type'] , $this->config->gms['notification_product_mode']  );
                                //读取ios设备
                                $devices = ImeiModel::instance()->lists( ImeiModel::IOS );
                                $alias = array();
                                foreach ( $devices as $d ) {
                                    $alias[] = $d['imei'];
                                }
                                IosPusher::instance()->send( $post['content'] , $alias ,$this->config->gms['notification_product_mode']);
                    break;
                case 1:
                    $result = AndroidPusher::instance()->send( $post['title'] , $post['content'] , $post['msg_type'] , $this->config->gms['notification_product_mode']  );
                    break;
                case 2:
                        //读取ios设备
                        $devices = ImeiModel::instance()->lists( ImeiModel::IOS );
                        $alias = array();
                        foreach ( $devices as $d ) {
                            $alias[] = $d['imei'];
                        }
                    $result = IosPusher::instance()->send( $post['content'] , $alias ,$this->config->gms['notification_product_mode']);
                    break;
                default :
                    throw new \Exception( 'missing device type selected!' );
            }

            if ( !$result )
                $this->response( '推送消息发送失败 code:' . $result , 1 );

            if ( $post['device_type'] == 1 )
                $device = '安卓';
            else if($post['device_type'] == 2)
                $device = 'ios';
            else
                $device = '所有移动端';


            $log = '推送消息[标题:' . $post['title'] . '] ,内容:' . $post['content'] . ',消息类型为:广播,设备类型为:' . $device;
            if ( !empty( $post['alias'] ) )
                $log = '推送消息[标题:' . $post['title'] . '] ,内容:' . $post['content'] . ',消息类型为: 广播,设备类型为:' . $device . ',帐号:' . $post['alias'];
            SystemLog::instance()->save( ModuleDictionary::MODULE_MSG_PUSH , $log );
            $this->response( '发送成功!' );
        }

        function broadcast()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_MSG_PUSH );
            $this->init_navigator();
            $this->render( 'msg_push_broadcast.html' );
        }


        function taskList()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_MSG_PUSH_TASK_LIST );

            $page = empty( $this->args[1] ) ? 1 : $this->args[1];
            $count = 10;
            $start = ( $page - 1 ) * $count;

            //获取查询条件
//            $search_params = $this->http_get_params();
//            if ( !empty( $search_params['login_name'] ) ) {
//                $user = UserModel_M::instance()->readByLoginName( $search_params['login_name'] );
//                $search_params['user_id'] = $user['user_id'];
//            }
//            foreach ( $search_params as $k => $v ) {
//                if ( !empty( $v ) || $v == '0' )
//                    $this->output_data[ 'search_' . $k ] = $v;
//                else
//                    unset( $search_params[ $k ] );
//            }
//            $query_string = http_build_query( $search_params );

            $this->init_navigator();
            $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
            $list = MsgPushTask_M::instance()->lists($server['area_id'],$server['game_id'],$start,$count);
            $total = MsgPushTask_M::instance()->num_rows();

            foreach ( $list as &$item ) {
                $item['users_group'] = PushGroup::$tags[$item['users_group']];
                if($item['device'] == 1)
                    $item['device'] = '安卓';
                else if($item['device'] == 2)
                    $item['device'] = 'IOS';
                else
                    $item['device'] = '所有';
            }
            $this->output_data['btn_edit_permission'] = 0;

            //检查按钮权限
//            if ( Cookie::instance()->userdata( 'is_administrator' ) ) {
//                $this->output_data['btn_edit_permission'] = 1;
//            } else {
//                $session_p = Cookie::instance()->userdata( 'session_p' );
//                if ( !empty( $session_p ) ) {
//                    $session_p = Encoder::instance()->decode( $session_p );
//                    foreach ( $session_p as $p ) {
//                        if ( $p['module_id'] == ModuleDictionary::ROOT_MODULE_GAME ) {
//                            if ( Permission::instance()->hasPermission( $p['admin_permission'] , 2 ) )
//                                $this->output_data['btn_edit_permission'] = 1;
//                        }
//                    }
//                }
//            }

            //初始化分页
            $page_params = array(
                'total_rows'   => $total , #(必须)
                'method'       => 'html' , #(必须)
                'parameter'    => '/msgPush/taskList/' . ModuleDictionary::ROOT_MODULE_MSG_PUSH . '/?' ,  #(必须)
                'now_page'     => $page ,  #(必须)
                'list_rows'    => $count , #(可选) 默认为15
                'use_tag_li'   => true ,
                'li_classname' => 'active' ,
            );

            $pagiation = new Page( $page_params );
            if ( $pagiation->getTotalPage() > 1 )
                $this->output_data['pagiation'] = $pagiation->show( 1 );

            $this->output_data['list'] = $list;
            $this->output_data['total'] = $total;
            $this->render( 'msg_push_task_list.html' );
        }


        function taskAdd()
        {
            AdminUtil::instance()->check_permission(ModuleDictionary::MODULE_MSG_PUSH_TASK_ADD);
            $this->init_navigator();
            $this->output_data['success'] = empty($this->args[1]) ? 0 : 1;
            $this->output_data['user_groups'] = PushGroup::$tags;
            $this->render('msg_push_task_add.html');
        }

        function taskSave(){
            AdminUtil::instance()->check_permission(ModuleDictionary::MODULE_MSG_PUSH_TASK_ADD);
            $post = $this->input->post();
            $post['create_time'] = time();

            if(!$this->db->save($post,'gms_msg_push_task'))
                $this->set_error(Error::DATA_WRITE);

            Redirect::instance()->forward( '/msgPush/taskAdd/' . ModuleDictionary::ROOT_MODULE_MSG_PUSH . '/success' );
        }

        function taskDel(){
                $id = $this->args[1];
                if(!MsgPushTask_M::instance()->del($id))
                    $this->set_error(Error::DATA_DELETE);
            Redirect::instance()->forward( '/msgPush/taskList/' . ModuleDictionary::ROOT_MODULE_MSG_PUSH );
        }

    }