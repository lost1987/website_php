<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/15
     * Time: 10:35
     */

    namespace common;


    use core\SingleNess;

    class Profile extends SingleNess
    {
        /**
         * @var \core\DB
         */
        private $_gamedb;

        private $_user_id;

        protected static $_instance = null;

        function setGameDB($gamedb){
            $this->_gamedb = $gamedb;
            return $this;
        }

        function setUserId($user_id){
            $this->_user_id = $user_id;
            return $this;
        }

        function read($fields = '*'){
                if(is_array($fields))
                    $fields = implode(',',$fields);

                $sql = "SELECT $fields FROM profile WHERE user_id  = ?";
                $this->_gamedb->execute($sql,array($this->_user_id));
                return $this->_gamedb->fetch();
        }

        function update(Array $fields){
                return $this->_gamedb->update($fields,'profile',' WHERE user_id = '.$this->_user_id);
        }

    }