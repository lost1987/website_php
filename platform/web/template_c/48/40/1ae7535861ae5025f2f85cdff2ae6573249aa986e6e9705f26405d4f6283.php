<?php

/* index.html */
class __TwigTemplate_48401ae7535861ae5025f2f85cdff2ae6573249aa986e6e9705f26405d4f6283 extends Twig_Template
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
        echo "新蜂游戏平台
";
    }

    // line 7
    public function block_keywords($context, array $blocks = array())
    {
        // line 8
        echo "新蜂游戏平台
";
    }

    // line 11
    public function block_description($context, array $blocks = array())
    {
        // line 12
        echo "新蜂游戏平台
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
        ";
        // line 18
        if (((isset($context["is_login"]) ? $context["is_login"] : null) == 1)) {
            // line 19
            echo "        <div class=\"gameEnter\">
            ";
            // line 20
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["servers"]) ? $context["servers"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["game"]) {
                // line 21
                echo "            <div class=\"gameItem\">
                <div class=\"gameIcon\"><img src=\"";
                // line 22
                echo twig_escape_filter($this->env, twig_constant("CDN_PLATFORM_HOST"), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["game"]) ? $context["game"] : null), "web_icon", array()), "html", null, true);
                echo "\" /></div>
                <div class=\"gameContent\">
                    <div style=\"font-size:16px;\">";
                // line 24
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["game"]) ? $context["game"] : null), "game_name", array()), "html", null, true);
                echo "</div>
                    <p style=\"font-size:14px;margin-top:5px;\">";
                // line 25
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["game"]) ? $context["game"] : null), "web_game_desp", array()), "html", null, true);
                echo "</p>
                </div>
                ";
                // line 27
                if (($this->getAttribute((isset($context["game"]) ? $context["game"] : null), "flash_swf_path", array()) != "")) {
                    // line 28
                    echo "                <div><a href=\"/game/enter?server_id=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["game"]) ? $context["game"] : null), "id", array()), "html", null, true);
                    echo "\" class=\"btn btn-sm btn-success pull-right\" style=\"border-radius:5px;margin-top:25px;margin-right:20px;\">进入游戏</a></div>
                ";
                } else {
                    // line 30
                    echo "                <div><a href=\"javascript:;\"  class=\"btn btn-sm btn-default pull-right disabled\" style=\"border-radius:5px;margin-top:25px;margin-right:20px;\">即将上线</a></div>
                ";
                }
                // line 32
                echo "            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['game'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            echo "        </div>
        ";
        }
        // line 36
        echo "        <div class=\"loginPanel\" ";
        if ((isset($context["is_login"]) ? $context["is_login"] : null)) {
            echo "style=\"left:700px;\"";
        }
        echo " >
            ";
        // line 37
        if (((isset($context["is_login"]) ? $context["is_login"] : null) != 1)) {
            // line 38
            echo "            <div class=\"panel-heading\">
            <center>一个账号，双平台通用</center>
            </div>
            ";
        } else {
            // line 42
            echo "            <div class=\"panel-heading\" style=\"padding:0px 0px;height:53px;background: rgba(0,0,0,.5) !important\">
                     <div  style=\"width: 160px;height:53px; !important;text-align: center;float:left;line-height:53px;background: rgba(0,0,0,.5)\"><a href=\"";
            // line 43
            echo twig_escape_filter($this->env, twig_constant("WHMJ_HOST"), "html", null, true);
            echo "\" >武汉麻将</a></div>
                    <div style=\"border:solid black 1px;border-bottom-color:rgb(163,217,0);width: 160px;height:53px; !important;text-align: center;float:left;line-height:53px;\" >游戏平台</div>
            </div>
            ";
        }
        // line 47
        echo "            ";
        if (((isset($context["is_login"]) ? $context["is_login"] : null) != 1)) {
            // line 48
            echo "            <div class=\"panel-body\" style=\"height: 230px;\">
                <form role=\"form\" id=\"loginForm\" class=\"p35 in\" method=\"post\" action=\"/user/login\">
                    <fieldset>
                        <div class=\"form-group\">
                            <div class=\"input-group\">
                                <span class=\"input-group-addon\"><span class=\"icon icon-userW\"></span></span>
                                <input type=\"text\" class=\"form-control\" id=\"login_name\" name=\"login_name\" placeholder=\"用户名/邮箱/手机号\">
                                <input type=\"hidden\" value=\"";
            // line 55
            echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : null), "html", null, true);
            echo "\" name=\"csrf_token\" />
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"input-group\">
                                <span class=\"input-group-addon\"><span class=\"icon icon-lockW\"></span></span>
                                <input type=\"password\" class=\"form-control\" name=\"source_password\" id=\"source_password\">
                                <input type=\"hidden\" class=\"form-control\" name=\"password\" id=\"password\">
                                <input type=\"hidden\" name=\"login_type\" id=\"login_type\" value=\"pt\" />
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
            // line 75
            echo "                <div class=\"panel-body\">
                <form>
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
            // line 86
            echo twig_escape_filter($this->env, (isset($context["nickname"]) ? $context["nickname"] : null), "html", null, true);
            echo "</span> 您好！<a href=\"/user/logout\" class=\"text-blue\" id=\"exitBtn\">退出</a></span>
                    </div>
                    <div class=\"p35 bg-black\">
                        <div class=\"row\">
                            <div class=\"col-xs-6\">
                                <p>筹码：";
            // line 91
            echo twig_escape_filter($this->env, ((array_key_exists("chip", $context)) ? (_twig_default_filter((isset($context["chip"]) ? $context["chip"] : null), 0)) : (0)), "html", null, true);
            echo "</p>
                            </div>
                            <div class=\"col-xs-6\">
                                <p>钻石：";
            // line 94
            echo twig_escape_filter($this->env, ((array_key_exists("diamond", $context)) ? (_twig_default_filter((isset($context["diamond"]) ? $context["diamond"] : null), 0)) : (0)), "html", null, true);
            echo "</p>
                            </div>
                        </div>
                    </div>
                    <div class=\"p10 mt5\">
                           <center><a href=\"";
            // line 99
            echo twig_escape_filter($this->env, twig_constant("WHMJ_HOST"), "html", null, true);
            echo "\" class=\"btn btn-lg btn-success\" style=\"border-radius:5px;margin-top:10px;\">返回武汉麻将</a></center>
                    </div>
                </div>
        ";
        }
        // line 103
        echo "            </div>
        </div>
    </div>
