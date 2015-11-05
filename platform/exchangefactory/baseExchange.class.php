<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/29
     * Time: 下午4:39
     */

    namespace exchangefactory;


    use common\Account;
    use common\base\BaseProducts;
    use common\base\BaseServers;
    use common\Error;
    use common\Event;
    use common\EventDispatcher;
    use common\ItemsManager;
    use common\model\StoreOrders;
    use common\model\UserModel;
    use common\Profile;
    use common\Response;
    use core\DB;
    use core\Singleton;
    use utils\Tools;

    /**
     * 兑换基类
     * Class BaseExchange
     * @package exchangefactory
     */
    class BaseExchange extends Singleton
    {

        /**
         * 玩家账号数据
         * @var  Array
         */
        protected $_user = null;

        /**
         * 商品数据
         * @var Array
         */
        protected $_product = null;

        /**
         * 游戏专属用户数据
         * @var Array
         */
        protected  $_profile = null;

        /**
         * 动态游戏数据库实例
         * @var \core\DB
         */
        protected $_gameDB = null;

        /**
         * 商品数量
         * @var int
         */
        protected  $_product_num = 1;

        /**
         * 初始化类属性
         * @param $product_id 商品ID
         * @param $user_id  用户ID
         * @throws \Exception
         */
        protected function init($product_id,$user_id){
                $this->_product = BaseProducts::instance()->read($product_id);
                $server_id = $this->_product['server_id'];
                $server = BaseServers::instance()->read($server_id);
                $this->_gameDB = new DB();
                $this->_gameDB->init_db($server);
                $this->_profile = Profile::instance()->setUserId($user_id)->setGameDB($this->_gameDB)->read(array('items','items_num'));
                $this->_user = UserModel::instance()->getUserByUid($user_id,array('user_id','diamond','items','items_num'));
        }

        /**
         * 阻止扶持帐号进行兑换功能
         * @param array $user
         */
        protected  function preventSupportAccount(){
            if($this->_user['user_flag'] == 2)
                Response::instance()->say(Error::SUPPORTER_ACCOUNT_FORBIDDEN);
        }

        /**
         * 扣除及增加用户物品
         */
        protected function costUserItems(){
                $cost_item_id = intval($this->_product['item_cost_type']);
                $get_item_id = intval($this->_product['item_get_type']);
                $cost_item_num = intval($this->_product['item_cost_num']);
                $get_item_num =  intval($this->_product['item_get_num']);
                $additional_num = intval($this->_product['item_additional_num']);

                //TODO 判断VIP折扣信息
                if($this->_product['vip_discount']){

                }

                if($this->isGloabalItem($cost_item_id)){//扣除类型为全局
                        //读取全局物品数据
                        if($cost_item_id == 3){//扣钻石
                                $this->_user['diamond'] = intval($this->_user['diamond']) - $cost_item_num*$this->_product_num;
                                if($this->_user['diamond'] < 0)
                                    throw new \Exception(Error::NOT_ENOUGH_DIAMOND);
                                $fields = array('diamond' => $this->_user['diamond']);
                                if(!UserModel::instance()->updateUser($fields,$this->_user['user_id']))
                                        throw new \Exception(Error::DB_UPDATE_ERROR);
                        }else{//扣除其他全局道具
                                $user_items = $this->_user['items'];
                                $user_items_num = $this->_user['items_num'];
                                if(!ItemsManager::instance()->checkItems( $cost_item_id , $cost_item_num*$this->_product_num , $user_items , $user_items_num ))
                                        throw new \Exception(Error::NOT_ENOUGH_ITEM);
                                ItemsManager::instance()->costItems( $cost_item_id , $cost_item_num*$this->_product_num , $user_items , $user_items_num );
                                $fields = array(
                                    'items' => $user_items,
                                    'items_num' => $user_items_num
                                );
                                if(!UserModel::instance()->updateUser($fields,$this->_user['user_id']))
                                    throw new \Exception(Error::DB_UPDATE_ERROR);
                        }
                }else{
                            $user_profile_items = $this->_profile['items'];
                            $user_profile_items_num = $this->_profile['items_num'];
                            if(!ItemsManager::instance()->checkItems($cost_item_id,$cost_item_num*$this->_product_num,$user_profile_items,$user_profile_items_num))
                                throw new \Exception(Error::NOT_ENOUGH_ITEM);
                            ItemsManager::instance()->costItems( $cost_item_id , $cost_item_num*$this->_product_num , $user_profile_items , $user_profile_items_num );
                            $fields = array(
                                'items' => $user_profile_items,
                                'items_num' => $user_profile_items_num
                            );
                            if(!Profile::instance()->update($fields))
                                throw new \Exception(Error::DB_UPDATE_ERROR);
                }


                if($this->isGloabalItem($get_item_id)){//获取类型为全局
                        if($get_item_id == 3){//加钻石
                            $this->_user['diamond'] = intval($this->_user['diamond']) + ($get_item_num + $additional_num)*$this->_product_num;
                            $fields = array('diamond' => $this->_user['diamond']);
                            if(!UserModel::instance()->updateUser($fields,$this->_user['user_id']))
                                throw new \Exception(Error::DB_UPDATE_ERROR);
                        }else{//加其他全局道具
                            $user_items = $this->_user['items'];
                            $user_items_num = $this->_user['items_num'];
                            ItemsManager::instance()->addItems( $get_item_id , ($get_item_num + $additional_num)*$this->_product_num , $user_items , $user_items_num );
                            $fields = array(
                                'items' => $user_items,
                                'items_num' => $user_items_num
                            );
                            if(!UserModel::instance()->updateUser($fields,$this->_user['user_id']))
                                throw new \Exception(Error::DB_UPDATE_ERROR);
                        }
                }else{
                    $user_profile_items = $this->_profile['items'];
                    $user_profile_items_num = $this->_profile['items_num'];
                    ItemsManager::instance()->addItems( $get_item_id , ($get_item_num + $additional_num)*$this->_product_num, $user_profile_items , $user_profile_items_num );
                    $fields = array(
                        'items' => $user_profile_items,
                        'items_num' => $user_profile_items_num
                    );
                    if(!Profile::instance()->update($fields))
                        throw new \Exception(Error::DB_UPDATE_ERROR);
                }
        }

        /**
         * 保存订单
         * @throws \Exception
         */
        protected  function saveStoreOrder(){
            for($i = 0 ; $i < $this->_product_num ; $i++) {
                $fields = array(
                    'order_no'    => uniqid( mt_rand() ) ,
                    'server_id'   => $this->_product['server_id'] ,
                    'product_id'  => $this->_product['id'] ,
                    'create_time' => time() ,
                    'user_id'     => $this->_user['user_id'] ,
                    'state'       => 1
                );
                if ( !StoreOrders::instance()->save( $fields ) )
                    throw new \Exception( Error::DB_UPDATE_ERROR );
            }
        }

        /**
         * 主方法  执行兑换流程
         * @param     int $platform 渠道ID
         * @param     int $product_id   商品ID
         * @param     int  $user_id          用户ID
         * @param    int $product_num 商品数量
         */
        public function doExchange($platform , $product_id , $user_id , $product_num = 1){
                $this->init($product_id,$user_id);
                $this->_product_num = $product_num;
                try{
                    $this->_gameDB->begin();
                    $this->db->begin();

                    $this->costUserItems();
                    $this->saveStoreOrder();

                    $this->_gameDB->commit();
                    $this->db->commit();

                    $data['platform_id'] = $platform;
                    $data['user_id'] = $user_id;
                    $data['product'] = $this->_product;
                    @EventDispatcher::instance()->dispatch(Event::DO_AFTER_EXCHANGE,$data);
                    Account::instance()->setUserId($user_id)->flush();
                    Response::instance()->success();
                }catch (\Exception $e){
                    $this->_gameDB->rollback();
                    $this->db->rollback();
                    Response::instance()->say($e->getMessage());
                }
        }


        /**
         * 验证是否是全局物品
         * @param $item_id
         * @return bool
         */
        final protected function isGloabalItem($item_id){
                    $item_id = intval($item_id);
                    if(  ($item_id >= 10000 && $item_id < 20000)  || $item_id == 3)
                        return true;
                    return false;
        }
    }