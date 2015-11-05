<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/17
     * Time: 上午10:38
     */

    namespace dhmanager\model;


    use core\Model;

    class ExchangeModel extends Model
    {
        private static $_instance = null;

        /**
         * @return  \dhmanager\model\ExchangeModel
         */
        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function lists( $start = null , $count = null )
        {
            $limit = '';
            if ( null !== $start && null !== $count ) {
                $limit = " limit $start,$count ";
            }
            $sql = "SELECT a.*,b.name as admin_name  FROM dh_exchange a  LEFT JOIN dh_admin b ON a.admin_id = b.id ORDER BY  a.create_time DESC $limit";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }

        function num_rows()
        {
            $sql = "SELECT COUNT(*) as num FROM dh_exchange ";
            $this->db->execute( $sql );

            return $this->db->fetch()['num'];
        }

        function analysis( $start = null , $count = null )
        {
            $limit = '';
            if ( null !== $start && null !== $count ) {
                $limit = " limit $start,$count ";
            }
            $sql = "SELECT
                          SUM(product_rmb) as rmb,
                          FROM_UNIXTIME(create_time,'%Y-%m-%d') as create_time
                           FROM
                           dh_exchange
                            GROUP BY
                            FROM_UNIXTIME(create_time,'%Y-%m-%d')
                            ORDER BY
                            create_time
                            DESC
                            $limit ";
            $this->db->execute( $sql );
            return $this->db->fetch_all();
        }

        function analysis_rows(){
            $sql = "SELECT COUNT(*) as num FROM dh_exchange GROUP BY  FROM_UNIXTIME(create_time,'%Y-%m-%d')";
            $this->db->execute($sql);
            return $this->db->fetch()['num'];
        }

        function totalRmb(){
            $sql = "SELECT SUM(product_rmb) as total FROM dh_exchange";
            $this->db->execute($sql);
            return $this->db->fetch()['total'];
        }
    }