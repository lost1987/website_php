<?php

/* excode_error.html */
class __TwigTemplate_1b684c4c062353bd9dc32ffbf8b78af31085e67af0ecd63e1f1f1f4d3da7aee9 extends Twig_Template
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
    button{
        border:1px black solid !important;
    }
    h2
    {
        color:rgb(156,232,236);
    }

</style>
<body>

<div class=\"container-fluid\">
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class=\"row\" style=\"margin-top:100px;\">
        <div class=\"col-xs-12 col-sm-12 col-md-12\">
            <form class=\"form-horizontal\" >
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <img src=\"/images/dh/excode_error.png\" />
                        <h2>出错了!</h2>
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <h2>";
        // line 139
        echo twig_escape_filter($this->env, (isset($context["err"]) ? $context["err"] : null), "html", null, true);
        echo "</h2><br/>
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
</html>";
    }

    public function getTemplateName()
    {
        return "excode_error.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 139,  28 => 8,  19 => 1,);
    }
}
