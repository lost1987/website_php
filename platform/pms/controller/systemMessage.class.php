<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/12/12
     * Time: 上午11:39
     */

    namespace pms\controller;


    use core\Cookie;
    use core\Encoder;
    use pms\core\AdminController;
    use core\Redirect;
    use pms\libs\AdminUtil;
    use pms\libs\Error;
    use pms\libs\ModuleDictionary;
    use pms\libs\SystemLog;
    use pms\model\SystemMessage_M;
    use utils\Page;

    class SystemMessage extends AdminController
    {


        function lists()
        {
            //检查权限
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_MESSAGE_LIST );

            $page = empty( $this->args[1] ) ? 1 : $this->args[1];
            $count = 10;
            $start = ( $page - 1 ) * $count;

            $list = SystemMessage_M::instance()->lists( $start , $count );
            $total = SystemMessage_M::instance()->num_rows();
            $this->init_navigator();

            //初始化分页
            $page_params = array(
                'total_rows'   => $total , #(必须)
                'method'       => 'html' , #(必须)
                'parameter'    => '/systemMessage/lists/' . ModuleDictionary::ROOT_MODULE_SYSTEM_INFO . '/?' ,  #(必须)
                'now_page'     => $page ,  #(必须)
                'list_rows'    => $count , #(可选) 默认为15
                'use_tag_li'   => true ,
                'li_classname' => 'active'
            );

            $pagiation = new Page( $page_params );
            if ( $pagiation->getTotalPage() > 1 )
                $this->output_data['pagiation'] = $pagiation->show( 1 );

            $this->output_data['list'] = $list;
            $this->output_data['total'] = $total;
            $this->render( 'system_message_list.html' );
        }

        function add()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_MESSAGE_ADD );
            $this->init_navigator();
            if ( $this->args[1] == 'success' )
                $this->output_data['success'] = 1;
            else
                $this->output_data['success'] = 0;
            $this->render( 'system_message_add.html' );
        }

        function save()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_MESSAGE_ADD );
            $contents = $this->input->post( 'nicknames' );
            $pri = $this->input->post('pri');
            $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
            if ( !SystemMessage_M::instance()->save( $contents,$server['id'],$pri ) )
                $this->set_error( Error::DATA_WRITE );

            SystemLog::instance()->save( ModuleDictionary::MODULE_SYSTEM_MESSAGE_ADD , "添加公告:" . implode( ',' , $contents ) );
            Redirect::instance()->forward( '/systemMessage/add/' . ModuleDictionary::ROOT_MODULE_SYSTEM_INFO . '/success' );
        }

        function del()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_SYSTEM_MESSAGE_ADD );
            if ( !SystemMessage_M::instance()->del( $this->args[1] ) )
                $this->set_error( Error::DATA_WRITE );
            Redirect::instance()->forward( '/systemMessage/lists/' . ModuleDictionary::ROOT_MODULE_SYSTEM_INFO );
        }
    }