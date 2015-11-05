<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/9
     * Time: 下午3:30
     */

    namespace api\controller;


    use core\Base;
    use cps\Platform;

    class Cps extends Base
    {
        /**
         * url :  /cps/addResource/$cps_platform_id/$area_id
         */
            function addResource(){
                    $platform_id = $this->args[0];
                    $area_id = $this->args[1];
                    $post = $_REQUEST;
                    unset($post['c'],$post['m']);
                    $cpsPlatform = Platform::instance()->cpsInstance($platform_id);
                    $cpsPlatform->addResource($post,$platform_id,$area_id);
            }

            /**
             * 角色查询接口
             * http://api.16youxi.com/cps/roleInfo/$cps_platform_id/$area_id?startday=2015-03-01&endday=2015-03-06&sign=3d5d98db2b800d29ffed3a65bca39c84
             */
            function roleInfo(){
                $platform_id = $this->args[0];
                $area_id = $this->args[1];
                $post = $_REQUEST;
                unset($post['c'],$post['m']);
                $cpsPlatform = Platform::instance()->cpsInstance($platform_id);
                $cpsPlatform->roleInfo($post,$platform_id,$area_id);
            }
    }