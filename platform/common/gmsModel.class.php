<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/24
     * Time: 14:55
     */

    namespace common;


    use core\DB;
    use core\Singleton;

    class GmsModel extends Singleton
    {
        function __construct(){
            if(!is_object($this->db) || $this->db->getDBName() != 'gms'){
                if(!empty($this->gmsDB))
                    $this->db = $this->gmsDB;
                else{
                    $this->db = new DB();
                    $this->db->init_db_from_config('gms');
                    $this->bindProperty('gmsDB',$this->db);
                }
            }
        }
    }