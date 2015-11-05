<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/23
     * Time: 上午9:59
     */

    namespace exchangefactory;


    use api\libs\Error;
    use api\core\Baseapi;
    use common\model\UserModel;
    use common\ResourceManager;
    use gamefactory\IGameFactory;
    use utils\Tools;
    use web\libs\DataUtil;
    use web\model\IndexHandleResultModel;
    use common\model\ProductOrderModel;

    /**
     * 兑换基类
     */
    class BaseExchange extends Baseapi
    {

        /**
         * 阻止扶持帐号进行兑换功能
         * @param $user
         */
        protected  function preventSupportAccount($user){
                if($user['user_flag'] == 2)
                    $this->response(null,Error::SUPPORTER_ACCOUNT_FORBIDDEN);
        }

        /**
         * 检查商品是否存在以及验证用户资源
         * @param $profile     用户资源信息
         * @param $product_id  商品ID
         * @param $diamond     用户拥有的钻石
         * @return bool
         */
        protected function checkProductAndResource( $profile , $product , $diamond )
        {
            if ( false == $product )
                $this->response( null , Error::NO_SUCH_PRODUCT );

            //得到价格的资源字段值 例如 coins,ticket等
            if ( $product['price_type'] == 1 ) {
                if ( intval( $product['price'] ) > $diamond )
                    $this->response( null , Error::NOT_ENOUGH_RESOURCE );
            } else {
                if ( empty( $profile['items'] ) || empty( $profile['items_num'] ) )
                    $this->response( null , Error::NOT_ENOUGH_RESOURCE );
                if ( !ResourceManager::instance()->checkResource( $this->config->common['game_resource_changetypes'][ $product['price_type'] ] , $product['price'] , $profile['items'] , $profile['items_num'] ) )
                    $this->response( null , Error::NOT_ENOUGH_RESOURCE );
            }
        }

        /**
         * 扣除和增加用户的资源
         * @param $profile
         * @param $product
         * @throws \Exception
         */
        protected function changeUserResource( $profile , $product , IGameFactory $gameFunc )
        {
            $sourceCollection = $profile['items'];
            $sourceNumCollection = $profile['items_num'];

            if ( intval( $product['additional_num'] ) > 0 )
                $product['tool'] += $product['additional_num'];

            if($product['tool_type'] == 1){
                $user = UserModel::instance()->getUserByUid( $profile['user_id'] );
                $fields = array(
                    'diamond' => intval( $user['diamond'] ) + intval( $product['tool'] )
                );
                if ( !UserModel::instance()->updateUser( $fields , $profile['user_id'] ) )
                    throw new \Exception( Error::DATA_WRITE_ERROR );
            }else{
                ResourceManager::instance()->addResource( $this->config->common['game_resource_changetypes'][ $product['tool_type'] ] , $product['tool'] , $sourceCollection , $sourceNumCollection );
            }

            if ( $product['price_type'] == 1 ) {
                $user = UserModel::instance()->getUserByUid( $profile['user_id'] );
                $fields = array(
                    'diamond' => intval( $user['diamond'] ) - intval( $product['price'] )
                );
                if ( !UserModel::instance()->updateUser( $fields , $profile['user_id'] ) )
                    throw new \Exception( Error::DATA_WRITE_ERROR );
            } else {
                ResourceManager::instance()->reduceResource( $this->config->common['game_resource_changetypes'][ $product['price_type'] ] , $product['price'] , $sourceCollection , $sourceNumCollection );
            }

            $fields = array(
                'items'     => $sourceCollection ,
                'items_num' => $sourceNumCollection
            );

            if ( !$gameFunc->updateProfile( $profile['user_id'] , $fields ) )
                throw new \Exception( Error::DATA_WRITE_ERROR );
        }

        /**
         * 执行购买/兑换
         * @param \Core\Db     $gameDB
         * @param  int         $platform
         * @param  int        $game_id
         * @param  int         $area_id
         * @param array        $profile
         * @param array        $product
         * @param IGameFactory $gameFunc
         * @param array        $user
         * @param int $action_type
         */
        protected function executeExchange( \Core\Db $gameDB , $platform , $game_id , $area_id , Array $profile , Array $product , IGameFactory $gameFunc , Array $user ,$action_type )
        {
            try {
                $this->db->begin();
                $gameDB->begin();

                //更改用户资源
                $this->changeUserResource( $profile , $product , $gameFunc );

                $indexResultHandler = array(
                    'handler_type'  => 3 ,
                    'reporter_name' => $user['login_name'] ,
                    'result'        => 4 ,
                    'note'          => ''
                );

                $productOrder = array(
                    'product_id'   => $product['id'] ,
                    'game_id'      => $game_id ,
                    'area_id'      => $area_id ,
                    'user_id'      => $profile['user_id'] ,
                    'create_at'    => date( 'Y-m-d H:i:s' ) ,
                    'ip'           => Tools::getip() ,
                    'name'         => '' ,
                    'address'      => '' ,
                    'mobile'       => 0 ,
                    'product_name' => $product['name'] ,
                    'product_pic'  => $product['image'] ,
                    'cost_info'    => $product['price'] . $this->config->common['price_type'][ $product['price_type'] ] ,
                    'get_info'     => empty( $product['tool'] ) ? '/' : $product['tool'] . $this->config->common['tool_type'][ $product['tool_type'] ],
                    'product_num' => $product['product_num']
                );

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

        /**
         * 处理用户兑换商品的记录
         * @param $indexResultHandler
         * @param $productOrder
         * @throws \Exception
         */
        protected function saveUserProductInfo( $indexResultHandler , $productOrder )
        {
            $handleResultModel = IndexHandleResultModel::instance();
            if ( !$handleResultModel->save( $indexResultHandler ) )
                throw new \Exception( Error::DATA_WRITE_ERROR );

            $handler_id = $this->db->insert_id();
            $productOrder['handler_id'] = $handler_id;
            $productOrderModel = ProductOrderModel::instance();

            if ( !$productOrderModel->save( $productOrder ) )
                throw new \Exception( Error::DATA_WRITE_ERROR );
        }
    }