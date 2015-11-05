<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/1/19
 * Time: 上午11:27
 */

namespace uad\libs;


use core\DB;
use web\libs\UserUtil;

class GameUser {

    private static $_instance = null;

    private $_xfDB;

    static function instance(){
        if(self::$_instance == null)
            self::$_instance = new self;
        return self::$_instance;
    }

    function __construct(){
        $this->_xfDB = new DB();
        $this->_xfDB->init_db_from_config('xinfeng');
    }

    function getGameUserByLoginName($loginName){
            $sql = "SELECT user_id,login_name,nickname,user_number,password,invite_code FROM xf_user WHERE login_name = ?";
            $this->_xfDB->execute($sql,array($loginName));
            return $this->_xfDB->fetch();
    }

    function getGameUserByUid($uid){
            $sql = "SELECT user_id,login_name,nickname,user_number,password,invite_code FROM xf_user WHERE uid = ?";
            $this->_xfDB->execute($sql,array($uid));
            return $this->_xfDB->fetch();
    }

    function getGameUserByEmail($email){
        $sql = "SELECT user_id,login_name,nickname,user_number,password,invite_code FROM xf_user WHERE email = ?";
        $this->_xfDB->execute($sql,array($email));
        return $this->_xfDB->fetch();
    }

    function getGameUserByMobile($mobile){
        $sql = "SELECT user_id,login_name,nickname,user_number,password,invite_code FROM xf_user WHERE mobile = ?";
        $this->_xfDB->execute($sql,array($mobile));
        return $this->_xfDB->fetch();
    }

    function getAuth($uid){
        $sql = "SELECT * FROM xf_user_auth WHERE uid = ?";
        $this->_xfDB->execute($sql,array($uid));
        $auths = $this->_xfDB->fetch_all();
        $user_auth = array();
        $user_auth[UserUtil::USER_AUTH_IDCARD] = 0;
        $user_auth[UserUtil::USER_AUTH_MAIL] = 0;
        $user_auth[UserUtil::USER_AUTH_SMS] = 0;

        $auth_types = array_keys($user_auth);
        foreach($auths as $auth){
            if(in_array($auth['auth_type'],$auth_types)){
                $user_auth[ $auth['auth_type'] ] = 1;
            }
        }
        unset($auth_types,$auths);
        return $user_auth;
    }
}