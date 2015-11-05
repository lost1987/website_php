<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/11
     * Time: 下午2:30
     */

    namespace dhmanager\core;


    use dhmanager\libs\AdminUtil;
    use utils\Http;

    /**
     * 该控制器只服务于administrator 构造时会进行身份验证
     * Class AdministratorController
     * @package dhmanager\core
     */
    class AdministratorController extends DhController
    {
                function __construct(){
                        parent::__construct();
                        if(false == AdminUtil::instance()->isAdministrator()) {
                            Http::sendHttpStatus( 403 );
                            exit;
                        }
                }
    }