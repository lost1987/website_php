<?php

/* index.html */
class __TwigTemplate_ca0421d37ab181b918b88304b0bdcea8a4d9a2f4882c2c3b2407bdc3c8e61229 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("baseMain.html");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'banner' => array($this, 'block_banner'),
            'content' => array($this, 'block_content'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "baseMain.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "武汉麻将
";
    }

    // line 7
    public function block_keywords($context, array $blocks = array())
    {
        // line 8
        echo "武汉麻将
";
    }

    // line 11
    public function block_description($context, array $blocks = array())
    {
        // line 12
        echo "武汉麻将
";
    }

    // line 15
    public function block_banner($context, array $blocks = array())
    {
        // line 16
        echo "<div class=\"banner01\" ";
        if ((isset($context["is_login"]) ? $context["is_login"] : null)) {
            echo "style=\"background:url('../images/banner04.png') center no-repeat #0D1955\"";
        }
        echo ">
    <div class=\"container\">
        <div class=\"loginPanel\" ";
        // line 18
        if ((isset($context["is_login"]) ? $context["is_login"] : null)) {
            echo "style=\"left:700px;\"";
        }
        echo ">
            ";
        // line 19
        if (((isset($context["is_login"]) ? $context["is_login"] : null) != 1)) {
            // line 20
            echo "            <div class=\"panel-heading\">
                <center>一个账号，双平台通用</center>
            </div>
            ";
        } else {
            // line 24
            echo "            <div class=\"panel-heading\" style=\"padding:0px 0px;height:53px;background: rgba(0,0,0,.5) !important\">
                <div  style=\"border:solid black 1px;border-bottom-color:rgb(163,217,0);width: 160px;height:53px; !important;text-align: center;float:left;line-height:53px;\">武汉麻将</div>
                <div style=\"width: 160px;height:53px; !important;text-align: center;float:left;line-height:53px;background: rgba(0,0,0,.5)\" ><a href=\"";
            // line 26
            echo twig_escape_filter($this->env, twig_constant("PLATFORM_HOST"), "html", null, true);
            echo "\" >游戏平台</a></div>
            </div>
            ";
        }
        // line 29
        echo "            <div class=\"panel-body\">
                ";
        // line 30
        if (((isset($context["is_login"]) ? $context["is_login"] : null) != 1)) {
            // line 31
            echo "                <form role=\"form\" id=\"loginForm\" class=\"p35 in\" method=\"post\" action=\"/user/login\">
                    <fieldset>
                        <div class=\"form-group\">
                            <div class=\"input-group\">
                                <span class=\"input-group-addon\"><span class=\"icon icon-userW\"></span></span>
                                <input type=\"text\" class=\"form-control\" id=\"login_name\" name=\"login_name\" placeholder=\"用户名/邮箱/手机号\">
                                <input type=\"hidden\" value=\"";
            // line 37
            echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : null), "html", null, true);
            echo "\" name=\"csrf_token\" />
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"input-group\">
                                <span class=\"input-group-addon\"><span class=\"icon icon-lockW\"></span></span>
                                <input type=\"password\" class=\"form-control\" name=\"source_password\" id=\"source_password\">
                                <input type=\"hidden\" class=\"form-control\" name=\"password\" id=\"password\">
                                <input type=\"hidden\" id=\"login_type\" name=\"login_type\" />
                            </div>
                        </div>
                        <p class=\"text-right font12\">
                            <span style=\"float:left;color:RGB(255,183,60)\" id=\"errorAlert\">用户名或密码错误</span>
                            <a href=\"/user/password/1\">忘记密码？</a>
                        </p>
                        <button type=\"button\" onclick=\"login()\" class=\"btn btn-warning btn-block mb10\" >登陆</button>
                        <div>更多登陆方式<a href=\"/weibo/sina/login\"> <span class=\"icon icon-sina\"></span></a><a href=\"/user/signup\" class=\"pull-right text-org\">立即注册</a></div>
                    </fieldset>
                </form>
                ";
        } else {
            // line 57
            echo "                <form>
                    <div class=\"form-group\" style=\"display:none\">
                        <div class=\"input-group\">
                            <span class=\"input-group-addon\"><span class=\"icon icon-lockW\"></span></span>
                            <input type=\"password\" class=\"form-control\" name=\"\" id=\"\">
                        </div>
                    </div>
                </form>
                <div id=\"afterLogin\" class=\"afterLogin\">
                    <div class=\"p35 clearfix\">
                        <span class=\"info\"><span class=\"uName\">";
            // line 67
            echo twig_escape_filter($this->env, (isset($context["nickname"]) ? $context["nickname"] : null), "html", null, true);
            echo "</span> 您好！<a href=\"/user/logout\" class=\"text-blue\" id=\"exitBtn\">退出</a></span><a href=\"/game/enter\" class=\"btn btn-sm btn-success pull-right\">进入游戏</a>
                    </div>
                    <div class=\"p35 bg-black\">
                        <div class=\"row\">
                            <div class=\"col-xs-6\">
                                <p>金币：";
            // line 72
            echo twig_escape_filter($this->env, (isset($context["coins"]) ? $context["coins"] : null), "html", null, true);
            echo "</p>
                                <p>胜率：";
            // line 73
            echo twig_escape_filter($this->env, (isset($context["ratio"]) ? $context["ratio"] : null), "html", null, true);
            echo "</p>
                            </div>
                            <div class=\"col-xs-6\">
                                <p>钻石：";
            // line 76
            echo twig_escape_filter($this->env, (isset($context["diamond"]) ? $context["diamond"] : null), "html", null, true);
            echo "</p>
                                <p>等级：<span class=\"text-blue\" >";
            // line 77
            echo twig_escape_filter($this->env, (isset($context["vip_level"]) ? $context["vip_level"] : null), "html", null, true);
            echo "</span></p>
                            </div>
                        </div>
                    </div>
                    <div class=\"p10 mt5\">
                        <ul class=\"nav nav-tabs nav-justified\">
                            <li><a href=\"/userinfo\"><span class=\"icon icon-user-org\"></span>账号中心</a></li>
                            <li><a href=\"/payment/prepare/0\"><span class=\"icon icon-charge-org\"></span>立即充值</a></li>
                            <li><a href=\"/service\"><span class=\"icon icon-chat-org\"></span>客服中心</a></li>
                        </ul>
                    </div>
                </div>
                ";
        }
        // line 90
        echo "            </div>
        </div>
    </div>
