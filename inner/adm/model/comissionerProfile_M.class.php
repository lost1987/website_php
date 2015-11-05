<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/3/25
 * Time: 下午4:08
 */

namespace adm\model;


use core\Model;

class ComissionerProfile_M extends Model{

    private static $_instance = null;

    static function instance(){
        if(self::$_instance == null)
            self::$_instance = new self;
        return self::$_instance;
    }

    function save($fields){
        return $this->db->save($fields,'adm_comissioner_profile');
    }

    function read($uid){
        $sql = "SELECT * FROM  adm_comissioner_profile WHERE uid = ?";
        $this->db->execute($sql,array($uid));
        return $this->db->fetch();
    }

} 