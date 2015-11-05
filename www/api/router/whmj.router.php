<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/3/16
 * Time: 下午4:39
 */
    //router_id => array(service,method ...)
return array(
    1001 => array('api\games\whmj\controller\player','global_rank'),
    1002 => array('api\games\whmj\controller\player','info'),
    1003 => array('api\games\whmj\controller\survey','index'),
    1004 => array('api\games\whmj\controller\info','help')
);