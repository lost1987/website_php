<?php

/* chart_datas_baoxiang_table.html */
class __TwigTemplate_c5d9bf940b412fdc06316babac9a511159d2dffd27edaea273180444a2ab3a96 extends Twig_Template
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
        echo "宝箱场统计
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
            宝箱场统计
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
                    <th>钻石出现概率</th>
                    <th class=\"hidden-phone\">奖券出现概率</th>
                </tr>
                </thead>
                <tbody>
                <td>";
        // line 60
        echo twig_escape_filter($this->env, (isset($context["diamondRatio"]) ? $context["diamondRatio"] : null), "html", null, true);
        echo "</td>
                <td class=\"hidden-phone\">";
        // line 61
        echo twig_escape_filter($this->env, (isset($context["couponRatio"]) ? $context["couponRatio"] : null), "html", null, true);
        echo "</td>
                </tbody>
            </table>
        </div>
        <br/><br/>

        <span class=\"label label-important\">开宝箱次数:</span><br/><br/>
        <div class=\"portlet-body\">
            <div id=\"chart1\" style=\"width:100%;height:230px;\"></div>
        </div>
        <br/><br/>

        <span class=\"label label-important\">机器人金币输赢:</span><br/><br/>
        <div class=\"portlet-body\">
            <div id=\"chart2\" style=\"width:100%;height:230px;\"></div>
        </div>
        <br/><br/>

        <span class=\"label label-important\">奖券钻石发放:</span><br/><br/>
        <div class=\"portlet-body\">
            <div id=\"chart3\" style=\"width:100%;height:230px;\"></div>
        </div>
        <br/><br/>

        <span class=\"label label-important\">宝箱桌数和人数:</span><br/><br/>
        <div class=\"portlet-body\">
            <div id=\"chart4\" style=\"width:100%;height:230px;\"></div>
        </div>
        <br/><br/>
    </div>
</div>


<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>
<input type=\"hidden\" id=\"dateLine\" value=\"";
        // line 98
        echo twig_escape_filter($this->env, (isset($context["dateLine"]) ? $context["dateLine"] : null), "html", null, true);
        echo "\" /><!--时间线-->
<input type=\"hidden\" id=\"data\" value=\"";
        // line 99
        echo twig_escape_filter($this->env, (isset($context["data"]) ? $context["data"] : null), "html", null, true);
        echo "\" /><!--数据-->
";
    }

    // line 103
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 104
        echo "<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/jquery.dataTables.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/DT_bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.zh-CN.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/echarts/echarts.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/private/chart_datas_baoxiang_table.js\"></script>
";
    }

    // line 113
    public function block_javascript_custom($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "chart_datas_baoxiang_table.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  168 => 113,  157 => 104,  154 => 103,  148 => 99,  144 => 98,  104 => 61,  100 => 60,  55 => 17,  52 => 16,  43 => 9,  40 => 8,  35 => 5,  32 => 4,);
    }
}
