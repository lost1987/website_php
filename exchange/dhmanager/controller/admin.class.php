<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/11
     * Time: 下午2:41
     */

    namespace dhmanager\controller;


    use core\Redirect;
    use dhmanager\core\AdministratorController;
    use dhmanager\libs\AdminUtil;
    use dhmanager\libs\Error;
    use dhmanager\model\AdminModel;
    use utils\Page;

    class Admin extends AdministratorController
    {
            function lists(){
                $page = empty( $this->args[0] ) ? 1 : $this->args[0];
                $count = 15;
                $start = ( $page - 1 ) * $count;

                $list = AdminModel::instance()->lists($start,$count);
                $total = AdminModel::instance()->num_rows();
                $this->_output_data['list'] = $list;

                //初始化分页
                $page_params = array(
                    'total_rows'   => $total , #(必须)
                    'method'       => 'html' , #(必须)
                    'parameter'    => '/admin/lists/?' ,  #(必须)
                    'now_page'     => $page ,  #(必须)
                    'list_rows'    => $count , #(可选) 默认为15
                    'use_tag_li'   => true ,
                    'li_classname' => 'active' ,
                    'query_string' => ''
                );

                $pagiation = new Page( $page_params );
                if ( $pagiation->getTotalPage() > 1 )
                    $this->_output_data['pagiation'] = $pagiation->show( 1 );

                $this->render('admin_lists.html');
            }

            function add(){
                  $id = $this->args[0];
                  if(!empty($id)){
                        $admin = AdminModel::instance()->readByID($id);
                        $this->_output_data['admin'] = $admin;
                  }
                 $this->render('admin_add.html');
            }

            function save(){
                    $post = $this->input->post();
                    $post['password'] = AdminUtil::instance()->covertPassword(md5($post['password']));
                    if(empty($post['id']))
                        unset($post['id']);

                    if(!$this->db->save($post,'dh_admin'))
                        Redirect::instance()->forward('/error/'.Error::DB_INSERT_ERROR);

                    Redirect::instance()->forward('/admin/lists');
            }

            function update(){
                $post = $this->input->post();
                $id = $post['id'];
                unset($post['id']);

                if(!$this->db->update($post,'dh_admin'," where id = $id" ))
                    Redirect::instance()->forward('/error/'.Error::DB_UPDATE_ERROR);

                Redirect::instance()->forward('/admin/lists');
            }

            function del(){
                $id = $this->args[0];
                if($id == 1)
                    Redirect::instance()->forward('/error/'.Error::ADMIN_FORBIDDEN);

                if(!AdminModel::instance()->del($id))
                    Redirect::instance()->forward('/error/'.Error::DB_DELETE_ERROR);

                Redirect::instance()->forward('/admin/lists');
            }
    }