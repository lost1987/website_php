<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-9-16
     * Time: 下午3:52
     */

    namespace web\controller;

    use common\base\BaseProducts;
    use common\base\BaseStoreCategory;
    use common\Platform;
    use core\Controller;
    use core\Cookie;
    use core\DB;
    use core\Encoder;
    use core\Redirect;
    use exchangefactory\FactoryExchange;
    use gamefactory\GameFactory;
    use utils\Page;
    use web\libs\DataUtil;
    use web\libs\Error;
    use web\libs\UserUtil;
    use web\model\ArticlesModel;
    use common\model\PurchaseProfileModel;
    use common\model\StoreCategoryModel;
    use common\model\StoreProductsModel;
    use common\model\UserModel;

    /**
     * 道具商城
     * Class Store
     * @package web\controller
     */
    class Store extends Controller
    {

        function __construct()
        {
            exit;
            parent::__construct();
            $this->scModel = BaseStoreCategory::instance();
            $this->spModel = BaseProducts::instance();
        }

        function index()
        {
            $this->category();
        }

        /**
         * 根据栏目来获取商品列表
         */
        function category()
        {
            $pagecount = 9;
            $category_id = intval( $this->args[0] );
            $page = empty( $this->args[1] ) ? 1 : $this->args[1];
            $start = ( $page - 1 ) * $pagecount;

            //用户是否登录
            $is_login = UserUtil::instance()->isLogin();
            //用户是否设置交易密码 默认未设置
            $is_set_purchase = 0;
            if ( $is_login ) {
                $uid = Cookie::instance()->userdata( 'uid' );
                $is_set_purchase = UserModel::instance()->is_set_purchase( $uid );
                $user = UserModel::instance()->getUserByUid( $uid );
            }

            //读取道具分类
            $categories = $this->scModel->lists();
            array_unshift( $categories , array( 'id' => 0 , 'name' => '全部' ) );

            //读取分类的道具列表
            $products = $this->spModel->lists( $start , $pagecount , $category_id );
            $products_total = $this->spModel->num_rows( $category_id );
            $price_types = $this->config->common['price_type'];

            $images = array();
            $vipLevel = 1;
            foreach ( $products as &$p ) {
                $p['price'] = UserUtil::instance()->vipResourceDiscount( $p['price'] , $vipLevel );
                $p['price_type_name'] = $price_types[ $p['price_type'] ];
                $p['price_name'] = $p['price'];
                $p['price_type_column'] = $this->config->common['price_type_columns'][ $p['price_type'] ];
                $p['user_resource'] = $user[ $this->config->common['price_type_columns'][ $p['price_type'] ] ];
                $images[] = array(
                    'name'  => $p['name'] ,
                    'image' => $p['image']
                );
            }
            $this->output_data['images'] = Encoder::instance()->encode( $images );

            //数据输出合并
            $output_data = array(
                'categories'      => $categories ,
                'products'        => $products ,
                'is_set_purchase' => $is_set_purchase == true ? 1 : 0 ,
                'token'           => Cookie::instance()->get_csrf_cookie() ,
                'coupon'          => empty( $coupon ) ? 0 : $coupon ,
                'ticket'          => empty( $ticket ) ? 0 : $ticket ,
                'diamond'         => empty( $diamond ) ? 0 : $diamond ,
                'coins'           => empty( $coins ) ? 0 : $coins ,
                'category_id'     => $category_id
            );

            $this->output_data = array_merge( $this->output_data , $output_data );

            //分页代码初始化
            $page_params = array(
                'total_rows'   => $products_total , #(必须)
                'method'       => 'html' , #(必须)
                'parameter'    => '/store/category/' . $category_id . '/?' ,  #(必须)
                'now_page'     => $page ,  #(必须)
                'list_rows'    => $pagecount , #(可选) 默认为15
                'li_classname' => 'active' ,
                'use_tag_li'   => true
            );
            $pagination = new Page( $page_params );
            if ( $pagination->getTotalPage() > 1 )
                $this->output_data['pagiation'] = $pagination->show( 1 );

            $this->output_data['faq'] = ArticlesModel::instance()->listsByCategory( 0 , 10 , 3 );
            $this->tpl->display( 'store.html' , $this->output_data );
        }

        function product()
        {
            UserUtil::instance()->checkLogin( '/error/index/' . Error::ERROR_NO_LOGIN );
            $product_id = intval( $this->args[0] );
            $category_id = intval( $this->args[1] );

            $uid = Cookie::instance()->userdata( 'uid' );

            //读取道具分类
            $categories = $this->scModel->lists();
            array_unshift( $categories , array( 'id' => 0 , 'name' => '全部' ) );

            $product = StoreProductsModel::instance()->read( $product_id );
            $price_types = $this->config->common['price_type'];
            $product['price'] = UserUtil::instance()->vipResourceDiscount( $product['price'] , $vipLevel );
            $product['price_type_name'] = $price_types[ $product['price_type'] ];
            $product['price_name'] = $product['price'] . $product['price_type_name'];
            $product['price_type_column'] = $this->config->common['price_type_columns'][ $product['price_type'] ];
            Cookie::instance()->set_userdata( 'store_referer' , $_SERVER['HTTP_REFERER'] );
            $this->output_data['product'] = $product;
            $this->output_data['categories'] = $categories;
            $this->output_data['category_id'] = $category_id;
            $this->output_data['token'] = Cookie::instance()->get_csrf_cookie();
            $this->output_data['faq'] = ArticlesModel::instance()->listsByCategory( 0 , 10 , 3 );
            if ( $product['product_type'] == 0 )//实物
                $this->tpl->display( 'store_product_real.html' , $this->output_data );
            else if ( $product['product_type'] == 2 || $product['product_type'] == 3 )//道具
                $this->tpl->display( 'store_product_item.html' , $this->output_data );
        }

        function done()
        {
            UserUtil::instance()->checkLogin( '/error/index/' . Error::ERROR_NO_LOGIN );
            $product_id = intval( $this->args[0] );
            $category_id = intval( $this->args[1] );

            //读取道具分类
            $categories = $this->scModel->lists();
            array_unshift( $categories , array( 'id' => 0 , 'name' => '全部' ) );

            $product = StoreProductsModel::instance()->read( $product_id );
            $this->output_data['product'] = $product;
            $this->output_data['categories'] = $categories;
            $this->output_data['category_id'] = $category_id;
            $this->output_data['referer'] = Cookie::instance()->userdata( 'store_referer' );
            $this->output_data['faq'] = ArticlesModel::instance()->listsByCategory( 0 , 10 , 3 );
            $this->tpl->display( 'store_product_result.html' , $this->output_data );
        }

        /**
         * 兑换 付钱
         * error: 0 正常  , 1 用户未登录 ,2 消费密码错误,3数据更新错误,4 对应资源不足
         */
        function purchase()
        {
            UserUtil::instance()->checkLogin();

            //验证token
            $this->csrf_token_validation( false );

            //验证password
            $password = $this->input->post( 'password' );
            $uid = Cookie::instance()->userdata( 'uid' );
            $user = UserModel::instance()->getUserByUid( $uid );
            $purchaseProfile = PurchaseProfileModel::instance()->read( $uid );
            if ( !UserUtil::instance()->is_purchase_password_valid( $password , $purchaseProfile['purchase_password'] , $user['user_number'] ) ) {
                $this->response( null , Error::ERROR_PURCHASE_PWD );
            }

            $product_id = $this->args[0];
            $product = $this->spModel->read( $product_id );

            switch ($product['product_type']) {
                case 0://实物
                    $class = 'RealExchange';
                    break;
                case 1://充值卡
                    $class = 'CardExchange';
                    break;
                case 2://道具 资源消耗类
                    $class = 'MonetaryExchange';
                    break;
                case 3://vip卡
                    $class = 'VipCardExchange';
                    break;
                default:
                    Redirect::instance()->forward( '/error/index/' . Error::ERROR_COMMON );
            }

            FactoryExchange::invoke($class)->doExchange(Platform::CLIENT_ORIGIN_WEB,$product,$uid);
        }
    }