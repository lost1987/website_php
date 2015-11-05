<?php

/* header.html */
class __TwigTemplate_896ce13da19e4539d85a80d9c6b66638e727b0a53ce8cc6af19f484405a073af extends Twig_Template
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
        echo "<nav class=\"navbar navbar-default topNav\" role=\"navigation\">
    <div class=\"container\">
        <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
                <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            ";
        // line 10
        if (((isset($context["index"]) ? $context["index"] : null) && ((isset($context["is_login"]) ? $context["is_login"] : null) == false))) {
            // line 11
            echo "            <a class=\"navbar-brand\" href=\"javascript:;\" onclick=\"changeToWhmj()\"><img src=\"";
            echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
            echo "/images/logo.png\" alt=\"\"></a>
            ";
        } else {
            // line 13
            echo "            <a class=\"navbar-brand\" href=\"/\"><img src=\"";
            echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
            echo "/images/logo_pt.png\" alt=\"\"></a>
            ";
        }
        // line 15
        echo "        </div>
        <div id=\"navbar\" class=\"navbar-collapse collapse\">
            ";
        // line 17
        if ((((isset($context["index"]) ? $context["index"] : null) == 0) && ((isset($context["is_login"]) ? $context["is_login"] : null) == 0))) {
            // line 18
            echo "            <a name=\"tops\"></a>
            <ul class=\"nav navbar-nav\">
                <li><a href=\"javascript:;\" id=\"login\">登陆</a>
                    <div class=\"loginPannel\" id=\"loginPannel\">
                        <form role=\"form\" action=\"/user/login\" method=\"post\" id=\"loginingForm\">
                            <div class=\"form-group mbn\">
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"><span class=\"icon icon-user\"></span></span>
                                    <input type=\"text\" class=\"form-control\" id=\"login_name\" placeholder=\"请输入账号/邮箱/手机号\">
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"><span class=\"icon icon-lock\"></span></span>
                                    <input type=\"password\" class=\"form-control\" id=\"temp_password\" placeholder=\"请输入密码\">
                                </div>
                            </div>
                            <p class=\"text-right font12\">
                                没有账号？<a href=\"/user/signup\" class=\"text-blue\">立即注册></a>
                            </p>
                            <button style=\"width:160px;margin-left:50px;\" type=\"button\" class=\"btn btn-block btn-lg btn-warning\" onclick=\"loginAjax()\">登&nbsp;&nbsp;陆</button>
                        </form>
                    </div>
                </li>
                <li><a href=\"/user/signup\">注册</a></li>
            </ul>
            <script src=\"";
            // line 44
            echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
            echo "/js/common/md5.min.js\"></script>
            <script>
                function loginAjax(){
                      var login_name =   \$(\"#login_name\").val();
                      var password = \$(\"#temp_password\").val();

                      if(login_name != '' || password != ''){
                          \$.post('/user/loginWithAjax','login_name='+login_name+'&password='+md5(password),function(data){
                              data = \$.parseJson(data);
                              if(data != 'error'){
                                    window.location.reload();
                              }
                          })
                          return;
                      }
                      \$.alert('请输入用户名和密码');
                }
            </script>
            ";
        }
        // line 63
        echo "            <ul class=\"nav navbar-nav\">
                ";
        // line 64
        if ((isset($context["is_login"]) ? $context["is_login"] : null)) {
            // line 65
            echo "                <li><a href=\"/userinfo\"><span class=\"text-org\">";
            echo twig_escape_filter($this->env, (isset($context["nickname"]) ? $context["nickname"] : null), "html", null, true);
            echo "</span> 您好！</a></li>
                <li><a href=\"/user/logout\"><span class=\"text-blue\">退出</span></a></li>
                ";
        }
        // line 68
        echo "            </ul>
            ";
        // line 69
        if ((isset($context["is_login"]) ? $context["is_login"] : null)) {
            // line 70
            echo "            <ul class=\"nav navbar-nav navbar-right\">
                <li class=\"active\"><a href=\"/\">首页</a></li>
                <li><a href=\"/service\">客服</a></li>
                <!--<li><a href=\"/store\">商城</a></li>-->
                <li><a href=\"/payment/prepare/0\">充值</a></li>
            </ul>
            ";
        } else {
            // line 77
            echo "                    ";
            if ((isset($context["index"]) ? $context["index"] : null)) {
                // line 78
                echo "                        <a class=\"navbar-brand\" style=\"margin-left:600px;\" href=\"javascript:;\" onclick=\"changeToPt()\"><img src=\"";
                echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
                echo "/images/logo_pt.png\" alt=\"\"></a>
                    ";
            }
            // line 80
            echo "            ";
        }
        // line 81
        echo "        </div><!--/.nav-collapse -->
    </div>
</nav>";
    }

    public function getTemplateName()
    {
        return "header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 81,  135 => 80,  126 => 77,  117 => 70,  112 => 68,  105 => 65,  100 => 63,  78 => 44,  50 => 18,  48 => 17,  38 => 13,  32 => 11,  30 => 10,  19 => 1,  183 => 64,  179 => 37,  176 => 36,  171 => 28,  167 => 21,  164 => 20,  159 => 12,  154 => 7,  149 => 6,  141 => 64,  137 => 63,  129 => 78,  119 => 54,  115 => 69,  110 => 50,  108 => 49,  101 => 45,  92 => 38,  89 => 36,  87 => 35,  84 => 34,  82 => 33,  75 => 28,  72 => 27,  64 => 22,  62 => 20,  51 => 15,  45 => 12,  37 => 7,  26 => 1,  576 => 276,  572 => 275,  568 => 274,  563 => 272,  559 => 271,  556 => 270,  553 => 269,  472 => 191,  462 => 187,  459 => 186,  455 => 185,  450 => 183,  439 => 174,  425 => 173,  420 => 170,  418 => 169,  405 => 168,  398 => 163,  395 => 162,  390 => 159,  387 => 158,  370 => 157,  366 => 155,  355 => 150,  351 => 149,  345 => 148,  339 => 145,  335 => 143,  331 => 142,  327 => 141,  320 => 136,  311 => 133,  308 => 132,  304 => 131,  300 => 130,  294 => 126,  279 => 124,  271 => 122,  263 => 120,  260 => 119,  243 => 118,  236 => 113,  234 => 112,  231 => 111,  228 => 110,  220 => 103,  213 => 99,  205 => 94,  199 => 91,  191 => 86,  178 => 75,  155 => 55,  146 => 48,  143 => 66,  136 => 43,  133 => 62,  127 => 38,  125 => 37,  118 => 36,  114 => 34,  107 => 32,  103 => 64,  97 => 28,  95 => 27,  90 => 25,  86 => 24,  80 => 22,  77 => 30,  73 => 20,  70 => 26,  68 => 18,  60 => 16,  57 => 18,  52 => 12,  49 => 11,  44 => 15,  41 => 7,  36 => 4,  33 => 6,);
    }
}
