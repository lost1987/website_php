<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/25
     * Time: 下午5:05
     */

    namespace gms\controller;
    use core\Cookie;
    use core\DB;
    use core\Encoder;
    use core\Redirect;
    use gms\core\AdminController;
    use gms\libs\AdminUtil;
    use gms\libs\Error;
    use gms\libs\ModuleDictionary;
    use utils\Upload;

    /**
     * 处理和游戏相关 和用户无关的控制器
     * Class Game
     * @package gms\controller
     */
    class Game extends AdminController
    {

         function help(){
                 $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
                 $gameDB = new DB();
                 $gameDB->init_db($server);
                 $sql = "SELECT * FROM help WHERE id = 1";
                 $gameDB->execute($sql);
                 $result = $gameDB->fetch();
                $this->output_data['help_image'] = explode(',',$result['help_image']);
                $this->output_data['guize_image'] = explode(',',$result['guihua_image']);

                AdminUtil::instance()->check_permission(ModuleDictionary::MODULE_GAME_HELP);
                $this->init_navigator();
                $this->render('game_help.html');
         }

        function saveHelp(){
                $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
                $gameDB = new DB();
                $gameDB->init_db($server);
                $sql = "SELECT * FROM help WHERE id = 1";
                $gameDB->execute($sql);
                $result = $gameDB->fetch();

                $upload = new Upload();
                $upload->set_allowed_ext( $this->config->gms['upload']['image_allowed_ext'] );
                $upload->set_max_size();
                $upload->set_upload_folder( 'upload/images/help' );

                $fields = array();

                $help_urls = array();
                $guize_urls = array();
                for($i =1 ; $i < 6; $i++){
                    $file_help = $_FILES['help_image'.$i];
                    $file_guihua = $_FILES['guihua_image'.$i];

                    if(!empty($file_help['type'])) {
                        $help = $upload->upload( $file_help );
                        $help_urls[] = $help['url'];
                    }

                    if(!empty($file_guihua['type'])) {
                        $help = $upload->upload( $file_guihua );
                        $guize_urls[] = $help['url'];
                    }
                }

                $fields['help_image'] = implode(',',$help_urls);
                $fields['guihua_image'] = implode(',',$guize_urls);

                if(empty($result)){
                            if(!$gameDB->save($fields,'help'))
                                Redirect::instance()->forward('/error/'.Error::DATA_WRITE);
                }else{
                            if(!$gameDB->update($fields,'help',' where id = 1 '))
                                Redirect::instance()->forward('/error/'.Error::DATA_WRITE);
                }

                Redirect::instance()->forward('/game/help');
        }
    }