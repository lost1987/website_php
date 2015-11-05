<?php

/* vigrous_children.html */
class __TwigTemplate_d6fc70e2726970220cee103de2164d844fb3c2588d5f6b9cb6a540a283a2b1e8 extends Twig_Template
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
        echo "<style>
    .am-datepicker tr.am-datepicker-header{
       color:black;
       background-color: white;
    }

    .am-datepicker td.am-datepicker-old, .am-datepicker td.am-datepicker-new{
        color:#c7c7c7;
    }

    .am-datepicker .am-datepicker-dow{
        color:black;
    }

    .am-datepicker-caret{
        border-bottom: white;
    }

</style>

<div class=\"am-cf am-padding\">
    <div class=\"am-fl am-cf\"><strong class=\"am-text-primary am-text-lg\">下线活跃度</strong>  <small></small></div>
</div>

<!--
<div class=\"am-g am-padding\">
    <div class=\"am-u-md-12 am-cf\">
        <div class=\"am-fl am-cf\">
            <form class=\"am-form-inline\">
                <div class=\"am-form-group am-form-icon am-margin-right-sm\">
                    <label>日期</label>
                    <input type=\"text\" name=\"search_create_time\" id=\"search_create_time\" value=\"";
        // line 32
        echo twig_escape_filter($this->env, (isset($context["search_create_time"]) ? $context["search_create_time"] : null), "html", null, true);
        echo "\" class=\"am-form-field form_datetime\" data-am-datepicker readonly placeholder=\"申请日期\">
                </div>

                <button type=\"button\" id=\"search_btn\"  class=\"am-btn am-btn-default\"><i class=\"am-icon-search\"></i>&nbsp;搜索</button>
            </form>
        </div>
    </div>
</div>
-->

<div class=\"am-g am-padding\">
    <div class=\"am-u-sm-12\">
        <table class=\"am-table am-table-striped am-table-hover table-main\">
            <thead>
            <tr>
                <th>昵称</th>
                <th>活跃</th>
                <th>已累积经验</th>
                <th>注册时间</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 54
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 55
            echo "            <tr>
                <td>";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "nickname", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "virgous", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "expr_get", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "create_time", array()), "html", null, true);
            echo "</td>
            </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        echo "            </tbody>
        </table>
        <div class=\"am-cf\">
            共 ";
        // line 65
        echo twig_escape_filter($this->env, (isset($context["num_rows"]) ? $context["num_rows"] : null), "html", null, true);
        echo " 条记录
            <div class=\"am-fr\">
                <ul class=\"am-pagination\">
                    ";
        // line 68
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
                </ul>
            </div>
        </div>
    </div>
</div>



<script src=\"";
        // line 77
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/standalone/vigrous_children.js\"></script>
<script src=\"";
        // line 78
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/common-list.js\"></script>";
    }

    public function getTemplateName()
    {
        return "vigrous_children.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 78,  128 => 77,  116 => 68,  110 => 65,  105 => 62,  96 => 59,  92 => 58,  88 => 57,  84 => 56,  81 => 55,  77 => 54,  52 => 32,  19 => 1,);
    }
}
