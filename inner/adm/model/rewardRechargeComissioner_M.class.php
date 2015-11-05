<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/3/23
 * Time: 上午11:22
 */

namespace adm\model;


use core\Model;

class RewardRechargeComissioner_M extends Model{

    private static $_instance = null;

    static function instance()
    {
        if ( self::$_instance == null )
            self::$_instance = new self;

        return self::$_instance;
    }

    function save($fields){
        return $this->db->save($fields,'adm_comissioner_reward_recharge');
    }

    function read($uid){
        $sql = "SELECT * FROM adm_comissioner_reward_recharge WHERE uid = ?";
        $this->db->execute($sql,array($uid));
        return $this->db->fetch();
    }

    function update($fields,$uid){
        return $this->db->update($fields,'adm_comissioner_reward_recharge','WHERE uid = '.$uid);
    }
} 