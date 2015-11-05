<?php

/* news_right_bar.html */
class __TwigTemplate_5d170acc59cb4d4e0d74cba024ce020252f4dc70a7f088e35d5e25b9ac3ff855 extends Twig_Template
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
        echo "<div class=\"col-xs-4\">
    <div class=\"bl1 ml15 inner\">
        <div class=\"p15 bb1 pt30\">
            <h4 class=\"mbn\"><strong>焦点资讯</strong></h4>
        </div>
        <div class=\"pt15 pr15\">
            <ul class=\"list list03 nowrap\">
                ";
        // line 8
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["right_bar_news"]) ? $context["right_bar_news"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 9
            echo "                <li><a href=\"/articles/detail/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
            echo "</a></li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "            </ul>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "news_right_bar.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 11,  32 => 9,  28 => 8,  19 => 1,  172 => 62,  168 => 35,  165 => 34,  160 => 29,  157 => 28,  153 => 21,  150 => 20,  145 => 13,  140 => 8,  135 => 7,  129 => 64,  127 => 62,  123 => 61,  119 => 60,  109 => 53,  92 => 41,  84 => 36,  82 => 34,  77 => 31,  72 => 27,  70 => 26,  62 => 20,  58 => 19,  52 => 16,  46 => 13,  38 => 8,  26 => 1,  99 => 45,  97 => 44,  90 => 40,  79 => 24,  75 => 28,  67 => 17,  64 => 22,  61 => 15,  54 => 12,  51 => 11,  44 => 8,  41 => 7,  34 => 7,  31 => 3,);
    }
}
