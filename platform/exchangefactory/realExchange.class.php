<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/19
     * Time: 10:39
     */

    namespace exchangefactory;
    use common\model\StoreOrders;
    use common\Error;
    use common\Response;
    use utils\Strings;

    /**
     * 兑换实物
     * Class RealExchange
     * @package exchangefactory
     */
    class RealExchange extends BaseExchange implements IExchange
    {

        protected static $_instance = null;

        /**
         * @override
         * 保存订单
         * @throws \Exception
         */
        protected function saveStoreOrder()
        {
            $address = $this->input->post('address');
            $mobile = $this->input->post('mobile');
            $real_name = $this->input->post('real_name');

            if(!Strings::is_mobile($mobile))
                Response::instance()->say(Error::FORM_STRING_FORMAT_ERROR);
            if(empty($address))
                Response::instance()->say(Error::FORM_STRING_FORMAT_ERROR);

            for($i = 0 ; $i < $this->_product_num ; $i++) {
                $fields = array(
                    'order_no'    => uniqid( mt_rand() ) ,
                    'server_id'   => $this->_product['server_id'] ,
                    'product_id'  => $this->_product['id'] ,
                    'create_time' => time() ,
                    'user_id'     => $this->_user['user_id'] ,
                    'address'  => $address,
                    'mobile' => $mobile,
                    'real_name' => $real_name,
                    'state'       => 1
                );
                if ( !StoreOrders::instance()->save( $fields ) )
                    throw new \Exception( Error::DB_UPDATE_ERROR );
            }
        }

    }