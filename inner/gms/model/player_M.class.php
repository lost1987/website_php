<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/11/5
     * Time: 下午2:54
     */

    namespace gms\model;

    use common\model\UserModel_M;
    use gms\core\GameModel;

    class Player_M extends GameModel
    {

        private static $_instance = null;

        private $_condition = '';

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function read( $id )
        {
            $sql = "SELECT * FROM profile WHERE id = ?";
            $this->_game_server->execute( $sql , array( $id ) );

            return $this->_game_server->fetch();
        }

        function save( $fields )
        {
            return $this->_game_server->save( $fields , 'profile' );
        }

        function update( $fields , $id )
        {
            return $this->_game_server->update( $fields , 'profile' , "WHERE uid = $id" );
        }

        function del( $id )
        {
            $sql = "DELETE FROM profile WHERE id = ?";

            return $this->_game_server->execute( $sql , array( $id ) );
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

            $sql = "SELECT a.user_id,b.login_name,b.nickname,b.area,b.forbidden,b.diamond,b.user_number FROM game.profile a,xinfeng.xf_user b  {$this->_condition} ORDER BY b.regist_time  DESC  $limit";
            $this->_game_server->execute( $sql );
            $this->_condition = '';
            return  $this->_game_server->fetch_all();
        }


        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM profile  a LEFT JOIN xinfeng.xf_user b ON a.user_id = b.user_id  {$this->_condition}";
            $this->_game_server->execute( $sql );
            $this->_condition = '';

            return $this->_game_server->fetch()['num'];
        }

        /**
         * @param array $cond
         */
        function set_condition( $params )
        {
            $this->_condition = array();

            $this->_condition[] = ' a.user_id = b.user_id ';

            if ( !empty( $params['user_id'] ) )
                $this->_condition[] = " a.user_id = '{$params['user_id']}' ";

            if($params['user_flag'] != '' && intval($params['user_flag']) > -1)
                $this->_condition[] = " b.user_flag = {$params['user_flag']} ";

            if ( count( $this->_condition ) > 0 ) {
                $this->_condition = implode( ' AND ' , $this->_condition );
                $this->_condition = ' WHERE ' . $this->_condition;
            } else
                $this->_condition = '';

            return $this;
        }
    }