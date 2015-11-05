<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-10-14
     * Time: 上午9:48
     */

    namespace common\model;


    use common\XfModel;

    class ActivitiesModel extends XfModel
    {
        protected static $_instance = null;

        function lists( $start = null , $count = null , $order = 'DESC' )
        {
            $limit = '';
            if ( $start !== null && $count !== null )
                $limit = " LIMIT  $start,$count";

            $sql = "SELECT * FROM xf_platform_activities ORDER BY create_time $order  $limit";
            $this->db->execute( $sql );

            return $this->db->fetch_all();

        }

        function num_rows()
        {
            $sql = "SELECT COUNT(*) AS num  FROM xf_platform_activities";
            $this->db->execute( $sql );

            return $this->db->fetch()['num'];
        }


        function read( $id )
        {
            $sql = "SELECT * FROM  xf_platform_activities WHERE id = ? ";
            $this->db->execute( $sql , array( $id ) );

            return $this->db->fetch();
        }

        /**
         * @param int $calendarDate 时间戳
         * @return mixed
         */
        function readCalendarActivitiesByDate( $calendarDate )
        {
            $sql = "SELECT id,name FROM  xf_platform_activities WHERE calendar_date = ? ORDER BY create_time DESC limit 0,2";
            $this->db->execute( $sql , array( $calendarDate ) );

            return $this->db->fetch_all();
        }
    }