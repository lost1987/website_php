<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/2/2
     * Time: 下午5:10
     */

    namespace pms\model;


    use common\PmsModel;

    class ArticleCategory_M extends PmsModel
    {

        protected static $_instance = null;

        private $_condition = '';

        function lists()
        {
            $sql = "SELECT * FROM pms_articles_category";
            $this->db->execute( $sql );

            return $this->db->fetch_all();
        }
    }