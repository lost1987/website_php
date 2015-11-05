<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/13
     * Time: 16:02
     */

    namespace api\controller;


    use api\core\LoginedController;
    use common\base\BaseGameHelp;
    use common\Error as CommonError;
    use common\ImageSuffix;
    use common\Response;
    use core\Encoder;
    use utils\Arrays;

    /**
     * 平台/游戏帮助
     * Class Help
     * @package api\controller
     */
    class Help extends LoginedController
    {
            function game(){
                $server_id = $this->input->post('server_id');
                if(empty($server_id))
                    Response::instance()->say(CommonError::SERVER_ID_NOT_EXSIT);
                $help = BaseGameHelp::instance()->readByServerId($server_id);
                $help['images'] = Encoder::instance()->decode($help['images']);
                foreach($help['images'] as &$image){
                    foreach($image['urls'] as &$img){
                        $img = CDN_PLATFORM_HOST.$img.'?'.ImageSuffix::GAME_HELP;
                    }
                }
                $help['images'] = Arrays::std_multi_array_format($help['images']);
                Response::instance()->success($help['images']);
            }
    }