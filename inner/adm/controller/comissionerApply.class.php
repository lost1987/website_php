<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/3/24
 * Time: 上午10:46
 */

namespace adm\controller;


use adm\core\AdmAutoValidationController;
use adm\libs\AdmError;
use adm\libs\Comissioner;
use adm\model\ComissionerApply_M;
use adm\model\RewardRecharge_M;
use adm\model\RewardRechargeComissioner_M;
use adm\model\User_M;
use utils\Page;
use utils\Tools;

class ComissionerApply extends AdmAutoValidationController{

    function lists(){
        //初始化参数
        $page = intval($this->args[0]) <= 0 ? 1 : $this->args[0];
        $pagecount = 12;
        $start = ($page-1) *  $pagecount;

        //查询处理
        $search_params = $this->http_get_params();
        foreach($search_params as $k => $v){
            $this->output_data[$k] = $v;
        }

        //列表
        $list = ComissionerApply_M::instance()->set_condition($search_params)->lists($start,$pagecount);
        $state = array(
            0 => '待处理',
            1 => '已生效',
            2 => '已驳回'
        );
        foreach($list as &$item){
            //读取用户当前的返利比例
            $comissionerRechargeRatio = RewardRechargeComissioner_M::instance()->read($item['uid']);
            //获取当前阶段可提升最大的充值返利比例
            $childNum = User_M::instance()->userChildrenNumDirectly($item['uid']);
            list($curStage,$maxRatio) = Comissioner::instance()->getMaxStageRatio($childNum);
            $user = User_M::instance()->read($item['uid']);
            //获取一级下线的人数
            $item['childNum'] = User_M::instance()->userChildrenNumDirectly($item['uid']);
            $item['curStageRatio'] = $comissionerRechargeRatio['ratio_stage'.$curStage]*100 .'%';
            $item['reachableStageRatio'] = $maxRatio*100 .'%';
            $item['login_name'] = $user['login_name'];
            $item['nickname'] = $user['nickname'];
            $item['apply_time'] = date('Y-m-d H:i:s',$item['apply_time']);
            $item['handle_time'] = empty($item['handle_time']) ? '/' : date('Y-m-d H:i:s',$item['handle_time']);
            $item['stateName'] = $state[$item['state']];
        }

        //分页
        $num_rows = ComissionerApply_M::instance()->set_condition($search_params)->num_rows();
        $page_params = array(
            'total_rows'=>$num_rows, #(必须)
            'method'    =>'html', #(必须)
            'parameter' =>'/user/lists/?',  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows' =>$pagecount, #(可选) 默认为15
            'use_tag_li' => true,
            'li_classname' =>'am-active'
        );

        $pagiation = new Page($page_params);
        if($pagiation->getTotalPage() > 1)
            $this->output_data['pagiation'] = $pagiation->show(1);

        $this->output_data['list'] = $list;
        $this->output_data['total'] = $num_rows;

        //输出
        $content = $this->tpl->render( 'comissionerApply_list.html' , $this->output_data );
        $this->response($content);
    }

