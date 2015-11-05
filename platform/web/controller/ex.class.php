<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/21
     * Time: 下午5:30
     */

    namespace web\controller;


    use core\Base;
    use core\DB;
    use core\Redirect;
    use utils\Tools;

    /**
     * 玩家微信兑换购物券
     * Class Ex
     * @package web\controller
     */
    class Ex extends Base
    {

        function index(){
            $output['err'] = $this->input->get('err');
            $this->tpl->display('excode.html',$output);
        }

        /**
         * 检查兑换码和消费密码
         */
        function excodeExec()
        {
            $excode = $this->input->post('excode');
            $purchasePwd = $this->input->post('pp');

            $sql = "SELECT a.user_id,a.product_name FROM xf_store_productorder a , xf_index_handleresult b  WHERE a.excode = ? and a.handler_id = b.id and b.result=0  ";
            $this->db->execute($sql,array($excode));
            $productOrder  = $this->db->fetch();

            if(!$productOrder)
                Redirect::instance()->forward('/ex?err=兑换码不存在或者已经使用!');

            $user_id = $productOrder['user_id'];

            $sql = "SELECT a.user_id,a.user_number,a.login_name,a.nickname,a.mobile,b.purchase_password FROM xf_user a LEFT JOIN xf_purchaseprofile b ON a.user_id = b.user_id WHERE  a.user_id = $user_id";
            $this->db->execute( $sql );
            $result = $this->db->fetch();

            if ( !$result )
                Redirect::instance()->forward('/ex?err=用户不存在');

            $purchasePassword = md5( $purchasePwd . '#' . $result['user_number'] );
            if ( $purchasePassword != $result['purchase_password'] )
                Redirect::instance()->forward('/ex?err=消费密码错误或未设置!');

            $outputData['product_name'] = $productOrder['product_name'];
            $outputData['excode'] = $excode;
            $outputData['password'] = $purchasePwd;
            $this->tpl->display('excode_select.html',$outputData);
        }

        /**
         * 根据选择的处理方式 进行数据处理
         * @throws \Exception
         */
        function excodeValidate(){
            $excode = $this->input->post('excode');
            $purchasePwd = $this->input->post('pp');
            $type = $this->input->post('type');
            $mobile = $this->input->post('mobile');
            $qq = $this->input->post('qq');
            $bank_no = $this->input->post('bank_no');
            $bank_name = $this->input->post('bank_name');
            $name = $this->input->post('name');
            $alipay_name = $this->input->post('alipay_name');
            $alipay_account = $this->input->post('alipay_account');
            $address = $this->input->post('address');

            $sql = "SELECT a.user_id,a.product_id,a.product_name,a.handler_id FROM xf_store_productorder a , xf_index_handleresult b  WHERE a.excode = ? and a.handler_id = b.id and b.result=0  ";
            $this->db->execute($sql,array($excode));
            $productOrder  = $this->db->fetch();

            if(!$productOrder)
                Redirect::instance()->forward('/ex/error?err=兑换码不存在或者已经使用!');

            $user_id = $productOrder['user_id'];
            $handler_id = $productOrder['handler_id'];
            $product_id = $productOrder['product_id'];
            $product_name = $productOrder['product_name'];

            $sql = "SELECT a.user_id,a.user_number,a.login_name,a.nickname,a.mobile,b.purchase_password FROM xf_user a LEFT JOIN xf_purchaseprofile b ON a.user_id = b.user_id WHERE  a.user_id = $user_id";
            $this->db->execute( $sql );
            $result = $this->db->fetch();

            if ( !$result )
                Redirect::instance()->forward('/ex/error?err=用户不存在');

            $purchasePassword = md5( $purchasePwd . '#' . $result['user_number'] );
            if ( $purchasePassword != $result['purchase_password'] )
                Redirect::instance()->forward('/ex/error?err=消费密码错误或未设置!');

            $dhDB = new DB();
            $dhDB->init_db_from_config('dh');
            try {
                $this->db->begin();
                $dhDB->begin();

                $time = date('Y-m-d H:i:s');
                $sql = "UPDATE xf_index_handleresult  SET result = 4,handle_time='$time'   WHERE id = $handler_id";
                if ( !$this->db->execute( $sql ) )
                    throw new \Exception('网络出错!请稍后再试!');

                $product_rmb  = preg_replace('/(\d+)(.*)/','$1',$product_name);

                $fields = array(
                    'create_time' => time(),
                    'product_name'=>$product_name,
                    'uid' => $user_id,
                    'admin_id' => 0,
                    'login_name'=>$result['login_name'],
                    'nickname' => $result['nickname'],
                    'mobile' => $result['mobile'],
                    'excode'=>$excode,
                    'type' => $type,
                    'product_id'=>$product_id,
                    'qq' => $qq,
                    'bank_no' => $bank_no,
                    'bank_name' => $bank_name,
                    'name' => $name,
                    'alipay_name' => $alipay_name,
                    'alipay_account'=>$alipay_account,
                    'address' => $address,
                    'product_rmb' => $product_rmb
                );
                if(!$dhDB->save($fields,'dh_exchange'))
                    throw new \Exception('网络出错!请稍后再试!');

                $this->db->commit();
                $dhDB->commit();

                Redirect::instance()->forward('/ex/success');
            } catch (\Exception $e) {
                $this->db->rollback();
                $dhDB->rollback();
                Tools::debug_log( __CLASS__ , __FUNCTION__ , '兑换错误' , $e );
                Redirect::instance()->forward('/ex/error?err='.$e->getMessage());
            }
        }

        function select(){
            $output_data['pn'] = $this->input->get('pn');
            $this->tpl->display('excode_select.html',$output_data);
        }

        function select_done(){
            $t =intval($this->args[0]);
            $output_data['type'] = $t;
            $output_data['excode'] = $this->input->post('excode');
            $output_data['pp'] = $this->input->post('pp');
            switch($t){
                case 1:
                    $this->tpl->display('excode_alipay.html',$output_data);
                    break;
                case 2:
                    $this->tpl->display('excode_bank.html',$output_data);
                    break;
                case 3:
                    $this->tpl->display('excode_fetch.html',$output_data);
                    break;
            }
        }

        /**
         * 处理成功
         */
        function success()
        {
            $this->tpl->display('excode_success.html');
        }

        /**
         * 处理错误
         */
        function error()
        {
                $output['err'] = $this->input->get('err');
                $this->tpl->display('excode_error.html',$output);
        }
    }