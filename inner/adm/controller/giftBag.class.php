<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/2/6
 * Time: 上午11:24
 */

namespace adm\controller;


use adm\core\AdmAutoValidationController;
use adm\libs\AdmError;
use adm\model\GiftBag_M;
use core\Encoder;
use utils\Arrays;
use utils\Tools;

class GiftBag extends AdmAutoValidationController{

    function index(){
        $gifts = GiftBag_M::instance()->lists();
        $this->output_data['gifts'] = $gifts;
        $content = $this->tpl->render('gift.html',$this->output_data);
        $this->response($content);
    }

    function update(){
        //{c:金币数量,d:钻石数量,t:门票数量,cp:奖券数量,f:鲜花数量,e:鸡蛋数量,h:喇叭数量,r:包房卡数量,cwd:赢牌金币加倍卡数量,clh:输牌金币减半卡数量,ced:经验加倍卡}
        $post = $this->input->post();
        $id = $post['id'];
        unset($post['id']);
        $post = Arrays::std_array_format($post);
        $fields = array(
            'items' => Encoder::instance()->encode($post)
        );
        if(!GiftBag_M::instance()->update($fields,$id))
            $this->response(null,AdmError::DATA_WRITE);
        $this->response();
    }

} 