    function childList(){
        //初始化参数
        $page = intval($this->args[0]) <= 0 ? 1 : $this->args[0];
        $pagecount = 12;
        $start = ($page-1) *  $pagecount;

        //查询处理
        $search_params = $this->http_get_params();
        foreach($search_params as $k => $v){
            $this->output_data[$k] = $v;
        }

        //列表
        $list = ComissionerApply_M::instance()->set_childCondition($search_params)->childLists($start,$pagecount);
        $state = array(
            0 => '待处理',
            1 => '已生效',
            2 => '已驳回'
        );
        foreach($list as &$item){
            //读取用户当前的返利比例
            $comissionerRechargeRatio = RewardRecharge_M::instance()->read($item['uid']);
            //获取当前阶段可提升最大的充值返利比例
            list(,$maxRatio) = Comissioner::instance()->getMaxChildStageRatio($item['uid']);
            $user = User_M::instance()->read($item['uid']);
            $parent = User_M::instance()->read($user['pid']);
            //获取一级下线的人数
            $item['childNum'] = User_M::instance()->userChildrenNumDirectly($item['uid']);
            $item['curStageRatio'] = $comissionerRechargeRatio['ratio1']*100 .'%';
            $item['reachableStageRatio'] = $maxRatio*100 .'%';
            $item['login_name'] = $user['login_name'];
            $item['nickname'] = $user['nickname'];
            $item['apply_time'] = date('Y-m-d H:i:s',$item['apply_time']);
            $item['handle_time'] = empty($item['handle_time']) ? '/' : date('Y-m-d H:i:s',$item['handle_time']);
            $item['stateName'] = $state[$item['state']];
            $item['parent'] = $parent['login_name'];
        }

        //分页
        $num_rows = ComissionerApply_M::instance()->set_childCondition($search_params)->num_rowsChild();
        $page_params = array(
            'total_rows'=>$num_rows, #(必须)
            'method'    =>'html', #(必须)
            'parameter' =>'/user/lists/?',  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows' =>$pagecount, #(可选) 默认为15
            'use_tag_li' => true,
            'li_classname' =>'am-active'
        );

        $pagiation = new Page($page_params);
        if($pagiation->getTotalPage() > 1)
            $this->output_data['pagiation'] = $pagiation->show(1);

        $this->output_data['list'] = $list;
        $this->output_data['total'] = $num_rows;

        //输出
        $content = $this->tpl->render( 'comissionerApplyChild_list.html' , $this->output_data );
        $this->response($content);
    }

    function agree(){
        $id = $this->input->post('id');
        $uid = $this->input->post('uid');
        $childNum = User_M::instance()->userChildrenNumDirectly($uid);
        $fields = Comissioner::instance()->setMaxStageRatio($childNum);
        try{
            $this->db->begin();
            if(!RewardRechargeComissioner_M::instance()->update($fields,$uid))
                throw new \Exception(AdmError::DATA_WRITE);

            $fields = array(
                'state' => 1,
                'handle_time' => time()
            );
            if(!ComissionerApply_M::instance()->update($fields,$id))
                throw new \Exception(AdmError::DATA_WRITE);

            $this->db->commit();
            $this->response($fields);
        }catch (\Exception $e){
            $this->db->rollback();
            Tools::debug_log(__CLASS__,__FUNCTION__,__FILE__,'审核推广员奖励出错',$e);
            $this->response($e->getMessage());
        }
    }

    function disagree(){
        $id =  $this->input->post('id');
        $comment = $this->input->post('comment');
        $time = time();
        $fields = array(
            'state' => 2,
            'handle_time' => $time,
            'comment' => $comment
        );

        if(!ComissionerApply_M::instance()->update($fields,$id))
            $this->response(AdmError::DATA_WRITE);

        $fields['handle_time'] = date('Y-m-d H:i:s',$time);
        $this->response($fields);
    }

    function agreeChild(){
        $id = $this->input->post('id');
        $uid = $this->input->post('uid');
        list(,$ratio1) = Comissioner::instance()->getMaxChildStageRatio($uid);
        $fields = array(
            'ratio1' => $ratio1
        );
        try{
            $this->db->begin();
            if(!RewardRecharge_M::instance()->update($fields,$uid))
                throw new \Exception(AdmError::DATA_WRITE);

            $fields = array(
                'state' => 1,
                'handle_time' => time()
            );
            if(!ComissionerApply_M::instance()->update($fields,$id))
                throw new \Exception(AdmError::DATA_WRITE);

            $this->db->commit();
            $this->response($fields);
        }catch (\Exception $e){
            $this->db->rollback();
            Tools::debug_log(__CLASS__,__FUNCTION__,__FILE__,'审核推广员一级下线奖励出错',$e);
            $this->response($e->getMessage());
        }
    }

}