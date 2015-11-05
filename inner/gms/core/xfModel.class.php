<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/18
     * Time: 上午10:25
     */

    namespace gms\core;


    use core\DB;

    class XfModel
    {

        protected $db = null;

        function __construct()
        {
            if ( empty( $this->_xfDB ) ) {
                $this->db = new DB();
                $this->db->init_db_from_config( 'xinfeng' );
            } else {
                $this->db = $this->_xfDB;
            }
        }

    }