<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/21
     * Time: 下午5:01
     */

    namespace exchangefactory;

    use api\libs\Error;
    use core\DB;
    use gamefactory\GameFactory;
    use utils\Tools;
    use web\libs\DataUtil;
    use common\UserResource;
    use web\libs\UserUtil;
    use common\model\GameAreaModel;
    use common\model\StoreProductsModel;
    use common\model\UserModel;

    /**
     * 兑换货币类商品类
     * Class MonetaryExchange
     * @package api\libs\exchange
     */
    class MonetaryExchange extends BaseExchange implements IExchange
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * 阻止扶持帐号进行兑换功能
         * @param $user
         * @param $product
         */
        protected function preventSupportAccount( $user ,$product)
        {
                    if($user['user_flag'] == 2){
                            if($product['tool_type'] != 1  ||  $product['price_type'] != 3)
                                $this->response(null,Error::SUPPORTER_ACCOUNT_FORBIDDEN);
                    }
        }


        function doExchange( $platform , $product_id , $user_id , $area_id , $game_id  , $product_num = 1)
        {
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );

            $gameFunc = GameFactory::invoke( $game_id , $gameDB );
            $profile = $gameFunc->readProfile( $user_id );

            $product = StoreProductsModel::instance()->read( $product_id );
            $user = UserModel::instance()->getUserByUid( $user_id );
            $this->preventSupportAccount($user,$product);
            if($product['tool_type'] != 1 && $product['vip_discount'])//获取类型不为钻石就打折
                    $product['price'] = UserUtil::instance()->vipResourceDiscount( $product['price'] , $profile['vip_level'] );
            $product['product_num'] = $product_num;
            $product['price'] = $product_num * $product['price'];
            $product['tool'] = $product_num * $product['tool'];
            $this->checkProductAndResource( $profile , $product , $user['diamond'] );
            $this->executeExchange($gameDB,$platform,$game_id,$area_id,$profile,$product,$gameFunc,$user,UserResource::ACTION_EXCHANGE);
        }
    }