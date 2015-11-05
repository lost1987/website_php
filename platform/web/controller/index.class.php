<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-9-15
     * Time: 下午6:08
     */

    namespace web\controller;


    use common\base\BaseServers;
    use core\Controller;
    use core\Cookie;
    use core\Encoder;
    use core\Redirect;
    use utils\Tools;
    use web\libs\UserUtil;
    use common\model\ActivitiesModel;
    use web\model\ArticlesModel;

    /**
     * 首页
     * Class Index
     * @package web\controller
     */
    class Index extends Controller
    {

        function index()
        {
            if ( Tools::is_mobile_request() )//手机访问直接到下载客户端页面
                Redirect::instance()->forward( '/download/mobile' );

            $errcode = isset( $_GET['code'] ) ? $this->input->get( 'code' ) : 0;
            $cookie = Cookie::instance();

            $this->output_data['code'] = $errcode;
            $this->output_data['csrf_token'] = $cookie->get_csrf_cookie();
            $this->output_data['is_login'] = $this->output_data['is_login'] ? 1 : 0;

            if ( $this->output_data['is_login'] ) {
                $uid = Cookie::instance()->userdata( 'uid' );
                $vip_level = Cookie::instance()->userdata( 'vip_level' );

                $this->output_data['chip'] = Cookie::instance()->userdata('chip');
                $this->output_data['diamond'] = Cookie::instance()->userdata( 'diamond');
                $this->output_data['vip_level'] = empty( $vip_level ) ? '普通用户' : 'Vip' . $vip_level;
                $total = $cookie->userdata( 'total' );
                $wins = $cookie->userdata( 'wins' );
                $this->output_data['ratio'] = UserUtil::instance()->userRatio( $wins , $total );
            }

            //读取游戏服务器
            $servers = BaseServers::instance()->lists();
            $this->output_data['servers'] = $servers;

            //读取活动
            $this->output_data['activity'] = ActivitiesModel::instance()->lists( 0 , 5 );
            $this->output_data['activityImages'] = array();
            foreach ( $this->output_data['activity'] as $item ) {
                $this->output_data['activityImages'][] = array(
                    'image' => $item['index_image_url'] ,
                    'name'  => $item['name']
                );
            }
            $this->output_data['activityImages'] = Encoder::instance()->encode( $this->output_data['activityImages'] );

            $this->output_data['footer_activity'] = ActivitiesModel::instance()->lists( 0 , 20 , 'ASC' );
            $this->output_data['activityFooterImages'] = array();
            foreach ( $this->output_data['footer_activity'] as $item ) {
                $this->output_data['activityFooterImages'][] = array(
                    'image' => $item['web_image_url'] ,
                    'name'  => $item['name']
                );
            }
            $this->output_data['activityFooterImages'] = Encoder::instance()->encode( $this->output_data['activityFooterImages'] );

            $this->output_data['news_with_image'] = ArticlesModel::instance()->listsFlag( 'i' , array( 3 , 4 ) , 0 , 2 );
            $this->output_data['newsImages'] = array();
            foreach ( $this->output_data['news_with_image'] as &$item ) {
                $item['publish_time'] = date( 'Y-m-d' , $item['publish_time'] );
                $item['description'] = mb_substr( $item['description'] , 0 , 25 );
                $this->output_data['newsImages'][] = array(
                    'name'  => $item['title'] ,
                    'image' => $item['image']
                );
            }
            $this->output_data['newsImages'] = Encoder::instance()->encode( $this->output_data['newsImages'] );

            $this->output_data['news_withOut_image'] = ArticlesModel::instance()->listsWithOutFlag( 'i' , array( 3 , 4 ) , 0 , 8 );
            foreach ( $this->output_data['news_withOut_image'] as &$item ) {
                $item['publish_time'] = date( 'm/d' , $item['publish_time'] );
            }
            $this->output_data['index'] = 1;
            $this->tpl->display( 'index.html' , $this->output_data );
        }

    }