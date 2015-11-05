<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/3/24
 * Time: 上午11:28
 */

namespace adm\model;


use core\Model;

class ComissionerApply_M extends Model{

    private static $_instance = null;

    static function instance()
    {
        if ( self::$_instance == null )
            self::$_instance = new self;

        return self::$_instance;
    }

    /**
     * @param null $start
     * @param null $count
     * @return mixed
     */
    function lists($start=null,$count=null){
        $limit = '';
        if($start !== null && $count !== null)
            $limit = " LIMIT $start , $count";

        $sql = "SELECT * FROM adm_comissioner_ratio_apply {$this->_condition}  $limit";
        $this->db->execute($sql);
        $this->_condition = '';
        return $this->db->fetch_all();
    }


    function childLists($start=null,$count=null){
        $limit = '';
        if($start !== null && $count !== null)
            $limit = " LIMIT $start , $count";

        $sql = "SELECT * FROM adm_comissioner_ratio_apply {$this->_childCondition}  $limit";
        $this->db->execute($sql);
        $this->_childCondition = '';
        return $this->db->fetch_all();
    }


    function num_rows(){
        $sql = "SELECT COUNT(*) as num FROM adm_comissioner_ratio_apply {$this->_condition}";
        $this->db->execute($sql);
        $this->_condition = '';
        return $this->db->fetch()['num'];
    }

    function num_rowsChild(){
        $sql = "SELECT COUNT(*) as num FROM adm_comissioner_ratio_apply {$this->_childCondition}";
        $this->db->execute($sql);
        $this->_childCondition = '';
        return $this->db->fetch()['num'];
    }

    /**
     * @param array $cond
     */
    function set_condition($params){
        $this->_condition = array();

        $this->_condition[] = ' type = 1 ';

        if(intval($params['search_comissioner']) > -1 && $params['search_comissioner'] != '')
            $this->_condition[] = " comissioner = {$params['search_comissioner']}";

        if(count($this->_condition)>0) {
            $this->_condition  =  implode(' AND ',$this->_condition);
            $this->_condition = ' WHERE ' . $this->_condition;
        }else
            $this->_condition = '';

        return $this;
    }


    /**
     * @param array $cond
     */
    function set_childCondition($params){
        $this->_childCondition = array();

        $this->_childCondition[] = ' type = 2 ';

        if(intval($params['search_comissioner']) > -1 && $params['search_comissioner'] != '')
            $this->_childCondition[] = " comissioner = {$params['search_comissioner']}";

        if(count($this->_childCondition)>0) {
            $this->_childCondition  =  implode(' AND ',$this->_childCondition);
            $this->_childCondition = ' WHERE ' . $this->_childCondition;
        }else
            $this->_childCondition = '';

        return $this;
    }


    function update($fields,$id){
        return $this->db->update($fields,'adm_comissioner_ratio_apply',' WHERE id = '.$id);
    }

}