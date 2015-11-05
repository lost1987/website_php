<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/15
     * Time: 下午4:15
     */

    namespace exchangefactory;
    use api\libs\Error;
    use common\model\GameAreaModel;
    use common\model\StoreProductsModel;
    use common\model\UserModel;
    use core\DB;
    use gamefactory\GameFactory;
    use common\UserResource;
    use web\libs\UserUtil;

    /**
     * 唯一物品兑换
     * Class UniqueExchange
     * @package exchangefactory
     */
    class UniqueExchange extends BaseExchange implements IExchange
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * 检查是否已经拥有了该物品
         * @param int $tool_type 将获得的物品id
         * @param string $items    该用户拥有的物品
         */
        private function checkHasGotOne($tool_type,$items,$product_num)
        {
            $items = explode(',',$items);
            if(in_array(strval($tool_type),$items))
                $this->response(null,Error::EXCHANGE_UNIQUE_ERROR);

            if($product_num > 1)
                $this->response(null,Error::EXCHANGE_UNIQUE_ERROR);
        }

        /**
         * @param int $platform   平台渠道
         * @param int $product_id 商品ID
         * @param int $user_id    用户ID
         * @param int $area_id    区域(游戏服务器)ID
         * @param int $game_id    游戏ID
         * @return mixed
         */
        function doExchange( $platform , $product_id , $user_id , $area_id , $game_id  , $product_num = 1)
        {
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );

            $gameFunc = GameFactory::invoke( $game_id , $gameDB );
            $profile = $gameFunc->readProfile( $user_id );

            $product = StoreProductsModel::instance()->read( $product_id );
            //验证物品的唯一性
            $this->checkHasGotOne($product['tool_type'],$profile['items'],$product_num);
            $user = UserModel::instance()->getUserByUid( $user_id );
            $this->preventSupportAccount($user);
            $product['price'] = UserUtil::instance()->vipResourceDiscount( $product['price'] , $profile['vip_level'] );
            $product['product_num'] = $product_num;
            $this->checkProductAndResource( $profile , $product , $user['diamond'] );
            $this->executeExchange($gameDB,$platform,$game_id,$area_id,$profile,$product,$gameFunc,$user,UserResource::ACTION_EXCHANGE);
        }

    }