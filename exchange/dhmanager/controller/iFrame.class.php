<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/11
     * Time: 上午9:35
     */

    namespace dhmanager\controller;


    use core\Cookie;
    use dhmanager\core\DhController;
    use dhmanager\libs\Navigator;

    class IFrame extends DhController
    {

        function main(){
            $this->tpl->display('right.html');
        }


        function left(){
            $this->_output_data['trees'] = Navigator::instance()->init();
            $this->render('left.html');
        }


        function top(){
            $this->_output_data['account'] = Cookie::instance()->userdata('account');
            $this->render('admin_top.html');
        }


    }