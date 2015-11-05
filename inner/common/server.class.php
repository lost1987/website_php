<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/6/15
 * Time: 上午10:03
 */

namespace common;


use common\model\GameAreaModel;
use core\Cookie;
use core\DB;
use core\Encoder;

/**
 * 游戏服务器通用操作
 * Class Server
 * @package common
 */
class Server {

    private static $_instance = null;

    private $_db = null;

    /**
     * @return \common\Server
     */
    static function instance(){
        if(self::$_instance == null)
            self::$_instance = new self;
        return self::$_instance;
    }

    function __construct(){
        $server = Encoder::instance()->decode(Cookie::instance()->userdata('server'));
        $area_id = $server['area_id'];
        $config = GameAreaModel::instance()->read($area_id);
        $this->_db = new DB();
        $this->_db->init_db($config);
    }

    function __destruct(){
        $this->_db->close();
    }

    function readProfile(Array $fields,$uid){
        $columns = implode(',',$fields);
        $sql = "SELECT $columns FROM profile WHERE user_id = ?";
        $this->_db->execute($sql,array($uid));
        return $this->_db->fetch();
    }

    function updateProfile(Array $fields,$uid){
        $columns = array_keys($fields);
        $values = array_values($fields);
        $sql =  ' UPDATE profile SET ';
        $sql_set = array();
        for($i = 0 ; $i < count($fields) ; $i++){
            $sql_set[] = " {$columns[$i]} = ? ";
        }
        $sql .= implode(',',$sql_set). " WHERE user_id = $uid ";
        return $this->_db->execute($sql,$values);
    }


} 