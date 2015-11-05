<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/31
     * Time: 上午9:53
     */

    namespace uad\model;


    use core\Model;

    class UserExprLog_M extends Model
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * 取得管理员列表
         * @param null $start
         * @param null $count
         * @return mixed
         */
        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $sql = "SELECT uid,sum(expr_get) as expr_get  FROM adm_comissioner_child_expr_log {$this->_condition} GROUP BY uid $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }


        function num_rows()
        {
            $sql = "SELECT COUNT(DISTINCT(uid)) as num FROM adm_comissioner_child_expr_log {$this->_condition}";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch()['num'];
        }

        /**
         * @param array $cond
         * @param       $uid 当前登录的用户uid
         */
        function set_condition( $params , $uid )
        {

            $this->_condition = array();

            $this->_condition[] = " uid IN (SELECT uid FROM adm_users WHERE pid = $uid) ";

            if ( !empty( $params['time_start'] ) )
                $this->_condition[] = " create_time >= {$params['time_start']}";

            if ( !empty( $params['time_end'] ) )
                $this->_condition[] = " create_time <= {$params['time_end']}";

            if ( !empty( $params['vigrousExpLimit'] ) )
                $this->_condition[] = " expr_get >= {$params['vigrousExpLimit']}";

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }

        /**
         * 获取当前统计的累计经验值
         * @param $uid
         * @return mixed
         */
        function getCurrentExpr( $uid )
        {
            $sql = "SELECT expr_reach FROM adm_comissioner_child_expr_log WHERE uid = ? ORDER BY create_time DESC limit 1";
            $this->db->execute( $sql , array( $uid ) );

            return $this->db->fetch();
        }

    }