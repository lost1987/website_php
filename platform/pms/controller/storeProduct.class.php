<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/11
     * Time: 上午11:10
     */

    namespace pms\controller;


    use common\base\BaseItems;
    use common\base\BaseProducts;
    use pms\core\AdminController;
    use core\Cookie;
    use core\Encoder;
    use core\Permission;
    use core\Redirect;
    use pms\libs\AdminUtil;
    use pms\libs\Error;
    use pms\libs\ModuleDictionary;
    use pms\model\StoreCategory_M;
    use pms\model\StoreProducts_M;
    use utils\Arrays;
    use utils\Page;
    use utils\Upload;

    /**
     * 商品管理
     * Class StoreProduct
     * @package pms\controller
     */
    class StoreProduct extends AdminController
    {

        function product_info()
        {
            $id = $this->args[0];
            $handler_id = $this->args[1];
            $server = AdminUtil::instance()->selected_server();
            $sid = $server['area_id'];
            $product = StoreProducts_M::instance()->read( $id );
            $product['price_name'] = $this->config->common['price_type'][ $product['price_type'] ];
            $product['tool_name'] = $this->config->common['tool_type'][ $product['tool_type'] ];
            $product = Arrays::std_array_format( $product );
            switch ($product['product_type']) {
                case 0://实物
                    $info = RealProductLog_M::instance()->getLogByHandlerId( $handler_id , $sid );
                    if ( false != $info )
                        $product['info'] = Arrays::std_array_format( $info );
                    break;
                case 1://充值卡
                    $info = MobileProductLog_M::instance()->getLogByHandlerId( $handler_id , $sid );
                    if ( false != $info )
                        $product['info'] = Arrays::std_array_format( $info );
                    break;
            }
            $this->response( $product );
        }

        function lists()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_STORE_PRODUCTS_LIST );
            $page = empty( $this->args[1] ) ? 1 : $this->args[1];
            $count = 7;
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
            $list = StoreProducts_M::instance()->set_condition( $search_params )->lists( $start , $count );
            $total = StoreProducts_M::instance()->set_condition( $search_params )->num_rows();
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
                        if ( $p['module_id'] == ModuleDictionary::ROOT_MODULE_STORE ) {
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
                'parameter'    => '/storeProduct/lists/' . ModuleDictionary::ROOT_MODULE_STORE . '/?' ,  #(必须)
                'now_page'     => $page ,  #(必须)
                'list_rows'    => $count , #(可选) 默认为15
                'use_tag_li'   => true ,
                'li_classname' => 'active' ,
                'query_string' => $query_string
            );

            $pagiation = new Page( $page_params );
            if ( $pagiation->getTotalPage() > 1 )
                $this->output_data['pagiation'] = $pagiation->show( 1 );

            //商品类型
            $this->output_data['product_types'] = $this->config->pms['product_type'];
            $this->output_data['categories'] = StoreCategory_M::instance()->lists();

            $categories = StoreCategory_M::instance()->lists();
            foreach ( $list as &$item ) {
                $item['product_type_name'] = $this->config->pms['product_type'][ $item['product_type'] ];
                $item['category_name'] = $categories[ $item['category_id'] ]['name'];
                $item['is_visible'] = empty( $item['is_visible'] ) ? '否' : '是';
            }

            $this->output_data['list'] = $list;
            $this->output_data['total'] = $total;
            $this->render( 'store_products_list.html' );
        }


        function add()
        {
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_STORE_PRODUCTS_ADD );
            $this->output_data['success'] = $this->args[1] == 'success' ? 1 : 0;
            $this->init_navigator();
            $this->output_data['action'] = '/storeProduct/save';
            $this->output_data['action_name'] = '添加';
            $this->output_data['token'] = Cookie::instance()->get_csrf_cookie();
            $this->output_data['categories'] = StoreCategory_M::instance()->lists();
            $this->output_data['product_types'] = $this->config->pms['product_type'];

            //商品的获取和扣除类型
            $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
            $this->output_data['items'] = BaseItems::instance()->read($server['id']);

            if ( $this->args[1] == 'edit' ) {
                $id = $this->args[2];
                $this->output_data['item'] = StoreProducts_M::instance()->read( $id );
                $this->output_data['action'] = '/storeProduct/update/' . $id;
                $this->output_data['action_name'] = '编辑';
            }

            $this->render( 'store_products_add.html' );
        }

        function save()
        {
            $this->csrf_token_validation();
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_STORE_PRODUCTS_ADD );
            $post = $this->input->post();
            $upload = Upload::instance();
            $upload->set_allowed_ext( $this->config->pms['upload']['image_allowed_ext'] );
            $upload->set_max_size( $this->config->pms['upload']['image_product_max_size'] );
            $upload->set_upload_folder( $this->config->pms['upload']['image_folder'] );
            $image = $upload->upload( $_FILES['product_image'] );
            $url = $image['url'];
            unset( $image );
            $post['product_image'] = $url;
            $post['create_time'] = time();

            $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
            $post['server_id'] = $server['id'];

            if ( !StoreProducts_M::instance()->save( $post ) )
                $this->set_error( Error::DATA_WRITE );

            BaseProducts::instance()->clear();
            Redirect::instance()->forward( '/storeProduct/add/' . ModuleDictionary::ROOT_MODULE_STORE . '/success' );
        }

        function update()
        {
            $this->csrf_token_validation();
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_STORE_PRODUCTS_ADD );
            $post = $this->input->post();
            $id = $this->args[0];
            if ( !empty( $_FILES['image']['name'] ) ) {
                $upload = Upload::instance();
                $upload->set_allowed_ext( $this->config->pms['upload']['image_allowed_ext'] );
                $upload->set_max_size( $this->config->pms['upload']['image_product_max_size'] );
                $upload->set_upload_folder( $this->config->pms['upload']['image_folder'] );
                $image = $upload->upload( $_FILES['product_image'] );
                $url = $image['url'];
                unset( $image );
                $post['product_image'] = $url;

                $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
                $post['server_id'] = $server['id'];

                //删除旧图片
                $product = StoreProducts_M::instance()->read( $id );
                if ( file_exists( BASE_PATH . '/' . BASE_PROJECT . $product['product_image'] ) )
                    @unlink( BASE_PATH . '/' . BASE_PROJECT . $product['product_image'] );
                unset( $product );
            } else {
                unset( $post['product_image'] );
            }

            if ( !StoreProducts_M::instance()->update( $post , $id ) )
                $this->set_error( Error::DATA_WRITE );

            BaseProducts::instance()->clear();
            Redirect::instance()->forward( '/storeProduct/lists/' . ModuleDictionary::ROOT_MODULE_STORE_PRODUCTS );
        }

        function del()
        {
            $id = $this->args[1];
            $product = StoreProducts_M::instance()->read( $id );
            if ( false == $product )
                $this->set_error( Error::DATA_DELETE );

            if ( file_exists( BASE_PATH . '/' . BASE_PROJECT . $product['image'] ) )
                @unlink( BASE_PATH . '/' . BASE_PROJECT . $product['image'] );
            unset( $product );

            if ( !StoreProducts_M::instance()->del( $id ) )
                $this->set_error( Error::DATA_DELETE );

            BaseProducts::instance()->clear();
            Redirect::instance()->forward( '/storeProduct/lists/' . ModuleDictionary::ROOT_MODULE_STORE );
        }

    }