</div>
";
    }

    // line 97
    public function block_content($context, array $blocks = array())
    {
        // line 98
        echo "<div class=\"col-xs-8\">
    ";
        // line 99
        $this->env->loadTemplate("article_tablist.html")->display($context);
        // line 100
        echo "    <div class=\"mt10\">
        <div class=\"panel nobd inner\">
            <div id=\"demo1\" class=\"picBtnTop\">
                <div class=\"hd\">
                    <ul class=\"list-unstyled\">
                        ";
        // line 105
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["activity"]) ? $context["activity"] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 106
            echo "                        ";
            if (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index0", array()) == 0)) {
                // line 107
                echo "                        <li class=\"on\"><a href=\"/activity/detail/";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
                echo "</a></li>
                        ";
            } else {
                // line 109
                echo "                        <li><a href=\"/activity/detail/";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
                echo "</a></li>
                        ";
            }
            // line 111
            echo "
                        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 113
        echo "                    </ul>
                </div>
                <div class=\"bd\">
                    <ul class=\"list-unstyled\" id=\"centerActivityPicList\">
                        <input type=\"hidden\" id=\"activityImages\" value=\"";
        // line 117
        echo twig_escape_filter($this->env, (isset($context["activityImages"]) ? $context["activityImages"] : null), "html", null, true);
        echo "\" />
                        ";
        // line 118
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["activity"]) ? $context["activity"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 119
            echo "                        <li style=\"width:450px;height:199px;\">
                            <div class=\"pic\"><a href=\"/activity/detail/";
            // line 120
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\"></a></div>
                        </li>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 123
        echo "                    </ul>
                </div>
            </div>
            <div class=\"p15\">
                <div class=\"row\" id=\"newsImageDiv\">
                    <input type=\"hidden\" id=\"newsImages\" value=\"";
        // line 128
        echo twig_escape_filter($this->env, (isset($context["newsImages"]) ? $context["newsImages"] : null), "html", null, true);
        echo "\" />
                    ";
        // line 129
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["news_with_image"]) ? $context["news_with_image"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 130
            echo "                    <div class=\"col-xs-6\" >
                        <div class=\"media\">
                            <a href=\"/articles/detail/";
            // line 132
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\" class=\"pull-left\" rel=\"image\" style=\"width:99px;height:86px; \">
                            </a>
                            <div class=\"media-body\">
                                <p class=\"media-heading nowrap\"><a href=\"/articles/detail/";
            // line 135
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\" class=\"pull-left\"><strong>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
            echo "</strong></a></p>
                                <div class=\"font14\">";
            // line 136
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "description", array()), "html", null, true);
            echo "</div>
                                <span class=\"time\">";
            // line 137
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "publish_time", array()), "html", null, true);
            echo "</span>
                            </div>
                        </div>
                    </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 142
        echo "                </div>
                <div class=\"row nopd\">
                    ";
        // line 144
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["news_withOut_image"]) ? $context["news_withOut_image"] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 145
            echo "                            ";
            if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "first", array())) {
                // line 146
                echo "                            <div class=\"col-xs-6\">
                                <ul class=\"mt30 list nowrap list01 pl mbn\">
                            ";
            }
            // line 149
            echo "                            ";
            if ((($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index", array()) % 5) == 0)) {
                // line 150
                echo "                                </ul>
                            </div>
                            <div class=\"col-xs-6\">
                                <ul class=\"mt30 list nowrap list01 pl mbn\">
                            ";
            }
            // line 155
            echo "                                    <li><span class=\"time\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "publish_time", array()), "html", null, true);
            echo "</span><a href=\"/articles/detail/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
            echo "\"><span class=\"text-grey\">[";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "category_name", array()), "html", null, true);
            echo "]</span> ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
            echo "</a></li>
                            ";
            // line 156
            if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "last", array())) {
                // line 157
                echo "                                </ul>
                            </div>
                            ";
            }
            // line 160
            echo "                        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 161
        echo "                </div>
            </div>
        </div>
    </div>
