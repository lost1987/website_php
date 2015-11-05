<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/12
     * Time: 上午10:34
     */

    namespace dhmanager\controller;


    use common\Error;
    use core\Cookie;
    use dhmanager\core\DhController;
    use dhmanager\model\ExchangeModel;
    use utils\Page;

    class Exchange extends DhController
    {
            function lists()
            {
                $page = empty( $this->args[0] ) ? 1 : $this->args[0];
                $count = 15;
                $start = ( $page - 1 ) * $count;

                $list = ExchangeModel::instance()->lists($start,$count);
                $total = ExchangeModel::instance()->num_rows();

                $types = array(
                   1 => '支付宝提现',
                    2=>'银行卡提现',
                    3=>'领取代金券'
                );

                $status = array(
                    0=>'未处理',
                    1=>'已处理'
                );
                foreach($list as &$item){
                    $item['typename'] = $types[$item['type']];
                    $item['status_name'] = $status[$item['status']];
                }
                $this->_output_data['list'] = $list;

                //初始化分页
                $page_params = array(
                    'total_rows'   => $total , #(必须)
                    'method'       => 'html' , #(必须)
                    'parameter'    => '/exchange/lists/?' ,  #(必须)
                    'now_page'     => $page ,  #(必须)
                    'list_rows'    => $count , #(可选) 默认为15
                    'use_tag_li'   => true ,
                    'li_classname' => 'active' ,
                    'query_string' => ''
                );

                $pagiation = new Page( $page_params );
                if ( $pagiation->getTotalPage() > 1 )
                    $this->_output_data['pagiation'] = $pagiation->show( 1 );

                $this->render('exchange_lists.html');
            }

            function analysis()
            {
                $page = empty( $this->args[0] ) ? 1 : $this->args[0];
                $count = 15;
                $start = ( $page - 1 ) * $count;

                $list = ExchangeModel::instance()->analysis($start,$count);
                $total = ExchangeModel::instance()->analysis_rows();
                $totalRmb = ExchangeModel::instance()->totalRmb();
                $this->_output_data['list'] = $list;

                //初始化分页
                $page_params = array(
                    'total_rows'   => $total , #(必须)
                    'method'       => 'html' , #(必须)
                    'parameter'    => '/exchange/analysis/?' ,  #(必须)
                    'now_page'     => $page ,  #(必须)
                    'list_rows'    => $count , #(可选) 默认为15
                    'use_tag_li'   => true ,
                    'li_classname' => 'active' ,
                    'query_string' => ''
                );

                $pagiation = new Page( $page_params );
                if ( $pagiation->getTotalPage() > 1 )
                    $this->_output_data['pagiation'] = $pagiation->show( 1 );

                $this->_output_data['totalRmb'] = $totalRmb;
                $this->render('exchange_analysis.html');
            }

            function handle()
            {
                    $orderid = $this->input->post('orderid');
                    $type = $this->input->post('type');

                    $fields = array(
                        'admin_id' => Cookie::instance()->userdata('admin_id'),
                        'status' => 1
                    );

                    if($type != 1 && $type != 2){
                         $fields['express']  =   $this->input->post('express');
                    }

                    if(!$this->db->update($fields,'dh_exchange',' where id='.$orderid ))
                        $this->response(Error::DB_UPDATE_ERROR);

                    $this->response();
            }
    }