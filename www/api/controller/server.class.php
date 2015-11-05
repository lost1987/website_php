<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/5
     * Time: 下午2:07
     */

    namespace api\controller;
    use api\core\Baseapi;
    use common\model\ActivitiesModel;
    use common\model\GameAreaModel;
    use utils\Arrays;

    /**
     * 获取服务器相关信息
     * Class Server
     * @package api\controller
     */
    class Server extends Baseapi
    {
            function lists(){
                  $list =   GameAreaModel::instance()->listCache();
                  foreach($list as &$item){
                      $item['icon'] = $item['static_host'].'/mobile/'.$item['icon'];
                      $item['desp_image']  = $item['static_host'].'/mobile/'.$item['desp_image'];
                      $item['update_time']  = date('m月d日',$item['update_time']);
                      $item['preview'] = array();
                      $preview  = explode(',',$item['preview_images_name']);
                      foreach($preview as $p){
                          $item['preview'][] = $item['static_host'].'/mobile/'.$p;
                      }

                      unset($item['server_db_host'],$item['server_db_name'],
                          $item['server_db_user'],$item['server_db_passwd'],
                          $item['server_db_port'],$item['redis_idx'],
                          $item['static_host'],$item['preview_images_name']);
                  }

                  //读取活动
                  $ac_images = array();
                  $activity_images = ActivitiesModel::instance()->lists(0,5);
                  foreach($activity_images as $i){
                      if(!empty($i['mobile_image_url']))
                            $ac_images[] = WWW_HOST.$i['mobile_image_url'];
                  }

                  $list = array_values($list);
                  $response['servers'] = Arrays::std_multi_array_format($list);
                  $response['ac_images'] = Arrays::std_array_format($ac_images);
                  $this->response($response);
            }
    }