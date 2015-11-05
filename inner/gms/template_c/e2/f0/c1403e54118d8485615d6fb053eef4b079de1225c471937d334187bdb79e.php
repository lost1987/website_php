<?php

/* base.html */
class __TwigTemplate_e2f0c1403e54118d8485615d6fb053eef4b079de1225c471937d334187bdb79e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'description' => array($this, 'block_description'),
            'author' => array($this, 'block_author'),
            'css' => array($this, 'block_css'),
            'content' => array($this, 'block_content'),
            'javascript_plugins' => array($this, 'block_javascript_plugins'),
            'javascript_custom' => array($this, 'block_javascript_custom'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>

<!-- 

Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 2.3.1

Version: 1.3

Author: KeenThemes

Website: http://www.keenthemes.com/preview/?theme=metronic

Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469

-->

<!--[if IE 8]> <html lang=\"en\" class=\"ie8 no-js\"> <![endif]-->

<!--[if IE 9]> <html lang=\"en\" class=\"ie9 no-js\"> <![endif]-->

<!--[if !IE]><!--> <html lang=\"en\" class=\"no-js\"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset=\"utf-8\" />

    <title>";
        // line 29
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    <meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\" />

    <meta content=\"";
        // line 33
        $this->displayBlock('description', $context, $blocks);
        echo "\" name=\"description\" />

    <meta content=\"";
        // line 35
        $this->displayBlock('author', $context, $blocks);
        echo "\" name=\"author\" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href=\"/media/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>

    <link href=\"/media/css/bootstrap-responsive.min.css\" rel=\"stylesheet\" type=\"text/css\"/>

    <link href=\"/media/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\"/>

    <link href=\"/media/css/style-metro.css\" rel=\"stylesheet\" type=\"text/css\"/>

    <link href=\"/media/css/style.css\" rel=\"stylesheet\" type=\"text/css\"/>

    <link href=\"/media/css/style-responsive.css\" rel=\"stylesheet\" type=\"text/css\"/>

    <link href=\"/media/css/default.css\" rel=\"stylesheet\" type=\"text/css\" id=\"style_color\"/>

    <link href=\"/media/css/uniform.default.css\" rel=\"stylesheet\" type=\"text/css\"/>

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    ";
        // line 58
        $this->displayBlock('css', $context, $blocks);
        // line 60
        echo "    <!-- END PAGE LEVEL STYLES -->

    <link rel=\"shortcut icon\" href=\"/media/image/favicon.ico\" />
</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class=\"page-header-fixed\">

<!-- BEGIN HEADER -->

<div class=\"header navbar navbar-inverse navbar-fixed-top\">

<!-- BEGIN TOP NAVIGATION BAR -->

<div class=\"navbar-inner\">

<div class=\"container-fluid\">

<!-- BEGIN LOGO -->

<a class=\"brand\" href=\"index.html\">

    <img src=\"/media/image/logo.png\" alt=\"logo\"/>

</a>

<!-- END LOGO -->

<!-- BEGIN RESPONSIVE MENU TOGGLER -->

<a href=\"javascript:;\" class=\"btn-navbar collapsed\" data-toggle=\"collapse\" data-target=\".nav-collapse\">

    <img src=\"/media/image/menu-toggler.png\" alt=\"\" />

</a>

<!-- END RESPONSIVE MENU TOGGLER -->

<!-- BEGIN TOP NAVIGATION MENU -->
<ul class=\"nav pull-right\">
<li><a href=\"javascript:;\">当前服务器:&nbsp;<i id=\"curServerName\" style=\"color:greenyellow\">";
        // line 103
        echo twig_escape_filter($this->env, (isset($context["currentServer"]) ? $context["currentServer"] : null), "html", null, true);
        echo "</i></a></li>
<li class=\"dropdown\" id=\"header_inbox_bar\">

    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">

        <i class=\"icon-hdd\"></i>

        <span class=\"badge\"><!--5--></span>

    </a>

    <ul class=\"dropdown-menu extended inbox\">
        <li>

            <p>选择服务器</p>

        </li>

        <li>
            ";
        // line 122
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["servers"]) ? $context["servers"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 123
            echo "             <a href=\"javascript:;\" rel=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "area_id", array()), "html", null, true);
            echo "\" onclick=\"selectServer(this)\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
            echo "</a>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 125
        echo "        </li>
    </ul>

</li>

<li class=\"dropdown\" id=\"header_notification_bar\">

    <a href=\"#\" title=\"系统功能\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">

        <i class=\"icon-cog\"></i>

        <span class=\"badge\"><!--6--></span>

    </a>

    <ul class=\"dropdown-menu extended notification\">

        <li>

            <p>系统功能</p>

        </li>

        <li>

            <a href=\"/system/ajax_clear_cache\">
                清理缓存
            </a>

            <a href=\"javascript:showErrorCodes()\">
                错误代码
            </a>

        </li>
    </ul>

</li>

<li class=\"dropdown user\">

    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">

        <img alt=\"\" src=\"/media/image/avatar1_small.jpg\" />

        <span class=\"username\">";
        // line 169
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["session"]) ? $context["session"] : null), "nickname", array()), "html", null, true);
        echo "</span>

        <i class=\"icon-angle-down\"></i>

    </a>

    <ul class=\"dropdown-menu\">

        <li><a href=\"javascript:;\"><i class=\"icon-user\"></i>我的资料</a></li>

        <li><a href=\"/admin/to_reset_password/2\"><i class=\"icon-lock\"></i> 修改密码</a></li>

        <li class=\"divider\"></li>

        <li><a href=\"/login/logout\"><i class=\"icon-key\"></i>注销</a></li>

    </ul>

