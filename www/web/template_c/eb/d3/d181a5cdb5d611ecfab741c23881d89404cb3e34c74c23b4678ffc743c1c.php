<?php

/* basePersonnal.html */
class __TwigTemplate_ebd3d181a5cdb5d611ecfab741c23881d89404cb3e34c74c23b4678ffc743c1c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'title' => array($this, 'block_title'),
            'css' => array($this, 'block_css'),
            'banner' => array($this, 'block_banner'),
            'content' => array($this, 'block_content'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
    <meta name=\"keywords\" content=\"";
        // line 6
        $this->displayBlock('keywords', $context, $blocks);
        echo "\">
    <meta name=\"description\" content=\"";
        // line 7
        $this->displayBlock('description', $context, $blocks);
        echo "\">
    <meta name=\"author\" content=\"\">

    <!-- Note there is no responsive meta tag here -->

    <title>";
        // line 12
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    <!-- Bootstrap core CSS -->
    <link href=\"";
        // line 15
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/css/bootstrap.css\" rel=\"stylesheet\">

    <!-- Custom styles for this template -->
    <link href=\"";
        // line 18
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/css/main.css\" rel=\"stylesheet\">
    ";
        // line 19
        $this->displayBlock('css', $context, $blocks);
        // line 21
        echo "</head>

<body>

";
        // line 25
        $this->env->loadTemplate("header.html")->display($context);
        // line 26
        echo "
";
        // line 27
        $this->displayBlock('banner', $context, $blocks);
        // line 30
        echo "
<div class=\"main\">
    <div class=\"container\">
        <div class=\"\">
            <div class=\"row\">
                <div class=\"col-xs-2\">
                    <div class=\"bg-blueD inner\">
                        <div class=\"mainTitle\">
                            <h3 class=\"sTitle\">
                                <a href=\"/userinfo\">
                                <span class=\"icon icon-user-w\"></span>
                                <span class=\"bl1\">
                                  <span class=\"uppercase\">USER</span><br>个人中心
                                </span>
                                </a>
                            </h3>
                        </div>
                        <div class=\"leftSide pt30 pb30 pl10\">
                            <ul class=\"nav nav-pills nav-stacked\" role=\"tablist\">
                                <li class=\"";
        // line 49
        echo twig_escape_filter($this->env, (isset($context["userInfoActive"]) ? $context["userInfoActive"] : null), "html", null, true);
        echo "\"><a href=\"/userinfo\"><span class=\"icon icon-arrowR-org\"></span>账号信息</a></li>
                                <li class=\"";
        // line 50
        echo twig_escape_filter($this->env, (isset($context["userOrderActive"]) ? $context["userOrderActive"] : null), "html", null, true);
        echo "\"><a href=\"/userinfo/myOrders\"><span class=\"icon icon-arrowR-org\"></span>我的订单</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

        ";
        // line 56
        $this->displayBlock('content', $context, $blocks);
        // line 58
        echo "
        ";
        // line 59
        $this->env->loadTemplate("faq_right_bar.html")->display($context);
        // line 60
        echo "    </div>
</div>
    </div> <!-- /container -->
</div>

<div class=\"\">
    <div class=\"container\">
        <div class=\"footer\">
            ";
        // line 68
        $this->env->loadTemplate("footer.html")->display($context);
        // line 69
        echo "        </div>
    </div>
</div>
";
        // line 72
        $this->env->loadTemplate("notice.html")->display($context);
        // line 73
        echo "<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- Placed at the end of the document so the pages load faster -->
<script src=\"";
        // line 77
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/jquery.min.js\"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src=\"http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js\"></script>
<script src=\"http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js\"></script>
<![endif]-->
<script src=\"";
        // line 84
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/bootstrap.min.js\"></script>
<script src=\"";
        // line 85
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/common.js\"></script>
";
        // line 86
        $this->displayBlock('script', $context, $blocks);
        // line 88
        echo "</body>
</html>
";
    }

    // line 6
    public function block_keywords($context, array $blocks = array())
    {
    }

    // line 7
    public function block_description($context, array $blocks = array())
    {
    }

    // line 12
    public function block_title($context, array $blocks = array())
    {
    }

    // line 19
    public function block_css($context, array $blocks = array())
    {
        // line 20
        echo "    ";
    }

    // line 27
    public function block_banner($context, array $blocks = array())
    {
        // line 28
        echo "<div class=\"banner02\"></div>
";
    }

    // line 56
    public function block_content($context, array $blocks = array())
    {
        // line 57
        echo "        ";
    }

    // line 86
    public function block_script($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "basePersonnal.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 86,  201 => 57,  198 => 56,  190 => 27,  186 => 20,  183 => 19,  178 => 12,  173 => 7,  168 => 6,  162 => 88,  160 => 86,  156 => 85,  152 => 84,  136 => 73,  134 => 72,  117 => 60,  115 => 59,  112 => 58,  110 => 56,  101 => 50,  97 => 49,  76 => 30,  74 => 27,  71 => 26,  69 => 25,  63 => 21,  61 => 19,  51 => 15,  45 => 12,  37 => 7,  26 => 1,  581 => 339,  577 => 338,  573 => 337,  568 => 335,  565 => 334,  562 => 333,  552 => 326,  540 => 323,  528 => 320,  516 => 317,  513 => 316,  511 => 315,  500 => 313,  488 => 310,  476 => 307,  324 => 157,  310 => 156,  302 => 154,  294 => 152,  291 => 151,  274 => 150,  249 => 127,  242 => 124,  235 => 121,  233 => 120,  229 => 118,  222 => 115,  215 => 112,  213 => 111,  209 => 109,  202 => 106,  195 => 103,  193 => 28,  176 => 88,  171 => 86,  164 => 82,  159 => 80,  146 => 69,  142 => 77,  140 => 66,  137 => 65,  133 => 63,  129 => 69,  127 => 68,  114 => 50,  106 => 45,  98 => 40,  90 => 35,  82 => 30,  70 => 20,  67 => 19,  60 => 16,  57 => 18,  52 => 12,  49 => 11,  44 => 8,  41 => 7,  36 => 4,  33 => 6,);
    }
}
