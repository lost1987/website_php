<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/1/5
     * Time: 下午2:39
     */

    namespace common;


    class Platform
    {
        //注册端渠道
        const CLIENT_ORIGIN_MOBILE = 1;
        const CLIENT_ORIGIN_WEB = 2;
        const CLIENT_WEIBO = 3;
        const CLIENT_360 = 4;
        const CLIENT_BAIDU = 5;
        const CLIENT_HUAWEI = 6;
        const CLIENT_XIAOMI = 7;
        const CLIENT_MEIZU = 8;
        const CLIENT_LENOVO = 9;
        const CLIENT_OPPO = 10;
        const CLIENT_KUPAI = 11;
        const CLIENT_WEIXIN = 12;
        const CLIENT_APKMAO = 13;//应用猫
        const CLIENT_CPS_OFFER99 = 14;//易瑞特广告平台

        //充值平台
        const RECHARGE_APLIPAY = 1;
        const RECHARGE_CHINABANK = 2;
        const RECHARGE_APPSTORE = 3;
        const RECHARGE_QIHU = 4;
        const RECHARGE_BAIDU = 5;
        const RECHARGE_HUAWEI = 6;
        const RECHARGE_XIAOMI = 7;
        const RECHARGE_MEIZU = 8;
        const RECHARGE_LENOVO = 9;
        const RECHARGE_OPPO = 10;
        const RECHARGE_KUPAI = 11;
        const RECHARGE_APKMAO = 12;

        private static $_instance = null;

        static function instance()
        {
            if ( self::$_instance == null )
                self::$_instance = new self;

            return self::$_instance;
        }

        function getClientPlatforms()
        {
            return array(
                self::CLIENT_ORIGIN_WEB    => '原版网页端' ,
                self::CLIENT_ORIGIN_MOBILE => '原版手机客户端' ,
                self::CLIENT_360           => '360手机客户端' ,
                self::CLIENT_BAIDU         => '百度手机客户端' ,
                self::CLIENT_HUAWEI        => '华为手机客户端' ,
                self::CLIENT_WEIBO         => '微博端' ,
                self::CLIENT_XIAOMI        => '小米手机客户端' ,
                self::CLIENT_MEIZU         => '魅族手机客户端' ,
                self::CLIENT_LENOVO        => '联想手机客户端' ,
                self::CLIENT_OPPO          => 'OPPO手机客户端' ,
                self::CLIENT_KUPAI         => '酷派手机客户端' ,
                self::CLIENT_WEIXIN        => '微信端' ,
                self::CLIENT_APKMAO        => '应用猫',
                self::CLIENT_CPS_OFFER99 => '易瑞特'
            );
        }

        function getRechargePlatforms()
        {
            return array(
                self::RECHARGE_APLIPAY   => '支付宝' ,
                self::RECHARGE_APPSTORE  => '苹果APPSTORE' ,
                self::RECHARGE_BAIDU     => '百度客户端充值' ,
                self::RECHARGE_CHINABANK => '网银充值' ,
                self::RECHARGE_HUAWEI    => '华为客户端充值' ,
                self::RECHARGE_QIHU      => '360客户端充值' ,
                self::RECHARGE_XIAOMI    => '小米手机客户端' ,
                self::RECHARGE_MEIZU     => '魅族手机客户端' ,
                self::RECHARGE_LENOVO    => '联想手机客户端' ,
                self::RECHARGE_OPPO      => 'OPPO手机客户端' ,
                self::RECHARGE_KUPAI     => '酷派手机客户端' ,
                self::RECHARGE_APKMAO    => '应用猫手机客户端'
            );
        }

        function getRechargeType( $orderNo )
        {
            list( $orderNoPrefix , ) = explode( '_' , $orderNo );
            switch ($orderNoPrefix) {
                case '360':
                    $rechargeType = self::RECHARGE_QIHU;
                    break;

                case 'bd':
                    $rechargeType = self::RECHARGE_BAIDU;
                    break;

                case 'hw':
                    $rechargeType = self::RECHARGE_HUAWEI;
                    break;

                case 'xiaomi':
                    $rechargeType = self::RECHARGE_XIAOMI;
                    break;


                case 'meizu':
                    $rechargeType = self::RECHARGE_MEIZU;
                    break;


                case 'lenovo':
                    $rechargeType = self::RECHARGE_LENOVO;
                    break;


                case 'oppo':
                    $rechargeType = self::RECHARGE_OPPO;
                    break;

                case 'coolpad':
                    $rechargeType = self::RECHARGE_KUPAI;
                    break;

                case 'apkmao':
                    $rechargeType = self::RECHARGE_APKMAO;
            }

            return $rechargeType;
        }

        /**
         * 根据充值订单号 返回充值的平台渠道
         * @param $orderNo
         * @return int
         */
        function getRechargePlatform( $orderNo )
        {
            list( $orderNoPrefix , ) = explode( '_' , $orderNo );
            switch ($orderNoPrefix) {
                case 'web':
                    $platform = self::CLIENT_ORIGIN_WEB;
                    break;

                case 'mb':
                    $platform = self::CLIENT_ORIGIN_MOBILE;
                    break;

                case '360':
                    $platform = self::CLIENT_360;
                    break;

                case 'bd':
                    $platform = self::CLIENT_BAIDU;
                    break;

                case 'hw':
                    $platform = self::CLIENT_HUAWEI;
                    break;

                case 'xiaomi':
                    $platform = self::CLIENT_XIAOMI;
                    break;


                case 'meizu':
                    $platform = self::CLIENT_MEIZU;
                    break;


                case 'lenovo':
                    $platform = self::CLIENT_LENOVO;
                    break;


                case 'oppo':
                    $platform = self::CLIENT_OPPO;
                    break;

                case 'coolpad':
                    $platform = self::CLIENT_KUPAI;
                    break;

                case 'apkmao':
                    $platform = self::CLIENT_APKMAO;
                    break;

                default:
                    $platform = self::CLIENT_ORIGIN_WEB;
                    break;
            }

            return $platform;
        }

        /**
         * 从第三方(非专门的运营平台)同步登录获得登录平台 如微博,微信等
         */
        function getPlatformFromThird( $prefix )
        {
            switch ($prefix) {
                case 'wb':
                    $platform = self::CLIENT_WEIBO;
                    break;
                case 'wx':
                    $platform = self::CLIENT_WEIXIN;
                    break;
                default:
                    $platform = self::CLIENT_WEIBO;
                    break;
            }

            return $platform;
        }

        /**
         * anysdk专用判断平台渠道来源
         * @param $userSdk
         * @return int
         */
        function getPlatformFromAnySdk( $userSdk )
        {
            switch ($userSdk) {
                case '360':
                    $platform = self::CLIENT_360;
                    break;

                case 'bdyouxi':
                    $platform = self::CLIENT_BAIDU;
                    break;

                case 'huawei':
                    $platform = self::CLIENT_HUAWEI;
                    break;

                case 'baidu':
                    $platform = self::CLIENT_BAIDU;
                    break;

                case 'xiaomi':
                    $platform = self::CLIENT_XIAOMI;
                    break;


                case 'meizu':
                    $platform = self::CLIENT_MEIZU;
                    break;

                case 'lenovo':
                    $platform = self::CLIENT_LENOVO;
                    break;

                case 'oppo':
                    $platform = self::CLIENT_OPPO;
                    break;

                case 'coolpad':
                    $platform = self::CLIENT_KUPAI;
                    break;

                default:
                    $platform = self::CLIENT_ORIGIN_WEB;
                    break;
            }

            return $platform;
        }

        function getRechargePlatformByOrderPrefix( $orderNo )
        {
            list( $orderNoPrefix , ) = explode( '_' , $orderNo );
            switch ($orderNoPrefix) {
                case '360':
                    $rechargeType = '360手机客户端';
                    break;

                case 'bd':
                    $rechargeType = '百度手机客户端';
                    break;

                case 'hw':
                    $rechargeType = '华为手机客户端';
                    break;

                case 'xiaomi':
                    $rechargeType = '小米手机客户端';
                    break;


                case 'meizu':
                    $rechargeType = '魅族手机客户端';
                    break;


                case 'lenovo':
                    $rechargeType = '联想手机客户端';
                    break;


                case 'oppo':
                    $rechargeType = 'oppo手机客户端';
                    break;

                case 'coolpad':
                    $rechargeType = '酷派手机客户端';
                    break;

                case 'apkmao':
                    $rechargeType = 'apk猫手机客户端';
                    break;
                case 'mb':
                    $rechargeType = '原版手机客户端';
                    break;
                default:
                    $rechargeType = '网页端';
            }

            return $rechargeType;
        }

    }