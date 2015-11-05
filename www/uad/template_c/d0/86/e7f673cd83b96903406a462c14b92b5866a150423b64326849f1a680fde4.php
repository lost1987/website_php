<?php

/* comissioner.html */
class __TwigTemplate_d086e7f673cd83b96903406a462c14b92b5866a150423b64326849f1a680fde4 extends Twig_Template
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
    <div class=\"am-fl am-cf\"><strong class=\"am-text-primary am-text-lg\">推广员专区</strong>  <small></small></div>
</div>

<div class=\"am-g am-padding\">
    <div class=\"am-u-md-12 am-cf\">
            <table class=\"am-table am-table-striped am-table-hover table-main\">
                <caption class=\"am-text-left am-margin-left-sm\"><strong class=\"am-text-primary am-text-sm\">分成规则</strong></caption>
                <tr>
                    <th></th>
                    <th>< 10人</th>
                    <th>10-29人</th>
                    <th>30-59人</th>
                    <th>60-99人</th>
                    <th>> 100人</th>
                </tr>
                <tr>
                    <td>最高分成</td>
                    <td>";
        // line 19
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["maxRatio"]) ? $context["maxRatio"] : null), "ratio_stage0", array()) * 100), "html", null, true);
        echo "%</td>
                    <td>";
        // line 20
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["maxRatio"]) ? $context["maxRatio"] : null), "ratio_stage10", array()) * 100), "html", null, true);
        echo "%</td>
                    <td>";
        // line 21
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["maxRatio"]) ? $context["maxRatio"] : null), "ratio_stage30", array()) * 100), "html", null, true);
        echo "%</td>
                    <td>";
        // line 22
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["maxRatio"]) ? $context["maxRatio"] : null), "ratio_stage60", array()) * 100), "html", null, true);
        echo "%</td>
                    <td>";
        // line 23
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["maxRatio"]) ? $context["maxRatio"] : null), "ratio_stage100", array()) * 100), "html", null, true);
        echo "%</td>
                </tr>
                <tr>
                    <td>当前分成</td>
                    <td>";
        // line 27
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["curRatio"]) ? $context["curRatio"] : null), "ratio_stage0", array()) * 100), "html", null, true);
        echo "%</td>
                    <td>";
        // line 28
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["curRatio"]) ? $context["curRatio"] : null), "ratio_stage10", array()) * 100), "html", null, true);
        echo "%</td>
                    <td>";
        // line 29
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["curRatio"]) ? $context["curRatio"] : null), "ratio_stage30", array()) * 100), "html", null, true);
        echo "%</td>
                    <td>";
        // line 30
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["curRatio"]) ? $context["curRatio"] : null), "ratio_stage60", array()) * 100), "html", null, true);
        echo "%</td>
                    <td>";
        // line 31
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["curRatio"]) ? $context["curRatio"] : null), "ratio_stage100", array()) * 100), "html", null, true);
        echo "%</td>
                </tr>
            </table>


            <table class=\"am-table am-table-striped am-table-hover table-main\">
                <caption class=\"am-text-left am-margin-left-sm\"><strong class=\"am-text-primary am-text-sm\">当前状态</strong></caption>
                <tr>
                    <th>一级下线</th>
                    <th>状态</th>
                    <th>活跃下线(昨日)</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td>";
        // line 45
        echo twig_escape_filter($this->env, (isset($context["childNum"]) ? $context["childNum"] : null), "html", null, true);
        echo "人</td>
                    <td>
                        <a href=\"javascript:;\" id=\"comment\">";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["selfApply"]) ? $context["selfApply"] : null), "stateName", array()), "html", null, true);
        echo "</a>
                    </td>
                    <td>";
        // line 49
        echo twig_escape_filter($this->env, (isset($context["virgousNum"]) ? $context["virgousNum"] : null), "html", null, true);
        echo "人 &nbsp; [<a href=\"javascript:;\" onclick=\"showChildrenVigrous()\">详情</a>]</td>
                    <td>
                        <div class=\"am-btn-toolbar\">
                            <div class=\"am-btn-group am-btn-group-xs\">
                                <button id=\"selfApplyBtn\" class=\"am-btn am-btn-default am-btn-xs am-text-secondary\" onclick=\"selfRatioApply(";
        // line 53
        echo twig_escape_filter($this->env, (isset($context["uid"]) ? $context["uid"] : null), "html", null, true);
        echo ")\" ";
        echo twig_escape_filter($this->env, (isset($context["upButtonDisabled"]) ? $context["upButtonDisabled"] : null), "html", null, true);
        echo "> 提升分成比例</button>
                                <input type=\"hidden\" value=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "comment", array()), "html", null, true);
        echo "\" />
                            </div>
                        </div>
                    </td>
                    ";
        // line 58
        if (($this->getAttribute((isset($context["selfApply"]) ? $context["selfApply"] : null), "state", array()) == 2)) {
            // line 59
            echo "                    <script>
                    \$(function() {
                        \$('#comment').popover({
                            content: '";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["selfApply"]) ? $context["selfApply"] : null), "comment", array()), "html", null, true);
            echo "',
                            trigger:'hover'
                        })
                    });
                    </script>
                    ";
        }
        // line 68
        echo "                </tr>
            </table>
    </div>
