<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/18
     * Time: 下午3:19
     */

    namespace common;


    use core\DB;
    use core\Singleton;

    /**
     * 只实例化xinfeng库的model父类
     * Class XfModel
     * @package common
     */
    class XfModel extends Singleton
    {

        function __construct(){
            if(!is_object($this->db) || $this->db->getDBName() != 'xinfeng'){
                if(!empty($this->xfDB))
                    $this->db = $this->xfDB;
                else{
                    $this->db = new DB();
                    $this->db->init_db_from_config('xinfeng');
                    $this->bindProperty('xfDB',$this->db);
                }
            }
        }

    }