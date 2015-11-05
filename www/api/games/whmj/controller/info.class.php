<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/26
     * Time: 上午11:08
     */

    namespace api\games\whmj\controller;


    use api\core\GameBase;

    class Info extends GameBase
    {
          function help(){
                $sql = "SELECT  help_image,guihua_image  FROM help WHERE id = 1";
                $this->_context->_gameDB->execute($sql);
                $result = $this->_context->_gameDB->fetch();
                $result['help_image'] = explode(',',$result['help_image']);
                $result['guihua_image'] = explode(',',$result['guihua_image']);
                $this->response($result);
          }
    }