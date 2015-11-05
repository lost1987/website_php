<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/26
     * Time: 14:28
     */

    namespace pms\controller;


    use core\Redirect;
    use pms\core\AdminController;
    use pms\libs\AdminUtil;
    use pms\libs\ModuleDictionary;
    use utils\Tools;

    /**
     * 游戏数据查询
     * Class GameData
     * @package pms\controller
     */
    class GameData extends AdminController
    {
        function query(){
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_DATA_QUERY );
            $this->init_navigator();
            $this->render('game_data_query.html');
        }

        function createCSV(){
            set_time_limit(300);
            AdminUtil::instance()->check_permission( ModuleDictionary::MODULE_GAME_DATA_QUERY );
            $sql = $this->input->sPost('sql');
            if(preg_match('/([ ]|\")UPDATE[ ].*/i',$sql) > 0)
                die('非法语句 UPDATE ');

            if(preg_match('/([ ]|\")INSERT[ ].*/i',$sql) > 0)
                die('非法语句 INSERT ');

            if(preg_match('/([ ]|\")DELETE[ ].*/i',$sql) > 0)
                die('非法语句 DELETE ');

            if(preg_match('/([ ]|\")TRUNCATE[ ].*/i',$sql) > 0)
                die('非法语句 TRUNCATE ');

            if(preg_match('/([ ]|\")DROP[ ].*/i',$sql) > 0)
                die('非法语句 DROP ');

            $this->db->execute($sql);
            $data = $this->db->fetch_all();
            $structSample = array();
            foreach($data[0] as $k => $v){
                $structSample[] = $k;
            }
            $fields = implode(',',$structSample)."\n";
            $content = '';
            foreach($data as $item){
                foreach($item as $k=>$v){
                    if(strpos($v,',') > -1)
                        $v = str_replace(',','#',$v);
                    $content .= iconv('UTF-8','GB2312',$v).',';

                }
                $content .= "\n";
            }
            $output = $fields.$content;
            Tools::exportCSV(time().'.csv',$output);
        }
    }