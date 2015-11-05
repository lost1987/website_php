<?php
    use Workerman\Worker;
    require_once './Workerman/Autoloader.php';

    $ws_worker = new Worker('MsgpackNL://0.0.0.0:2346');

    $ws_worker->count = 1;

    $ws_worker->name = 'database_backup';

    $dsn = "mysql:host=192.168.2.21;dbname=xinfeng;charset=utf8";
    $pdo = null;

    $ws_worker->onConnect = function(){
    };

    $ws_worker->onMessage = function($connection, $data){
        if($data != 'fetch_data'){
            $connection->destory();
            return;
        }

        global $pdo,$dsn;
        $pdo = new \PDO($dsn,'root','root');
        $stmt = $pdo->prepare('SELECT * FROM xf_platform_items_change_log WHERE id >50000 and id < 50050');
        $stmt -> execute();
        $result = $stmt ->  fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
        $connection->send($result);

        $pdo = null;
    };

    Worker::runAll();