</div>
";
    }

    // line 110
    public function block_content($context, array $blocks = array())
    {
        // line 111
        echo "<div class=\"col-xs-8\">
    ";
        // line 112
        $this->env->loadTemplate("article_tablist.html")->display($context);
        // line 113
        echo "    <div class=\"mt10\">
        <div class=\"panel nobd inner\">
            <div id=\"demo1\" class=\"picBtnTop\">
                <div class=\"hd\">
                    <ul class=\"list-unstyled\">
                        ";
        // line 118
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
            // line 119
            echo "                        ";
            if (($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index0", array()) == 0)) {
                // line 120
                echo "                        <li class=\"on\"><a href=\"/activity/detail/";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
                echo "</a></li>
                        ";
            } else {
                // line 122
                echo "                        <li><a href=\"/activity/detail/";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
                echo "</a></li>
                        ";
            }
            // line 124
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
        // line 126
        echo "                    </ul>
                </div>
                <div class=\"bd\">
                    <ul class=\"list-unstyled\" id=\"centerActivityPicList\">
                        <input type=\"hidden\" id=\"activityImages\" value=\"";
        // line 130
        echo twig_escape_filter($this->env, (isset($context["activityImages"]) ? $context["activityImages"] : null), "html", null, true);
        echo "\" />
                        ";
        // line 131
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["activity"]) ? $context["activity"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 132
            echo "                        <li style=\"width:450px;height:199px;\">
                            <div class=\"pic\"><a href=\"/activity/detail/";
            // line 133
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\"></a></div>
                        </li>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 136
        echo "                    </ul>
                </div>
            </div>
            <div class=\"p15\">
                <div class=\"row\" id=\"newsImageDiv\">
                    <input type=\"hidden\" id=\"newsImages\" value=\"";
        // line 141
        echo twig_escape_filter($this->env, (isset($context["newsImages"]) ? $context["newsImages"] : null), "html", null, true);
        echo "\" />
                    ";
        // line 142
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["news_with_image"]) ? $context["news_with_image"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 143
            echo "                    <div class=\"col-xs-6\" >
                        <div class=\"media\">
                            <a href=\"/articles/detail/";
            // line 145
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\" class=\"pull-left\" rel=\"image\" style=\"width:99px;height:86px; \">
                            </a>
                            <div class=\"media-body\">
                                <p class=\"media-heading nowrap\"><a href=\"/articles/detail/";
            // line 148
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\" class=\"pull-left\"><strong>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
            echo "</strong></a></p>
                                <div class=\"font14\">";
            // line 149
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "description", array()), "html", null, true);
            echo "</div>
                                <span class=\"time\">";
            // line 150
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
        // line 155
        echo "                </div>
                <div class=\"row nopd\">
                    ";
        // line 157
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
            // line 158
            echo "                            ";
            if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "first", array())) {
                // line 159
                echo "                            <div class=\"col-xs-6\">
                                <ul class=\"mt30 list nowrap list01 pl mbn\">
                            ";
            }
            // line 162
            echo "                            ";
            if ((($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index", array()) % 5) == 0)) {
                // line 163
                echo "                                </ul>
                            </div>
                            <div class=\"col-xs-6\">
                                <ul class=\"mt30 list nowrap list01 pl mbn\">
                            ";
            }
            // line 168
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
            // line 169
            if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "last", array())) {
                // line 170
                echo "                                </ul>
                            </div>
                            ";
            }
            // line 173
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
        // line 174
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
        // line 183
        echo twig_escape_filter($this->env, (isset($context["activityFooterImages"]) ? $context["activityFooterImages"] : null), "html", null, true);
        echo "\" />
            <ul class=\"picList\" id=\"acList\">
                ";
        // line 185
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["footer_activity"]) ? $context["footer_activity"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 186
            echo "                <li style=\"width: 188px;height:113px;\">
                    <div class=\"pic\"><a href=\"/activity/detail/";
            // line 187
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\" target=\"_blank\">
                        </a></div>
                </li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 191
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

    // line 269
    public function block_script($context, array $blocks = array())
    {
        // line 270
        echo "<script>
var errCode = ";
        // line 271
        echo twig_escape_filter($this->env, (isset($context["code"]) ? $context["code"] : null), "html", null, true);
        echo ";
var is_login = ";
        // line 272
        echo twig_escape_filter($this->env, (isset($context["is_login"]) ? $context["is_login"] : null), "html", null, true);
        echo ";
</script>
<script src=\"";
        // line 274
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/md5.min.js\"></script>
<script src=\"";
        // line 275
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/imageLoaded.js\"></script>
<script src=\"";
        // line 276
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
        return array (  576 => 276,  572 => 275,  568 => 274,  563 => 272,  559 => 271,  556 => 270,  553 => 269,  472 => 191,  462 => 187,  459 => 186,  455 => 185,  450 => 183,  439 => 174,  425 => 173,  420 => 170,  418 => 169,  405 => 168,  398 => 163,  395 => 162,  390 => 159,  387 => 158,  370 => 157,  366 => 155,  355 => 150,  351 => 149,  345 => 148,  339 => 145,  335 => 143,  331 => 142,  327 => 141,  320 => 136,  311 => 133,  308 => 132,  304 => 131,  300 => 130,  294 => 126,  279 => 124,  271 => 122,  263 => 120,  260 => 119,  243 => 118,  236 => 113,  234 => 112,  231 => 111,  228 => 110,  220 => 103,  213 => 99,  205 => 94,  199 => 91,  191 => 86,  178 => 75,  155 => 55,  146 => 48,  143 => 47,  136 => 43,  133 => 42,  127 => 38,  125 => 37,  118 => 36,  114 => 34,  107 => 32,  103 => 30,  97 => 28,  95 => 27,  90 => 25,  86 => 24,  80 => 22,  77 => 21,  73 => 20,  70 => 19,  68 => 18,  60 => 16,  57 => 15,  52 => 12,  49 => 11,  44 => 8,  41 => 7,  36 => 4,  33 => 3,);
    }
}
