<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-9-30
     * Time: 下午2:19
     */

    namespace web\controller;

    use common\Platform;
    use core\Controller;
    use core\Cookie;
    use core\DB;
    use core\Redirect;
    use gamefactory\GameFactory;
    use web\libs\DataUtil;
    use web\libs\Error;
    use libs\payment\FactoryPay;
    use web\model\ArticlesModel;
    use common\model\GameAreaModel;
    use common\model\UserModel;

    class Payment extends Controller
    {

        function prepare()
        {
            $type = intval( $this->args[0] );

            if ( $this->output_data['is_login'] ) {
                $this->output_data['login_name'] = Cookie::instance()->userdata( 'login_name' );
            }

            if ( $type == 0 || $type == 1 ) {//网银或支付宝
                $amount_types = $this->config->common['pay_amount_ratio'];
            } else if ( $type == 2 ) {//手机卡支付
                $amount_types = $this->config->common['pay_amount_ratio_mobile'];
            }

            $output_data = array(
                'amount_types' => $amount_types ,
                'login_name'   => Cookie::instance()->userdata( 'login_name' ) ,
                'nick_name'    => Cookie::instance()->userdata( 'nickname' ) ,
                'pay_type'     => $type ,
                'token'        => Cookie::instance()->get_csrf_cookie()
            );

            $this->output_data['faq'] = ArticlesModel::instance()->listsByCategory( 0 , 10 , 3 );
            $this->output_data = array_merge( $this->output_data , $output_data );
            $this->tpl->display( 'charging.html' , $this->output_data );
        }

        /**
         * 充值就绪
         */
        function go()
        {
            $this->csrf_token_validation();

            $login_name = $this->input->get( 'login_name' );
            $amount_type = $this->input->get( 'amount_type' );
            $pay_type = $this->input->get( 'pay_type' );

            $user = UserModel::instance()->getUserByLoginName( $login_name );
            if ( false === $user )
                Redirect::instance()->forward( '/error/index/' . Error::ERROR_NO_USER );

            $uid = $user['user_id'];
            $payClass = '';
            $remark['uid'] = $uid;
            switch ($pay_type) {
                case 0://网银在线
                    $payClass = 'PayChinaBank';
                    $remark['pay_type'] = $pay_type;
                    break;
                case 1://支付宝
                    $payClass = 'PayAliPay';
                    $remark['pay_type'] = $pay_type;
                    break;
                case 2://网银在线手机卡
                    $payClass = 'PayChinaBank';
                    $remark['pay_type'] = $pay_type;
                    break;
            }

            FactoryPay::invoke( $payClass )->pay( $amount_type ,$remark );
        }

    }