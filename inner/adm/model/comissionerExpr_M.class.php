<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/6/25
 * Time: 上午10:06
 */

namespace adm\model;


use core\Model;
use utils\Date;

class ComissionerExpr_M extends Model{

    private static $_instance = null;

    /**
     * @return \adm\model\ComissionerExpr_M
     */
    static function instance()
    {
        if ( self::$_instance == null )
            self::$_instance = new self;

        return self::$_instance;
    }

    /**
     * 获得当月的经验值
     * @param $pid
     */
    function currentChildRenGetExpr($uid){
          $times = Date::instance()->monthTimeStampSE();
          $sql = "SELECT SUM(expr_get) as expr_get FROM adm_comissioner_child_expr_log WHERE create_time > ? AND create_time < ? AND  uid = ?";
         $this->db->execute($sql,array($times['start'],$times['end'],$uid));
        return $this->db->fetch()['expr_get'];
    }

    /**
     * 获得上月的经验值
     * @param $pid
     */
    function lastMonthChildRenGetExprPrev($uid){
        $times = Date::instance()->lastMonthTimeStampSE();
        $sql = "SELECT SUM(expr_get) as expr_get FROM adm_comissioner_child_expr_log WHERE create_time > ? AND create_time < ? AND  uid = ?";
        $this->db->execute($sql,array($times['start'],$times['end'],$uid));
        return $this->db->fetch()['expr_get'];
    }

    /**
     * 当前的经验值
     * @param $uid
     */
    function currentExpr($uid){
        $sql = "SELECT expr_reach FROM adm_comissioner_child_expr_log WHERE uid = ? ORDER BY create_time DESC  limit 1";
        $this->db->execute($sql,array($uid));
        return $this->db->fetch()['expr_reach'];
    }


} 