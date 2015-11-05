<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/6/17
 * Time: 上午10:30
 */

namespace gms\model;


use core\Model;

class SystemMonitor_M extends Model{

    private static $_instance = null;

    static function instance()
    {
        if ( self::$_instance == null )
            self::$_instance = new self;

        return self::$_instance;
    }

    /**
     * 系统历史最高负载
     * @return mixed
     */
    function maxLoad(){
        $sql = "SELECT MAX(cpuSysUsage) as cpuSysUsage,
                MAX(cpuUserUsage) as cpuUserUsage,
                MAX(memUsage) as memUsage,
                MAX(load5) as load5,
                MAX(load10) as load10,
                MAX(load15) as load15
                FROM gms_system_monitor";

        $this->db->execute($sql);
        return $this->db->fetch();
    }

    /**
     * 最近30分钟服务器负载情况
     * @return mixed
     */
    function lists(){
        $end_time = time();
        $start_time = $end_time - 600;
        $sql = 'SELECT * FROM gms_system_monitor WHERE create_time > ? AND create_time < ?';
        $this->db->execute($sql,array($start_time,$end_time));
        return $this->db->fetch_all();
    }

} 