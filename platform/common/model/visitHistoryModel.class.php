<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/12/11
     * Time: 下午5:02
     */

    namespace common\model;


    use common\XfModel;
    use utils\Tools;

    class VisitHistoryModel extends XfModel
    {

        protected static $_instance = null;

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

        function create($user_id,$platform_type){
            $fields = array(
                'user_id' => $user_id,
                'login_time' => date('Y-m-d H:i:s'),
                'ip_address' => Tools::getip(),
                'login_type' => $platform_type,
            );
            return $this->db->save($fields,'xf_user_visit_history');
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