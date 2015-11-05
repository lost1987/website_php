<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/4/15
     * Time: 下午3:05
     */

    namespace utils;

    /**
     * 字符串操作类
     * Class Strings
     * @package utils
     */
    class Strings
    {

        /**
         * 计算字符串的长度(包括中英数字混合情况)  长度计算和JS一样
         * @param        $str
         * @param string $charset
         * @return int
         */
        static function strlen_ex( $str , $charset = 'UTF-8' )
        {
            return iconv_strlen( $str , $charset );
        }

        /*
        *检测字符串是否由纯英文，纯中文，中英文混合组成
        * @param string
        * @return 1:纯英文;2:纯中文;3:中英文混合
        */
        static function check_string_type( $str = '' )
        {
            if ( trim( $str ) == '' ) {
                return '';
            }
            $m = mb_strlen( $str , 'utf-8' );
            $s = strlen( $str );
            if ( $s == $m ) {
                return 1;
            }
            if ( $s % $m == 0 && $s % 3 == 0 ) {
                return 2;
            }

            return 3;
        }


        /**
         * 简单的过滤字符串
         * @param  string $str
         * @return string
         */
        static function inputFilter( $str )
        {
            if ( empty( $str ) && intval( $str ) != 0 ) {
                return;
            }
            if ( $str == "" ) {
                return $str;
            }
            $str = trim( $str );
            $str = str_replace( "&" , "&amp;" , $str );
            $str = str_replace( ">" , "&gt;" , $str );
            $str = str_replace( "<" , "&lt;" , $str );
            $str = str_replace( chr( 32 ) , "&nbsp;" , $str );
            $str = str_replace( chr( 9 ) , "&nbsp;" , $str );
            $str = str_replace( chr( 34 ) , "&" , $str );
            $str = str_replace( chr( 39 ) , "&#39;" , $str );
            $str = str_replace( chr( 13 ) , "<br />" , $str );
            $str = str_replace( "'" , "''" , $str );
            $str = str_replace( "select" , "sel&#101;ct" , $str );
            $str = str_replace( "join" , "jo&#105;n" , $str );
            $str = str_replace( "union" , "un&#105;on" , $str );
            $str = str_replace( "where" , "wh&#101;re" , $str );
            $str = str_replace( "insert" , "ins&#101;rt" , $str );
            $str = str_replace( "delete" , "del&#101;te" , $str );
            $str = str_replace( "update" , "up&#100;ate" , $str );
            $str = str_replace( "like" , "lik&#101;" , $str );
            $str = str_replace( "drop" , "dro&#112;" , $str );
            $str = str_replace( "create" , "cr&#101;ate" , $str );
            $str = str_replace( "modify" , "mod&#105;fy" , $str );
            $str = str_replace( "rename" , "ren&#097;me" , $str );
            $str = str_replace( "alter" , "alt&#101;r" , $str );
            $str = str_replace( "cast" , "ca&#115;" , $str );

            return $str;
        }

        /**
         * 替换字符串中某些字符为$replaceTo
         * @param $sourceString
         * @param $replaceTo
         */
        static function entry_string( $sourceString , $replaceTo )
        {
            if ( strlen( $sourceString ) < 6 )
                return $sourceString;

            $idx = strlen( $sourceString ) / 3;
            $a = str_split( $sourceString );
            for ( $i = 0 ; $i < count( $a ) ; $i ++ ) {
                if ( $i > $idx && $i < count( $a ) - $idx ) {
                    $a[ $i ] = $replaceTo;
                }
            }

            return implode( '' , $a );
        }

        /**
         * 验证是否是全中文汉子
         * @param $str
         * @return bool
         */
        static function is_chinese( $str )
        {
            if ( preg_match( "/^[\x{4e00}-\x{9fa5}]+$/u" , $str ) )
                return true;
            else
                return false;
        }

        /**
         * 验证手机格式是否正确
         * @param $mobile
         * @return bool
         */
        static function is_mobile( $mobile )
        {
            if ( preg_match( "/^(13[0-9]{9})|(15[0|1|2|3|5|6|7|8|9]\d{8})|(18[0|1|2|3|4|5|6|7|8|9]\d{8})$/" , $mobile ) ) {
                //验证通过
                return true;
            } else {
                //手机号码格式不对
                return false;
            }
        }

        /**
         * 加*手机号或电话号码
         * @param $phone
         */
        static function entry_phone( $phone )
        {
            return substr( $phone , 0 , 3 ) . '*****' . substr( $phone , 8 , strlen( $phone ) );
        }

        static function entry_email( $email )
        {
            return preg_replace( '/(.{3})(.*)/i' , '***$2' , $email );
        }


        /**
         * 验证email 地址格式
         * @param $email
         * @return bool
         */
        static function isValidEmail( $email )
        {
            $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
            if ( preg_match( $pattern , $email ) )
                return true;

            return false;
        }

        /**
         * 将str 的每个字母 转换成ascii 再转成16进制
         * 只支持英文 结果类似如下
         * \x30\x31\x32\x33\
         */
        static function strtoAscii16( $str )
        {
            if ( !is_string( $str ) ) return null;
            $asciis = array();
            for ( $i = 0 ; $i < strlen( $str ) ; $i ++ ) {
                $asciis[] = '\x' . dechex( ord( $str[ $i ] ) );
            }

            return implode( $asciis );
        }

        /**
         * 将类似 \x30\x31\x32\x33\ 这类字符转换成 10进制的字符串
         * 过程: 以上为例 30,31,32,33 都是16进制
         * 将他们先转为10进制然后再用ascii码来换成字符
         * 再连接起来就是结果
         * @param $x16
         * @return null|string
         */
        static function ascii16toStr( $x16 )
        {
            if ( !is_string( $x16 ) ) return null;
            $charlist = explode( '\x' , $x16 );
            $str = array();
            foreach ( $charlist as $char ) {
                if ( empty( $char ) ) continue;
                $str[] = chr( hexdec( $char ) );
            }

            return implode( $str );
        }


        /**
         * 生成 a-z0-9 随机组成的字符串
         * @param  int $length     生成的字符串长度
         * @param bool $onlyNumber 是否只生成数字
         * @return string
         */
        static function make_rand_str( $length = 18 , $onlyNumber = false )
        {
            // 密码字符集，可任意添加你需要的字符
            if ( $onlyNumber ) {
                $chars = array( '0' , '1' , '2' , '3' , '4' , '5' , '6' , '7' , '8' , '9' );
            } else {
                $chars = array( 'a' , 'b' , 'c' , 'd' , 'e' , 'f' , 'g' , 'h' ,
                    'i' , 'j' , 'k' , 'l' , 'm' , 'n' , 'o' , 'p' , 'q' , 'r' , 's' ,
                    't' , 'u' , 'v' , 'w' , 'x' , 'y' , 'z' , 'A' , 'B' , 'C' , 'D' ,
                    'E' , 'F' , 'G' , 'H' , 'I' , 'J' , 'K' , 'L' , 'M' , 'N' , 'O' ,
                    'P' , 'Q' , 'R' , 'S' , 'T' , 'U' , 'V' , 'W' , 'X' , 'Y' , 'Z' ,
                    '0' , '1' , '2' , '3' , '4' , '5' , '6' , '7' , '8' , '9' );
            }

            // 在 $chars 中随机取 $length 个数组元素键名
            $keys = array_rand( $chars , $length );
            $password = '';
            for ( $i = 0 ; $i < $length ; $i ++ ) {
                // 将 $length 个数组元素连接成字符串
                $password .= $chars[ $keys[ $i ] ];
            }

            return $password;
        }

        static function daddslashes( $string , $force = 1 )
        {
            if ( is_array( $string ) ) {
                foreach ( $string as $key => $val ) {
                    unset( $string[ $key ] );
                    $string[ addslashes( $key ) ] = daddslashes( $val , $force );
                }
            } else {
                $string = addslashes( $string );
            }

            return $string;
        }


        /**
         * 替换中文的UTF8字符串
         * @param $parttern
         * @param $replacement
         * @param $str
         * @return string
         */
        static function utf8_parttern_replace( $parttern , $replacement , $str )
        {
            $default = mb_regex_encoding();
            if ( strtolower( mb_regex_encoding() ) != 'utf-8' ) {
                mb_regex_encoding( 'UTF-8' );
            }
            $result = mb_ereg_replace( $parttern , $replacement , $str );
            mb_regex_encoding( $default );

            return $result;
        }

        /**
         * 截取中文的UTF8字符串
         * @param $str
         * @param $start
         * @param $len
         * @return string
         */
        static function utf8_substr( $str , $start , $len )
        {
            $default = mb_internal_encoding();
            if ( strtolower( mb_internal_encoding() ) != 'utf-8' ) {
                mb_internal_encoding( 'UTF-8' );
            }
            $result = mb_substr( $str , $start , $len );
            mb_internal_encoding( $default );

            return $result;
        }

        /**
         * 计算utf-8字符串的字节数
         * @param $str
         * @return int
         */
        static function utf8_strlen( $str )
        {
            $count = 0;
            for ( $i = 0 ; $i < strlen( $str ) ; $i ++ ) {
                $value = ord( $str[ $i ] );
                if ( $value > 127 ) {
                    $count ++;
                    if ( $value >= 192 && $value <= 223 ) $i ++;
                    elseif ( $value >= 224 && $value <= 239 ) $i = $i + 2;
                    elseif ( $value >= 240 && $value <= 247 ) $i = $i + 3;
                    else die( 'Not a UTF-8 compatible string' );
                }
                $count ++;
            }

            return $count;
        }

        /**
         * 分割字符串为数组 并且设置格式化数组的值
         * @param string $separator
         * @param string $string
         * @param int    $type int|string
         * @return array
         */
        static function explode( $separator , $string , $type = 'string' )
        {
            $array = explode( $separator , $string );
            if ( $type == 'int' ) {
                foreach ( $array as $k => $v ) {
                    $array[ $k ] = intval( $v );
                }
            }

            return $array;
        }
    }