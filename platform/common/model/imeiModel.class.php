<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/6/23
 * Time: 下午2:12
 */

namespace common\model;



use common\XfModel;

class ImeiModel extends XfModel{

    const IOS = 2;

    const ANDROID = 1;

    protected  static $_instance = null;

    /**
     * 获取设备号
     * @param    int   $type 1=android 2=ios
     */
    function lists($type){
            $sql =  "SELECT login_name,imei FROM xf_imei WHERE type = ?";
            $this->db->execute($sql,array($type));
            return $this->db->fetch_all();
    }
} 