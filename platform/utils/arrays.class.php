<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/4/15
 * Time: 下午3:06
 */

namespace utils;

/**
 * 数组操作类
 * Class Arrays
 * @package utils
 */
class Arrays {

    /**
     *把 xml 转换成数组
     * @param type $xml
     * @return type
     */
    static function xml_to_array($xml){
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches)){
            $count = count($matches[0]);
            for($i = 0; $i < $count; $i++){
                $subxml= $matches[2][$i];
                $key = $matches[1][$i];
                if(preg_match( $reg, $subxml )){
                    $arr[$key] = self::xml_to_array( $subxml );
                }else{
                    $arr[$key] = $subxml;
                }
            }
        }
        return $arr;
    }

    /**
     * 将对象转换成数组
     * @param type $obj
     * @return type
     */
    static function objectToArray($obj){
        $_arr = is_object($obj) ? get_object_vars($obj) :$obj;
        foreach ($_arr as $key=>$val){
            $val = (is_array($val) || is_object($val)) ? self::objectToArray($val):$val;
            $_arr[$key] = $val;
        }
        return $_arr;
    }

    /**
     * 格式化数组 如果数组值中有数字则转换为整型 format
     * @param $list
     */
    static function std_array_format( $list )
    {
        if ( !is_array( $list ) )
            throw new \Exception( 'function:std_array_format ,arguments must be array' );

        foreach ( $list as &$item ) {
            if(is_array($item)){
                foreach($item as &$child){
                    if ( Tools::entry_int( $child ) )
                        $child = intval( $child );
                    else if ( Tools::entry_float( $child ) )
                        $child = floatval( $child );
                }
            }else{
                if ( Tools::entry_int( $item ) )
                    $item = intval( $item );
                else if ( Tools::entry_float( $item ) )
                    $item = floatval( $item );
            }
        }

        return $list;
    }


    /**
     * 格式化二维数组 如果数组值中有数字则转换为整型 format
     * @param $list
     */
    static function std_multi_array_format( $list )
    {
        if ( !is_array( $list ) )
            throw new \Exception( 'function:std_array_format ,arguments must be array' );

        foreach ( $list as &$item ) {
            foreach ( $item as &$iitem ) {
                if(is_array($iitem)){
                    foreach($iitem as &$child){
                        if ( Tools::entry_int( $child ) )
                            $child = intval( $child );
                        else if ( Tools::entry_float( $child ) )
                            $child = floatval( $child );
                    }
                }else {
                    if ( Tools::entry_int( $iitem ) )
                        $iitem = intval( $iitem );
                    else if ( Tools::entry_float( $iitem ) )
                        $iitem = floatval( $iitem );
                }
            }
        }

        return $list;
    }


    /**
     * 数组操作
     * 取二维数组中 $key=$value 的子数组
     * @param $key
     * @param $value
     * @param $array
     */
    static function array_fetch_child_by_key_value( $key , $value , $array )
    {
        $arr = null;
        foreach ( $array as $k => $v ) {
            if ( $v[ $key ] == $value ) {
                $arr = $v;
            }
        }

        return $arr;
    }


    /**
     * 数组操作
     * 将数组的所有值转化为string
     * 仅支持非对象数组 , 且数组将不会被转换
     * 支持1维和2维数组
     * @param $array
     * @return array
     */
    static function array_val_toString($array){
        foreach($array as $k1 => &$v1){
            if (is_array($v1)){
                foreach($v1 as $k2 => &$v2){
                    $v2 = strval($v2);
                }
            }else{
                $v1 = strval($v1);
            }
        }
        return $array;
    }

    /**
     * 数组操作
     * 条件 数组元素必须是对象 索引必须是数字
     * @param $key       对象key
     * @param $symbol    连接符号
     * @param $array
     * @return String
     * 将数组中指定对象key的值 , 进行符号连接,返回一个连接后的字符串
     */
    static function array_object_implode_values_by_key( $key , $symbol , $array )
    {
        $value_array = array();
        foreach ( $array as $obj ) {
            $value_array[] = $obj->$key;
        }

        return implode( $symbol , $value_array );
    }

    /**
     * 数组操作
     * 条件 数组元素必须是对象 索引必须是数字
     * @param $array
     * @return Array
     * 删除指定对象key的数组中value重复的值 ,并将这些不重复的值返回到一个数组中
     */
    static function array_object_delete_repeat_values_by_key( $key , $array )
    {
        $value_array = array();
        foreach ( $array as $obj ) {
            $value_array[] = $obj->$key;
        }

        return array_unique( $value_array );
    }

    /**
     * 数组操作
     * @param $index
     * @param $array
     * @return mixed
     * @throws OutOfRangeException
     * 删除下标为index的数组元素
     */
    static function array_delete_element( $index , $array )
    {
        if ( $index < 0 )
            throw new OutOfRangeException( 'index must be > 0' );
        unset( $array[ $index - 1 ] );

        return $array;
    }

    /**
     * 数组操作
     * @param $element  要插入的元素
     * @param $index    要插入的索引位置
     * @param $array    原始数组
     * @return array
     *                  将元素插入到$index的数组位置
     */
    static function array_insert_element( $element , $index , $array )
    {
        if ( $index < 0 )
            throw new OutOfRangeException( 'index must be > 0' );
        $next_array = array_slice( $array , $index - 1 );
        $pre_array = array_slice( $array , 0 , $index - 1 );
        $pre_array[] = $element;

        return array_merge( $pre_array , $next_array );
    }


    /**
     * 数组操作
     * 通过数组的值取得key(只能用于一维数组)
     * @param $value
     * @param $array
     */
    static function array_toggle_fetch_value( $value , $array )
    {
        $return_val = null;
        foreach ( $array as $k => $v ) {
            if ( $value == $v )
                $return_val = $k;
        }

        return $return_val;
    }

    /**
     * 数组操作
     * 对二维数组进行排序
     * 例如:
     * array(4) {
    [200] => array(2) {
    ["money"] => string(3) "200"
    ["newcoins"] => string(5) "60000"
    }
    [50] => array(2) {
    ["money"] => string(2) "50"
    ["newcoins"] => string(5) "50000"
    }
    [10] => array(2) {
    ["money"] => string(2) "10"
    ["newcoins"] => string(5) "10000"
    }
    [2] => array(2) {
    ["money"] => string(1) "2"
    ["newcoins"] => string(4) "5000"
    }
    }
     * array_multi_ksort('money',$multiArray,false);
     * @param      $keyName 二维数组中子元素的key
     * @param      $multiArray 二维数组
     * @param bool $asc 是否降序排列 默认降序
     * @return array
     */
    static function array_multi_ksort($keyName,$multiArray,$asc=true){
        $temp = array();
        foreach($multiArray as $k => $v){
            $temp[$v[$keyName]] = $v;
        }
        unset($multiArray);
        if($asc)
            ksort($temp);
        else
            krsort($temp);
        return $temp;
    }

    /**
     * 数组操作
     * 取数组下标从start 到 end条
     */
    static function array_fetch( $start , $limit , $array )
    {
        if ( !is_int( $start ) || !is_int( $limit ) ) {
            return;
        }

        $newarray = array();

        for ( $i = $start ; $i < $limit ; $i ++ ) {
            if ( !empty( $array[ $i ] ) )
                $newarray[] = $array[ $i ];
        }

        return $newarray;
    }
} 