<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/10
     * Time: 下午2:41
     */

    namespace common\model;

    use core\DB;

    class GuideModel
    {

        private static $_instance = null;

        private $_condition = '';

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function __construct()
        {
            $this->db = new DB();
            $this->db->init_db_from_config( 'gms' );
        }

        function read( $id )
        {
            $sql = "SELECT images FROM gms_guide WHERE id = ?";
            $this->db->execute( $sql , array( $id ) );

            return $this->db->fetch();
        }

        function save( $fields )
        {
            return $this->db->save( $fields , 'gms_guide' );
        }

        function lists( $start = null , $count = null , $game_id )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT $start , $count";

            $time = time();

            if ( empty( $this->_condition ) )
                $this->_condition = " WHERE game_id = $game_id AND expired_time > $time";
            else
                $this->_condition .= " AND game_id = $game_id ";

            $sql = "SELECT name,images,squeue  FROM gms_guide  {$this->_condition}  ORDER BY create_time DESC $limit";
            $this->db->execute( $sql );
            $this->_condition = '';

            return $this->db->fetch_all();
        }

        function num_rows( $game_id )
        {

            if ( empty( $this->_condition ) )
                $this->_condition = " WHERE game_id = $game_id ";
            else
                $this->_condition .= " AND game_id = $game_id ";

            $sql = " SELECT COUNT(*) AS num FROM gms_guide {$this->_condition}";
            $this->db->execute( $sql );

            return $this->db->fetch()['num'];
        }

        function del( $id )
        {
            $sql = "DELETE FROM gms_guide WHERE id = ?";

            return $this->db->execute( $sql , array( $id ) );
        }
    }