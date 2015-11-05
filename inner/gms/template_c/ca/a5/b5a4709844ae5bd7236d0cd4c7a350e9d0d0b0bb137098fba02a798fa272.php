<?php

/* chart_datas_total.html */
class __TwigTemplate_caa5b5a4709844ae5bd7236d0cd4c7a350e9d0d0b0bb137098fba02a798fa272 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'css' => array($this, 'block_css'),
            'content' => array($this, 'block_content'),
            'javascript_plugins' => array($this, 'block_javascript_plugins'),
            'javascript_custom' => array($this, 'block_javascript_custom'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        // line 5
        echo "数据概览
";
    }

    // line 8
    public function block_css($context, array $blocks = array())
    {
        // line 9
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/select2_metro.css\"/>
<link rel=\"stylesheet\" href=\"/media/css/DT_bootstrap.css\"/>
<link rel=\"stylesheet\" href=\"/media/css/common/form_search.css\"/>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/addtional.css\"/>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/datepicker.css\"/>
";
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "<!-- BEGIN PAGE HEADER-->


<div class=\"row-fluid\">


    <div class=\"span12\">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class=\"page-title\">
            数据概览
            <small></small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>


</div>


<!-- END PAGE HEADER-->


<!-- BEGIN PAGE CONTENT-->

<div class=\"row-fluid\">
    <div class=\"portlet\">
    <div class=\"portlet-title\">
        <div class=\"caption\"></div>
        <div class=\"tools\">
            <a href=\"javascript:;\" class=\"collapse\"></a>
        </div>
    </div>

    <span class=\"label label-important\">总览:</span><br/><br/>
    <div class=\"portlet-body\">
        <table class=\"table table-striped table-bordered table-hover\">
            <thead>
            <tr>
                <th>累计用户</th>
                <th class=\"hidden-phone\">累计付费用户</th>
                <th>累计付费金额</th>
                <th>付费率</th>
                <th>ARPU</th>
                <th>ARPPU</th>
            </tr>
            </thead>
            <tbody>
            <td>";
        // line 64
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "register", array()), "html", null, true);
        echo "</td>
            <td class=\"hidden-phone\">";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "rechargeNum", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "rechargeTotal", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 67
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "payRatio", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 68
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "ARPU", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 69
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "ARPPU", array()), "html", null, true);
        echo "</td>
            </tbody>
        </table>
    </div>
    <br/><br/>


    <span class=\"label label-important\">今日数据:</span><br/><br/>
    <div class=\"portlet-body\">
        <table class=\"table table-striped table-bordered table-hover\">
            <thead>
            <tr>
                <th>新增用户</th>
                <th class=\"hidden-phone\">活跃用户</th>
                <th>新增用户占比</th>
                <th>启动次数</th>
            </tr>
            </thead>
            <tbody>
            <td>";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["today"]) ? $context["today"] : null), "newUsers", array()), "html", null, true);
        echo "</td>
            <td class=\"hidden-phone\">";
        // line 89
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["today"]) ? $context["today"] : null), "vigorous", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 90
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["today"]) ? $context["today"] : null), "newUsersRatio", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 91
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["today"]) ? $context["today"] : null), "loginCount", array()), "html", null, true);
        echo "</td>
            </tbody>
        </table>
    </div>
    <br/><br/>

    <span class=\"label label-important\">时段分析:</span><br/><br/>
    <div class=\"portlet-body\">
        <div id=\"chart_t\" style=\"width:100%;height:230px;\"></div>
    </div>
    <br/><br/>

    <span class=\"label label-important\">整体趋势:</span><br/><br/>
    <div class=\"portlet-body\">
        <div id=\"chart_w\" style=\"width:100%;height:230px;\"></div>
    </div>
    <br/><br/>

    <span class=\"label label-important\">付费分析:</span><br/><br/>
    <div class=\"portlet-body\">
        <div id=\"chart_p\" style=\"width:100%;height:230px;\"></div>
    </div>
    <br/><br/>

    <span class=\"label label-important\">留存分析:</span><br/><br/>
    <div class=\"portlet-body\">
        <div id=\"chart_r\" style=\"width:100%;height:230px;\"></div>
    </div>
    <br/><br/>


    <span class=\"label label-important\">游戏规模:</span><br/><br/>
    <div class=\"portlet-body\">
        <table class=\"table table-striped table-bordered table-hover\">
            <thead>
            <tr>
                <th>累计用户</th>
                <th class=\"hidden-phone\">过去7天的活跃用户(%)</th>
                <th>过去30天的活跃用户(%)</th>
            </tr>
            </thead>
            <tbody>
            <td>";
        // line 133
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["e"]) ? $context["e"] : null), "register", array()), "html", null, true);
        echo "</td>
            <td class=\"hidden-phone\">";
        // line 134
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["e"]) ? $context["e"] : null), "weekVigorousRatio", array()), "html", null, true);
        echo "</td>
            <td>";
        // line 135
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["e"]) ? $context["e"] : null), "monthVigorousRatio", array()), "html", null, true);
        echo "</td>
            </tbody>
        </table>
    </div>
    <br/><br/>

    <span class=\"label label-important\">渠道分析:</span><br/><br/>
    <div class=\"portlet-body\">
        <div id=\"chart_pt\" style=\"width:100%;height:730px;\"></div>
    </div>
    <br/><br/>
</div>
</div>


<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>
<input type=\"hidden\" id=\"t\" value=\"";
        // line 154
        echo twig_escape_filter($this->env, (isset($context["t"]) ? $context["t"] : null), "html", null, true);
        echo "\" /><!--时段分析-->
<input type=\"hidden\" id=\"w\" value=\"";
        // line 155
        echo twig_escape_filter($this->env, (isset($context["w"]) ? $context["w"] : null), "html", null, true);
        echo "\" /><!--整体趋势-->
<input type=\"hidden\" id=\"p\" value=\"";
        // line 156
        echo twig_escape_filter($this->env, (isset($context["p"]) ? $context["p"] : null), "html", null, true);
        echo "\" /> <!--付费分析-->
<input type=\"hidden\" id=\"r\" value=\"";
        // line 157
        echo twig_escape_filter($this->env, (isset($context["r"]) ? $context["r"] : null), "html", null, true);
        echo "\" /> <!--留存分析-->
<input type=\"hidden\" id=\"pt\" value=\"";
        // line 158
        echo twig_escape_filter($this->env, (isset($context["pt"]) ? $context["pt"] : null), "html", null, true);
        echo "\" /> <!--留存分析-->
";
    }

    // line 162
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 163
        echo "<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/jquery.dataTables.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/DT_bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.zh-CN.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/echarts/echarts.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/private/chart_datas_total.js\"></script>
";
    }

    // line 172
    public function block_javascript_custom($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "chart_datas_total.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  269 => 172,  258 => 163,  255 => 162,  249 => 158,  245 => 157,  241 => 156,  237 => 155,  233 => 154,  211 => 135,  207 => 134,  203 => 133,  158 => 91,  154 => 90,  150 => 89,  146 => 88,  124 => 69,  120 => 68,  116 => 67,  112 => 66,  108 => 65,  104 => 64,  55 => 17,  52 => 16,  43 => 9,  40 => 8,  35 => 5,  32 => 4,);
    }
}
