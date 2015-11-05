<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/3/25
 * Time: 上午11:10
 */

namespace uad\controller;


use core\Cookie;
use uad\core\UadAutoValidationController;
use uad\libs\UadError;
use uad\model\ComissionerApply_M;
use uad\model\ComissionerNewCoinsChange_M;
use uad\model\RewardRechargeComissioner_M;
use uad\model\User_M;
use uad\model\UserExprLog_M;
use utils\Date;
use utils\Page;

class Comissioner extends UadAutoValidationController{

    function __construct(){
        parent::__construct();
        if(!\uad\libs\Comissioner::instance()->isComissioner())
            $this->response(null,UadError::FORBBIDEN_OPERATION);
    }

    function index(){
        $comissioner = \uad\libs\Comissioner::instance();
        $uid = Cookie::instance()->userdata('uad_uid');
        $maxRatio = array(
            'ratio_stage0'=> $comissioner::MAX_RATIO_STATE_0,
            'ratio_stage10' => $comissioner::MAX_RATIO_STATE_10,
            'ratio_stage30' => $comissioner::MAX_RATIO_STATE_30,
            'ratio_stage60' => $comissioner::MAX_RATIO_STATE_60,
            'ratio_stage100' => $comissioner::MAX_RATIO_STATE_100,
        );

        //取出当前的充值返现比例
        $curRatio = RewardRechargeComissioner_M::instance()->read($uid);
        //取出用户的1级下线数量
        $childNum = User_M::instance()->userChildrenNumDirectly($uid);
        $states = array(
            0=>'待处理',
            1=>'已批准',
            2=>'已驳回'
        );
        //取出用户自己的奖励申请状态
        $selfApply = ComissionerApply_M::instance()->getLastApply($uid);
        if(empty($selfApply)) {
            $selfApply['stateName'] = '-';
            $upButtonDisabled = false;
        }else{
            $selfApply['stateName'] = $states[$selfApply['state']];
            $upButtonDisabled = true;
            if($childNum > 9 && intval($selfApply['state']) != 0)
                $upButtonDisabled = false;
        }



        //查询今日活跃的下线数量
        $time = Date::instance()->monthTimeStampSE();
        $params['time_start'] = $time['start'];
        $params['time_end'] = $time['end'];
        $days = ( ($params['time_end']-$params['time_start'])/60*60*24 ) >> 0;

        $params['vigrousExpLimit'] = 200*$days;//达到活跃的经验阀值
        $this->output_data['virgousNum'] = UserExprLog_M::instance()->set_condition($params,$uid)->num_rows();
        unset($time,$params,$days);


        //初始化参数
        $page = intval($this->args[0]) <= 0 ? 1 : $this->args[0];
        $pagecount = 12;
        $start = ($page-1) *  $pagecount;

        $month = intval(date('m'));
        $year = intval(date('Y'));
        if($month == 1) {
            $month = 12;
            $year -= 1;
        }
        else
            $month -= 1;
        $params['change_time'] = mktime(0,0,0,$month,1,$year);
        $params['uid'] = $uid;

        $nickname = $this->input->get('nickname');
        if(!empty($nickname)) {
            $child = User_M::instance()->readByNickName( $nickname );
            $params['from_uid'] = $child['uid'];
        }

        $comissionerNewCoinsChangeList = ComissionerNewCoinsChange_M::instance()->set_condition($params)->lists($start,$pagecount);
        $comissionerNewCoinsChangeNumRows = ComissionerNewCoinsChange_M::instance()->set_condition($params)->num_rows();

        foreach($comissionerNewCoinsChangeList as &$item){
            $temp = User_M::instance()->read($item['from_uid']);
            $item['nickname'] = $temp['nickname'];
            $apply = ComissionerApply_M::instance()->getLastApply($item['from_uid']);
            if(!empty($apply) && $apply['state'] == 0)
                $item['childApplyBtnDisabled']  = 'disabled';
        }

        $page_params = array(
            'total_rows'=>$comissionerNewCoinsChangeNumRows, #(必须)
            'method'    =>'html', #(必须)
            'parameter' =>'/comissioner/index/?',  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows' =>$pagecount, #(可选) 默认为15
            'use_tag_li' => true,
            'li_classname' =>'am-active'
        );

        $this->output_data['list'] = $comissionerNewCoinsChangeList;
        $this->output_data['num_rows'] = $comissionerNewCoinsChangeNumRows;
        $pagiation = new Page($page_params);
        if($pagiation->getTotalPage() > 1)
            $this->output_data['pagiation'] = $pagiation->show(1);

        $this->output_data['nickname'] = $nickname;
        $this->output_data['maxRatio'] = $maxRatio;
        $this->output_data['curRatio'] = $curRatio;
        $this->output_data['childNum'] = $childNum;
        $this->output_data['selfApply'] = $selfApply;
        $this->output_data['upButtonDisabled'] = $upButtonDisabled ?  'disabled="true"' : '';
        $this->output_data['uid'] = $uid;
        $content = $this->tpl->render('comissioner.html',$this->output_data);
        $this->response($content);
    }


    function ratioApply(){
        $uid = $this->input->post('uid');
        $type = $this->input->post('type');
        $time = time();

        $fields = array(
            'uid' => $uid,
            'state' => 0,
            'apply_time' => $time,
            'type' => $type
        );

        if(!ComissionerApply_M::instance()->save($fields))
            $this->response(null,UadError::DATA_WRITE);

        $this->response();
    }


    function vigrousChildren(){

        //初始化参数
        $page = intval($this->args[0]) <= 0 ? 1 : $this->args[0];
        $pagecount = 12;
        $start = ($page-1) *  $pagecount;

        //查询处理
        $search_params = $this->http_get_params();
        foreach($search_params as $k => $v){
            $this->output_data[$k] = $v;
        }

        $time = Date::instance()->monthTimeStampSE();
        $search_params['time_start'] = $time['start'];
        $search_params['time_end'] = $time['end'];
        $days = ( ($search_params['time_end']-$search_params['time_start'])/60*60*24 ) >> 0;

        $vigrousExpLimit = 200*$days;//达到活跃的经验阀值

        $uid = Cookie::instance()->userdata('uad_uid');
        $list = UserExprLog_M::instance()->set_condition($search_params,$uid)->lists($start,$pagecount);
        $num_rows = UserExprLog_M::instance()->set_condition($search_params,$uid)->num_rows();


        foreach($list as &$item){
            $item['virgous'] = '否';
            if($item['expr_get'] >= $vigrousExpLimit)
                $item['virgous'] = '是';

            $user = User_M::instance()->read($item['uid']);
            $item['nickname'] = $user['nickname'];
            $item['create_time'] = date('Y-m-d',$user['create_time']);
            $exprLog = UserExprLog_M::instance()->getCurrentExpr($item['uid']);
        }

        $page_params = array(
            'total_rows'=>$num_rows, #(必须)
            'method'    =>'html', #(必须)
            'parameter' =>'/comissioner/vigrousChildren/?',  #(必须)
            'now_page'  =>$page,  #(必须)
            'list_rows' =>$pagecount, #(可选) 默认为15
            'use_tag_li' => true,
            'li_classname' =>'am-active'
        );

        $this->output_data['list'] = $list;
        $this->output_data['num_rows'] = $num_rows;
        $pagiation = new Page($page_params);
        if($pagiation->getTotalPage() > 1)
            $this->output_data['pagiation'] = $pagiation->show(1);

        $content = $this->tpl->render('vigrous_children.html',$this->output_data);
        $this->response($content);
    }

}