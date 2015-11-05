<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-10-15
     * Time: 上午9:18
     * 充值回调接口
     */
    namespace api\controller;

    use api\libs\Error;
    use api\core\Baseapi;
    use core\Configure;
    use core\DB;
    use core\Encoder;
    use gamefactory\GameFactory;
    use libs\payment\AlipayNotify;
    use utils\Curl;
    use web\libs\DataUtil;
    use common\Platform;
    use common\model\GameAreaModel;
    use common\model\PaymentOrder;
    use libs\payment\PayAliPay;
    use libs\payment\PayChinaBank;
    use utils\Tools;
    use common\model\AppStoreRecordModel;

    /**
     * 处理充值加钱接口,和移动端充值订单号
     * Class Payment
     * @package api\controller
     */
    class Payment extends Baseapi
    {
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

            list( $game_id , $area_id ) = explode( '|' , $remark1 );
            if ( empty( $game_id ) )
                $game_id = 1;
            if ( empty( $area_id ) )
                $area_id = 1;
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );
            $gameFunc = GameFactory::invoke( $game_id , $gameDB );

            $md5string = strtoupper( md5( $v_oid . $v_pstatus . $v_amount . $v_moneytype . $key ) );
            if ( $v_md5str == $md5string ) {
                if ( $v_pstatus == "20" ) {//支付成功 开始走业务流程
                    //查询该订单信息
                    try {
                        $this->db->begin();
                        $gameDB->begin();

                        $myorder = PaymentOrder::instance()->getByOrderNo( $v_oid );
                        if ( !$myorder )
                            throw new \Exception( '订单号不存在' );

                        if ( intval( $myorder['status'] ) > 0 ) {
                            die( 'ok' );
                            //'订单已完成,非法请求';
                        }

                        if ( $myorder['money'] != $v_amount )
                            throw new \Exception( '充值金额与订单金额不符' );

                        //给用户增加资源
                        $gameFunc->payCallBack( $myorder );

                        //修改订单状态
                        $fields = array(
                            'pay_at' => date( 'Y-m-d H:i:s' ) ,
                            'status' => 1
                        );

                        if ( !PaymentOrder::instance()->updateByOrderNo( $fields , $v_oid ) )
                            throw new \Exception( '订单状态修改失败' );

                        $this->db->commit();
                        $gameDB->commit();
                        echo 'ok';
                        //=============银行通知结束=============
                        //TODO 读取游戏库
                        DataUtil::instance()->doAfterRecharge( $myorder , Platform::RECHARGE_CHINABANK , $area_id , $game_id );
                    } catch (\Exception $e) {
                        Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , $e->getMessage() );
                        $this->db->rollback();
                        $gameDB->rollback();
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

                list( $game_id , $area_id ) = explode( '|' , $extra_common_param );
                if ( empty( $game_id ) )
                    $game_id = 1;
                if ( empty( $area_id ) )
                    $area_id = 1;
                $server = GameAreaModel::instance()->read( $area_id );
                $gameDB = new DB();
                $gameDB->init_db( $server );
                $gameFunc = GameFactory::invoke( $game_id , $gameDB );

                try {
                    $this->db->begin();
                    $gameDB->begin();

                    if ( $trade_status != 'TRADE_FINISHED' && $trade_status != 'TRADE_SUCCESS' )
                        throw new \Exception( '交易失败' );

                    $myorder = PaymentOrder::instance()->getByOrderNo( $out_trade_no );
                    if ( !$myorder )
                        throw new \Exception( '订单号不存在' );

                    if ( intval( $myorder['status'] ) > 0 ) {
                        die( 'success' );
                        //'订单已完成,非法请求';
                    }

                    if ( $myorder['money'] != $amount )
                        throw new \Exception( '充值金额与订单金额不符' );

                    //给用户增加资源
                    $gameFunc->payCallBack( $myorder );

                    //修改订单状态
                    $fields = array(
                        'pay_at' => date( 'Y-m-d H:i:s' ) ,
                        'status' => 1
                    );
                    if ( !PaymentOrder::instance()->updateByOrderNo( $fields , $out_trade_no ) )
                        throw new \Exception( '订单状态修改失败' );

                    $this->db->commit();
                    $gameDB->commit();
                    echo 'success';
                    //=============银行通知结束=============
                    //TODO 读取游戏库
                    DataUtil::instance()->doAfterRecharge( $myorder , Platform::RECHARGE_APLIPAY , $area_id , $game_id );
                } catch (\Exception $e) {
                    Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , $e->getMessage() );
                    $this->db->rollback();
                    $gameDB->rollback();
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
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( false == $session )
                $this->response( null , Error::USER_NOT_LOGIN );

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

            if ( strcmp( $result['receipt']['bid'] , 'com.16youxi.MjMobile' ) !== 0 )
                $this->response( $responseData , Error::APP_STORE_VERIFY_FAILED );

            if ( intval( $result['status'] ) !== 0 )
                $this->response( $responseData , Error::APP_STORE_VERIFY_FAILED );


            //开始充值流程
            Configure::instance()->load( 'web' );
            $order = PaymentOrder::instance()->getByOrderNo( $order_id );
            if ( !$order )
                $this->response( $responseData , Error::NO_PAYMENT_ORDER );

            if ( $order['status'] == 1 )
                $this->response( $responseData , Error::PAYMENT_ORDER_ALREALLY_FINISHED );

            if ( AppStoreRecordModel::instance()->recordExsit( $appstoreRecord ) )
                $this->response( $responseData , Error::PAYMENT_ORDER_INVALID );


            $area_id = $session['area_id'];
            $game_id = $session['game_id'];

            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );
            $gameFunc = GameFactory::invoke( $game_id , $gameDB );

            try {
                $this->db->begin();
                $gameDB->begin();

                $gameFunc->payCallBack( $order );

                //修改订单状态
                $fields = array(
                    'pay_at' => date( 'Y-m-d H:i:s' ) ,
                    'status' => 1
                );
                if ( !PaymentOrder::instance()->updateByOrderNo( $fields , $order_id ) )
                    throw new \Exception( Error::DATA_WRITE_ERROR );

                if ( !AppStoreRecordModel::instance()->save( $appstoreRecord ) )
                    throw new \Exception( Error::DATA_WRITE_ERROR );

                $this->db->commit();
                $gameDB->commit();
                //TODO 读取游戏库
                DataUtil::instance()->doAfterRecharge( $order , Platform::RECHARGE_APPSTORE , 1 , 1 );

                //返回给客户端
                $this->response( $responseData );
            } catch (\Exception $e) {
                $this->db->rollback();
                $gameDB->rollback();
                $this->response( $responseData , $e->getMessage() );
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
            $session = $this->check_session( $this->input->post( 'sessionid' ) );
            if ( false == $session )
                $this->response( null , Error::USER_NOT_LOGIN );

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
            if ( !in_array( $money , array_keys( $pay_amount ) ) )//验证money的合法性
                $this->response( null , Error::ARGUMENTS_ERROR );

            $fields = array(
                'user_id'    => $session['uid'] ,
                'order_no'   => $order_no ,
                'money'      => $money ,
                'diamond'    => $pay_amount[ $money ] ,
                'pay_type'   => $pay_type ,
                'status'     => 0 ,
                'create_at'  => date( 'Y-m-d H:i:s' ) ,
                'pay_for_id' => $session['uid'] ,
                'pay_info'   => '' ,
                'ip'         => Tools::getip() ,
                'game_id'    => $session['game_id'] ,
                'area_id'    => $session['area_id']
            );

            if ( !PaymentOrder::instance()->save( $fields ) )
                $this->response( null , Error::DATA_WRITE_ERROR );
            $this->response( $order_no );
        }
    }