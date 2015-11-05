<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-10-14
     * Time: 上午9:48
     */

    namespace web\model;


    use core\DB;
    use core\Model;

    class ArticlesModel extends Model
    {

        private static $_instance = null;

        protected $db;

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

        function listsByCategory( $start = null , $count = null , $categoryId )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT  $start,$count";

            $sql = "SELECT a.*,b.category_name FROM gms_articles a LEFT JOIN gms_articles_category b ON a.category_id = b.id WHERE a.category_id = $categoryId ORDER BY a.publish_time DESC  $limit";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }

        /**
         * @param int   $start
         * @param int   $count
         * @param array $unEqualCategoryId
         * @return mixed
         */
        function lists( $start = null , $count = null , $unEqualCategoryId = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT  $start,$count";

            $category = '';
            if ( $unEqualCategoryId !== null ) {
                $unEqualCategoryId = implode( ',' , $unEqualCategoryId );
                $category = " WHERE  a.category_id not in ($unEqualCategoryId)";
            }

            $sql = "SELECT a.*,b.category_name FROM gms_articles a LEFT JOIN gms_articles_category b ON a.category_id = b.id $category ORDER BY a.publish_time DESC  $limit";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }

        function listsFlag( $flag , Array $unEqualCategoryId = null , $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT  $start,$count";

            $category = '';
            if ( $unEqualCategoryId !== null ) {
                $unEqualCategoryId = implode( ',' , $unEqualCategoryId );
                $category = " and a.category_id not in ($unEqualCategoryId)";
            }

            $sql = "SELECT a.*,b.category_name FROM gms_articles a LEFT JOIN gms_articles_category b ON a.category_id = b.id WHERE FIND_IN_SET('$flag',a.flag) > 0 $category ORDER BY a.publish_time DESC  $limit";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }

        function listsWithOutFlag( $flag , Array $unEqualCategoryId = null , $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT  $start,$count";

            $category = '';
            if ( $unEqualCategoryId !== null ) {
                $unEqualCategoryId = implode( ',' , $unEqualCategoryId );
                $category = " and a.category_id not in ($unEqualCategoryId)";
            }

            $sql = "SELECT a.*,b.category_name FROM gms_articles a LEFT JOIN gms_articles_category b ON a.category_id = b.id WHERE (a.flag is NULL or FIND_IN_SET('$flag',a.flag) = 0) $category ORDER BY a.publish_time DESC  $limit";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }

        function num_rows( $unEqualCategoryId = null )
        {
            $category = '';
            if ( $unEqualCategoryId !== null ) {
                $unEqualCategoryId = implode( ',' , $unEqualCategoryId );
                $category = " WHERE  category_id not in ($unEqualCategoryId)";
            }

            $sql = "SELECT COUNT(*) AS num  FROM gms_articles $category";
            $this->db->execute( $sql );

            return $this->db->fetch()['num'];
        }


        function read( $id )
        {
            $sql = "SELECT * FROM  gms_articles WHERE id = ? ";
            $this->db->execute( $sql , array( $id ) );

            return $this->db->fetch();
        }
    }