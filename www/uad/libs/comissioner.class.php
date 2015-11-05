<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/3/23
 * Time: 上午11:26
 */

namespace uad\libs;


use core\Base;
use core\Cookie;
use uad\model\User_M;

/**
 * 推广专员相关
 * Class Comissioner
 * @package adm\libs
 */
class Comissioner extends Base{

    private static  $_instance = null;

    const MAX_RATIO_STATE_0 = 0.05;
    const MAX_RATIO_STATE_10 = 0.10;
    const MAX_RATIO_STATE_30 = 0.20;
    const MAX_RATIO_STATE_60 = 0.40;
    const MAX_RATIO_STATE_100 = 0.60;

    const MAX_CHILD_RATIO1_STAGE_0 = 0.05;
    const MAX_CHILD_RATIO1_STAGE_10 = 0.07;
    const MAX_CHILD_RATIO1_STAGE_100 = 0.10;

    static function instance(){
        if(self::$_instance == null)
            self::$_instance = new self;
        return self::$_instance;
    }

    function isComissioner(){
        if( Cookie::instance()->userdata('uad_comissioner') )
            return true;
        return false;
    }

} 