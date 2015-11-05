<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/8
     * Time: 18:06
     */

    namespace core;


    use common\Error;
    use common\Response;
    use interfaces\IStartup;

    class Command extends SingleNess implements IStartup
    {

        protected static $_instance = null;

        function run( $dir , \Omni &$omni )
        {
                $cmd_id = $omni->input->get('cmd');
                $cfg = Configure::instance();
                $cfg->load('cmd');
                $command = $cfg->cmd[$cmd_id];

                if(empty($command))
                    Response::instance()->say(Error::COMMAND_NOT_EXSIT);

                list($controllerName,$methodName) = $command;
                if(!class_exists($controllerName))
                    Response::instance()->say(Error::CLASS_NOT_EXSIT);

                $controller = new $controllerName;
                call_user_func(array($controller,$methodName));
        }

    }