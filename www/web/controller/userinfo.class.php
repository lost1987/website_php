<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-9-18
     * Time: 下午3:09
     * 用户个人信息相关操作
     */

    namespace web\controller;

    use common\Platform;
    use core\Controller;
    use core\DB;
    use core\Redis;
    use gamefactory\GameFactory;
    use utils\Page;
    use utils\Strings;
    use web\libs\DataUtil;
    use web\libs\Error;
    use web\libs\UserUtil;
    use core\Cookie;
    use core\Configure;
    use web\model\ArticlesModel;
    use common\model\GameAreaModel;
    use common\model\ProductOrderModel;
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
            $game_id = 1;
            $area_id = 1;
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );
            $gameFunc = GameFactory::invoke( $game_id , $gameDB );
            $profile = $gameFunc->readProfile( $uid );
            if ( empty( $profile ) ) {
                $profile = $gameFunc->initProfile( $uid );
                DataUtil::instance()->doAfterRegister( Platform::CLIENT_ORIGIN_WEB , $uid , 1 , 1 );
            }
            unset( $profile['diamond'] );
            $user = array_merge( $user , $profile );
            unset( $profile , $server , $gameDB );
            $avatar_name = 'male';
            if ( $user['gender'] == 0 ) {//男
                $user['gender'] = '男';
                $user['avatar_path'] = STATIC_HOST . '/images/tx/male' . ( $user['avatar'] + 1 ) . '.jpg';
            } else {//女
                $user['gender'] = '女';
                $user['avatar_path'] = STATIC_HOST . '/images/tx/female' . ( $user['avatar'] + 1 ) . '.jpg';
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

            /*读取订单**/
            $orderlist = ProductOrderModel::instance()->read( $uid , $start , $count );
            //为了兼容老版本商城
            foreach ( $orderlist as &$item ) {
                $item['product_name'] = empty( $item['product_name'] ) ? $item['name'] : $item['product_name'];
            }
            $total = ProductOrderModel::instance()->read_num_rows( $uid );
            $orderstatus = Configure::instance()->common['order_status'];
            if ( is_array( $orderlist ) ) {
                foreach ( $orderlist as &$order ) {
                    $order['status'] = $orderstatus[ $order['result'] ];
                    $order['create_at'] = substr( $order['create_at'] , 0 , 10 );
                }
            }
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

            $area_id = 1;
            $game_id = 1;
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );
            $gameFunc = GameFactory::invoke( $game_id , $gameDB );
            $profile = $gameFunc->readProfile( $uid );

            $vipLv = $profile['vip_level'];
            if ( $vipLv == 0 && $avatar > 2 )
                $this->response( null , Error::ERROR_VIP_LEVEL_NOT_ENOUGH );

            $fields = array(
                'avatar' => $avatar
            );

            if ( !UserModel::instance()->updateUser( $fields , $uid ) )
                $this->response( null , Error::ERROR_DATA_WRITE );

            //为了和游戏同步 , 更新 redis
            $r = new Redis( $this->config->common['redis']['host'] , $this->config->common['redis']['port'] );
            $redis = $r->getResource();
            $redis->select( 0 );
            $redis->hSet( 'MjUserInfo:' . $uid , 'Avatar' , $avatar );
            $redis->close();

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

            $orderid = intval( $this->input->post( 'orderid' ) );
            $product = ProductOrderModel::instance()->readByOrderId( $orderid );
            $price_types = Configure::instance()->common['price_type'];
            $tool_types = Configure::instance()->common['tool_type'];
            $order_status = Configure::instance()->common['order_status'];
            $product['price_type'] = $price_types[ $product['price_type'] ];
            $product['tool_type'] = $tool_types[ $product['tool_type'] ];
            $product['status'] = $order_status[ $product['result'] ];
            $product['create_at'] = date( 'Y-m-d' , strtotime( $product['create_at'] ) );
            $product['mobile'] = empty( $product['mobile'] ) ? '/' : $product['mobile'];
            $uid = Cookie::instance()->userdata( 'uid' );

            $gmsDB = new DB();
            $gmsDB->init_db_from_config( 'gms' );
            $sql = "SELECT express_no,express_name FROM gms_real_product_log WHERE user_id = ? AND product_id = ? AND handler_id  = ?";
            $gmsDB->execute( $sql , array( $uid , $product['product_id'] , $product['handler_id'] ) );
            $log = $gmsDB->fetch();
            if ( $log ) {
                $product['express'] = $log['express_name'] . ':' . $log['express_no'];
            }
            $gmsDB->close();

            $this->response( $product );
        }
    }