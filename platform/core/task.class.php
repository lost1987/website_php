<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/7/1
 * Time: 下午1:59
 */

namespace core;
use interfaces\IStartup;

/**
 * 任务启动类
 * Class Scope
 * @package core
 */
class Task extends SingleNess implements IStartup{

    protected static $_instance = null;

    function run( $dir , \Omni &$omni )
    {
        $className = 'tasks\\run\\'.ucfirst($omni->className);
        $class = new $className;
        if($class instanceof \interfaces\IExecutable)
            $class -> execute();
        else
            die('可执行定时任务实例必须是\interfaces\IExecutable的子类!');
    }

}