<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/3/16
 * Time: 下午6:12
 */
namespace api\games\whmj\service;
class DemoService {

    private static $_instance = null;

    private $_context = null;

    static function instance($context){
        if(self::$_instance == null)
            self::$_instance = new self($context);
        return self::$_instance;
    }

    function __construct($context){
        $this->_context = $context;
    }

} 