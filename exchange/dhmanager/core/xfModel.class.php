<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/21
     * Time: 上午10:51
     */

    namespace dhmanager\core;


    use core\DB;
    use core\Model;

    class XfModel extends Model
    {
            function __construct(){
                if(empty($this->xfDB))
                {
                    $xfDB =  new DB();
                    $xfDB->init_db_from_config('xinfeng');
                    $this->bindProperty('xfDB',$xfDB);
                }
            }
    }