</li>

<!-- END USER LOGIN DROPDOWN -->

</ul>

<!-- END TOP NAVIGATION MENU -->

</div>

</div>

<!-- END TOP NAVIGATION BAR -->

</div>

<!-- END HEADER -->

<!-- BEGIN CONTAINER -->

<div class=\"page-container\">

<!-- BEGIN SIDEBAR -->

<div class=\"page-sidebar nav-collapse collapse\">

<!-- BEGIN SIDEBAR MENU -->

<ul class=\"page-sidebar-menu\">

<li>

    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

    <div class=\"sidebar-toggler hidden-phone\"></div>

    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

</li>

<li>

    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

    <form class=\"sidebar-search\">

        <div class=\"input-box\">

            <a href=\"javascript:;\" class=\"remove\"></a>

            <input type=\"text\" placeholder=\"Search...\" />

            <input type=\"button\" class=\"submit\" value=\" \" />

        </div>

    </form>
</li>
    <!-- END RESPONSIVE QUICK SEARCH FORM -->

    <!--BEGIN NAVIGATOR-->
    ";
        // line 248
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modules_root"]) ? $context["modules_root"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["root"]) {
            // line 249
            echo "    ";
            if (($this->getAttribute((isset($context["root"]) ? $context["root"] : null), "visible", array()) == 1)) {
                // line 250
                echo "                ";
                if (((isset($context["module_root_sel_id"]) ? $context["module_root_sel_id"] : null) == $this->getAttribute((isset($context["root"]) ? $context["root"] : null), "id", array()))) {
                    // line 251
                    echo "                         <li class=\"active\">
                ";
                } else {
                    // line 253
                    echo "                        <li class=\"\">
                ";
                }
                // line 255
                echo "
                    <a href=\"javascript:;\">

                        <i class=\"";
                // line 258
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["root"]) ? $context["root"] : null), "icon", array()), "html", null, true);
                echo "\"></i>

                        <span class=\"title\">";
                // line 260
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["root"]) ? $context["root"] : null), "module_name", array()), "html", null, true);
                echo "</span>

                        <span class=\"arrow\"></span>

                    </a>
                    <ul class=\"sub-menu\">
                        ";
                // line 266
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["modules_child"]) ? $context["modules_child"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                    // line 267
                    echo "                            ";
                    if ((($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "pid", array()) == $this->getAttribute((isset($context["root"]) ? $context["root"] : null), "id", array())) && ($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "visible", array()) == 1))) {
                        // line 268
                        echo "                                    <li >

                                        <a href=\"";
                        // line 270
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "module_url", array()), "html", null, true);
                        echo "/";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["root"]) ? $context["root"] : null), "id", array()), "html", null, true);
                        echo "\">

                                            ";
                        // line 272
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "module_name", array()), "html", null, true);
                        echo "</a>

                                    </li>
                            ";
                    }
                    // line 276
                    echo "                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 277
                echo "                    </ul>
                </li>
            </li>
    ";
            }
            // line 281
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['root'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 282
        echo "</ul>

<!-- END SIDEBAR MENU -->

</div>

<!-- END SIDEBAR -->

<!-- BEGIN PAGE -->

<div class=\"page-content\">

    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

    <div id=\"portlet-config\" class=\"modal hide\">

        <div class=\"modal-header\">

            <button data-dismiss=\"modal\" class=\"close\" type=\"button\"></button>

            <h3>Widget Settings</h3>

        </div>

        <div class=\"modal-body\">

            Widget settings form goes here

        </div>

    </div>

    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

    <!-- BEGIN PAGE CONTAINER-->

    <div class=\"container-fluid\">
        ";
        // line 319
        $this->displayBlock('content', $context, $blocks);
        // line 321
        echo "    </div>

    <!-- END PAGE CONTAINER-->

</div>

<!-- END PAGE -->

</div>

<!-- END CONTAINER -->


<!-- 模态框（Modal） -->
<div class=\"modal fade\" id=\"waitTipModal\" tabindex=\"-1\" role=\"dialog\"
     aria-labelledby=\"waitTipModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <img src=\"/media/image/select2-spinner.gif\" />&nbsp;&nbsp;<span id=\"waitTipModalContent\"></span>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 模态框（Modal）错误代码 -->
<div class=\"modal fade\" id=\"errorCodeModal\" tabindex=\"-1\" role=\"dialog\" style=\"display:none\"
     aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\"
                        aria-hidden=\"true\">×
                </button>
                <h4 class=\"modal-title\" id=\"sendModalLabel\">
                    错误代码
                </h4>
            </div>
            <div class=\"modal-body\">
            <table class=\"table\" id=\"error_code_table\">
            </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- BEGIN FOOTER -->

<div class=\"footer\">

    <div class=\"footer-inner\">

        2013 &copy; Metronic by keenthemes.

    </div>

    <div class=\"footer-tools\">

\t\t\t<span class=\"go-top\">

\t\t\t<i class=\"icon-angle-up\"></i>

\t\t\t</span>

    </div>

</div>

<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<script src=\"/media/js/jquery-1.10.1.min.js\" type=\"text/javascript\"></script>

<script src=\"/media/js/jquery-migrate-1.2.1.min.js\" type=\"text/javascript\"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src=\"/media/js/jquery-ui-1.10.1.custom.min.js\" type=\"text/javascript\"></script>

<script src=\"/media/js/bootstrap.min.js\" type=\"text/javascript\"></script>

<!--[if lt IE 9]>

<script src=\"/media/js/excanvas.min.js\"></script>

<script src=\"/media/js/respond.min.js\"></script>

<![endif]-->

<script src=\"/media/js/jquery.slimscroll.min.js\" type=\"text/javascript\"></script>

<script src=\"/media/js/jquery.blockui.min.js\" type=\"text/javascript\"></script>

<script src=\"/media/js/jquery.cookie.min.js\" type=\"text/javascript\"></script>

<script src=\"/media/js/jquery.uniform.min.js\" type=\"text/javascript\" ></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src=\"/media/js/date.js\" type=\"text/javascript\"></script>
<script src=\"/media/js/daterangepicker.js\" type=\"text/javascript\"></script>
";
        // line 426
        $this->displayBlock('javascript_plugins', $context, $blocks);
        // line 428
        echo "<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src=\"/media/js/app.js\" type=\"text/javascript\"></script>
";
        // line 432
        $this->displayBlock('javascript_custom', $context, $blocks);
        // line 434
        echo "<!-- END PAGE LEVEL SCRIPTS -->

<script>

    jQuery(document).ready(function() {

        App.init(); // initlayout and core plugins

    });

    function selectServer(node){
        var area_id = \$(node).attr('rel');
        \$.post('/system/selectServer','area_id='+area_id,function(data){
                var response = eval('('+data+')');
                if(response.error == 0){
                    \$(\"#curServerName\").html(response.data);
                    alert('选择服务器成功');
                }
        });
    }

    function showErrorCodes(){
        \$.post('/error/showErrorCodes','',function(data){
            var response = eval('('+data+')');
            if(response.error == 0){
                var trs = '<tr> <th>代码</th><th>内容</th></tr>';
                \$.each(response.data,function(i,item){
                    trs += '<tr><td>'+item.code+'</td><td>'+item.name+'</td></tr>';
                });
                \$(\"#error_code_table\").html(trs);
                \$(\"#errorCodeModal\").modal();
            }
        });
    }

</script>
<!-- END JAVASCRIPTS -->
</html>";
    }

    // line 29
    public function block_title($context, array $blocks = array())
    {
    }

    // line 33
    public function block_description($context, array $blocks = array())
    {
    }

    // line 35
    public function block_author($context, array $blocks = array())
    {
    }

    // line 58
    public function block_css($context, array $blocks = array())
    {
        // line 59
        echo "    ";
    }

    // line 319
    public function block_content($context, array $blocks = array())
    {
        // line 320
        echo "        ";
    }

    // line 426
    public function block_javascript_plugins($context, array $blocks = array())
    {
    }

    // line 432
    public function block_javascript_custom($context, array $blocks = array())
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
        return array (  619 => 432,  614 => 426,  610 => 320,  607 => 319,  603 => 59,  600 => 58,  595 => 35,  590 => 33,  585 => 29,  544 => 434,  542 => 432,  536 => 428,  534 => 426,  427 => 321,  425 => 319,  386 => 282,  380 => 281,  374 => 277,  368 => 276,  361 => 272,  354 => 270,  350 => 268,  347 => 267,  343 => 266,  334 => 260,  329 => 258,  324 => 255,  320 => 253,  316 => 251,  313 => 250,  310 => 249,  306 => 248,  224 => 169,  178 => 125,  167 => 123,  163 => 122,  141 => 103,  96 => 60,  94 => 58,  68 => 35,  63 => 33,  56 => 29,  26 => 1,);
    }
}
