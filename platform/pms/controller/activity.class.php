<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/20
     * Time: 上午10:48
     */

    namespace pms\controller;


    use pms\core\AdminController;
    use core\Cookie;
    use core\Encoder;
    use core\Permission;
    use core\Redirect;
    use pms\libs\AdminUtil;
    use pms\libs\Error;
    use pms\libs\ModuleDictionary;
    use pms\libs\SystemLog;
    use pms\model\Activity_M;
    use utils\Curl;
    use utils\Date;
    use utils\Page;
    use utils\Tools;
    use utils\Upload;

    /**
     * 最新活动
     * Class Activity
     * @package pms\controller
     */
    class Activity extends AdminController
    {

        function lists()
        {
            //检查权限
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_ACTIVITY_LIST );

            $page = empty( $this->args[1] ) ? 1 : $this->args[1];
            $count = 10;
            $start = ( $page - 1 ) * $count;

            //获取查询条件
            $search_params = $this->http_get_params();
            foreach ( $search_params as $k => $v ) {
                if ( !empty( $v ) || $v == '0' )
                    $this->output_data[ 'search_' . $k ] = $v;
                else
                    unset( $search_params[ $k ] );
            }
            $query_string = http_build_query( $search_params );

            $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
            $search_params['server_id'] = $server['id'];
            $list = Activity_M::instance()->set_condition( $search_params )->lists( $start , $count );
            foreach ( $list as &$item ) {
                $item['expire_time'] = Date::instance()->format_YmdHi( $item['expire_time'] , Date::FORMAT_YMDHI_STANDARD );
                $item['publish_time'] = Date::instance()->format_YmdHi( $item['publish_time'] , Date::FORMAT_YMDHI_STANDARD );
            }
            $total = Activity_M::instance()->set_condition( $search_params )->num_rows();
            $this->init_navigator();

            $this->output_data['btn_edit_permission'] = 0;
            $this->output_data['btn_del_permission'] = 0;

            //检查按钮权限
            if ( Cookie::instance()->userdata( 'is_administrator' ) ) {
                $this->output_data['btn_edit_permission'] = 1;
                $this->output_data['btn_del_permission'] = 1;
            } else {
                $session_p = Cookie::instance()->userdata( 'session_p' );
                if ( !empty( $session_p ) ) {
                    $session_p = Encoder::instance()->decode( $session_p );
                    foreach ( $session_p as $p ) {
                        if ( $p['module_id'] == ModuleDictionary::ROOT_MODULE_ACTIVITY ) {
                            if ( Permission::instance()->hasPermission( $p['admin_permission'] , 2 ) )
                                $this->output_data['btn_edit_permission'] = 1;
                            if ( Permission::instance()->hasPermission( $p['admin_permission'] , 4 ) )
                                $this->output_data['btn_del_permission'] = 1;
                        }
                    }
                }
            }

            //初始化分页
            $page_params = array(
                'total_rows'   => $total , #(必须)
                'method'       => 'html' , #(必须)
                'parameter'    => '/activities/lists/' . ModuleDictionary::ROOT_MODULE_ACTIVITY . '/?' ,  #(必须)
                'now_page'     => $page ,  #(必须)
                'list_rows'    => $count , #(可选) 默认为15
                'use_tag_li'   => true ,
                'li_classname' => 'active' ,
                'query_string' => $query_string
            );

            $pagiation = new Page( $page_params );
            if ( $pagiation->getTotalPage() > 1 )
                $this->output_data['pagiation'] = $pagiation->show( 1 );

            $this->output_data['list'] = $list;
            $this->output_data['total'] = $total;
            $this->render( 'activity_list.html' );
        }

        function add()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_ACTIVITY_ADD );
            $this->output_data['success'] = $this->args[1] == 'success' ? 1 : 0;
            $this->init_navigator();
            $this->output_data['action'] = '/activity/save';
            $this->output_data['action_name'] = '添加';
            $this->output_data['token'] = Cookie::instance()->get_csrf_cookie();

            if ( $this->args[1] == 'edit' ) {
                $id = $this->args[2];
                $this->output_data['item'] = Activity_M::instance()->read( $id );
                $this->output_data['item']['expire_time'] = Date::instance()->format_YmdHi( $this->output_data['item']['expire_time'] , Date::FORMAT_YMDHI_STANDARD );
                $this->output_data['action'] = '/activity/update/' . $id;
                $this->output_data['action_name'] = '编辑';
            }

            $this->render( 'activity_add.html' );
        }

        function save()
        {
            $this->csrf_token_validation();
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_ACTIVITY_ADD );
            $post = $this->input->post();
            $file = $_FILES;

            $post['create_time'] = time();
            $post['content'] = $this->input->sPost( 'content' );

            //上传图片
            $upload1 = new Upload();
            $upload1->set_allowed_ext( $this->config->pms['upload']['image_allowed_ext'] );
            $upload1->set_max_size();
            $upload1->set_upload_folder( 'upload/images/game' );
            $file1 = $upload1->upload( $file['web_image'] );
            $post['web_image_url'] =   $file1['url'];

            $upload3 = new Upload();
            $upload3->set_allowed_ext( $this->config->pms['upload']['image_allowed_ext'] );
            $upload3->set_max_size( 504800 );
            $upload3->set_upload_folder( 'upload/images/game' );
            $file3 = $upload3->upload( $file['index_image'] );
            $post['index_image_url'] = $file3['url'];

            $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
            $post['server_id'] = $server['id'];

            if ( !$insert_id = Activity_M::instance()->save( $post ) ) {
                @unlink( $file1['path'] );
                @unlink( $file3['path'] );
                $this->set_error( Error::DATA_WRITE );
            }

            SystemLog::instance()->save( ModuleDictionary::MODULE_ACTIVITY_ADD , "添加最新活动#id:$insert_id" );
            Redirect::instance()->forward( '/activity/add/41/success' );
        }


        function update()
        {
            $this->csrf_token_validation();
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_ACTIVITY_ADD );
            $post = $this->input->post();
            $file = $_FILES;
            $post['content'] = $this->input->sPost( 'content' );

            $id = $this->args[0];
            //如果图片不为空 则上传图片
            if ( !empty( $_FILES['web_image']['name'] ) ) {
                $upload1 = new Upload();
                $upload1->set_allowed_ext( $this->config->pms['upload']['image_allowed_ext'] );
                $upload1->set_max_size();
                $upload1->set_upload_folder( 'upload/images/game' );
                $file1 = $upload1->upload( $file['web_image'] );
                $post['web_image_url'] =   $file1['url'];
            } else {
                unset( $post['web_image'] );
            }

            if ( !empty( $_FILES['index_image']['name'] ) ) {
                $upload3 = new Upload();
                $upload3->set_allowed_ext( $this->config->pms['upload']['image_allowed_ext'] );
                $upload3->set_max_size( 504800 );
                $upload3->set_upload_folder( 'upload/images/game' );
                $file3 = $upload3->upload( $file['index_image'] );
                $post['index_image_url'] = $file3['url'];
            } else {
                unset( $post['index_image'] );
            }


            $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
            $post['server_id'] = $server['id'];

            if ( !Activity_M::instance()->update( $post , $id ) ) {
                @unlink( $file1['path'] );
                @unlink( $file3['path'] );
                $this->set_error( Error::DATA_WRITE );
            }

            SystemLog::instance()->save( ModuleDictionary::MODULE_ACTIVITY_ADD , "编辑最新活动#id:$id" );
            Redirect::instance()->forward( '/activity/lists/41' );
        }


        function del()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_ACTIVITY_DEL );
            $id = $this->args[1];
            if ( !Activity_M::instance()->del( $id ) )
                $this->set_error( Error::DATA_DELETE );

            SystemLog::instance()->save( ModuleDictionary::MODULE_ACTIVITY_DEL , "删除最新活动#id:$id" );
            Redirect::instance()->forward( '/activity/lists/41' );
        }
    }