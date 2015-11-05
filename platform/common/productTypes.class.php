<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/26
     * Time: 11:08
     */

    namespace common;


    use core\SingleNess;

    class ProductTypes extends SingleNess
    {
        protected static $_instance = null;

        const MONETARY = 1;
        const REAL = 2;

        private $_types = array(
            1 => '普通兑换',
            2 => '实物兑换'
        );

        function getTypeName($type){
           return $this->_types[$type];
        }

        function all(){
            return $this->_types;
        }
    }