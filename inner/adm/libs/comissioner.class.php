<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/3/23
 * Time: 上午11:26
 */

namespace adm\libs;


use adm\model\RewardRechargeComissioner_M;
use adm\model\User_M;
use core\Base;

/**
 * 推广专员相关
 * Class Comissioner
 * @package adm\libs
 */
class Comissioner extends Base{

    private static  $_instance = null;

    const MAX_RATIO_STAGE_0 = 0.05;
    const MAX_RATIO_STAGE_10 = 0.10;
    const MAX_RATIO_STAGE_30 = 0.20;
    const MAX_RATIO_STAGE_60 = 0.40;
    const MAX_RATIO_STAGE_100 = 0.60;

    const MAX_CHILD_RATIO1_STAGE_0 = 0.05;
    const MAX_CHILD_RATIO1_STAGE_10 = 0.07;
    const MAX_CHILD_RATIO1_STAGE_100 = 0.10;

    static function instance(){
        if(self::$_instance == null)
            self::$_instance = new self;
        return self::$_instance;
    }

    /**
     * 务必配合事物使用
     * 初始化专员,在把普通用户设置为专员的时候调用
     * @param $uid
     * @return bool
     */
    function init($uid){
        $fieldsComissioner = array(
            'uid' => $uid
        );

        $fieldsUser = array(
            'comissioner' => 1
        );

        if(!RewardRechargeComissioner_M::instance()->save($fieldsComissioner))
            throw new \Exception(AdmError::DATA_WRITE);

        if(!User_M::instance()->update($fieldsUser,$uid))
            throw new \Exception(AdmError::DATA_WRITE);

        return true;
    }


    /**
     * 获取专员的充值返利阶段最大比例
     * @param $childNum
     * @return array 阶段,比例
     */
    function getMaxStageRatio($childNum){
        if ( $childNum >= 0 && $childNum <= 9 )
            return array(0,self::MAX_RATIO_STAGE_0);
        else if ( $childNum >= 10 && $childNum <= 29 )
            return array(10,self::MAX_RATIO_STAGE_10);
        else if ( $childNum >= 30 && $childNum <= 59 )
            return array(30,self::MAX_RATIO_STAGE_30);
        else if ( $childNum >= 60 && $childNum <= 99 )
            return array(60,self::MAX_RATIO_STAGE_60);
        else if ( $childNum >= 100 )
            return array(100,self::MAX_RATIO_STAGE_100);
    }

    /**
     * 获取专员的充值返利阶段最大比例
     * @param $uid
     * @return array 阶段,比例
     */
    function getMaxChildStageRatio($child_id){
        //取得1级下线个数
        $childNum = User_M::instance()->userChildrenNumDirectly( $child_id );
        if ( $childNum >= 0 && $childNum <= 9 )
            return array(0,self::MAX_CHILD_RATIO1_STAGE_0);
        else if ( $childNum >= 10 && $childNum <= 99 )
            return array(10,self::MAX_CHILD_RATIO1_STAGE_10);
        else if ( $childNum >= 100 )
            return array(100,self::MAX_CHILD_RATIO1_STAGE_100);
    }


    function setMaxStageRatio($childNum){
        //当前最大奖励
        list($reachableStage,$curMaxRatio) = $this->getMaxStageRatio($childNum);

        $fields = array();
        //取出当前阶段之前的阶段值 并给予最大奖励 再把未达到的阶段奖励提升到当前最大奖励
        $stages = array(0,10,30,60,100);

        $r = new \ReflectionClass($this);
        foreach($stages as $s){
            if($reachableStage > $s){
                $fields['ratio_stage'.$s] = $r->getConstant('MAX_RATIO_STAGE_'.$s);
            }else{
                $fields['ratio_stage'.$s] = $curMaxRatio;
            }
        }

        return $fields;
    }
} 