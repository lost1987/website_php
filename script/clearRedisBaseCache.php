<?php

$redis = new Redis();
$redis->connect('127.0.0.1');
$redis->select(2);
$keys = $redis->keys('common*');
foreach($keys as $key){
    $redis->del($key);
}
$redis->close();
 die('clear end');

?>
