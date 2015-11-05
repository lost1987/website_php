<?php

/* excode_alipay.html */
class __TwigTemplate_7ffb47e6bda8b3a31dc0dde2e74aa854eb3ac5bdba2179a791e8e637f6b568be extends Twig_Template
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
    <title>购物券兑换-支付宝提现</title>
    <!-- Bootstrap core CSS -->
    <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/css/bootstrap.min.css\" rel=\"stylesheet\">
    <script src=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/jquery.min.js\" ></script>
    <script src=\"";
        // line 10
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/jquery.ext.js\" ></script>
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
            margin-top:10px !important;
            font-size:20px;
            margin-bottom: 10px;
        }

        button{
            width: 160px;
            height: 59px;
            margin-top:40px;
        }

        .btn{
            font-size: 24px !important;
        }

        .kefu{
            margin-top:50px;
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
        <div class=\"col-xs-4 col-sm-4 col-md-4 \" style=\"text-align: center;color:rgb(156,232,236)\">
            <h2>请填写您的收款信息</h2>
        </div>
        <div class=\"col-xs-4 col-sm-4 col-md-4\"> </div>
    </div>
    <div class=\"row\" style=\"margin-top:30px;\">
        <div class=\"col-xs-12 col-sm-12 col-md-12\">
            <form class=\"form-horizontal\" action=\"/ex/excodeValidate\" method=\"post\" id=\"_form\">
                <input type=\"hidden\" value=\"";
        // line 141
        echo twig_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : null), "html", null, true);
        echo "\" name=\"type\" />
                <input type=\"hidden\" value=\"";
        // line 142
        echo twig_escape_filter($this->env, (isset($context["pp"]) ? $context["pp"] : null), "html", null, true);
        echo "\" name=\"pp\" />
                <input type=\"hidden\" value=\"";
        // line 143
        echo twig_escape_filter($this->env, (isset($context["excode"]) ? $context["excode"] : null), "html", null, true);
        echo "\" name=\"excode\" />
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"alipay_account\"  id=\"alipay_account\" class=\"form-control\" placeholder=\"请输入您的支付宝帐号\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"alipay_account_again\" id=\"alipay_account_again\" class=\"form-control\" placeholder=\"请再次输入您的支付宝帐号\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"alipay_name\"  id=\"alipay_name\" class=\"form-control\" placeholder=\"收款人姓名\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"mobile\" id=\"mobile\" class=\"form-control\" placeholder=\"手机号\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"qq\" id=\"qq\" class=\"form-control\" placeholder=\"QQ号\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center;color:white\">

                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-2   col-md-offset-5\" style=\"text-align: center\">
                        <button type=\"button\" class=\"btn btn-default btn-block\" onclick=\"doSubmit()\">提交</button>
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"kefu\" style=\"text-align: center\">
                        客服电话:17092775719
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"qq\" style=\"text-align: center\">
                        QQ:3148250047
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    function doSubmit(){
            var alipay_account = document.getElementById('alipay_account').value.replace(/\\s+/g,'');
            if(alipay_account == '')
            {
                alert('请输入正确的支付宝帐号');
                return;
            }else if(!\$.is_email(alipay_account)  &&  !\$.is_mobile(alipay_account)){
                alert('请输入正确的支付宝帐号');
                return;
            }

            var alipay_account_again = document.getElementById('alipay_account_again').value.replace(/\\s+/g,'');
            if(alipay_account_again == '')
            {
                alert('请再次输入支付宝帐号');
                return;
            }

            if(alipay_account != alipay_account_again){
                alert('两次输入的支付宝帐号不一致');
                return;
            }

            var alipay_name = document.getElementById('alipay_name').value.replace(/\\s+/g,'');
            if(alipay_name == '')
            {
                alert('请输入收款人姓名');
                return;
            }
            var mobile = document.getElementById('mobile').value.replace(/\\s+/g,'');
            if(mobile == '' || !\$.is_mobile(mobile))
            {
                alert('请输入手机号');
                return;
            }
            var qq = document.getElementById('qq').value.replace(/\\s+/g,'');
            if(qq == '')
            {
                alert('请输入qq号');
                return;
            }

            document.getElementById('_form').submit();
    }
</script>
</html>";
    }

    public function getTemplateName()
    {
        return "excode_alipay.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 143,  174 => 142,  170 => 141,  36 => 10,  32 => 9,  28 => 8,  19 => 1,);
    }
}
