<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/24
     * Time: 上午9:44
     */

    mysql_connect('127.0.0.1','game','no.1@China!game');
    mysql_select_db('xinfeng');
    mysql_set_charset('utf8');

    $file_path = "robot_names.txt";
    $file = fopen($file_path,"r");
    $names = array();
    while(!feof($file))
    {
        $names[] = fgets($file);
    }
    fclose($file);

    $sql = "SELECT user_id FROM xf_user WHERE is_robot = 1";
    $result = mysql_query($sql);

    try{
        mysql_query("begin");
        $flag = 0;
        while($row = mysql_fetch_assoc($result)){
            $myname = $names[$flag];
            $sql = "UPDATE xf_user SET nickname='$myname' WHERE user_id = {$row['user_id']}";
            mysql_query($sql);
            $flag++;
            usleep(10);
        }
        mysql_query("commit");
        mysql_close();
        die('success!');
    }catch (Exception $e){
        mysql_query('rollback');
        mysql_close();
        die('error!');
    }
