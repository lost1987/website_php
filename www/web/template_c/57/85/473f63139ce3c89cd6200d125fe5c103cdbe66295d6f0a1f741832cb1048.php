<?php

/* excode_select.html */
class __TwigTemplate_5785473f63139ce3c89cd6200d125fe5c103cdbe66295d6f0a1f741832cb1048 extends Twig_Template
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
    <title>购物券兑换-选择兑换方式</title>
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
            margin-top:6px;
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
            width: 320px;
            height: 59px;
            margin-top:50px;
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
            width: 400px;
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
                    <h2>您的兑换码已经认证成功!</h2>
                    <small>您兑换的商品为: ";
        // line 135
        echo twig_escape_filter($this->env, (isset($context["pn"]) ? $context["pn"] : null), "html", null, true);
        echo "</small><br/>
                    <small>本平台提供代金券回购服务,您可以直接领取现金</small><br/>
                    <small>回购标准为面值90%</small><br/>
                </div>
                <div class=\"col-xs-4 col-sm-4 col-md-4\"> </div>
    </div>
    <div class=\"row\" style=\"margin-top:30px;\">
        <div class=\"col-xs-12 col-sm-12 col-md-12\">
           <form class=\"form-horizontal\"  action=\"/ex/select_done/1\" method=\"post\" id=\"_form1\">
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <button type=\"button\" onclick=\"document.getElementById('_form1').submit();\" class=\"btn btn-default btn-block\">支付宝提现</button>
                    </div>
                </div>
               <input type=\"hidden\" name=\"excode\" value=\"";
        // line 149
        echo twig_escape_filter($this->env, (isset($context["excode"]) ? $context["excode"] : null), "html", null, true);
        echo "\" />
               <input type=\"hidden\" name=\"pp\" value=\"";
        // line 150
        echo twig_escape_filter($this->env, (isset($context["password"]) ? $context["password"] : null), "html", null, true);
        echo "\" />
            </form>
            <form class=\"form-horizontal\" action=\"/ex/select_done/2\" method=\"post\" id=\"_form2\" >
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <button type=\"button\" onclick=\"document.getElementById('_form2').submit();\"   class=\"btn btn-default btn-block\">银行卡提现</button>
                    </div>
                </div>
                <input type=\"hidden\" name=\"excode\" value=\"";
        // line 158
        echo twig_escape_filter($this->env, (isset($context["excode"]) ? $context["excode"] : null), "html", null, true);
        echo "\" />
                <input type=\"hidden\" name=\"pp\" value=\"";
        // line 159
        echo twig_escape_filter($this->env, (isset($context["password"]) ? $context["password"] : null), "html", null, true);
        echo "\" />
             </form>
            <form class=\"form-horizontal\" action=\"/ex/select_done/3\" method=\"post\" id=\"_form3\">
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <button type=\"button\" onclick=\"document.getElementById('_form3').submit();\"   class=\"btn btn-default btn-block\">领取代金券</button>
                    </div>
                </div>
                <input type=\"hidden\" name=\"excode\" value=\"";
        // line 167
        echo twig_escape_filter($this->env, (isset($context["excode"]) ? $context["excode"] : null), "html", null, true);
        echo "\" />
                <input type=\"hidden\" name=\"pp\" value=\"";
        // line 168
        echo twig_escape_filter($this->env, (isset($context["password"]) ? $context["password"] : null), "html", null, true);
        echo "\" />
              </form>
            <form class=\"form-horizontal\" >
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


</script>
</html>";
    }

    public function getTemplateName()
    {
        return "excode_select.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  209 => 168,  205 => 167,  194 => 159,  190 => 158,  179 => 150,  175 => 149,  158 => 135,  28 => 8,  19 => 1,);
    }
}
