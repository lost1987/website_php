<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/30
     * Time: 下午5:38
     * php 计划任务启动类
     * 启动 php -c /etc/php.ini bootstrap.php
     */

    define('BASE_PATH',dirname(dirname(__FILE__)));
    error_reporting( E_ALL & ~E_NOTICE );
    ini_set( 'display_errors' , 'on' );

    /*设置时区***/
    date_default_timezone_set( "Asia/Shanghai" );

    $args = getopt( "c:n:" );
    $command = $args['c'];
    $className = $args['n'];

    $tip = "命令使用方式:bootstrap.php -c  [all|start|stop]  -n [类名(任务名)]".chr(10);
    if(empty($command))
        die($tip);

    $globalCfg = require BASE_PATH.'/conf/tasks.inc.php';
    switch ($command) {
        case 'all':
            $processNum = count( $globalCfg['daemons'] );
            for($i = 0 ; $i < $processNum ; $i++){
                $className = $globalCfg['daemons'][$i];
                $shell = $globalCfg['bin'].' '.BASE_PATH.'/tasks/exec.php -n '.lcfirst($className).' > '.BASE_PATH.'/logs/'.$className.'.error  &';
                $pid = pcntl_fork();
                if($pid == 0) {
                    $cur_pid = getmypid();
                    passthru( $shell );
//                    error_log($shell);
                    posix_kill($cur_pid,SIGTERM);
                }else if($pid){
                    pcntl_wait($status,WNOHANG);
                }
            }
            $checkShell = 'ps aux | grep exec.php |grep -v grep';
            system($checkShell);
            break;

        case 'start':
            if(empty($className))
                die($tip);
            if(!in_array($className,$globalCfg['daemons']))
                die($tip);
            $shell = $globalCfg['bin'].' '.BASE_PATH.'/tasks/exec.php -n '.lcfirst($className).' > '.BASE_PATH.'/logs/'.$className.'.error  &';
            $pid = pcntl_fork();
            if($pid == 0) {
                $cur_pid = getmypid();
                passthru( $shell );
                posix_kill($cur_pid,SIGTERM);
            }
            break;

        case 'stop':
            $shell = 'ps -ef|grep exec.php|grep -v grep|awk  \'{print "kill -9 " $2}\' |sh';
            passthru($shell,$returnCode);
            $checkShell = 'ps aux | grep exec.php |grep -v grep';
            system($checkShell);
            $outputShell = 'echo -e "\e[0;41m 所有任务程序退出，code：'.$returnCode.'  \e[0m"';
            system($outputShell);
            break;

        default:
            echo '未知命令:'.chr(10);
            die($tip);
            break;
    }

