<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/2/5
 * Time: 下午8:11
 */

namespace uad\libs;


use core\Cookie;
use core\Encoder;
use uad\core\UadController;

class LoginSync extends UadController{

    private static $_instance = null;

    static function instance(){
        if (self::$_instance == null)
            self::$_instance = new self;
        return self::$_instance;
    }

    function loginSuccess($xfUser,$xfDB,$admDB){
        $sql = "SELECT * FROM adm_users WHERE uid = ?";
        $admDB->execute($sql,array($xfUser['user_id']));
        $user = $admDB->fetch();
        if(false == $user){
            $inviteCode = null;
            try{
                $admDB->begin();
                $xfDB->begin();
                if(!UserRelationShip::instance($admDB,$xfDB)->createRelationShipFromGame($xfUser,$inviteCode))
                    throw new \Exception(UadError::LOGIN_FAILED);

                $admDB->commit();
                $xfDB->commit();
            }catch (\Exception $e){
                $admDB->rollback();
                $xfDB->rollback();
                $this->response(null,$e->getMessage());
            }

            $sql = "SELECT * FROM adm_users WHERE uid = ?";
            $admDB -> execute($sql,array($xfUser['user_id']));
            $user = $admDB->fetch();
        }
        $inviteCode = empty($xfUser['invite_code']) ? $inviteCode : $xfUser['invite_code'];
        Cookie::instance()->set_userdata('uad_session_data',Encoder::instance()->encode($user));
        Cookie::instance()->set_userdata('uad_uid',$xfUser['user_id']);
        Cookie::instance()->set_userdata('uad_invite_code',$inviteCode);
        Cookie::instance()->set_userdata('uad_comissioner',$user['comissioner']);
    }
} 