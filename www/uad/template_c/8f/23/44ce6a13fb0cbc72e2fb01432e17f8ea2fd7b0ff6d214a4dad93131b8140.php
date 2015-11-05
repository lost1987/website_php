<?php

/* base.html */
class __TwigTemplate_8f2344ce6a13fb0cbc72e2fb01432e17f8ea2fd7b0ff6d214a4dad93131b8140 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'css' => array($this, 'block_css'),
            'content' => array($this, 'block_content'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html class=\"no-js\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <title>武汉新蜂乐众-用户推广系统</title>
    <meta name=\"description\" content=\"\">
    <meta name=\"keywords\" content=\"index\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\">
    <meta name=\"renderer\" content=\"webkit\">
    <meta http-equiv=\"Cache-Control\" content=\"no-siteapp\" />
    <!--<link rel=\"icon\" type=\"image/png\" href=\"\">-->
    <!--<link rel=\"apple-touch-icon-precomposed\" href=\"\">-->
    <meta name=\"apple-mobile-web-app-title\" content=\"Amaze UI\" />
    <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/css/amazeui.min.css\"/>
    <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/css/admin.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/css/app.css\">
    ";
        // line 18
        $this->displayBlock('css', $context, $blocks);
        // line 19
        echo "</head>
<body>
<!--[if lte IE 9]>
<p class=\"browsehappy\">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href=\"http://browsehappy.com/\" target=\"_blank\">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->

<header class=\"am-topbar admin-header\" data-am-sticky>
    <div class=\"am-topbar-brand\">
        <strong>武汉新蜂乐众推广系统&nbsp;
            ";
        // line 29
        if ((isset($context["isComissioner"]) ? $context["isComissioner"] : null)) {
            // line 30
            echo "                <span class=\"am-badge am-badge-danger am-round\">推广专员</span>
            ";
        }
        // line 32
        echo "        </strong>
        <small>
        &nbsp;&nbsp;
        <code>我的邀请码[在手机app中领取礼包时填写]:<b>";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["invite_code"]) ? $context["invite_code"] : null), "html", null, true);
        echo "</b></code>

        </small>
        ";
        // line 38
        if ((isset($context["isComissioner"]) ? $context["isComissioner"] : null)) {
            // line 39
            echo "        <code>我的推广连接:<b>";
            echo twig_escape_filter($this->env, twig_constant("WWW_HOST"), "html", null, true);
            echo "/user/signup?code=";
            echo twig_escape_filter($this->env, (isset($context["invite_code"]) ? $context["invite_code"] : null), "html", null, true);
            echo " </b><a href=\"javascript:;\" id=\"copy_link\">复制链接</a></code>
        ";
        } else {
            // line 41
            echo "        <code>我的邀请连接:<b>";
            echo twig_escape_filter($this->env, twig_constant("WWW_HOST"), "html", null, true);
            echo "/user/signup?code=";
            echo twig_escape_filter($this->env, (isset($context["invite_code"]) ? $context["invite_code"] : null), "html", null, true);
            echo " </b><a href=\"javascript:;\" id=\"copy_link\">复制链接</a></code>
        ";
        }
        // line 43
        echo "    </div>

    <button class=\"am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only\" data-am-collapse=\"{target: '#topbar-collapse'}\"><span class=\"am-sr-only\">导航切换</span> <span class=\"am-icon-bars\"></span></button>

    <div class=\"am-collapse am-topbar-collapse\" id=\"topbar-collapse\">

        <ul class=\"am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list\">
            <!--<li><a href=\"javascript:;\"><span class=\"am-icon-envelope-o\"></span> 收件箱 <span class=\"am-badge am-badge-warning\">5</span></a></li>-->
            <li><a href=\"";
        // line 51
        echo twig_escape_filter($this->env, twig_constant("WWW_HOST"), "html", null, true);
        echo "\">首页</a></li>
            <li class=\"am-dropdown\" data-am-dropdown>
                <a class=\"am-dropdown-toggle\" data-am-dropdown-toggle href=\"javascript:;\">
                    <span class=\"am-icon-user\"></span> ";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "nickname", array()), "html", null, true);
        echo " <span class=\"am-icon-caret-down\"></span>
                </a>
                <ul class=\"am-dropdown-content\">
                    <li><a href=\"/login/logout\"><span class=\"am-icon-power-off\"></span> 退出</a></li>
                </ul>
            </li>
            <li><a href=\"javascript:;\" id=\"admin-fullscreen\"><span class=\"am-icon-arrows-alt\"></span> <span class=\"admin-fullText\">开启全屏</span></a></li>
        </ul>
    </div>
</header>

<div class=\"am-cf admin-main am-g\">
<!-- sidebar start -->
    <div class=\"admin-sidebar\">
        <ul class=\"am-list admin-sidebar-list\">
           ";
        // line 69
        echo (isset($context["navigator"]) ? $context["navigator"] : null);
        echo "
        </ul>
    </div>
