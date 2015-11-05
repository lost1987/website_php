<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-7-28
     * Time: 下午4:48
     */

    namespace core;


    abstract class Base
    {

        /**
         *
         * @global \core\Omni $omni
         * @param string      $property
         * @return mixed
         */
        function __get( $property )
        {
            global $omni;

            return $omni->$property;
        }

        /**
         *
         * @global \core\Omni $omni
         * @param string      $property
         * @param mixed       $object
         */
        function bindProperty( $property , $object )
        {
            global $omni;
            $omni->$property = $object;
        }

    }