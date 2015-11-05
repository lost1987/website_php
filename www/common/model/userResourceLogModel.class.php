<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/12/10
     * Time: 下午5:12
     */

    namespace common\model;


    use core\DB;

    class UserResourceLogModel
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function save( $fields , $area_id )
        {
            $server = GameAreaModel::instance()->read( $area_id );
            $gameDB = new DB();
            $gameDB->init_db( $server );
            $fields['create_time'] = time();

            return $gameDB->save( $fields , 'user_resource_log' );
        }

        /**
         * 根据事件得到玩家获得的资源和扣除的资源
         * @param $user_id
         * @param $action
         * @param $tool_type
         * @param $price_type
         * @param $area_id
         * @return mixed
         * @throws \Exception
         */
        function read($user_id,$action,$tool_type,$price_type,$area_id){
                $sql = "SELECT tool,price FROM user_resource_log WHERE user_id = ? AND action = ? AND tool_type = ? AND price_type = ?";
                $server = GameAreaModel::instance()->read($area_id);
                $gameDB = new DB();
                $gameDB->init_db( $server );
                $gameDB->execute($sql,array($user_id,$action,$tool_type,$price_type));
                return $gameDB->fetch();
        }

    }