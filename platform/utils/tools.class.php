<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: lost
     * Date: 13-1-5
     * Time: 上午11:34
     * 工具类
     */
    namespace utils;

    /**
     * 工具类
     */
    class Tools
    {
        /**
         * 用于非url地址加密
         * @param string $string    原文或者密文
         * @param string $operation 操作(ENCODE | DECODE), 默认为 DECODE
         * @param string $key       密钥
         * @param int    $expiry    密文有效期, 加密时候有效， 单位 秒，0 为永久有效
         * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
         * @example
         *                          $a = authcode('abc', 'ENCODE', 'key');
         *                          $b = authcode($a, 'DECODE', 'key');  // $b(abc)
         *
         *   $a = authcode('abc', 'ENCODE', 'key', 3600);
         *   $b = authcode('abc', 'DECODE', 'key'); // 在一个小时内，$b(abc)，否则 $b 为空
         */
        static function authcode( $string , $operation = 'DECODE' , $key = '' , $expiry = 0 )
        {
            $string = strval($string);
            if(empty($string))
                return '';
            switch($operation){
                case 'ENCODE' :$content = self::encrypt($string,$key);
                    break;

                case 'DECODE' :$content = self::decrypt($string,$key);
                    break;
            }
            return $content;
        }


        /**
         * 对称加密算法 - (加密)。
         *
         * @param string $s
         * @param string $secure_key
         * @return string
         */
        static function encrypt($s, $secure_key) {
            if (!extension_loaded('mcrypt'))
                throw new \Exception('Mcrypt extension not installed.');

            if (null == $s || !is_string($s))
                return false;

            $td      = mcrypt_module_open('tripledes', '', 'ecb', '');
            $td_size = mcrypt_enc_get_iv_size($td);
            $iv      = mcrypt_create_iv($td_size, MCRYPT_RAND);
            $key     = substr($secure_key, 0, $td_size);
            mcrypt_generic_init($td, $key, $iv);
            $ret     = base64_encode(mcrypt_generic($td, $s));
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);

            return $ret;
        }

        /**
         * 对称加密算法 - (解密)。
         *
         * @param string $s
         * @param string $secure_key
         * @return string
         */
        static function decrypt($s, $secure_key) {
            if (!extension_loaded('mcrypt'))
                throw new \Exception('Mcrypt extension not installed.');

            if (null == $s)
                return false;

            $td      = mcrypt_module_open('tripledes', '', 'ecb', '');
            $td_size = mcrypt_enc_get_iv_size($td);
            $iv      = mcrypt_create_iv($td_size, MCRYPT_RAND);
            $key     = substr($secure_key, 0, $td_size);
            mcrypt_generic_init($td, $key, $iv);
            $ret     = trim(mdecrypt_generic($td, base64_decode($s)));
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);

            return $ret;
        }


        /**
         * 是否是 ajax 请求
         * @return boolean
         */
        static function is_ajax_req()
        {
            if ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
                //如果是ajax请求
                return TRUE;
            }

            return FALSE;
        }


        /**
         * 获取客户端 ip
         * @return string
         */
        static function getip()
        {
            if ( !empty( $_SERVER["HTTP_CLIENT_IP"] ) ) {
                $cip = $_SERVER["HTTP_CLIENT_IP"];
            } elseif ( !empty( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
                $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } elseif ( !empty( $_SERVER["REMOTE_ADDR"] ) ) {
                $cip = $_SERVER["REMOTE_ADDR"];
            } else {
                $cip = "无法获取！";
            }

            return $cip;
        }

        /**
         * 获取服务器 ip
         * @return type
         */
        static function get_server_ip()
        {
            if ( isset( $_SERVER ) ) {
                if ( $_SERVER['SERVER_ADDR'] ) {
                    $server_ip = $_SERVER['SERVER_ADDR'];
                } else {
                    $server_ip = $_SERVER['LOCAL_ADDR'];
                }
            } else {
                $server_ip = getenv( 'SERVER_ADDR' );
            }

            return $server_ip;
        }

        /**
         * 创建文件
         * @param string $file_name
         * @param string $str
         */
        static function createfile( $file_name , $str )
        {
            $file_pointer = fopen( $file_name , "w" );
            fwrite( $file_pointer , $str );
            fclose( $file_pointer );
        }

        /**
         * 创建目录
         * @param  string $dir
         */
        static function createDir( $dir )
        {
            if ( !is_dir( $dir ) ) {
                mkdir( $dir , 0777 , true );
            }
        }

        /**
         * 取得指定目录下的所有子目录
         * @param $dir String  目录的路径最后需要加'/'
         */
        static function fetch_children_dir( $dir )
        {

            if ( !preg_match( '/.*\/$/i' , $dir ) ) {
                $dir = $dir . DIRECTORY_SEPARATOR;
            }

            $files_dirs = scandir( $dir );
            $dirnames = array();
            foreach ( $files_dirs as $dirname ) {
                if ( is_dir( $dir . $dirname ) && strpos( $dirname , '.' ) === false ) {
                    $dirnames[] = $dirname;
                }
            }

            return $dirnames;
        }

        /**
         * 检查 php 扩展是否开启
         * @param $extension_name  扩展的名称
         * @return true:开启 false: 未开启
         */
        static function check_extension_is_on( $extension_name )
        {
            $extensions = get_loaded_extensions();
            if ( in_array( $extension_name , $extensions ) )
                return TRUE;

            return FALSE;
        }

        /**
         * 读取CSV
         * @param $filename
         * @return array
         */
        static function getCSVdata( $filename )
        {
            $row = 1;//第一行开始
            if ( ( $handle = fopen( $filename , "r" ) ) !== false ) {
                while ( ( $dataSrc = fgetcsv( $handle ) ) !== false ) {
                    $num = count( $dataSrc );
                    for ( $c = 0 ; $c < $num ; $c ++ )//列 column
                    {
                        if ( $row === 1 )//第一行作为字段
                        {
                            $dataName[] = $dataSrc[ $c ];//字段名称
                        } else {
                            foreach ( $dataName as $k => $v ) {
                                if ( $k == $c )//对应的字段
                                {
                                    $data[ $v ] = $dataSrc[ $c ];
                                }
                            }
                        }
                    }
                    if ( !empty( $data ) ) {
                        $dataRtn[] = $data;
                        unset( $data );
                    }
                    $row ++;
                }
                fclose( $handle );

                return $dataRtn;
            }
        }

        /**
         * 计算命中率(用于概率计算)
         * @param $rate   0-1的小数
         * @param $num    如果传入$num则$num为计算出的1-100之间的一个数字
         * @return bool
         * @throws Exception
         */
        static function hitted( $rate , &$num = null )
        {
            if ( is_string( $rate ) )
                $rate = ( float ) $rate;

            if ( $rate > 1 )
                throw new Exception( '传入的概率值 $rate 必须是 0~1 之间的浮点数或整数(0|1)。' , - 1 );

            $r = 100 * $rate;
            $v = mt_rand( 1 , 100 );

            if ( !empty( $num ) )
                $num = $v;

            if ( $v <= $r )
                return true;

            return false;
        }


        /***
         * 将字符串输出到控制台tty
         * @param $message
         */
        static function debug_output( $message )
        {
            echo '[' . date( 'Y-m-d H:i:s' ) . ']     ' . $message . chr( 10 );
        }


        /**
         * 输出信息到错误日志
         * @param $class   string 类名
         * @param $func    string 方法名
         * @param $file    string 文件
         * @param $message string 信息
         * @param $e EXCEPTION 异常对象 默认为null
         */
        static function debug_log( $class , $func , $file , $message ,\Exception $e = null)
        {
            $str = chr( 10 );
            $str .= "class  :   $class" . chr( 10 );
            $str .= "func   :   $func" . chr( 10 );
            $str .= "file   :   $file" . chr( 10 );
            $str .= "message:   $message" . chr( 10 );
            if($e !== null){
                $str .= "exception code:  " .$e->getCode(). chr( 10 );
                $str .= "exception line:  " .$e->getLine(). chr( 10 );
                $str .= "exception message:  " .$e->getMessage(). chr( 10 );
                $str .= "exception trace:  " .$e->getTraceAsString(). chr( 10 );
            }
            error_log( $str );
        }

        /**
         * 将数组的键值输出至日志
         * @param array $array
         */
        static function debug_array_log( Array $array )
        {
            foreach ( $array as $k => $v ) {
                error_log( 'key : ' . $k . ' | value : ' . $v );
            }
            error_log( '------------------------DONE------------------------' );
        }

        /**
         * 格式化 var_dump
         * @param type $var
         * @param type $echo
         * @param type $label
         * @param type $strict
         * @return string
         */
        static function dump( $var , $echo = true , $label = null , $strict = true )
        {
            $label = ( $label === null ) ? '' : rtrim( $label ) . ' ';
            if ( !$strict ) {
                if ( ini_get( 'html_errors' ) ) {
                    $output = print_r( $var , true );
                    $output = "<pre>" . $label . htmlspecialchars( $output , ENT_QUOTES ) . "</pre><br/>";
                } else {
                    $output = $label . " : " . print_r( $var , true );
                }
            } else {
                ob_start();
                var_dump( $var );
                $output = ob_get_clean();
                if ( !extension_loaded( 'xdebug' ) ) {
                    $output = preg_replace( "/\]\=\>\n(\s+)/m" , "] => " , $output );
                    $output = '<pre>' . $label . htmlspecialchars( $output , ENT_QUOTES ) . '</pre><br/>';
                }
            }
            if ( $echo ) {
                echo( $output );

                return null;
            } else
                return $output;
        }


        /**
         * 身份证号码验证
         * site http://www.jbxue.com
         */
        static function is_valid_idCard($idcard){
            try{
                if(empty($idcard)){
                    return false;
                }
                $City = array(11=>"北京",12=>"天津",13=>"河北",14=>"山西",15=>"内蒙古",21=>"辽宁",22=>"吉林",23=>"黑龙江",31=>"上海",
                              32=>"江苏",33=>"浙江",34=>"安徽",35=>"福建",36=>"江西",37=>"山东",41=>"河南",42=>"湖北",43=>"湖南",44=>"广东",45=>"广西",
                              46=>"海南",50=>"重庆",51=>"四川",52=>"贵州",53=>"云南",54=>"西藏",61=>"陕西",62=>"甘肃",63=>"青海",64=>"宁夏",65=>"新疆",
                              71=>"台湾",81=>"香港",82=>"澳门",91=>"国外");
                $iSum = 0;
                $idCardLength = strlen($idcard);
                //长度验证
                if(!preg_match('/^\d{17}(\d|x)$/i',$idcard) and!preg_match('/^\d{15}$/i',$idcard))
                {
                    return false;
                }
                //地区验证
                if(!array_key_exists(intval(substr($idcard,0,2)),$City))
                {
                    return false;
                }
                // 15位身份证验证生日，转换为18位
                if ($idCardLength == 15)
                {
                    $sBirthday = '19'.substr($idcard,6,2).'-'.substr($idcard,8,2).'-'.substr($idcard,10,2);
                    $d = new \DateTime($sBirthday);
                    $dd = $d->format('Y-m-d');
                    if($sBirthday != $dd)
                    {
                        return false;
                    }
                    $idcard = substr($idcard,0,6)."19".substr($idcard,6,9);//15to18
                    $Bit18 = self::getVerifyBit($idcard);//算出第18位校验码
                    $idcard = $idcard.$Bit18;
                }
                // 判断是否大于2078年，小于1900年
                $year = substr($idcard,6,4);
                if ($year<1900 || $year>2078 )
                {
                    return false;
                }

                //18位身份证处理
                $sBirthday = substr($idcard,6,4).'-'.substr($idcard,10,2).'-'.substr($idcard,12,2);
                $d = new \DateTime($sBirthday);
                $dd = $d->format('Y-m-d');
                if($sBirthday != $dd)
                {
                    return false;
                }
                //身份证编码规范验证
                $idcard_base = substr($idcard,0,17);
                if(strtoupper(substr($idcard,17,1)) != self::getVerifyBit($idcard_base))
                {
                    return false;
                }else{
                    return true;
                }
            }catch (\Exception $e){
                return false;
            }
        }

        /**
         * 计算身份证校验码，根据国家标准GB 11643-1999
         */
        static function getVerifyBit($idcard_base)
        {
            if(strlen($idcard_base) != 17)
            {
                return false;
            }
            //加权因子
            $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
            //校验码对应值
            $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4','3', '2');
            $checksum = 0;
            for ($i = 0; $i < strlen($idcard_base); $i++)
            {
                $checksum += substr($idcard_base, $i, 1) * $factor[$i];
            }
            $mod = $checksum % 11;
            $verify_number = $verify_number_list[$mod];
            return $verify_number;
        }

        /**
         * 匹配正整数
         * @param $val
         */
        static function entry_int( $val )
        {
            $parttern = '/^(0|[1-9][0-9]*)$/';
            if ( preg_match( $parttern , $val ) )
                return true;

            return false;
        }


        /**
         * 匹配正浮点数
         * @param $val
         */
        static function entry_float( $val )
        {
            $parttern = '/^\d+(\.\d+)?$/';
            if ( preg_match( $parttern , $val ) )
                return true;

            return false;
        }

        /**
         * Luhn算法验证银行卡的有效性
         * @param $cardNo
         * @return bool
         */
        static function bankCardLuhn($cardNo){
            $cardChars = str_split(strrev($cardNo));
            $odd_sum = 0;
            $even_sum = 0;
            for($i = 0 ; $i <count($cardChars) ; $i++){
                if(($i+1) % 2 != 0){
                    //从卡号最后一位数字开始，逆向将奇数位(1、3、5等等)相加。
                    $odd_sum += $cardChars[$i];
                }else{
                    //从卡号最后一位数字开始，逆向将偶数位数字，先乘以2（如果乘积为两位数，则将其减去9），再求和
                    $temp = $cardChars[$i] * 2;
                    if($temp > 10)
                        $temp = $temp-9;
                    $even_sum += $temp;
                }
            }

            //将奇数位总和加上偶数位总和，结果应该可以被10整除。
            if( ($odd_sum + $even_sum) % 10 == 0)
                return true;
            else
                return false;
        }

        /**
         * 是否是手机端的请求
         * @return bool
         */
        static function is_mobile_request()
        {
            $_SERVER['ALL_HTTP'] = isset( $_SERVER['ALL_HTTP'] ) ? $_SERVER['ALL_HTTP'] : '';
            $mobile_browser = '0';
            if ( preg_match( '/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i' , strtolower( $_SERVER['HTTP_USER_AGENT'] ) ) )
                $mobile_browser ++;
            if ( ( isset( $_SERVER['HTTP_ACCEPT'] ) ) and ( strpos( strtolower( $_SERVER['HTTP_ACCEPT'] ) , 'application/vnd.wap.xhtml+xml' ) !== false ) )
                $mobile_browser ++;
            if ( isset( $_SERVER['HTTP_X_WAP_PROFILE'] ) )
                $mobile_browser ++;
            if ( isset( $_SERVER['HTTP_PROFILE'] ) )
                $mobile_browser ++;
            $mobile_ua = strtolower( substr( $_SERVER['HTTP_USER_AGENT'] , 0 , 4 ) );
            $mobile_agents = array(
                'w3c ' , 'acs-' , 'alav' , 'alca' , 'amoi' , 'audi' , 'avan' , 'benq' , 'bird' , 'blac' ,
                'blaz' , 'brew' , 'cell' , 'cldc' , 'cmd-' , 'dang' , 'doco' , 'eric' , 'hipt' , 'inno' ,
                'ipaq' , 'java' , 'jigs' , 'kddi' , 'keji' , 'leno' , 'lg-c' , 'lg-d' , 'lg-g' , 'lge-' ,
                'maui' , 'maxo' , 'midp' , 'mits' , 'mmef' , 'mobi' , 'mot-' , 'moto' , 'mwbp' , 'nec-' ,
                'newt' , 'noki' , 'oper' , 'palm' , 'pana' , 'pant' , 'phil' , 'play' , 'port' , 'prox' ,
                'qwap' , 'sage' , 'sams' , 'sany' , 'sch-' , 'sec-' , 'send' , 'seri' , 'sgh-' , 'shar' ,
                'sie-' , 'siem' , 'smal' , 'smar' , 'sony' , 'sph-' , 'symb' , 't-mo' , 'teli' , 'tim-' ,
                'tosh' , 'tsm-' , 'upg1' , 'upsi' , 'vk-v' , 'voda' , 'wap-' , 'wapa' , 'wapi' , 'wapp' ,
                'wapr' , 'webc' , 'winw' , 'winw' , 'xda' , 'xda-'
            );
            if ( in_array( $mobile_ua , $mobile_agents ) )
                $mobile_browser ++;
            if ( strpos( strtolower( $_SERVER['ALL_HTTP'] ) , 'operamini' ) !== false )
                $mobile_browser ++;
            // Pre-final check to reset everything if the user is on Windows
            if ( strpos( strtolower( $_SERVER['HTTP_USER_AGENT'] ) , 'windows' ) !== false )
                $mobile_browser = 0;
            // But WP7 is also Windows, with a slightly different characteristic
            if ( strpos( strtolower( $_SERVER['HTTP_USER_AGENT'] ) , 'windows phone' ) !== false )
                $mobile_browser ++;
            if ( $mobile_browser > 0 )
                return true;
            else
                return false;
        }

        static function exportCSV($filename,$data){
            header('content-type:text/csv');
            header("Content-Disposition:attachment;filename=".$filename);
            header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
            header('Expires:0');
            header('Pragma:public');
            echo $data;
        }
    }

    ?>