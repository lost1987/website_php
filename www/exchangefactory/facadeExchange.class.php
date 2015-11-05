<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/12
     * Time: 下午4:25
     */

    namespace exchangefactory;
    use common\model\GameAreaModel;
    use common\model\StoreProductsModel;
    use common\model\UserModel;
    use common\model\UserResourceLogModel;
    use core\DB;
    use core\Encoder;
    use gamefactory\GameFactory;
    use gamefactory\IGameFactory;
    use api\libs\Error;
    use common\Error as C_Error;
    use utils\Tools;
    use web\libs\DataUtil;
    use web\libs\Sms;
    use common\UserResource;

    /**
     * 门面兑换 网点兑换
     * Class FacadeExchange
     * @package exchangefactory
     */
    class FacadeExchange extends BaseExchange implements IExchange
    {

        private static $_instance = null;

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

                $log = UserResourceLogModel::instance()->read($user['user_id'],UserResource::ACTION_ADD_FUCHI,1,0,$area_id);
                $couponCanCost = $coupon+$diamond - intval($log['tool']);

                if($couponCanCost < $needCoupon)
                    $this->response(null,Error::SUPPORTER_ACCOUNT_LIMIT);
            }
        }

        /**
         * @param int $platform   平台渠道
         * @param int $product_id 商品ID
         * @param int $user_id    用户ID
         * @param int $area_id    区域(游戏服务器)ID
         * @param int $game_id    游戏ID
         * @return mixed
         */
        function doExchange( $platform , $product_id , $user_id , $area_id , $game_id , $product_num = 1)
        {
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );

            $gameFunc = GameFactory::invoke( $game_id , $gameDB );
            $profile = $gameFunc->readProfile( $user_id );

            $product = StoreProductsModel::instance()->read( $product_id );
            $user = UserModel::instance()->getUserByUid( $user_id );
            $this->preventSupportAccount($user,$profile,$product,$area_id);
            if(empty($user['mobile']))
                $this->response(null,C_Error::ACCOUNT_UNAUTH_MOBILE_ERROR);
            $product['product_num'] = $product_num;
            $product['price'] = $product_num * $product['price'];
            $product['tool'] = $product_num * $product['tool'];
            $this->checkProductAndResource( $profile , $product , $user['diamond'] );
            $this->executeExchange($gameDB,$platform,$game_id,$area_id,$profile,$product,$gameFunc,$user,UserResource::ACTION_EXCHANGE);
        }

        /**
         * 执行购买/兑换
         * @param \Core\Db     $gameDB
         * @param  int         $platform
         * @param  int         $game_id
         * @param  int         $area_id
         * @param array        $profile
         * @param array        $product
         * @param IGameFactory $gameFunc
         * @param array        $user
         * @param int          $action_type
         */
        protected function executeExchange( \Core\Db $gameDB , $platform , $game_id , $area_id , Array $profile , Array $product , IGameFactory $gameFunc , Array $user , $action_type )
        {
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

                $exCode = $this->fetch_excode($product['name']);

                $productOrder = array(
                    'product_id'   => $product['id'] ,
                    'game_id'      => $game_id ,
                    'area_id'      => $area_id ,
                    'user_id'      => $profile['user_id'] ,
                    'create_at'    => date( 'Y-m-d H:i:s' ) ,
                    'ip'           => Tools::getip() ,
                    'name'         => '' ,
                    'address'      => '' ,
                    'mobile'       =>  $user['mobile'],
                    'product_name' => $product['name'] ,
                    'product_pic'  => $product['image'] ,
                    'cost_info'    => $product['price'] . $this->config->common['price_type'][ $product['price_type'] ] ,
                    'get_info'     => empty( $product['tool'] ) ? '/' : $product['tool'] . $this->config->common['tool_type'][ $product['tool_type'] ],
                    'excode' => $exCode,
                    'product_num' => $product['product_num']
                );

                //TODO 消息格式
                $message = "您已在新蜂武汉麻将成功兑换雪域阳光代金券，兑换码为：{$exCode} ,您可以登陆http://dh.xy777.net/  进行领取";
                //发送user_message 给用户
                $userMessage = array(
                        'receiver_uid' => $user['user_id'],
                        'has_read' => 0,
                        'msg_type'=>9,
                        'sender' => 'system',
                        'msg_jsoned_params' => Encoder::instance()->encode(array(
                                    'title' => '兑换奖励',
                                    'content' => $message
                        )),
                        'msg_time' => date('YmdHi')
                );
                if(!$gameDB->save($userMessage,'user_messages'))
                        throw new \Exception(Error::DATA_WRITE_ERROR);

                //处理商品记录
                $this->saveUserProductInfo( $indexResultHandler , $productOrder );
                $this->db->commit();
                $gameDB->commit();

                DataUtil::instance()->doAfterExchange( $platform , $product , $profile , $action_type, $area_id , $game_id );
                $this->response( array('mobile'=>$user['mobile'],'excode'=>$exCode,'name'=>$product['name']),false);

                //TODO 发送短信 添加短信模板
                $mobile = $user['mobile'];
                if(!Sms::instance()->sendGet($message,$mobile))
                    $this->response(null,C_Error::SMS_SEND_FAILED);

            } catch (\Exception $e) {
                $this->db->rollback();
                $gameDB->rollback();
                $this->response( null , $e->getMessage() );
            }
        }

        /**
         * 取得一条兑换码并更改兑换码的状态
         * @param $product_name
         * @return mixed
         * @throws \Exception
         */
        private function fetch_excode($product_name){
                $pkey = 'newbeesoft';
                $time = time();

                $post = array(
                    'product_name' => $product_name,
                    'time' => $time,
                    'sign' => md5($time.$pkey)
                );
                $c = curl_init();
                curl_setopt($c , CURLOPT_URL,DH_HOST.'/ex/provider');
                curl_setopt($c,CURLOPT_POST,1);
                curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($c,CURLOPT_CONNECTTIMEOUT_MS,1200);
                curl_setopt($c,CURLOPT_POSTFIELDS,http_build_query($post));
                $result = curl_exec($c);
                $result = json_decode($result,true);

                if(intval($result['error']) != 0)
                    throw new \Exception(Error::NOT_ENOUGH_EXCODE);

                return $result['data']['excode'];
        }

    }