<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-9-18
     * Time: 下午3:09
     * 用户个人信息相关操作
     */

    namespace web\controller;

    use common\Account;
    use common\base\BaseItems;
    use common\base\BaseProducts;
    use common\ItemsManager;
    use common\model\StoreOrders;
    use common\Response;
    use common\StatusManager;
    use core\Controller;
    use core\DB;
    use core\Redis;
    use utils\Page;
    use utils\Strings;
    use web\libs\Error;
    use web\libs\UserUtil;
    use core\Cookie;
    use core\Configure;
    use web\model\ArticlesModel;
    use common\model\PurchaseProfileModel;
    use common\model\UserModel;

    /**
     * 用户信息
     * Class Userinfo
     * @package web\controller
     */
    class Userinfo extends Controller
    {
        /**
         * 用户详细页
         */
        function index()
        {
            UserUtil::instance()->checkLogin( '/error/index/' . Error::ERROR_NO_LOGIN );

            $uid = Cookie::instance()->userdata( 'uid' );
            $areas = Configure::instance()->common['areas'];
            $user = UserModel::instance()->getUserByUid( $uid );
            $items = ItemsManager::instance()->format($user['items'],$user['items_num']);
            $user['chip'] = $items['chip'];
            unset($items);

            $avatar_name = 'male';
            if ( $user['gender'] == 0 ) {//男
                $user['gender'] = '男';
                $user['avatar_path'] = CDN_PLATFORM_HOST . '/avatar/male/normal' .$user['avatar'] . '.png';
            } else {//女
                $user['gender'] = '女';
                $user['avatar_path'] = CDN_PLATFORM_HOST . '/avatar/female/normal' . $user['avatar'] . '.png';
                $avatar_name = 'female';
            }
            $user['area_name'] = $areas[ $user['area'] ];
            $user['mobile'] = Strings::entry_phone( $user['mobile'] );
            $vip_level = Cookie::instance()->userdata( 'vip_level' );
            if ( $vip_level > 0 )
                $this->output_data['vip'] = 1;

            $this->output_data['user'] = $user;
            $this->output_data['areas'] = $areas;
            $this->output_data['avatar_name'] = $avatar_name;
            $this->output_data['userAuth'] = UserUtil::instance()->get_auth( $uid );

            /*读取purchaseprofile 数据***/
            $purchase = PurchaseProfileModel::instance()->read( $uid );
            $this->output_data['is_set_purchase'] = empty( $purchase['purchase_password'] ) ? 0 : 1;
            $this->output_data['csrf_token'] = Cookie::instance()->get_csrf_cookie();

            $this->output_data['userInfoActive'] = 'active';
            $this->output_data['faq'] = ArticlesModel::instance()->listsByCategory( 0 , 10 , 3 );
            $this->tpl->display( 'user_info.html' , $this->output_data );
        }


        function myOrders()
        {
            UserUtil::instance()->checkLogin( '/error/index/' . Error::ERROR_NO_LOGIN );
            $uid = Cookie::instance()->userdata( 'uid' );

            $page = empty( $this->args[0] ) ? 1 : $this->args[0];
            $count = 10;
            $start = ( $page - 1 ) * $count;

            $params = array('user_id' => $uid);
            /*读取订单**/
            $orderlist = StoreOrders::instance()->setCondition($params)->lists($start,$count);
            //读取所有商品
            $products = BaseProducts::instance()->lists();
            //为了兼容老版本商城
            foreach ( $orderlist as &$item ) {
                $item['product_name'] = $products[$item['product_id']]['product_name'];
                $item['state'] = StatusManager::instance()->output($item['state']);
                $item['create_time'] = date('Y-m-d H:i:s',$item['create_time']);
            }
            $total = StoreOrders::instance()->setCondition($params)->numRows();

            //处理分页
            $params = array(
                'total_rows'   => $total , #(必须)
                'method'       => 'html' , #(必须)
                'parameter'    => '/userinfo/myOrders/?' ,  #(必须)
                'now_page'     => $page ,  #(必须)
                'list_rows'    => $count , #(可选) 默认为15
                'use_tag_li'   => true ,
                'li_classname' => 'active'
            );
            $pagiation = new Page( $params );
            if ( $pagiation->getTotalPage() > 1 )
                $this->output_data['pagiation'] = $pagiation->show( 1 );

            $this->output_data['orderlist'] = $orderlist;
            $this->output_data['userOrderActive'] = 'active';
            $this->tpl->display( 'user_order.html' , $this->output_data );
        }

        function updateAvatar()
        {
            UserUtil::instance()->checkLogin();

            $uid = Cookie::instance()->userdata( 'uid' );
            $avatar = intval( $this->input->post( 'avatar' ) );

            $fields = array(
                'avatar' => $avatar
            );

            if ( !UserModel::instance()->updateUser( $fields , $uid ) )
                $this->response( null , Error::ERROR_DATA_WRITE );

            //为了和游戏同步 , 更新 redis
            Account::instance()->setUserId($uid)->flush();
            $this->response();
        }


        function updateArea()
        {
            UserUtil::instance()->checkLogin();

            $area = intval( $this->input->post( 'area' ) );
            $uid = Cookie::instance()->userdata( 'uid' );
            if ( !UserModel::instance()->updateUser( array( 'area' => $area ) , $uid ) )
                $this->response( null , Error::ERROR_DATA_WRITE );
            $this->response( $this->config->common['areas'][ $area ] );
        }

        function updatePassword()
        {
            /*
                * 0 修改成功
                * 1  旧密码错误
                * 3 登录信息过期
                * 4 网络错误
                */
            UserUtil::instance()->checkLogin();

            $old_pass = $this->input->post( 'old_pass' );
            $new_pass = $this->input->post( 'new_pass' );

            $uid = Cookie::instance()->userdata( 'uid' );
            $userModel = UserModel::instance();
            $user = $userModel->getUserByUid( $uid );

            if ( strlen( $old_pass ) != 32 || strlen( $new_pass ) != 32 )
                $this->response( null , Error::ERROR_STRING_FORMAT );

            if ( !UserUtil::instance()->is_password_valid( $old_pass , $user['password'] , $user['user_number'] ) )
                $this->response( null , Error::ERROR_LOGIN_PWD );

            $new_pass = UserUtil::instance()->makePassword( $new_pass , $user['user_number'] );

            if ( !$userModel->updateUser( array( 'password' => $new_pass ) , $uid ) )
                $this->response( null , Error::ERROR_DATA_WRITE );

            $this->response();
        }


        function updatePurchase()
        {
            /*
                        * 0 修改成功
                        * 1  旧密码错误
                        * 3 登录信息过期
                        * 4 网络错误
                        */
            UserUtil::instance()->checkLogin();

            $old_pass = $this->input->post( 'old_pass' );
            $new_pass = $this->input->post( 'new_pass' );

            $uid = Cookie::instance()->userdata( 'uid' );
            $userModel = UserModel::instance();
            $user = $userModel->getUserByUid( $uid );
            $purchaseModel = PurchaseProfileModel::instance();
            $purchase = $purchaseModel->read( $uid );

            if ( !UserUtil::instance()->is_purchase_password_valid( $old_pass , $purchase['purchase_password'] , $user['user_number'] ) )
                $this->response( null , Error::ERROR_PURCHASE_PWD );

            $new_pass = UserUtil::instance()->makePassword( $new_pass , $user['user_number'] );

            if ( !$purchaseModel->updateProfile( array( 'purchase_password' => $new_pass ) , $uid ) ) {
                $this->response( null , Error::ERROR_DATA_WRITE );
            }
            $this->response();
        }

        function setPurchase()
        {
            /*
                        * 0 修改成功
                        * 1  旧密码错误
                        * 3 登录信息过期
                        * 4 网络错误
                        */
            UserUtil::instance()->checkLogin();

            $new_pass = $this->input->post( 'new_pass' );

            $uid = Cookie::instance()->userdata( 'uid' );
            $userModel = UserModel::instance();
            $user = $userModel->getUserByUid( $uid );

            $new_pass = UserUtil::instance()->makePassword( $new_pass , $user['user_number'] );

            $model = PurchaseProfileModel::instance();
            $purchase_profile = $model->read( $uid );

            if ( false == $purchase_profile ) {//写入
                $fields = array(
                    'user_id'           => $uid ,
                    'purchase_password' => $new_pass ,
                    'confirmation_key'  => ''
                );
                if ( !PurchaseProfileModel::instance()->saveProfile( $fields ) )
                    $this->response( null , Error::ERROR_DATA_WRITE );

            } else {//更新
                $fields = array(
                    'purchase_password' => $new_pass
                );
                if ( !PurchaseProfileModel::instance()->updateProfile( $fields , $uid ) )
                    $this->response( null , Error::ERROR_DATA_WRITE );
            }

            $this->response();
        }

        /**
         * 用户订单详情
         */
        function showProductDetail()
        {
            UserUtil::instance()->checkLogin();

            $id = intval( $this->input->post( 'orderid' ) );
            $order = StoreOrders::instance()->readByID($id);
            $products = BaseProducts::instance()->lists();
            $product = $products[$order['product_id']];
            $items = BaseItems::instance()->lists();
            $item_get_type_name = $items[$product['item_get_type']]['item_name'];
            $item_cost_type_name = $items[$product['item_cost_type']]['item_name'];
            $product['cost_info'] = $product['item_cost_num'].$item_cost_type_name;
            $product['get_info'] = $product['item_get_num'].$item_get_type_name;
            unset(
                $product['visible'],
                $product['item_get_type'],
                $product['item_cost_type'],
                $product['squeue'],
                $product['vip_discount'],
                $product['product_type'],
                $product['create_time'],
                $order['user_id']
            );
            $order['state'] = StatusManager::instance()->output($order['state']);
            $order['create_time'] = date('Y-m-d H:i:s',$order['create_time']);
            $response = array_merge($order,$product);
            Response::instance()->success($response);
        }
    }