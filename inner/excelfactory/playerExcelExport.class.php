<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/6/4
     * Time: 上午10:06
     */

    namespace excelfactory;


    use core\DB;

    class PlayerExcelExport extends BaseExcelExport implements IExcelExport
    {

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        /**
         * 数据抓取类
         * @param httpRequest $request
         * @return array(Array $data ,Array $columnNames,Array $columnKeys)
         * 返回 (原数据数组$data,列中文名数组,列键名数组)
         */
        public function fetchData( Array $request )
        {
            $xfDb = new DB();
            $xfDb->init_db_from_config( 'xinfeng' );
            $sql = "SELECT a.user_id,a.login_name,a.regist_time,a.register_type,a.diamond,b.coins,b.coupon ,b.ticket  FROM xinfeng.xf_user a,game.profile b where a.user_id = b.user_id AND a.is_robot=0";
            $xfDb->execute( $sql );
            $data = $xfDb->fetch_all();
            foreach ( $data as &$d ) {
                $sql = "SELECT COUNT(*) as num,SUM(money) as money FROM xinfeng.xf_payment_order WHERE user_id = ? AND status = 1";
                $xfDb->execute( $sql , array( $d['user_id'] ) );
                $payorder = $xfDb->fetch();
                $d['pay_num'] = $payorder['num'];
                $d['pay_money'] = $payorder['money'];
                $d['regist_time'] = substr( $d['regist_time'] , 0 , 8 );
                unset( $d['user_id'] );
                usleep( 100 );
            }
            $columnNames = array(
                '用户名' , '注册时间' , '注册渠道' , '金币' , '钻石' , '奖券' , '门票' , '充值次数' , '充值金额'
            );

            $columnKeys = array(
                'login_name' , 'regist_time' , 'register_type' , 'coins' , 'diamond' , 'coupon' , 'ticket' , 'pay_num' , 'pay_money'
            );

            return array( $data , $columnNames , $columnKeys );
        }


    }