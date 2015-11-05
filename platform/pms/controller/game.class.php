<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/25
     * Time: 下午5:05
     */

    namespace pms\controller;
    use core\Cookie;
    use core\DB;
    use core\Encoder;
    use core\Redirect;
    use pms\core\AdminController;
    use pms\libs\AdminUtil;
    use pms\libs\Error;
    use pms\libs\ModuleDictionary;
    use utils\Upload;

    /**
     * 处理和游戏相关 和用户无关的控制器
     * Class Game
     * @package pms\controller
     */
    class Game extends AdminController
    {
        /**
         * 游戏设置项
         */
        function argumentSettings(){
            AdminUtil::instance()->check_permission(ModuleDictionary::MODULE_GAME_MANAGER_ARGUMENT_SETTINGS);
            $this->init_navigator();
            $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
            $gameSetting = include(BASE_PATH.'/pms/libs/game_setting.php');
            $gameSetting = $gameSetting[$server['id']];

            $this->redis->select(0);
            if(count($gameSetting) > 0){
                foreach($gameSetting as &$setting){
                    list($key,,,) = $setting;
                    $val = $this->redis->get($key);
                    $setting[] = $val;
                }

                $this->output_data['settings'] = $gameSetting;
                $this->output_data['game_name'] = $server['game_name'];
                $this->render('game_argument_settings.html');
            }
            die('未发现设置项,请配置后再设置');
        }

        function saveArguments(){
            $this->redis->select(0);
            $post = $this->input->post();
            foreach($post as $key => $val){
                $this->redis->set($key,$val);
            }
            Redirect::instance()->forward('/game/argumentSettings/'.ModuleDictionary::ROOT_MODULE_GAME_MANAGER);
        }
    }