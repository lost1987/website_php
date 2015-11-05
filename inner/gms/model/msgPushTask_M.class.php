<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/6/30
 * Time: 上午10:43
 */

namespace gms\model;


use core\Model;

class MsgPushTask_M extends Model{

    private static $_instance = null;

    private $_condition = '';

    static function instance()
    {
        if ( self::$_instance == null )
            self::$_instance = new self;

        return self::$_instance;
    }

    function lists($area_id,$game_id, $start = null , $count = null )
    {
        $limit = '';
        if ( $start !== null && $count !== null )
            $limit = " LIMIT $start , $count";

        $sql = "SELECT * FROM gms_msg_push_task {$this->_condition} $limit ";
        $this->db->execute( $sql );
        $this->_condition = '';
        $result_array = $this->db->fetch_all();
        $array = array();
        foreach ( $result_array as $k => $v ) {
            $array[ $v['id'] ] = $v;
        }
        unset( $result_array );

        return $array;
    }


    function num_rows()
    {
        $sql = "SELECT COUNT(*) as num FROM  gms_msg_push_task  {$this->_condition}";
        $this->db->execute( $sql );
        $this->_condition = '';

        return $this->db->fetch()['num'];
    }

    function del($id){
        $sql = "DELETE FROM gms_msg_push_task WHERE id = ?";
        return $this->db->execute($sql,array($id));
    }
} 