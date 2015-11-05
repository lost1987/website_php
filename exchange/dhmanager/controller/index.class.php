<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/8/11
     * Time: 上午9:45
     */

    namespace dhmanager\controller;


    use dhmanager\core\DhController;

    class Index extends DhController
    {
            function index(){
                $this->render('index.html');
            }
    }