<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/24
     * Time: 15:03
     */

    namespace common;


    use core\DB;
    use core\Singleton;

    class PmsModel extends Singleton
    {
        function __construct(){
            if(!is_object($this->db) || $this->db->getDBName() != 'pms'){
                if(!empty($this->pmsDB))
                    $this->db = $this->pmsDB;
                else{
                    $this->db = new DB();
                    $this->db->init_db_from_config('pms');
                    $this->bindProperty('pmsDB',$this->db);
                }
            }
        }
    }