<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/12/29
     * Time: 上午9:32
     */

    namespace api\controller;


    use api\libs\Error;
    use api\core\Baseapi;
    use core\DB;
    use core\Encoder;
    use gamefactory\GameFactory;
    use utils\Arrays;
    use utils\Curl;
    use web\libs\DataUtil;
    use common\Platform;
    use web\libs\UserUtil;
    use common\model\GameAreaModel;
    use common\model\PaymentOrder;
    use common\model\UserModel;
    use common\model\PurchaseProfileModel;

    class Anysdk extends Baseapi
    {

        function __construct()
        {
            parent::__construct();
            $this->pKey = $this->config->api['anySdk']['pKey'];
            $this->loginUrl = $this->config->api['anySdk']['loginCheckUrl'];
        }

        /**
         * @param $anySdkParams
         * @param $data
         * @param $error
         * @throws \Exception
         */
        private function anyResponse( $anySdkParams , $data , $error = 0 )
        {
            $anySdkParams['ext'] = array(
                'error' => intval( $error ) ,
                'data'  => $data
            );

            die( Encoder::instance()->encode( $anySdkParams ) );
        }

        /**
         * anysdk 登录接口
         * 返回示例
         * {"status":"ok","data":{"id":"1359699538","name":"360U1359699538","avatar":"http:\/\/quc.qhimg.com\/dm\/48_48_100\/t00df551a583a87f4e9.jpg?f=91cd0cfe10d13ec2c874c827faf9a107","sex":"\u672a\u77e5","area":"","nick":""},"common":{"channel":"000023","user_sdk":"360","uid":"1359699538","server_id":"1"},"ext":""}
         */
        function login()
        {
            $c = new Curl();
            $c->setOpt( CURLOPT_RETURNTRANSFER , 1 );
            $anySdk = $c->post( $this->loginUrl , $this->input->post() );

            if ( empty( $anySdk ) )
                $this->anyResponse( $anySdk , null , Error::ANYSDK_RESPONSE_FAILED );
            $anySdk = Arrays::objectToArray( $anySdk );

            if ( strcmp( $this->pKey , $_POST['private_key'] ) != 0 )
                $this->anyResponse( $anySdk , null , Error::ANYSDK_PKEY_INVALID );

            if ( $anySdk['status'] != 'ok' )
                $this->anyResponse( $anySdk , null , Error::ANYSDK_LOGIN_FAILED );

            //Tools::debug_array_log($anySdk['common']);
            //Tools::debug_array_log($anySdk['ext']);
            $login_name = $anySdk['common']['user_sdk'] . 'U' . $anySdk['common']['uid'];
            $forbidden = 0;
            $regist_time = date( 'YmdHis' );
            $is_robot = 0;

            $userModel = UserModel::instance();
            $user = $userModel->getUserByLoginName( $login_name );
            $platform = Platform::instance()->getPlatformFromAnySdk( $anySdk['common']['user_sdk'] );
            $game_id = empty( $anySdk['ext']['game_id'] ) ? 1 : $anySdk['ext']['game_id'];
            $area_id = empty( $anySdk['ext']['area_id'] ) ? 1 : $anySdk['ext']['area_id'];
            if ( $user ) {
                DataUtil::instance()->doAfterLogin( $platform , $user , $game_id );

                $expire_time = $this->config->common['cookie']['timeout'];
                $session_key = UserUtil::instance()->createSessionId( $expire_time , $user , $area_id , $game_id );
                $response = array(
                    'session_name' => 'sessionid' ,
                    'session_key'  => $session_key ,
                    'user_number'  => $user['user_number'] ,
                    'uid'          => $user['user_id'] ,
                    'resource_uri' => '/user/info'
                );
                $response = Arrays::std_array_format( $response );
                $this->anyResponse( $anySdk , $response );

            } else {
                $nick_name = UserUtil::instance()->randomName();
                while ( 1 ) {
                    if ( !UserModel::instance()->isNickNameExsit( $nick_name ) )
                        break;
                    $nick_name = UserUtil::instance()->randomName();
                }

                $user_number = $userModel->getMaxUserNumber() + 1;
                $source_password = UserUtil::instance()->makeSourcePasswordByLoginName( $login_name , 8 );
                $password = UserUtil::instance()->makePasswordAuto( $source_password , $user_number );

                /*users**/
                $fields1 = array(
                    'login_name'    => $login_name ,
                    'nickname'      => $nick_name ,
                    'password'      => UserUtil::instance()->makePassword( $password , $user_number ) ,
                    'user_number'   => $user_number ,
                    'regist_time'   => $regist_time ,
                    'area'          => 1 ,
                    'avatar'        => 0 ,
                    'gender'        => 0 ,
                    'is_robot'      => $is_robot ,
                    'forbidden'     => $forbidden ,
                    'register_type' => $platform ,
                );

                $server = GameAreaModel::instance()->read( $area_id );
                $gameDb = new DB();
                $gameDb->init_db( $server );
                $gameFunc = GameFactory::invoke( $game_id , $gameDb );

                try {
                    $this->db->begin();
                    $gameDb->begin();
                    /*写入user**/
                    if ( !$userModel->saveUser( $fields1 ) )
                        throw new \Exception( Error::DATA_WRITE_ERROR );
                    $uid = $this->db->insert_id();

                    $fields2 = array(
                        'user_id'           => $uid ,
                        'purchase_password' => '' ,
                        'confirmation_key'  => ''
                    );

                    if ( !PurchaseProfileModel::instance()->saveProfile( $fields2 ) )
                        throw new \Exception ( Error::DATA_WRITE_ERROR );

                    $gameFunc->initProfile( $uid );

                    $this->db->commit();
                    $gameDb->commit();
                } catch (\Exception $e) {
                    $this->db->rollback();
                    $gameDb->rollback();
                    $this->anyResponse( $anySdk , null , $e->getMessage() );
                }

                DataUtil::instance()->doAfterRegister( $platform , $uid , $game_id, $area_id );

                $expire_time = $this->config->common['cookie']['timeout'];
                $user = array( 'login_name' => $login_name , 'user_number' => $user_number , 'user_id' => $uid );
                $session_key = UserUtil::instance()->createSessionId( $expire_time , $user , $area_id , $game_id );

                $response = array(
                    'session_name' => 'sessionid' ,
                    'session_key'  => $session_key ,
                    'user_number'  => $user_number ,
                    'uid'          => $user['user_id'] ,
                    'resource_uri' => '/user/info' ,
                    'password'     => $source_password
                );
                $response = Arrays::std_array_format( $response );
                $this->anyResponse( $anySdk , $response );
            }
        }


        function payback()
        {
            $params = $this->input->post();
            $sign = $params['sign'];
            foreach ( $params as $k => $v ) {
                if ( $v == '' )
                    unset( $params[ $k ] );
            }
            //sign 不参与签名
            unset( $params['sign'] );
            //数组按key升序排序
            ksort( $params );
            //将数组中的值不加任何分隔符合并成字符串
            $string = implode( '' , $params );
            //做一次md5并转换成小写，末尾追加游戏的privateKey，最后再次做md5并转换成小写
            $mysign = strtolower( md5( strtolower( md5( $string ) ) . $this->pKey ) );

            if ( $mysign != $sign ) {
                error_log( 'anySdk pay back sign error' );
                die( 'ok' );
            }

            $serial_number = empty($params['order_id']) ? '' : $params['order_id'];

            list( $order_id , $area_id , $game_id ) = explode( '|' , $params['private_data'] );
            if ( empty( $game_id ) ) $game_id = 1;
            if ( empty( $area_id ) ) $area_id = 1;
            if ( empty( $order_id ) ) {
                error_log( 'anySdk order_id is null' );
                die( 'ok' );
            }

            $order = PaymentOrder::instance()->getByOrderNo( $order_id );
            if ( false == $order ) {
                error_log( 'anySdk order_id is not exist' );
                die( 'ok' );
            }

            if ( intval( $params['pay_status'] ) == 1 ) {

                $server = GameAreaModel::instance()->read( $area_id );
                $gameDB = new DB();
                $gameDB->init_db( $server );
                $gameFunc = GameFactory::invoke( $game_id , $gameDB );

                //查询该订单信息
                try {

                    $amount = $this->input->post( 'amount' );

                    $this->db->begin();
                    $gameDB->begin();

                    if ( intval( $order['status'] ) > 0 ) {
                        die( 'ok' );
                        //'订单已完成,非法请求';
                    }

                    if ( intval( $order['money'] ) != intval( $amount ) )
                        throw new \Exception( 'anySdk 充值金额与订单金额不符' );

                    //给用户增加资源
                    $gameFunc->payCallBack( $order );

                    //修改订单状态
                    $fields = array(
                        'pay_at' => date( 'Y-m-d H:i:s' ) ,
                        'status' => 1,
                        'serial_number' => $serial_number
                    );
                    if ( !PaymentOrder::instance()->updateByOrderNo( $fields , $order_id ) )
                        throw new \Exception( '订单状态修改失败' );

                    $this->db->commit();
                    $gameDB->commit();
                    echo 'ok';
                    //=============银行通知结束=============
                    $recharge_type = Platform::instance()->getRechargeType( $order_id );
                    DataUtil::instance()->doAfterRecharge( $order , $recharge_type , $area_id , $game_id );
                } catch (\Exception $e) {
                    error_log( $e->getMessage() );
                    $this->db->rollback();
                    $gameDB->rollback();
                    die( 'failed' );
                }
            } else {
                error_log( 'anySdk pay failed' );
                die( 'ok' );
            }
        }


    }