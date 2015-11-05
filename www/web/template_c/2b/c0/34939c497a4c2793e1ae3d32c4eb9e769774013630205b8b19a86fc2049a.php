<?php

/* excode.html */
class __TwigTemplate_2bc034939c497a4c2793e1ae3d32c4eb9e769774013630205b8b19a86fc2049a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\">
    <title>购物券兑换</title>
    <!-- Bootstrap core CSS -->
    <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/css/bootstrap.min.css\" rel=\"stylesheet\">
    <script src=\"/js/common/md5.min.js\" ></script>
</head>
<style>
    /*媒体查询适配小屏幕**/
    @media screen and (min-width:0px) and (max-width:768px){
            .control-label{
                line-height: 30px;/**修正小屏幕label上下无法对齐**/
            }
    }

    @media screen and (min-width:0px) and (max-width:768px){
        .title{
                width: 200px;
        }

        input
        {
            height:40px !important;
            width: 200px;
            margin-top:5px !important;
            font-size:14px;
            margin-bottom: 10px;
        }

        button{
            width: 160px;
            height: 59px;
            margin-top:25px;
        }

        .btn{
            font-size: 18px !important;
        }

        .kefu{
            margin-top:40px;
            color:white;
        }

        .qq{
            color:white;
        }
    }

    @media screen and (min-width:768px) and (max-width:1080px){
        .title{
            width: 300px;
        }

        input
        {
            height:40px !important;
            width: 400px;
            margin-top:15px !important;
            font-size:20px;
            margin-bottom: 10px;
        }

        button{
            width: 160px;
            height: 59px;
            margin-top:80px;
        }

        .btn{
            font-size: 24px !important;
        }

        .kefu{
            margin-top:100px;
            color:white;
        }

        .qq{
            color:white;
        }
    }

    @media screen and (min-width:1080px) and (max-width:3080px){
        .title{
            width: 300px;
        }

        input
        {
            height:50px !important;
            width: 400px;
            margin-top:10px !important;
            font-size:20px;
            margin-bottom: 10px;
        }

        button{
            width: 160px;
            height: 59px;
            margin-top:10px !important;
            font-size:24px;
            margin-bottom: 10px;
        }

        .btn{
            font-size: 24px !important;
        }

        .kefu{
            margin-top:150px;
            color:white;
        }

        .qq{
            color:white;
        }
    }
    body{
        background-color: #006d8a;
    }

</style>
<body>

<div class=\"container-fluid\">
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class=\"row\" style=\"margin-top:30px;\">
                <div class=\"col-xs-4 col-sm-4 col-md-4 \"> </div>
                <div class=\"col-xs-4 col-sm-4 col-md-4 \" style=\"text-align: center\"><img src=\"/images/dh/title.png\" class=\"title\"/></div>
                <div class=\"col-xs-4 col-sm-4 col-md-4\"> </div>
    </div>
    <div class=\"row\" style=\"margin-top:30px;\">
        <div class=\"col-xs-12 col-sm-12 col-md-12\">
           <form class=\"form-horizontal\" action=\"/ex/excodeExec\" method=\"post\" id=\"_form\">
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" class=\"form-control\" name=\"excode\" id=\"excode\" placeholder=\"您的兑换码\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                    <input type=\"password\" class=\"form-control\" name=\"password\" id=\"password\" placeholder=\"您的新蜂消费密码\" />
                     <input type=\"hidden\" name=\"pp\" id=\"pp\"/>
                    </div>
                </div>
               <div class=\"form-group\">
                   <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center;color:white\">
                          ";
        // line 152
        echo twig_escape_filter($this->env, (isset($context["err"]) ? $context["err"] : null), "html", null, true);
        echo "
                   </div>
               </div>
               <div class=\"form-group\"></div>
               <div class=\"form-group\"></div>
               <div class=\"form-group\"></div>
               <div class=\"form-group\"></div>
               <div class=\"form-group\"></div>
               <div class=\"form-group\"></div>
                <div class=\"form-group\">
                    <div class=\"col-md-2   col-md-offset-5\" style=\"text-align: center\">
                        <button type=\"button\" onclick=\"doSubmit()\" class=\"btn btn-default btn-block\">兑换</button>
                    </div>
                </div>
               <div class=\"form-group\">
                   <div class=\" kefu\" style=\"text-align: center\">
                            客服电话:17092775719
                   </div>
               </div>
               <div class=\"form-group\">
                   <div class=\"  qq\" style=\"text-align: center\">
                       QQ:3148250047
                   </div>
               </div>
            </form>
        </div>
    </div>
</div>

</body>
<script>
    function doSubmit() {
        var excode = document.getElementById('excode').value.replace(/\\s+/g, '');
        if (excode == '')
        {
            alert('请输入兑换码');
            return;
        }

        var password = document.getElementById('password').value.replace(/\\s+/g,'');
        if(password == ''){
            alert('请输入消费密码');
            return;
        }

        document.getElementById('pp').value = md5(password);
        document.getElementById('_form').submit();
    }
</script>
</html>";
    }

    public function getTemplateName()
    {
        return "excode.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 152,  28 => 8,  19 => 1,);
    }
}
