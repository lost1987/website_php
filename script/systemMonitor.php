<?php

$dbhost = '127.0.0.1';
$dbuser = 'game';
$dbpass = 'no.1@China!game';

mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db('gms');
mysql_set_charset('utf8');


define('CPU_COMMAND','top -b -n 1 | grep Cpu');
define('MEM_COMMAND','top -b -n 1 | grep Mem');
define('LOAD_COMMAND','top -b -n 1 | grep load');

while(1){
    $cpuinfo = exec(CPU_COMMAND);
    $data = preg_replace('/(.*?):(.*?)%(.*?),(.*?)%(.*)/', '$2,$4', $cpuinfo);
    list($cpuUserUsage,$cpuSysUsage) = explode(',',$data);
    $cpuSysUsage = str_replace(array('  ','\r'), '', $cpuSysUsage);
    $cpuUserUsage = str_replace(array('  ','\r'), '', $cpuUserUsage);
    

    $meminfo = exec(MEM_COMMAND);
    $data = preg_replace('/(.*?):(.*?)(\d+)(.*?),(.*?)(\d+)(.*?),(.*?)(\d+)(.*?),(.*)/', '$6,$9', $meminfo);
    list($memUsage,$memFree) = explode(',',$data);
    $memUsage = intval(str_replace(' ','',$memUsage));
    $memFree = intval(str_replace(' ','',$memFree));

    $loadinfo = exec(LOAD_COMMAND);
    $data = preg_replace('/(.*):[ ](.*),[ ](.*),[ ](.*)/', '$2,$3,$4', $loadinfo);
    list($load5,$load10,$load15) = explode(',',$data);
    $load5 = floatval(str_replace(' ','',$load5));
    $load10 = floatval(str_replace(' ','',$load10));
    $load15 = floatval(str_replace(' ','',$load15));
    
    $time = time();
    $sql = "insert into gms_system_monitor (cpuUserUsage,cpuSysUsage,memUsage,memFree,load5,load10,load15,create_time) values ('$cpuUserUsage','$cpuSysUsage',$memUsage,$memFree,$load5,$load10,$load15,$time)";
    
    if(!mysql_query($sql)){
        echo mysql_error();
    }
    
    sleep(10);
}




