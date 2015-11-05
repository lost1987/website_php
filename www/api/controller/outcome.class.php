<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/2
     * Time: 下午4:25
     */

    namespace api\controller;


    use api\core\Baseapi;

    class Outcome extends Baseapi
    {
        function productOrderValidate(){
            $excode = $this->input->post('excode');
            $purchasePwd = $this->input->post('pp');

            $sql = "SELECT a.user_id,a.product_name,a.product_id,a.handler_id  FROM xf_store_productorder a , xf_index_handleresult b  WHERE a.excode = ? and a.handler_id = b.id and b.result=0  ";
            $this->db->execute($sql,array($excode));
            $productOrder  = $this->db->fetch();

            if(!$productOrder)
                    $this->response(null,1000);//兑换码不存在或者已经使用!

            $user_id = $productOrder['user_id'];

            $sql = "SELECT a.user_id,a.user_number,a.login_name,a.nickname,a.mobile,b.purchase_password FROM xf_user a LEFT JOIN xf_purchaseprofile b ON a.user_id = b.user_id WHERE  a.user_id = $user_id";
            $this->db->execute( $sql );
            $result = $this->db->fetch();

            if ( !$result )
                $this->response(null,2000);///用户不存在');

            $purchasePassword = md5( $purchasePwd . '#' . $result['user_number'] );
            if ( $purchasePassword != $result['purchase_password'] )
                $this->response(null,3000);///消费密码错误或未设置!');

            $this->response( array_merge($productOrder,$result));
        }

        function handleProductResult(){
            $handler_id = $this->input->post('handler_id');
            $fields = array(
                'result' => 4,
                'handler_id' =>5
            );
            $this->db->update($fields,'xf_index_result',' where id='.$handler_id);
        }

    }