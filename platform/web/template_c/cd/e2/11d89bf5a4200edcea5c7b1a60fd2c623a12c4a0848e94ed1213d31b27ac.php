<?php

/* article_tablist.html */
class __TwigTemplate_cde211d89bf5a4200edcea5c7b1a60fd2c623a12c4a0848e94ed1213d31b27ac extends Twig_Template
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
        echo "<ul class=\"nav nav-tabs nav01\" role=\"tablist\">
    <li class=\"";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["xwzx"]) ? $context["xwzx"] : null), "html", null, true);
        echo "\"><a href=\"/articles\"><span class=\"icon icon-globe\"></span>公告资讯</a></li>
    <li class=\"";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["hdzq"]) ? $context["hdzq"] : null), "html", null, true);
        echo "\"><a href=\"/activity\"><span class=\"icon icon-boolom\"></span>活动专区</a></li>
    <!--<li class=\"";
        // line 4
        echo twig_escape_filter($this->env, (isset($context["phb"]) ? $context["phb"] : null), "html", null, true);
        echo "\"><a href=\"/rank\"><span class=\"icon icon-rank\"></span>排行榜</a></li>-->
    <li class=\"";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["xszn"]) ? $context["xszn"] : null), "html", null, true);
        echo "\"><a href=\"/introduce\"><span class=\"icon icon-dir\"></span>新手指南</a></li>
</ul>";
    }

    public function getTemplateName()
    {
        return "article_tablist.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 2,  39 => 13,  34 => 5,  23 => 3,  138 => 81,  135 => 80,  126 => 77,  117 => 70,  112 => 68,  105 => 65,  100 => 63,  78 => 44,  50 => 18,  48 => 17,  38 => 13,  32 => 11,  30 => 4,  19 => 1,  183 => 64,  179 => 37,  176 => 36,  171 => 28,  167 => 21,  164 => 20,  159 => 12,  154 => 7,  149 => 6,  141 => 64,  137 => 63,  129 => 78,  119 => 54,  115 => 69,  110 => 50,  108 => 49,  101 => 45,  92 => 38,  89 => 36,  87 => 35,  84 => 34,  82 => 33,  75 => 28,  72 => 27,  64 => 22,  62 => 20,  51 => 15,  45 => 12,  37 => 7,  26 => 3,  576 => 276,  572 => 275,  568 => 274,  563 => 272,  559 => 271,  556 => 270,  553 => 269,  472 => 191,  462 => 187,  459 => 186,  455 => 185,  450 => 183,  439 => 174,  425 => 173,  420 => 170,  418 => 169,  405 => 168,  398 => 163,  395 => 162,  390 => 159,  387 => 158,  370 => 157,  366 => 155,  355 => 150,  351 => 149,  345 => 148,  339 => 145,  335 => 143,  331 => 142,  327 => 141,  320 => 136,  311 => 133,  308 => 132,  304 => 131,  300 => 130,  294 => 126,  279 => 124,  271 => 122,  263 => 120,  260 => 119,  243 => 118,  236 => 113,  234 => 112,  231 => 111,  228 => 110,  220 => 103,  213 => 99,  205 => 94,  199 => 91,  191 => 86,  178 => 75,  155 => 55,  146 => 48,  143 => 66,  136 => 43,  133 => 62,  127 => 38,  125 => 37,  118 => 36,  114 => 34,  107 => 32,  103 => 64,  97 => 28,  95 => 27,  90 => 25,  86 => 24,  80 => 22,  77 => 30,  73 => 20,  70 => 26,  68 => 18,  60 => 16,  57 => 18,  52 => 12,  49 => 11,  44 => 15,  41 => 7,  36 => 4,  33 => 6,);
    }
}
