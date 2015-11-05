<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-8-15
     * Time: 下午6:58
     * 反射类扩展
     */

    namespace core;


    use ReflectionProperty;

    /**
     * 反射类 扩展于php内置的反射类 增加了直接获取常量属性的方法
     */
    class ReflectClass extends \ReflectionClass
    {

        /**
         * 通过过滤器获取类的属性
         * @param null $filter 过滤器 参照reflectProperty常量
         * @return array|null   如果返回数组 则数组每个元素都是ReflectionProperty对象实例
         */
        public function getProperties( $filter = null )
        {
            $properties = null;

            if ( $filter % 3 == 0 ) {
                switch ($filter) {
                    case 3 :
                        foreach ( parent::getProperties() as $property ) {
                            if ( !$property->isStatic() )
                                $properties[] = $property;
                        }
                        break;

                    default :
                        ;
                }
            } else {
                $properties = parent::getProperties( $filter );
            }

            return $properties;
        }

        /**
         * 设置反射取得的类对象实例的所有属性的值为null
         * @param null $filter 过滤器 参照reflectProperty常量
         * @param null $object 如果属性包含非静态属性的话 需要指定该反射类的对象实例
         */
        public function setPropertiesNull( $filter = null , $object = null )
        {
            $properties = $this->getProperties( $filter );
            foreach ( $properties as &$property ) {
                if ( !$property->isStatic() )
                    $property->setValue( $object , null );
                else
                    $property->setValue( null );
            }
        }

        //其实如果子类重写方法的参数和基类不一样，
        //只要给参数个默认值，使得编译器认为参数可以为空，
        //保持重写方法与基类方法的函数签名相同就可以了。
        //给参数加个默认值防止报警告 Declaration of should be compatible with that xxx
        public function getConstants($parttern=''){
           $consts =  parent::getConstants();
           if(strpos($parttern,'*') > -1){
               $find = str_replace('*','',$parttern);
               $constants = array();
               foreach($consts as $key => $val){
                    if(strpos($key,$find) > -1)
                        $constants[$key] = $val;
               }
           }else{
               $constants = array();
               foreach($consts as $key => $val){
                       $constants[$key] = $val;
               }
           }
            return $constants;
        }
    }