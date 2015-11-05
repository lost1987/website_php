<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/21
     * Time: 下午5:01
     */

    namespace exchangefactory;

    use common\Error;
    use common\Response;

    /**
     * 兑换货币类商品类
     * Class MonetaryExchange
     * @package \exchangefactory
     */
    class MonetaryExchange extends BaseExchange implements IExchange
    {

        protected  static $_instance = null;

        /**
         * 阻止扶持帐号进行兑换功能
         * @param $user
         * @param $product
         */
        protected function preventSupportAccount()
        {
                    if($this->_user['user_flag'] == 2){
                            if($this->_product['tool_type'] != 1  ||  $this->_product['price_type'] != 3)
                                Response::instance()->say(Error::SUPPORTER_ACCOUNT_FORBIDDEN);
                    }
        }
    }