</div>
<div class=\"col-xs-12\">
    <h4 class=\"mTitle\">活动专区</h4>
    <div class=\"picScroll-left mb20\" id=\"activity-list\">
        <div class=\"bd\">
            <input type=\"hidden\" id=\"activityFooterImages\" value=\"";
        // line 170
        echo twig_escape_filter($this->env, (isset($context["activityFooterImages"]) ? $context["activityFooterImages"] : null), "html", null, true);
        echo "\" />
            <ul class=\"picList\" id=\"acList\">
                ";
        // line 172
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["footer_activity"]) ? $context["footer_activity"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 173
            echo "                <li style=\"width: 188px;height:113px;\">
                    <div class=\"pic\"><a href=\"/activity/detail/";
            // line 174
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\" target=\"_blank\">
                        </a></div>
                </li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 178
        echo "            </ul>
        </div>
    </div>
</div>
<div class=\"col-xs-12\">
<h4 class=\"mTitle\">合作媒体</h4>
<div class=\"picScroll-left mb20\" id=\"hezuo-list\">
<div class=\"bd\">
<input type=\"hidden\" id=\"hezuoFooterImages\" value=\"
[
    {image:'/images/hezuo/bag.png'},
    {image:'/images/hezuo/72G.jpg'},
    {image:'/images/hezuo/1688.jpg'},
    {image:'/images/hezuo/bainong.png'},
    {image:'/images/hezuo/soyo.jpg'},
    {image:'/images/hezuo/zhang.jpg'},
    {image:'/images/hezuo/996.png'},
    {image:'/images/hezuo/benshouji.png'},
    {image:'/images/hezuo/9553.jpg'},
    {image:'/images/hezuo/bufan.png'},
    {image:'/images/hezuo/766.png'},
     {image:'/images/hezuo/520apk.png'},
]
\" />
<ul class=\"picList\" id=\"hzList\"style=\"padding: 0px;\">
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.ptbus.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.72g.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.1688wan.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56;\">
        <div class=\"pic\"><a href=\"http://www.bnapp.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.soyohui.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.zhanggame.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.996.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.benshouji.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.9553.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.bufan.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.766.com\" target=\"_blank\">
        </a></div>
    </li>
    <li style=\"width: 152px;height:56px;\">
        <div class=\"pic\"><a href=\"http://www.520apk.com\" target=\"_blank\">
        </a></div>
    </li>
</ul>
</div>
</div>
</div>
";
    }

    // line 256
    public function block_script($context, array $blocks = array())
    {
        // line 257
        echo "<script>
var errCode = ";
        // line 258
        echo twig_escape_filter($this->env, (isset($context["code"]) ? $context["code"] : null), "html", null, true);
        echo ";
var is_login=";
        // line 259
        echo twig_escape_filter($this->env, (isset($context["is_login"]) ? $context["is_login"] : null), "html", null, true);
        echo ";
</script>
<script src=\"";
        // line 261
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/md5.min.js\"></script>
<script src=\"";
        // line 262
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/imageLoaded.js\"></script>
<script src=\"";
        // line 263
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/index.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  534 => 263,  530 => 262,  526 => 261,  521 => 259,  517 => 258,  514 => 257,  511 => 256,  430 => 178,  420 => 174,  417 => 173,  413 => 172,  408 => 170,  397 => 161,  383 => 160,  378 => 157,  376 => 156,  363 => 155,  356 => 150,  353 => 149,  348 => 146,  345 => 145,  328 => 144,  324 => 142,  313 => 137,  309 => 136,  303 => 135,  297 => 132,  293 => 130,  289 => 129,  285 => 128,  278 => 123,  269 => 120,  266 => 119,  262 => 118,  258 => 117,  252 => 113,  237 => 111,  229 => 109,  221 => 107,  218 => 106,  201 => 105,  194 => 100,  192 => 99,  189 => 98,  186 => 97,  178 => 90,  162 => 77,  158 => 76,  152 => 73,  148 => 72,  140 => 67,  128 => 57,  105 => 37,  97 => 31,  95 => 30,  92 => 29,  86 => 26,  82 => 24,  76 => 20,  74 => 19,  68 => 18,  60 => 16,  57 => 15,  52 => 12,  49 => 11,  44 => 8,  41 => 7,  36 => 4,  33 => 3,);
    }
}
