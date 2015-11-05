<?php

/* children.html */
class __TwigTemplate_20fedbe0653b5a391ddbe6bfeb025cbd9835f242d6dd4b0706b66cd1295901a2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"am-cf am-padding\">
    <div class=\"am-fl am-cf\"><strong class=\"am-text-primary am-text-lg\"><span class=\"am-badge am-badge-primary am-radius\">";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "nickname", array()), "html", null, true);
        echo "</span></strong> / <small>下线列表</small></div>
</div>

<div class=\"am-g\">
<div class=\"am-u-md-12 am-cf\">
<div class=\"am-g\">
<div class=\"am-u-sm-12\">
<table class=\"am-table am-table-striped am-table-hover table-main\">
<thead>
<tr>
    <th class=\"table-check\"><input type=\"checkbox\" /></th>
    <th>UID</th>
    <th>账号</th>
    <th>昵称</th>
    <th>级</th>
    ";
        // line 17
        if (($this->getAttribute((isset($context["user"]) ? $context["user"] : null), "comissioner", array()) == 1)) {
            // line 18
            echo "    <th>上月获得经验值</th>
    <th>本月获得经验值</th>
    <th>总经验值</th>
    ";
        }
        // line 22
        echo "</tr>
</thead>
<tbody>
";
        // line 25
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 26
            echo "<tr>
    <td><input type=\"checkbox\" /></td>
    <td>";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo "</td>
    <td><a href=\"javascript:;\">";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
            echo "</a></td>
    <td>";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "nickname", array()), "html", null, true);
            echo "</td>
    <td>";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "leaf", array()), "html", null, true);
            echo "</td>
    ";
            // line 32
            if (($this->getAttribute((isset($context["user"]) ? $context["user"] : null), "comissioner", array()) == 1)) {
                // line 33
                echo "    <td>";
                echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "expr_get_last", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "expr_get_last", array()), 0)) : (0)), "html", null, true);
                echo "</td>
    <td>";
                // line 34
                echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "expr_get_current", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "expr_get_current", array()), 0)) : (0)), "html", null, true);
                echo "</td>
    <td>";
                // line 35
                echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "expr_reach", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "expr_reach", array()), 0)) : (0)), "html", null, true);
                echo "</td>
    ";
            }
            // line 37
            echo "</tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "</tbody>
</table>
<div class=\"am-cf\">
    共 ";
        // line 42
        echo twig_escape_filter($this->env, (isset($context["total"]) ? $context["total"] : null), "html", null, true);
        echo " 条记录
    <div class=\"am-fr\">
        <ul class=\"am-pagination\">
            ";
        // line 45
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
        </ul>
    </div>
</div>
</div>
</div>
";
        // line 51
        $this->displayBlock('script', $context, $blocks);
    }

    public function block_script($context, array $blocks = array())
    {
        // line 52
        echo "<script>
    var uid = ";
        // line 53
        echo twig_escape_filter($this->env, (isset($context["uid"]) ? $context["uid"] : null), "html", null, true);
        echo ";
</script>
<script src=\"";
        // line 55
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/standalone/children.js\"></script>
<script src=\"";
        // line 56
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/common-list.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "children.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  139 => 56,  135 => 55,  130 => 53,  127 => 52,  121 => 51,  112 => 45,  106 => 42,  101 => 39,  94 => 37,  89 => 35,  85 => 34,  80 => 33,  78 => 32,  74 => 31,  70 => 30,  66 => 29,  62 => 28,  58 => 26,  54 => 25,  49 => 22,  43 => 18,  41 => 17,  23 => 2,  20 => 1,);
    }
}
