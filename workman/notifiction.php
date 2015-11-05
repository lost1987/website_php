<?php
    define('BASEPATH',dirname(__FILE__));
    require BASEPATH.'/Pack/SimplePack.class.php';

    $sp = new SimplePack();
    $socket = stream_socket_client('127.0.0.1:2346',$errno,$errstr);
    $data = 'fetch_data';
    fwrite($socket,$sp->pack($data));
    while(!feof($socket)){
        $recvBuffer = stream_socket_recvfrom($socket,1024);
        $data = $sp->breakup($recvBuffer);
        if($data === null)
            continue;
        var_dump($data);
    }
    fclose($socket);