<!-- sidebar end -->
    <div class=\"admin-content\">
        ";
        // line 74
        $this->displayBlock('content', $context, $blocks);
        // line 76
        echo "    </div>

    <div class=\"admin-right\">
        <div class=\"am-panel am-panel-default\">
            <div class=\"am-panel-hd am-cf\" data-am-collapse=\"{target: '#collapse-panel-3'}\">最新提现</div>
            <div class=\"am-panel-bd am-collapse am-in am-cf\">
                <ul class=\"am-comments-list admin-content-comment\">
                    <li>
                        ";
        // line 84
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["depositList"]) ? $context["depositList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 85
            echo "                            <div>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "nickname", array()), "html", null, true);
            echo " 提现了 <font color=\"red\">￥";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "money", array()), "html", null, true);
            echo "</font></div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        echo "                    </li>
                </ul>
            </div>
        </div>

        ";
        // line 92
        if ((isset($context["isComissioner"]) ? $context["isComissioner"] : null)) {
            // line 93
            echo "        <div class=\"am-panel am-panel-default\">
            <div class=\"am-panel-hd am-cf\" data-am-collapse=\"{target: '#collapse-panel-3'}\">推广教程</div>
            <div class=\"am-panel-bd am-collapse am-in am-cf\">
                <ul class=\"am-comments-list admin-content-comment\">
                    <li>
                        ";
            // line 98
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["tutorial"]) ? $context["tutorial"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 99
                echo "                        <div><a href=\"";
                echo twig_escape_filter($this->env, twig_constant("WWW_HOST"), "html", null, true);
                echo "/articles/detail/";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
                echo "\" target=\"_blank\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
                echo "</a></div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 101
            echo "                    </li>
                </ul>
            </div>
        </div>
        ";
        }
        // line 106
        echo "
        <div class=\"am-panel am-panel-default\">
            <div class=\"am-panel-hd am-cf\" data-am-collapse=\"{target: '#collapse-panel-3'}\">常见问题</div>
            <div class=\"am-panel-bd am-collapse am-in am-cf\">
                <ul class=\"am-comments-list admin-content-comment\">
                    <li>
                        ";
        // line 112
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["articles"]) ? $context["articles"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 113
            echo "                        <div><a href=\"";
            echo twig_escape_filter($this->env, twig_constant("WWW_HOST"), "html", null, true);
            echo "/articles/detail/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
            echo "\" target=\"_blank\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
            echo "</a></div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 115
        echo "                    </li>
                </ul>
            </div>
        </div>


        <div class=\"am-panel am-panel-default\">
            <div class=\"am-panel-hd am-cf\" data-am-collapse=\"{target: '#collapse-panel-3'}\">客服</div>
            <div class=\"am-panel-bd am-collapse am-in am-cf\">
                <ul class=\"am-comments-list admin-content-comment\">
                    <li>
                        <div><a href=\"javascript:;\">电话:027-59817413</a></div>
                        <div><a href=\"http://shang.qq.com/wpa/qunwpa?idkey=cccb0ff5e146f7ad2f26d700d1b1fa3a24bc82bdb115c6833bcb47bba52de14f\" target=\"_blank\">武汉麻将班子群 129166897</a></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div data-am-widget=\"gotop\" class=\"am-gotop am-gotop-fixed\">
    <a href=\"#top\" title=\"回到顶部\" class=\"\">
        <i class=\"am-gotop-icon am-icon-hand-o-up\"></i>
    </a>
</div>

<!--alert window-->
<div class=\"am-modal am-modal-alert\" tabindex=\"-1\" id=\"error-alert\">
    <div class=\"am-modal-dialog\">
        <div class=\"am-modal-hd\" id=\"alert-title\"></div>
        <div class=\"am-modal-bd\" id=\"alert-msg\">
        </div>
        <div class=\"am-modal-footer\">
            <span class=\"am-modal-btn\">确定</span>
        </div>
    </div>
</div>

<!--confirm window-->
<div class=\"am-modal am-modal-confirm\" tabindex=\"-1\" id=\"confirm-alert\">
    <div class=\"am-modal-dialog\">
        <div class=\"am-modal-hd\" id=\"confirm-title\"></div>
        <div class=\"am-modal-bd\" id=\"confirm-content\">
        </div>
        <div class=\"am-modal-footer\">
            <span class=\"am-modal-btn\" id=\"confirm-btn-no\">取消</span>
            <span class=\"am-modal-btn\" id=\"confirm-btn-yes\">确定</span>
        </div>
    </div>
</div>

<footer>
    <hr>
    <p class=\"am-padding-left\" style=\"text-align: center\">武汉新蜂乐众网络技术有限公司版权所有 &nbsp;&nbsp;&nbsp;&nbsp;鄂ICP备14001438号 &nbsp;&nbsp;&nbsp;&nbsp;Copyright  ©2014 All Rights Reserved NBGame  <a href=\"http://webscan.360.cn/index/checkwebsite/url/16youxi.com\"><img border=\"0\" src=\"http://img.webscan.360.cn/status/pai/hash/1449514117216e332f1037572ba7e2e4\" width=\"70\"/></a></p>
</footer>

<!--[if lt IE 9]>
<script src=\"";
        // line 172
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/js/jquery.min.js\"></script>
<script src=\"http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js\"></script>
<script src=\"";
        // line 174
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/js/polyfill/rem.min.js\"></script>
<script src=\"";
        // line 175
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/js/polyfill/respond.min.js\"></script>
<script src=\"";
        // line 176
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/js/amazeui.legacy.js\"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src=\"";
        // line 180
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/js/jquery.min.js\"></script>
<script src=\"";
        // line 181
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/jquery.zclip.min.js\"></script>
<script src=\"";
        // line 182
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/errorMsg.js\" type=\"text/javascript\"></script>
<script src=\"";
        // line 183
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/js/amazeui.min.js\"></script>
<script src=\"";
        // line 184
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/amazeui.extend.js\" type=\"text/javascript\"></script>
<!--<![endif]-->
<script src=\"";
        // line 186
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/js/app.js\"></script>
<script>
    \$(function(){
        \$.fill_screen();
        \$(window).on('resize',function(){
            \$.fill_screen();
        });

        \$(window).trigger('resize');

        //初始化导航事件
        \$(\".usable\").click(function(){
            var __this = \$(this);
            var url = __this.attr('rel');

            \$.iAjax(url,'',function(data){
                \$(\".admin-content\").html(data);
            });
        });

        \$(\"a#copy_link\").zclip({
            path:'assets/lib/ZeroClipboard.swf',
            copy:\$(\"#copy_link\").prev().text(),
            afterCopy:function(){
                \$.alert(\$(\"#copy_link\").prev().text()+',已经复制到剪切板');
            }
        });

        setTimeout(\"\$('#zclip-ZeroClipboardMovie_1').css('top','1px');\",200);
    });

    var jiathis_config = {
        boldNum:0,
        siteNum:7,
        showClose:false,
        sm:\"t163,kaixin001,renren,douban,tsina,tqq,tsohu\",
        imageUrl:\"http://v2.jiathis.com/code/images/r5.gif\",
        imageWidth:26,
        marginTop:150,
        url:\"http://www.16youxi.com/user/signup/";
        // line 225
        echo twig_escape_filter($this->env, (isset($context["invite_code"]) ? $context["invite_code"] : null), "html", null, true);
        echo "\",
        title:\"致亲爱的麻油们，给你送上一个开心大红包。我在新蜂武汉麻将等你，快来战个天昏地暗！（我的专属邀请码：";
        // line 226
        echo twig_escape_filter($this->env, (isset($context["invite_code"]) ? $context["invite_code"] : null), "html", null, true);
        echo "）\",
        summary:\"\",
        pic:\"\",
        data_track_clickback:true,
        appkey:{
            \"tsina\":\"您网站的新浪微博APPKEY\",
            \"tqq\":\"您网站的腾讯微博APPKEY\",
            \"tpeople\":\"您网站的人民微博APPKEY\"
        },
        ralateuid:{
            \"tsina\":\"您的新浪微博UID\"
        }
    }
</script>
<!--在Amazeui加载后加载的脚本放在这里-->
";
        // line 241
        $this->displayBlock('script', $context, $blocks);
        // line 243
        echo "</body>
</html>
";
    }

    // line 18
    public function block_css($context, array $blocks = array())
    {
    }

    // line 74
    public function block_content($context, array $blocks = array())
    {
        // line 75
        echo "        ";
    }

    // line 241
    public function block_script($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  421 => 241,  417 => 75,  414 => 74,  409 => 18,  403 => 243,  401 => 241,  383 => 226,  379 => 225,  337 => 186,  332 => 184,  328 => 183,  324 => 182,  320 => 181,  316 => 180,  309 => 176,  305 => 175,  301 => 174,  296 => 172,  237 => 115,  222 => 113,  218 => 112,  210 => 106,  203 => 101,  188 => 99,  184 => 98,  177 => 93,  175 => 92,  168 => 87,  157 => 85,  153 => 84,  143 => 76,  141 => 74,  133 => 69,  115 => 54,  109 => 51,  99 => 43,  91 => 41,  83 => 39,  81 => 38,  75 => 35,  70 => 32,  66 => 30,  64 => 29,  52 => 19,  50 => 18,  46 => 17,  42 => 16,  38 => 15,  22 => 1,);
    }
}
