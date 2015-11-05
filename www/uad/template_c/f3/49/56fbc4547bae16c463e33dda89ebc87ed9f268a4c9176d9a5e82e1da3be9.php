<?php

/* children.html */
class __TwigTemplate_f34956fbc4547bae16c463e33dda89ebc87ed9f268a4c9176d9a5e82e1da3be9 extends Twig_Template
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
        echo "<div class=\"am-cf am-padding\">
    <div class=\"am-fl am-cf\"><strong class=\"am-text-primary am-text-lg\">好友管理</strong>  <small></small></div>
</div>

<div class=\"am-g am-padding\">
    <div class=\"am-u-md-12 am-cf\">
            <table class=\"am-table am-table-striped am-table-hover table-main\">
                <tr>
                    <th>今日新增下线</th>
                    <th>本周新增下线</th>
                    <th>本月新增下线</th>
                    <th>总下线</th>
                </tr>
                <tr>
                    <td>";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["todayChild"]) ? $context["todayChild"] : null), "html", null, true);
        echo "</td>
                    <td>";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["weekChild"]) ? $context["weekChild"] : null), "html", null, true);
        echo "</td>
                    <td>";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["monthChild"]) ? $context["monthChild"] : null), "html", null, true);
        echo "</td>
                    <td>";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["totalChild"]) ? $context["totalChild"] : null), "html", null, true);
        echo "</td>
                </tr>
                <tr>
                    <th>今日下线收益</th>
                    <th>本周下线收益</th>
                    <th>本月下线收益</th>
                    <th>总收益</th>
                </tr>
                <tr>
                    <td>";
        // line 27
        echo twig_escape_filter($this->env, (isset($context["todayIncome"]) ? $context["todayIncome"] : null), "html", null, true);
        echo "</td>
                    <td>";
        // line 28
        echo twig_escape_filter($this->env, (isset($context["weekIncome"]) ? $context["weekIncome"] : null), "html", null, true);
        echo "</td>
                    <td>";
        // line 29
        echo twig_escape_filter($this->env, (isset($context["monthIncome"]) ? $context["monthIncome"] : null), "html", null, true);
        echo "</td>
                    <td>";
        // line 30
        echo twig_escape_filter($this->env, (isset($context["totalIncome"]) ? $context["totalIncome"] : null), "html", null, true);
        echo "</td>
                </tr>
            </table>
    </div>
</div>

<div class=\"am-g am-padding\">
    <div class=\"am-u-md-12 am-cf\">
        <div class=\"am-fl am-cf\">
            <form class=\"am-form-inline am-margin-left-sm\">
                <div class=\"am-form-group am-form-icon am-margin-right-sm\">
                    <input type=\"text\" name=\"search_nickname\" id=\"search_nickname\" value=\"";
        // line 41
        echo twig_escape_filter($this->env, (isset($context["search_nickname"]) ? $context["search_nickname"] : null), "html", null, true);
        echo "\" class=\"am-form-field form_datetime\" placeholder=\"下线昵称\">
                </div>
                <button type=\"button\" id=\"search_btn\"  class=\"am-btn am-btn-default\"><i class=\"am-icon-search\"></i>&nbsp;搜索</button>
            </form>
        </div>
    </div>
</div>

<div class=\"am-g am-padding\">
    <div class=\"am-u-sm-12\">
        <table class=\"am-table am-table-striped am-table-hover table-main\">
            <thead>
            <tr>
                <th>昵称</th>
                <th>充值提成</th>
                <th>提现提成</th>
                <th>成长提成</th>
                <th>签到提成</th>
                <th>总收益</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 63
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 64
            echo "            <tr>
                <td>";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "nickname", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "incomeRecharge", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 67
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "incomeDeposit", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 68
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "incomeLevelup", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "incomeSign", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 70
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "incomeTotal", array()), "html", null, true);
            echo "</td>
            </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        echo "            </tbody>
        </table>
        <div class=\"am-cf\">
            共 ";
        // line 76
        echo twig_escape_filter($this->env, (isset($context["num_rows"]) ? $context["num_rows"] : null), "html", null, true);
        echo " 条记录
            <div class=\"am-fr\">
                <ul class=\"am-pagination\">
                    ";
        // line 79
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
                </ul>
            </div>
        </div>
    </div>
</div>
<script src=\"";
        // line 85
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/common-list.js\"></script>
<script src=\"";
        // line 86
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/standalone/children.js\"></script>";
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
        return array (  170 => 86,  166 => 85,  157 => 79,  151 => 76,  146 => 73,  137 => 70,  133 => 69,  129 => 68,  125 => 67,  121 => 66,  117 => 65,  114 => 64,  110 => 63,  85 => 41,  71 => 30,  67 => 29,  63 => 28,  59 => 27,  47 => 18,  43 => 17,  39 => 16,  35 => 15,  19 => 1,);
    }
}
