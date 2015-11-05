<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/12/11
     * Time: 下午5:02
     */

    namespace common\model;


    use core\Model;

    class VisitHistoryModel extends Model
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function currentUserMaxId( $uid )
        {
            $sql = "SELECT MAX(id) as id FROM xf_user_visit_history WHERE user_id = ?";
            $this->db->execute( $sql , array( $uid ) );

            return $this->db->fetch()['id'];
        }

        /**
         * 用户未登录的天数
         * @param int $uid
         * @param int $register_type
         */
        function lastLoginTime( $uid , $register_type )
        {
            $sql = "SELECT MAX(UNIX_TIMESTAMP(login_time)) as login_time FROM xf_user_visit_history WHERE  user_id = ? and login_type = ?";
            $this->db->execute( $sql , array( $uid , $register_type ) );

            return $this->db->fetch();
        }

        function save( $fields )
        {
            return $this->db->save( $fields , 'xf_user_visit_history' );
        }

        function update( $fields , $id )
        {
            return $this->db->update( $fields , 'xf_user_visit_history' , " WHERE id = $id" );
        }
    }