</div>

<div class=\"am-g am-padding\">
    <div class=\"am-u-md-12 am-cf\">
        <div class=\"am-fl am-cf\">
            <form class=\"am-form-inline am-margin-left-sm\">
                <div class=\"am-form-group am-form-icon am-margin-right-sm\">
                    <input type=\"text\" name=\"search_nickname\" id=\"search_nickname\" value=\"";
        // line 78
        echo twig_escape_filter($this->env, (isset($context["nickname"]) ? $context["nickname"] : null), "html", null, true);
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
                <th>下线昵称</th>
                <th>返现比例</th>
                <th>返现提成</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 98
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 99
            echo "            <tr>
                <td>";
            // line 100
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "nickname", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 101
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "from_ratio", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 102
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "coins_change", array()), "html", null, true);
            echo "</td>
                <td>
                    <div class=\"am-btn-toolbar\">
                    <div class=\"am-btn-group am-btn-group-xs\">
                        <button class=\"am-btn am-btn-default am-btn-xs am-text-secondary\" onclick=\"childRatioApply(";
            // line 106
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "from_uid", array()), "html", null, true);
            echo ",this)\" ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "childApplyBtnDisabled", array()), "html", null, true);
            echo ">申请福利</button>
                        <input type=\"hidden\" value=\"";
            // line 107
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "comment", array()), "html", null, true);
            echo "\" />
                    </div>
                    </div>
                </td>
            </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 113
        echo "            </tbody>
        </table>
        <div class=\"am-cf am-margin-left-sm\">
            共 ";
        // line 116
        echo twig_escape_filter($this->env, (isset($context["num_rows"]) ? $context["num_rows"] : null), "html", null, true);
        echo " 条记录
            <div class=\"am-fr\">
                <ul class=\"am-pagination\">
                    ";
        // line 119
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
                </ul>
            </div>
        </div>
    </div>
</div>
<script src=\"";
        // line 125
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/common-list.js\"></script>
<script src=\"";
        // line 126
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/standalone/comissioner.js\"></script>";
    }

    public function getTemplateName()
    {
        return "comissioner.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  240 => 126,  236 => 125,  227 => 119,  221 => 116,  216 => 113,  204 => 107,  198 => 106,  191 => 102,  187 => 101,  183 => 100,  180 => 99,  176 => 98,  153 => 78,  141 => 68,  132 => 62,  127 => 59,  125 => 58,  118 => 54,  112 => 53,  105 => 49,  100 => 47,  95 => 45,  78 => 31,  74 => 30,  70 => 29,  66 => 28,  62 => 27,  55 => 23,  51 => 22,  47 => 21,  43 => 20,  39 => 19,  19 => 1,);
    }
}
