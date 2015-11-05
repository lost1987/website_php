<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/10
     * Time: 下午4:52
     */

    namespace web\controller;


    use common\model\PaymentOrder;
    use core\Controller;
    use core\Cookie;
    use core\Redirect;
    use cps\Platform;

    class Cps extends Controller
    {
        function index(){
            if(!$this->output_data['is_login'])
                Redirect::instance()->forward('/');

            $uid = Cookie::instance()->userdata('uid');
//                $sql = "SELECT platform_id  FROM xf_cps_user WHERE  user_id = ?";
//                $this->db->execute($sql,array($uid));
//                $cpsUser = $this->db->fetch();
//                $platform_id = $cpsUser['platform_id'];

//                $info = Platform::instance()->platformInfo($platform_id);
            $taskUrl = 'http://list.offer99.com/index.php?action=offerlist&pid=l422dd752933d06cb8f675a620e82859&userid='.$uid;
            $output['taskUrl'] = $taskUrl;
            $this->tpl->display('cps.html',$output);
        }
    }