<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/13
     * Time: 09:10
     */

    namespace api\controller;


    use api\core\LoginedController;
    use common\base\BaseProducts;
    use common\ImageSuffix;
    use common\Response;
    use exchangefactory\FactoryExchange;
    use utils\Arrays;
    use common\Error as CommonError;

    class StoreProducts extends LoginedController
    {

        function lists(){
            $server_id = $this->input->post('server_id');
            $products = BaseProducts::instance()->readByServerId($server_id);
            $response = array();
            foreach($products as $product){
                unset(
                    $product['create_time'],
                    $product['squeue'],
                    $product['vip_discount'],
                    $product['visible']
                );
                $product['product_image'] = CDN_PLATFORM_HOST.$product['product_image'].'?'.ImageSuffix::STORE_PRODUCTS;
                $response[] = $product;
            }
            $response = Arrays::std_multi_array_format($response);
            Response::instance()->success($response);
        }

        function exchange(){
                $product_id = $this->input->post('product_id');
                $platform = $this->input->post('platform');
                $product_type = $this->input->post('product_type');
                $user_id = $this->_session['user_id'];

                if(empty($product_type))
                    Response::instance()->say(CommonError::STORE_PRODUCT_NOT_EXSIT);

                switch($product_type){
                    case BaseProducts::MONETARY:
                        FactoryExchange::invoke('MonetaryExchange')->doExchange($platform,$product_id,$user_id);
                        break;

                    case BaseProducts::REAL:
                        FactoryExchange::invoke('RealExchange')->doExchange($platform,$product_id,$user_id);
                        break;

                    default:
                        Response::instance()->say(CommonError::STORE_PRODUCT_TYPE_ERROR);
                }
        }


    }