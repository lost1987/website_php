<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/14
     * Time: 10:46
     */

    namespace common\model;


    use core\Singleton;

    class PlatformUserMessage extends Singleton
    {
            protected static $_instance = null;

            function lists($user_id){
                    $sql = "SELECT * FROM xf_platform_user_message WHERE to_id = ?  AND  action <> 3 ORDER BY ins_time DESC";
                    $this->db->execute($sql , array($user_id));
                    return $this->db->fetch_all();
            }

            function read($msg_id){
                    $sql = "SELECT id,msg_type,msg_body_json  FROM xf_platform_user_message WHERE msg_id = ?";
                    $this->db->execute($sql , array($msg_id));
                    return $this->db->fetch();
            }
    }