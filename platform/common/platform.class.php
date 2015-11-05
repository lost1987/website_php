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
        const CLIENT_ORIGIN_MOBILE_PLATFORM = 15;//平台手机端用户
        const CLIENT_ORIGIN_WEB_PLATFORM = 16;//网页平台端用户
        const CLIENT_APP_STORE = 17;//苹果客户端
        const CLIENT_CHINA_MOBILE = 18;//中国移动

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
                self::CLIENT_ORIGIN_MOBILE_PLATFORM => '平台手机端用户',
                self::CLIENT_APP_STORE => '苹果客户端',
                self::CLIENT_ORIGIN_WEB_PLATFORM => '网页平台端用户',
                self::CLIENT_CPS_OFFER99 => '易瑞特广告平台',
                self::CLIENT_CHINA_MOBILE => '中国移动客户端'
            );
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

                case 'mbplatform':
                    $platform = self::CLIENT_ORIGIN_MOBILE_PLATFORM;
                    break;

                case 'webplatform':
                    $platform = self::CLIENT_ORIGIN_WEB_PLATFORM;
                    break;

                case 'appstore':
                    $platform = self::CLIENT_APP_STORE;
                    break;

                case 'cm':
                    $platform = self::CLIENT_CHINA_MOBILE;
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
    }