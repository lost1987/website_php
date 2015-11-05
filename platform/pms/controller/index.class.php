<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/28
     * Time: 上午9:19
     */
    namespace pms\controller;

    use pms\core\AdminController;

    /**
     * 登入后默认控制器
     * Class Index
     * @package pms\controller
     */
    class Index extends AdminController
    {

        function index()
        {
            $this->init_navigator();
            $this->render( 'index.html' );
        }
    }