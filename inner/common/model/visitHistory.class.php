<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/5/5
     * Time: 上午11:20
     */

    namespace common\model;


    use gms\core\XfModel;

    class VisitHistory extends XfModel
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }
        /**
         * 查找活跃用户的数量
         * @param int $start_time 精确到天
         * @param int $end_time   精确到天
         */
        function vigorousNum( $start_time , $end_time )
        {
            $sql = "SELECT COUNT(DISTINCT(user_id)) as num FROM xf_user_visit_history WHERE UNIX_TIMESTAMP(login_time) >= $start_time AND UNIX_TIMESTAMP(login_time) <= $end_time";
            $this->db->execute( $sql );

            return $this->db->fetch()['num'];
        }
    }