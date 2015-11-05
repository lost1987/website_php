<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-10-15
     * Time: 上午9:18
     * 充值回调接口
     */
    namespace api\controller;

    use api\core\BaseApi;
    use common\Account;
    use common\Event;
    use common\EventDispatcher;
    use common\model\UserModel;
    use common\Response;
    use core\Encoder;
    use libs\payment\AlipayNotify;
    use utils\Curl;
    use common\model\PaymentOrder;
    use libs\payment\PayAliPay;
    use libs\payment\PayChinaBank;
    use utils\Tools;
    use common\model\AppStoreRecordModel;
    use common\Error as CommonError;

    /**
     * 处理充值加钱接口,和移动端充值订单号
     * Class Payment
     * @package api\controller
     */
    class Payment extends BaseApi
    {

        const RECHARGE_TYPE_ALIPAY = 1;
        const RECHARGE_TYPE_CHINABANK = 2;
        const RECHARGE_TYPE_APPSTORE = 3;

        /***
         * 网银在线 通知回调接口
         */
        function chinabank()
        {
            $cb = new PayChinaBank();
            $key = $cb->_key;
            unset( $cb );
            $v_oid = trim( $_POST['v_oid'] );//订单号
            $v_pmode = trim( $_POST['v_pmode'] );//支付银行
            $v_pstatus = trim( $_POST['v_pstatus'] );//支付状态20表示成功 30表示失败
            $v_pstring = trim( $_POST['v_pstring'] );//支付完成
            $v_amount = trim( $_POST['v_amount'] ); //订单实际支付金额
            $v_moneytype = trim( $_POST['v_moneytype'] ); //订单实际支付币种
            $v_md5str = trim( $_POST['v_md5str'] );
            $remark1 = trim( $_POST['remark1'] );

            $md5string = strtoupper( md5( $v_oid . $v_pstatus . $v_amount . $v_moneytype . $key ) );
            if ( $v_md5str == $md5string ) {
                if ( $v_pstatus == "20" ) {//支付成功 开始走业务流程
                    //查询该订单信息
                    try {
                        $this->db->begin();

                        $myorder = PaymentOrder::instance()->getByOrderNo( $v_oid );
                        $user_id = $myorder['user_id'];
                        if ( !$myorder )
                            throw new \Exception( '订单号不存在' );

                        if ( intval( $myorder['status'] ) > 0 ) {
                            die( 'ok' );
                            //'订单已完成,非法请求';
                        }

//                        if ( $myorder['money'] != $v_amount )
//                            throw new \Exception( '充值金额与订单金额不符' );

                        //给用户增加资源
                        $user = UserModel::instance()->getUserByUid($user_id,array('diamond'));
                       $fields = array(
                           'diamond' => intval($user['diamond']) + $myorder['diamond']
                       );
                        if(!$this->db->update($fields,'xf_user',' WHERE user_id = '.$user_id))
                            throw new \Exception('给用户增加资源失败!');

                        //修改订单状态
                        $fields = array(
                            'pay_at' => date( 'Y-m-d H:i:s' ) ,
                            'status' => 1
                        );

                        if ( !PaymentOrder::instance()->updateByOrderNo( $fields , $v_oid ) )
                            throw new \Exception( '订单状态修改失败' );

                        $this->db->commit();
                        echo 'ok';
                        //=============银行通知结束=============
                        Account::instance()->setUserId($user_id)->flush();
                        //TODO  给资源统计推送变化
                        $data = array(
                            'recharge_type' => self::RECHARGE_TYPE_CHINABANK,
                            'order_no' => $v_oid,
                            'user_id' => $user_id
                        );
                        @EventDispatcher::instance()->dispatch(Event::DO_AFTER_RECHARGE,$data);
                    } catch (\Exception $e) {
                        Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , $e->getMessage() );
                        $this->db->rollback();
                        die( 'error' );
                    }
                }
            } else {
                Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , '签名验证失败' );
                die( 'error' );
            }
        }

        /**
         * 支付宝 通知回调接口
         */
        function alipay()
        {

            error_log('alipy notify!');
            $alipay = new PayAliPay();
            $config['partner'] = $alipay->_mid;
            $config['key'] = $alipay->_key;
            $config['sign_type'] = $this->input->post( 'sign_type' );
            $config['input_charset'] = 'utf-8';
            $config['cacert'] = BASE_PATH . '\libs\payment\cacert.pem';
            $config['transport'] = 'http';
            $notify = new AlipayNotify( $config );

            $verify_result = $notify->verifyNotify();
            if ( $verify_result ) {
                //查询该订单信息
                $out_trade_no = $this->input->post( 'out_trade_no' );

                $trade_no = $this->input->post( 'trade_no' );

                $trade_status = $this->input->post( 'trade_status' );

                $amount = $this->input->post( 'total_fee' );

                $extra_common_param = $this->input->post( 'extra_common_param' );

                try {
                    $this->db->begin();

                    if ( $trade_status != 'TRADE_FINISHED' && $trade_status != 'TRADE_SUCCESS' )
                        throw new \Exception( '交易失败' );

                    $myorder = PaymentOrder::instance()->getByOrderNo( $out_trade_no );
                    $user_id = $myorder['user_id'];
                    if ( !$myorder )
                        throw new \Exception( '订单号不存在' );

                    if ( intval( $myorder['status'] ) > 0 ) {
                        die( 'success' );
                        //'订单已完成,非法请求';
                    }

//                    if ( $myorder['money'] != $amount )
//                        throw new \Exception( '充值金额与订单金额不符' );

                    //给用户增加资源
                    $user = UserModel::instance()->getUserByUid($user_id,array('diamond'));
                    $fields = array(
                        'diamond' => intval($user['diamond']) + $myorder['diamond']
                    );
                    if(!$this->db->update($fields,'xf_user',' WHERE user_id = '.$user_id))
                        throw new \Exception('给用户增加资源失败!');

                    //修改订单状态
                    $fields = array(
                        'pay_at' => date( 'Y-m-d H:i:s' ) ,
                        'status' => 1
                    );
                    if ( !PaymentOrder::instance()->updateByOrderNo( $fields , $out_trade_no ) )
                        throw new \Exception( '订单状态修改失败' );

                    $this->db->commit();
                    echo 'success';
                    //=============银行通知结束=============
                    //TODO  给资源统计推送变化
                    Account::instance()->setUserId($user_id)->flush();
                    $data = array(
                        'recharge_type' => self::RECHARGE_TYPE_CHINABANK,
                        'order_no' => $out_trade_no,
                        'user_id' => $user_id
                    );
                    @EventDispatcher::instance()->dispatch(Event::DO_AFTER_RECHARGE,$data);

                } catch (\Exception $e) {
                    Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , $e->getMessage() );
                    $this->db->rollback();
                    die( 'fail' );
                }
            } else {
                Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , 'SIGN验证失败' );
                die( 'fail' );
            }
        }

        /**
         * 苹果商店 验证 并加钱
         */
        function appstore()
        {
            $session = $this->checkSession($this->input->post( 'sessionid' ) );
            if ( false == $session )
                Response::instance()->say(CommonError::LOGIN_NEEDED);

            $post = $this->input->post();
            switch (intval( $post['t'] )) {
                case - 1://测试
                    $verify_url = 'https://sandbox.itunes.apple.com/verifyReceipt';
                    break;
                case 1://正式
                    $verify_url = 'https://buy.itunes.apple.com/verifyReceipt';
                    break;
                default:
                    $verify_url = 'https://buy.itunes.apple.com/verifyReceipt';
            }
            $curl = new Curl();
            $curl->setOpt( CURLOPT_RETURNTRANSFER , 1 );
            $curl->setOpt( CURLOPT_SSL_VERIFYHOST , false );
            $curl->setOpt( CURLOPT_SSL_VERIFYPEER , false );
            $order_id = $post['order_id'];
            $responseData = array( 'order_id' => $order_id );
            unset( $post['t'] , $post['order_id'] );
            $appstoreRecord = substr( md5( $post['receipt-data'] ) , 0 , 16 );
            $result = $curl->post( $verify_url , Encoder::instance()->encode( $post ) );
            $result = Encoder::instance()->decode( $result );

            if ( strcmp( $result['receipt']['bid'] , 'com.16youxi.NewbeeHall' ) !== 0 )
                Response::instance()->say(CommonError::APPSTORE_VERIFY_FAILED,$responseData);

            if ( intval( $result['status'] ) !== 0 )
                Response::instance()->say(CommonError::APPSTORE_VERIFY_FAILED,$responseData);


            //开始充值流程
            $order = PaymentOrder::instance()->getByOrderNo( $order_id );
            $user_id = $order['user_id'];
            if ( !$order )
                Response::instance()->say(CommonError::PAYMENT_ORDER_NOT_EXSIT,$responseData);

            if ( $order['status'] == 1 )
                Response::instance()->say(CommonError::PAYMENT_ORDER_DONE,$responseData);

            if ( AppStoreRecordModel::instance()->recordExsit( $appstoreRecord ) )
                Response::instance()->say(CommonError::PAYMENT_ORDER_INVALID,$responseData);

            try {
                $this->db->begin();

                //给用户增加资源
                $user = UserModel::instance()->getUserByUid($user_id,array('diamond'));
                $fields = array(
                    'diamond' => intval($user['diamond']) + $order['diamond']
                );
                if(!$this->db->update($fields,'xf_user',' WHERE user_id = '.$user_id))
                    throw new \Exception(CommonError::DB_UPDATE_ERROR);

                //修改订单状态
                $fields = array(
                    'pay_at' => date( 'Y-m-d H:i:s' ) ,
                    'status' => 1
                );
                if ( !PaymentOrder::instance()->updateByOrderNo( $fields , $order_id ) )
                    throw new \Exception( CommonError::DB_UPDATE_ERROR );

                if ( !AppStoreRecordModel::instance()->save( $appstoreRecord ) )
                    throw new \Exception( CommonError::DB_INSERT_ERROR );

                $this->db->commit();

                //TODO  给资源统计推送变化
                $data = array(
                    'recharge_type' => self::RECHARGE_TYPE_CHINABANK,
                    'order_no' => $order_id,
                    'user_id' => $user_id
                );
                Account::instance()->setUserId($user_id)->flush();
                @EventDispatcher::instance()->dispatch(Event::DO_AFTER_RECHARGE,$data);

                //返回给客户端
               Response::instance()->success($responseData);
            } catch (\Exception $e) {
                $this->db->rollback();
                Response::instance()->say($e->getMessage(),$responseData);
            }
        }


        /**
         * 生成订单号
         * 订单号规则
         * 默认不传platform参数 则是以mb开头的 表示手机端订单或者是默认的非第三方订单
         * platform = 360 则是以360开头的订单 表示是360平台充值的订单
         * platform = bd  则是以bd开头的订单 表示是百度平台的充值订单
         */
        function pay_order()
        {
            $session = $this->checkSession( $this->input->post( 'sessionid' ) );
            if ( false == $session )
                Response::instance()->say(CommonError::LOGIN_NEEDED);

            $pay_type = $this->input->post( 'pay_type' );
            $money = $this->input->post( 'money' );

            if ( $pay_type == 2 ) //手机卡支付
                $pay_amount = $this->config->common['pay_amount_ratio_mobile'];
            else
                $pay_amount = $this->config->common['mobile_amount_ratio'];

            $orderNoPrefix = $this->input->post( 'platform' );
            if ( false == $orderNoPrefix )
                $orderNoPrefix = 'mb';
            $order_no = $orderNoPrefix . '_' . date( 'Ymd' ) . uniqid();
//            if ( !in_array( $money , array_keys( $pay_amount ) ) )//验证money的合法性
//                Response::instance()->say(CommonError::PAYMENT_AMOUNT_ERROR);

            $fields = array(
                'user_id'    => $session['user_id'] ,
                'order_no'   => $order_no ,
                'money'      => $money ,
                'diamond'    => $pay_amount[ $money ] ,
                'pay_type'   => $pay_type ,
                'status'     => 0 ,
                'create_at'  => date( 'Y-m-d H:i:s' ) ,
                'pay_for_id' => $session['user_id'] ,
                'pay_info'   => '' ,
                'ip'         => Tools::getip()
            );

            if ( !PaymentOrder::instance()->save( $fields ) )
                Response::instance()->say(CommonError::DB_INSERT_ERROR);
            Response::instance()->success($order_no);
        }
    }