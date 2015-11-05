<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/21
     * Time: 下午5:02
     */

    namespace exchangefactory;

    use api\libs\Error;
    use common\model\UserResourceLogModel;
    use core\DB;
    use gamefactory\GameFactory;
    use utils\Strings;
    use utils\Tools;
    use web\libs\DataUtil;
    use common\UserResource;
    use common\model\GameAreaModel;
    use common\model\StoreProductsModel;
    use common\model\UserModel;

    class RealExchange extends BaseExchange implements IExchange
    {

        private static $_instance = null;

        private $_name = null;

        private $_mobile = null;

        private $_address = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * 验证扶持帐号进行兑换功能
         * @param $user
         * @param $profile
         * @param $product
         * @param $area_id
         */
        protected function preventSupportAccount( $user ,$profile,$product,$area_id)
        {
                if($user['user_flag'] == 2){
                    $coupon = intval($profile['coupon']);
                    $diamond = intval($user['diamond']);
                    $needCoupon = intval($product['coupon']);

                    //查询添加扶持帐号时候给予的钻石数
                    $log = UserResourceLogModel::instance()->read($user['user_id'],UserResource::ACTION_ADD_FUCHI,1,0,$area_id);
                    $couponCanCost = $coupon+$diamond - intval($log['tool']);

                    if($couponCanCost < $needCoupon)
                        $this->response(null,Error::SUPPORTER_ACCOUNT_LIMIT);
                }
        }


        function doExchange( $platform , $product_id , $user_id , $area_id , $game_id  , $product_num = 1)
        {
            //验证必填信息
            $this->_name = $this->input->post( 'name' );
            $this->_mobile = $this->input->post( 'mobile' );
            $this->_address = $this->input->post( 'address' );
            if ( !Strings::is_mobile( $this->_mobile ) )
                $this->response( null , Error::FORM_STRING_FORMAT );
            if ( empty( $this->_name ) )
                $this->response( null , Error::FORM_STRING_FORMAT );
            if ( empty( $this->_address ) )
                $this->response( null , Error::FORM_STRING_FORMAT );

            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );

            $gameFunc = GameFactory::invoke( $game_id , $gameDB );
            $profile = $gameFunc->readProfile( $user_id );

            $product = StoreProductsModel::instance()->read( $product_id );
            $user = UserModel::instance()->getUserByUid( $user_id );
            $this->preventSupportAccount($user,$profile,$product,$area_id);
            //$product['price'] = UserUtil::instance()->vipResourceDiscount( $product['price'] , $profile['vip_level'] );
            $product['product_num'] = $product_num;
            $product['price'] = $product_num * $product['price'];
            $product['tool'] = $product_num * $product['tool'];
            $this->checkProductAndResource( $profile , $product , $user['diamond'] );
            $this->executeExchange($gameDB,$platform,$game_id,$area_id,$profile,$product,$gameFunc,$user,UserResource::ACTION_EXCHANGE);
        }


        function executeExchange(\Core\Db $gameDB , $platform , $game_id , $area_id , Array $profile , Array $product , IGameFactory $gameFunc , Array $user ,$action_type){
            try {
                $this->db->begin();
                $gameDB->begin();

                //更改用户资源
                $this->changeUserResource( $profile , $product , $gameFunc );

                $indexResultHandler = array(
                    'handler_type'  => 3 ,
                    'reporter_name' => $user['login_name'] ,
                    'result'        => 0 ,
                    'note'          => ''
                );

                $productOrder = array(
                    'product_id'   => $product['id'] ,
                    'game_id'      => $game_id ,
                    'area_id'      => $area_id ,
                    'user_id'      => $profile['user_id'] ,
                    'create_at'    => date( 'Y-m-d H:i:s' ) ,
                    'ip'           => Tools::getip() ,
                    'name'         => $this->_name ,
                    'address'      => $this->_address ,
                    'mobile'       => $this->_mobile ,
                    'product_name' => $product['name'] ,
                    'product_pic'  => $product['image'] ,
                    'cost_info'    => $product['price'] . $this->config->common['price_type'][ $product['price_type'] ] ,
                    'get_info'     => empty( $product['tool'] ) ? '/' : $product['tool'] . $this->config->common['tool_type'][ $product['tool_type'] ],
                    'product_num' => $product['product_num']
                );

                if(intval($product['price_type']) == 52){
                    //如果是1块钱充值卡
                    $sql = "SELECT  id FROM user_item_history WHERE item_type = 52 AND use_flag =  0 AND user_id = {$user['user_id']} ORDER BY  ins_time ASC limit 30";
                    $gameDB->execute($sql);
                    $cards = $gameDB->fetch_all();
                    if(count($cards) < intval($product['price']))
                        throw new \Exception(Error::NOT_ENOUGH_RESOURCE);

                    $card_ids = array();
                    foreach($cards as $card){
                        $card_ids[] = $card['id'];
                    }
                    unset($cards);
                    $card_ids = implode(',',$card_ids);
                    $sql = "UPDATE user_item_history SET use_flag = 1 WHERE id in ($card_ids)";
                    if(!$gameDB->execute($sql))
                        throw new \Exception(Error::DATA_WRITE_ERROR);
                }

                //处理商品记录
                $this->saveUserProductInfo( $indexResultHandler , $productOrder );
                $this->db->commit();
                $gameDB->commit();

                DataUtil::instance()->doAfterExchange( $platform , $product , $profile , $action_type, $area_id , $game_id );
                $this->response( null );

            } catch (\Exception $e) {
                $this->db->rollback();
                $gameDB->rollback();
                $this->response( null , $e->getMessage() );
            }
        }

    }