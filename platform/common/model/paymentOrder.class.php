<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-9-26
     * Time: 下午4:03
     */

    namespace common\model;


    use core\Model;

    class PaymentOrder extends Model
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }


        function save( Array $fields )
        {
            return $this->db->save( $fields , 'xf_payment_order' );
        }


        function updateByOrderNo( Array $fields , $order_no )
        {
            return $this->db->update( $fields , 'xf_payment_order' , " WHERE order_no = '$order_no'" );
        }


        /**
         * 按日期查询充值
         * 只针对前台网站使用此方法
         * 其他情况不要用
         * @param        $uid
         * @param int    $start_time
         * @param int    $end_time
         * @param string $start
         * @param string $count
         * @return mixed
         */
        function searchByDate( $uid , $start_time , $end_time , $start = null , $count = null )
        {
            $limit = '';
            if ( $start !== null && $count !== null ) {
                $limit = " LIMIT  $start,$count";
            }

            $sql = "SELECT money as m,create_at as time FROM xf_payment_order WHERE user_id = ? and UNIX_TIMESTAMP(create_at) > ? and UNIX_TIMESTAMP(create_at) < ? and status = 1 ORDER BY create_at ASC $limit";
            $this->db->execute( $sql , array( $uid , $start_time , $end_time ) );

            return $this->db->fetch_all();
        }

        function searchByDateNums( $uid , $start_time , $end_time )
        {
            $sql = "SELECT count(*) as num FROM xf_payment_order WHERE user_id = ? and UNIX_TIMESTAMP(create_at) > ? and UNIX_TIMESTAMP(create_at) < ? and status = 1";
            $this->db->execute( $sql , array( $uid , $start_time , $end_time ) );

            return $this->db->fetch()['num'];
        }

        /**
         * 当前时间段 本次充值以前(不包含本次充值) 是否有充值
         * @param $uid
         * @param $orderNo 订单号
         * @param $start_time
         * @param $end_time
         * @return mixed
         */
        function rechargeNumsTodayExceptNow( $uid , $orderNo , $start_time , $end_time )
        {
            $sql = "SELECT count(*) as num FROM xf_payment_order WHERE user_id = ? and UNIX_TIMESTAMP(create_at) > ? and UNIX_TIMESTAMP(create_at) < ? and status = 1 and order_no <> '$orderNo'";
            $this->db->execute( $sql , array( $uid , $start_time , $end_time ) );

            return $this->db->fetch()['num'];
        }

        /**
         * 根据订单号获取一条信息
         * @param $order_no
         * @return mixed
         */
        function getByOrderNo( $order_no )
        {
            $sql = "SELECT * FROM xf_payment_order WHERE order_no = ?";
            $this->db->execute( $sql , array( $order_no ) );

            return $this->db->fetch();
        }

        /**
         * 根据uid获取他的充值记录数
         * @param $uid
         */
        function getNumsByUid( $uid )
        {
            $sql = "SELECT COUNT(*) as num FROM xf_payment_order WHERE user_id = ?";
            $this->db->execute( $sql , array( $uid ) );

            return $this->db->fetch()['num'];
        }
    }