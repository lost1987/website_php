<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/21
     * Time: 上午10:49
     */

    namespace dhmanager\controller;


    use dhmanager\libs\Error;
    use core\Redirect;
    use dhmanager\core\AdministratorController;
    use dhmanager\model\ExcodeModel;
    use utils\Page;
    use utils\Tools;

    class Excode extends AdministratorController
    {

        function lists(){
            $page = empty( $this->args[0] ) ? 1 : $this->args[0];
            $count = 15;
            $start = ( $page - 1 ) * $count;

            $list = ExcodeModel::instance()->lists($start,$count);
            $total = ExcodeModel::instance()->num_rows();
            $this->_output_data['list'] = $list;

            //初始化分页
            $page_params = array(
                'total_rows'   => $total , #(必须)
                'method'       => 'html' , #(必须)
                'parameter'    => '/excode/lists/?' ,  #(必须)
                'now_page'     => $page ,  #(必须)
                'list_rows'    => $count , #(可选) 默认为15
                'use_tag_li'   => true ,
                'li_classname' => 'active' ,
                'query_string' => ''
            );

            $pagiation = new Page( $page_params );
            if ( $pagiation->getTotalPage() > 1 )
                $this->_output_data['pagiation'] = $pagiation->show( 1 );

            $this->render('excode_list.html');
        }


        function add(){
            $id = $this->args[0];
            if(!empty($id)){
                $excode = ExcodeModel::instance()->readByID($id);
                $this->_output_data['excode'] = $excode;
            }
            $this->render('excode_add.html');
        }

        function save(){
            $post = $this->input->post();
            $num = $post['num'];
            unset($post['num']);
            $post['create_time'] = time();
            for($i = 0 ; $i < $num ; $i++){
                $post['excode'] = substr(uniqid(mt_rand()),0,8);
                ExcodeModel::instance()->save($post);
                usleep(100);
            }
            Redirect::instance()->forward('/excode/lists');
        }

        function update(){
            $post = $this->input->post();
            $id = $post['id'];
            unset($post['id']);

            if(!ExcodeModel::instance()->update($post,$id ))
                Redirect::instance()->forward('/error/'.Error::DB_UPDATE_ERROR);

            Redirect::instance()->forward('/excode/lists');
        }

        function del(){
            $id = $this->args[0];
            if($id == 1)
                Redirect::instance()->forward('/error/'.Error::ADMIN_FORBIDDEN);

            if(!ExcodeModel::instance()->del($id))
                Redirect::instance()->forward('/error/'.Error::DB_DELETE_ERROR);

            Redirect::instance()->forward('/excode/lists');
        }

    }