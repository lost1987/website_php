<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/21
     * Time: 下午5:30
     */

    namespace dh\controller;


    use core\Base;
    use core\DB;
    use core\Encoder;
    use core\Redirect;
    use utils\Curl;
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
            //检查兑换码是否存在
            $sql = "SELECT state FROM dh_excode WHERE excode = ?";
            $this->db->execute($sql,array($this->input->post('excode')));
            $ex = $this->db->fetch();
            if($ex['state'] == 2)
                Redirect::instance()->forward('/ex?err=兑换码不存在或者已经使用');

            $c = curl_init();
            curl_setopt($c , CURLOPT_URL,API_HOST.'/outcome/productOrderValidate');
            curl_setopt($c,CURLOPT_POST,1);
            curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($c,CURLOPT_POSTFIELDS,http_build_query($this->input->post()));
            $result = curl_exec($c);
            $result = json_decode($result,true);
            if(intval($result['error']) == 1000)
                Redirect::instance()->forward('/ex?err=兑换码不存在或者已经使用');
            else if(intval($result['error']) == 2000)
                Redirect::instance()->forward('/ex?err=用户不存在');
            else if(intval($result['error']) == 3000)
                Redirect::instance()->forward('/ex?err=消费密码错误或未设置');

            $outputData['product_name'] = $result['data']['product_name'];
            $outputData['excode'] = $this->input->post('excode');
            $outputData['password'] = $this->input->post('pp');
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

            $c = curl_init();
            curl_setopt($c , CURLOPT_URL,API_HOST.'/outcome/productOrderValidate');
            curl_setopt($c,CURLOPT_POST,1);
            curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($c,CURLOPT_POSTFIELDS,http_build_query(array(
                'excode' => $excode,'pp' => $purchasePwd
            )));
            $result = curl_exec($c);
            $result = json_decode($result,true);
            if(intval($result['error']) == 1000)
                Redirect::instance()->forward('/ex/error?err=兑换码不存在或者已经使用');
            else if(intval($result['error']) == 2000)
                Redirect::instance()->forward('/ex/error?err=用户不存在');
            else if(intval($result['error']) == 3000)
                Redirect::instance()->forward('/ex/error?err=消费密码错误或未设置');

            $user_id = $result['data']['user_id'];
            $product_id = $result['data']['product_id'];
            $product_name = $result['data']['product_name'];
            $handler_id = $result['data']['handler_id'];
            $login_name = $result['data']['login_name'];
            $nickname=$result['data']['nickname'];

            try {
                $this->db->begin();
                $product_rmb  = preg_replace('/(\d+)(.*)/','$1',$product_name);

                $fields = array(
                    'create_time' => time(),
                    'product_name'=>$product_name,
                    'uid' => $user_id,
                    'admin_id' => 0,
                    'login_name'=>$login_name,
                    'nickname' => $nickname,
                    'mobile' => $mobile,
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
                if(!$this->db->save($fields,'dh_exchange'))
                    throw new \Exception('网络出错!请稍后再试!');

                $fields1 = array(
                    'state' => 2
                );
                if(!$this->db->update($fields1,'dh_excode'," where excode='$excode'"))
                    throw new \Exception('网络出错!请稍后再试!');

                $this->db->commit();
                curl_setopt($c , CURLOPT_URL,API_HOST.'/outcome/handleProductResult');
                curl_setopt($c,CURLOPT_POST,1);
                curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($c,CURLOPT_POSTFIELDS,http_build_query(array(
                    'handler_id' => $handler_id
                )));
                curl_close($c);
                Redirect::instance()->forward('/ex/success');
            } catch (\Exception $e) {
                $this->db->rollback();
                curl_close($c);
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
         * 提供一个兑换码给兑换使用
         */
        function provider(){
            $pkey = 'newbeesoft';
            $product_name = $this->input->post('product_name');
            $time = $this->input->post('time');
            $sign = $this->input->post('sign');
            $mysign = md5($time.$pkey);
            if($mysign != $sign)
                    $this->response(null,1000);//签名错误

            $price = preg_replace('/(\d+)(.*)/','$1',$product_name);
            $sql = "SELECT id,excode FROM dh_excode WHERE state = 0  and price = $price ORDER BY create_time asc limit 1";
            $this->db->execute($sql);
            $ex = $this->db->fetch();
            if(empty($ex))
                $this->response(null,2000);//购物兑换码已经消耗完了,请去后台添加!

            $usql = "UPDATE dh_excode SET state = 1 WHERE id = ? ";
            if(!$this->db->execute($usql,array($ex['id'])))
                $this->response(null,3000);//修改兑换码状态出错

            $this->response($ex);
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

        /**
         * @param      $data   返回的数据
         * @param int  $error  错误代码
         * @param bool $end    是否输出后终止程序
         * @param int  $encode 编码方式
         * @throws \Exception
         */
        protected function response( $data , $error = 0 , $end = true , $encode = Encoder::JSON )
        {
            $response = array(
                'error' => intval( $error ) ,
                'data'  => $data
            );
            if ( $end )
                die( Encoder::instance()->encode( $response , $encode ) );
            else
                echo Encoder::instance()->encode( $response , $encode );
        }


        function search_bank(){
            $bin = $this->input->post('bin');
            $sql = "SELECT bank_name FROM dh_banks WHERE bank_bin = ?";
            $this->db->execute($sql,array($bin));
            $bank = $this->db->fetch();
            die($bank['bank_name']);
        }

    }