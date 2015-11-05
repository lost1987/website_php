<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/13
     * Time: 15:56
     */

    namespace api\controller;


    use api\core\LoginedController;
    use common\base\BaseGameAnnouncement;
    use common\base\BaseHallAnnouncement;
    use common\ImageSuffix;
    use common\Response;
    use common\Error as CommonError;
    use core\Encoder;
    use utils\Arrays;

    /**
     * 平台/游戏 公告
     * Class AnnounceMent
     * @package api\controller
     */
    class AnnounceMent extends LoginedController
    {
            function game(){
                //公告类型 0:版本更新,1:活动,2:提示
                  $server_id = $this->input->post('server_id');
                 if(empty($server_id))
                     Response::instance()->say(CommonError::SERVER_ID_NOT_EXSIT);
                 $announces = BaseGameAnnouncement::instance()->readByServerId($server_id);
                foreach($announces as &$announce){
                        $announce['images'] = Encoder::instance()->decode($announce['images']);
                        $announce['images']['image'] = CDN_PLATFORM_HOST.$announce['images']['image'].'?'.ImageSuffix::GAME_ANNOUNCE;
                        unset($announce['id'],$announce['squeue'],$announce['server_id'],$announce['expired_time']);
                }
                 $announces = Arrays::std_multi_array_format($announces);
                 Response::instance()->success($announces);
            }

            function hall(){
                $baseHallAnnounce = BaseHallAnnouncement::instance()->lists();
                $images = explode(',',$baseHallAnnounce[1]['image']);
                foreach($images as &$img){
                    $img = CDN_PLATFORM_HOST.$img.'?'.ImageSuffix::HALL_ANNOUNCE;
                }
                Response::instance()->success($images);
            }
    }