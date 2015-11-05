<?php

/* baseMain.html */
class __TwigTemplate_7b9a7bb4d876a1ed2046740c0a5ff2796a44c8ccb73aa784f19408577ba8910f extends Twig_Template
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
        // line 20
        $this->displayBlock('css', $context, $blocks);
        // line 22
        echo "</head>

<body>

";
        // line 26
        $this->env->loadTemplate("header.html")->display($context);
        // line 27
        echo "
";
        // line 28
        $this->displayBlock('banner', $context, $blocks);
        // line 30
        echo "
<div class=\"main\">
    <div class=\"container\">
        ";
        // line 33
        $this->env->loadTemplate("floatCode.html")->display($context);
        // line 34
        echo "        <div class=\"row\">
            ";
        // line 35
        $this->env->loadTemplate("index_left_bar.html")->display($context);
        // line 36
        echo "            ";
        $this->displayBlock('content', $context, $blocks);
        // line 38
        echo "        </div>
    </div> <!-- /container -->
</div>

<div class=\"\">
    <div class=\"container\">
        <div class=\"footer\">
            ";
        // line 45
        $this->env->loadTemplate("footer.html")->display($context);
        // line 46
        echo "        </div>
    </div>
</div>
";
        // line 49
        $this->env->loadTemplate("notice.html")->display($context);
        // line 50
        echo "<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src=\"";
        // line 53
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/jquery.min.js\"></script>
<script src=\"";
        // line 54
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/jquery.SuperSlide.2.1.1.js\"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src=\"http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js\"></script>
<script src=\"http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js\"></script>
<![endif]-->
<script src=\"";
        // line 61
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/jquery.datetimepicker.js\"></script>
<script src=\"";
        // line 62
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/common.js\"></script>
<script src=\"";
        // line 63
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/calendar.js\"></script>
";
        // line 64
        $this->displayBlock('script', $context, $blocks);
        // line 66
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

    // line 20
    public function block_css($context, array $blocks = array())
    {
        // line 21
        echo "    ";
    }

    // line 28
    public function block_banner($context, array $blocks = array())
    {
    }

    // line 36
    public function block_content($context, array $blocks = array())
    {
        // line 37
        echo "            ";
    }

    // line 64
    public function block_script($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "baseMain.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  183 => 64,  179 => 37,  176 => 36,  171 => 28,  167 => 21,  164 => 20,  159 => 12,  154 => 7,  149 => 6,  141 => 64,  137 => 63,  129 => 61,  119 => 54,  115 => 53,  110 => 50,  108 => 49,  101 => 45,  92 => 38,  89 => 36,  87 => 35,  84 => 34,  82 => 33,  75 => 28,  72 => 27,  64 => 22,  62 => 20,  51 => 15,  45 => 12,  37 => 7,  26 => 1,  576 => 276,  572 => 275,  568 => 274,  563 => 272,  559 => 271,  556 => 270,  553 => 269,  472 => 191,  462 => 187,  459 => 186,  455 => 185,  450 => 183,  439 => 174,  425 => 173,  420 => 170,  418 => 169,  405 => 168,  398 => 163,  395 => 162,  390 => 159,  387 => 158,  370 => 157,  366 => 155,  355 => 150,  351 => 149,  345 => 148,  339 => 145,  335 => 143,  331 => 142,  327 => 141,  320 => 136,  311 => 133,  308 => 132,  304 => 131,  300 => 130,  294 => 126,  279 => 124,  271 => 122,  263 => 120,  260 => 119,  243 => 118,  236 => 113,  234 => 112,  231 => 111,  228 => 110,  220 => 103,  213 => 99,  205 => 94,  199 => 91,  191 => 86,  178 => 75,  155 => 55,  146 => 48,  143 => 66,  136 => 43,  133 => 62,  127 => 38,  125 => 37,  118 => 36,  114 => 34,  107 => 32,  103 => 46,  97 => 28,  95 => 27,  90 => 25,  86 => 24,  80 => 22,  77 => 30,  73 => 20,  70 => 26,  68 => 18,  60 => 16,  57 => 18,  52 => 12,  49 => 11,  44 => 8,  41 => 7,  36 => 4,  33 => 6,);
    }
}
