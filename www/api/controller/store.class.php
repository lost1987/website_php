<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/20
     * Time: 上午9:50
     * 商城相关
     */

    namespace api\controller;


    use api\libs\Error;
    use api\core\Baseapi;
    use common\model\GameAreaModel;
    use common\model\StoreCategoryModel;
    use common\Platform;
    use core\DB;
    use exchangefactory\FactoryExchange;
    use gamefactory\GameFactory;
    use utils\Arrays;
    use web\libs\UserUtil;
    use common\model\PurchaseProfileModel;

    /**
     * 商品,资源兑换类
     * Class Store
     * @package api\controller
     */
    class Store extends Baseapi
    {
        /**
         * 根据栏目读取商品
         */
        function lists()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $uid = $session['uid'];
            $area_id = $session['area_id'];
            $game_id = $session['game_id'];
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );
            $gameFunc = GameFactory::invoke( $game_id , $gameDB );
            $profile = $gameFunc->readProfile( $uid );

            $vipLv = $profile['vip_level'];
            $category_id = $this->input->post( 'category_id' );

            $sql = " SELECT id,image,is_promote,name,vip_discount,price,price_type,tool_type,top_timestamp,is_top,product_type,additional_num FROM xf_store_products WHERE is_visible=1 AND area_id = $area_id AND game_id = $game_id AND category_id = $category_id ORDER BY modify_at DESC";
            $this->db->execute( $sql );
            $products = $this->db->fetch_all();
            if ( false == $products )
                $this->response( 0 );

            foreach ( $products as &$product ) {
                $product['price_type_display'] = $this->config->common['price_type'][ $product['price_type'] ];
                $product['is_promote'] = $product['is_promote'] ? true : false;
                $product['is_top'] = $product['is_top'] ? true : false;
                $product['top_timestamp'] = empty( $product['top_timestamp'] ) ? 0 : $product['top_timestamp'];
                $product['source_price'] = $product['price'];
                if($product['product_type'] != 0 && $product['vip_discount'])
                        $product['price'] = UserUtil::instance()->vipResourceDiscount( $product['price'] , $vipLv );
                unset( $product['price_type'] );

                if($product['tool_type'] == 1)
                            $product['tool_type'] =  3;
            }

            $products = Arrays::std_multi_array_format( $products );

            $output = array(
                'objects' => $products
            );

            $this->response( $output );
        }

        /**
         * 兑换
         */
        function exchange()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $uid = $session['uid'];
            $area_id = $session['area_id'];
            $game_id = $session['game_id'];
            $user_number = $session['user_number'];
            $purchase_password = $this->input->post( 'purchase_password' );
            $num = intval($this->input->post('num')) > 0  ? $this->input->post('num') : 1;
            //验证消费密码
            $gprofile = PurchaseProfileModel::instance()->read( $uid );
            if ( empty( $gprofile['purchase_password'] ) )
                $this->response( null , Error::PASSWORD_UNSET );

            $password = UserUtil::instance()->makePassword( $purchase_password , $user_number );
            if ( $password != $gprofile['purchase_password'] )
                $this->response( null , Error::PASSWORD_INVALID );

            //兑换类型
            $type = $this->args[0];
            if ( empty( $type ) )
                $this->response( null , Error::EXCHANGE_TYPE_ERROR );

            $class = ucfirst( $type ) . 'Exchange';
            $product_id = $this->input->post( 'product_id' );
            FactoryExchange::invoke( $class )->doExchange( Platform::CLIENT_ORIGIN_MOBILE , $product_id , $uid , $area_id , $game_id ,$num);
        }

        /**
         * 兑换不需要支付密码
         */
        function exchangeNP(){
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $uid = $session['uid'];
            $area_id = $session['area_id'];
            $game_id = $session['game_id'];
            $num = intval($this->input->post('num')) > 0  ? $this->input->post('num') : 1;

            //兑换类型
            $type = $this->args[0];
            if ( empty( $type ) || $type == 'real' )
                $this->response( null , Error::EXCHANGE_TYPE_ERROR );

            $class = ucfirst( $type ) . 'Exchange';
            $product_id = $this->input->post( 'product_id' );
            FactoryExchange::invoke( $class )->doExchange( Platform::CLIENT_ORIGIN_MOBILE , $product_id , $uid , $area_id , $game_id ,$num);
        }


        /**
         * 读取商品所有栏目(除开实物)
         */
        function category()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $list = StoreCategoryModel::instance()->lists();
            foreach($list as &$item){
                $item['unit_price_type'] = $this->config->common['game_resource_changetypes'][$item['unit_price_type']];
            }
            $this->response( Arrays::std_multi_array_format( $list ) );
        }

        /**
         * 读取所有vip卡商品
         */
        function vipCards(){
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $sql = "SELECT id,price,price_type,tool_type FROM xf_store_products WHERE category_id = 8 AND is_visible = 1";
            $this->db->execute($sql);
            $list = $this->db->fetch_all();
            $list = Arrays::std_multi_array_format($list);
            $this->response($list);
        }

        /**
         * 牌桌上点开展现的商品
         */
        function tableGoods()
        {
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( !$session )
                $this->response( null , Error::USER_NOT_LOGIN );

            $sql = "SELECT id,price,price_type,tool_type FROM xf_store_products WHERE category_id = 22 AND is_visible = 1";
            $this->db->execute($sql);
            $list = $this->db->fetch_all();
            $list = Arrays::std_multi_array_format($list);
            $this->response($list);
        }

        /**
         * 读取所有实物
         */
        function phyGoods(){
            $session = $this->check_session($this->input->post('sessionid'));
            if(!$session)
                $this->response(null, Error::USER_NOT_LOGIN);

            $sql = "SELECT id,category_id,price,price_type,tool_type,image,name,product_type,additional_num  FROM xf_store_products WHERE category_id in (3,23) AND is_visible = 1 ORDER BY modify_at DESC";
            $this->db->execute($sql);
            $list = $this->db->fetch_all();
            $list = Arrays::std_multi_array_format($list);
            $this->response($list);
        }

    }