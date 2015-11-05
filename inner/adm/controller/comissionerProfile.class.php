<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/3/25
 * Time: 下午2:54
 */

namespace adm\controller;


use adm\core\AdmAutoValidationController;
use utils\Upload;

class ComissionerProfile extends AdmAutoValidationController{

    function uploadIDCard(){
        $upload = Upload::instance();
        $upload->set_allowed_ext(array('jpg','png','gif'));
        $upload->set_max_size(1048576);
        $upload->set_upload_folder('upload/idcard');
        $info = $upload->upload($_FILES['profile_idcard']);
        $this->response($info);
    }
} 