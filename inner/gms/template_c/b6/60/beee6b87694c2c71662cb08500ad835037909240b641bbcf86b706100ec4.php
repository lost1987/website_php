<?php

/* chart_datas_robot_cheat.html */
class __TwigTemplate_b660beee6b87694c2c71662cb08500ad835037909240b641bbcf86b706100ec4 extends Twig_Template
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
        echo "机器人作弊
";
    }

    // line 8
    public function block_css($context, array $blocks = array())
    {
        // line 9
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/select2_metro.css\"/>
<link rel=\"stylesheet\" href=\"/media/css/DT_bootstrap.css\"/>
<link rel=\"stylesheet\" href=\"/media/css/common/form_search.css\"/>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/addtional.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/datepicker.css\" />
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
            机器人作弊
            <small></small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>


</div>


<!-- END PAGE HEADER-->


<!-- BEGIN PAGE CONTENT-->

<div class=\"row-fluid\">
    <!--表格查询区-->
    <form class=\"form-actions\" action=\"/datas/robotCheat/53\" method=\"get\" id=\"search_form\">
        <div class=\"control-group search_form_wrap span4\">
            <label class=\"control-label span2\"><b class=\"midnight\">精度</b></label>
            <div class=\"controls\">
                <select class=\"span2 m-wrap\" name=\"precision\" id=\"precision\">
                    ";
        // line 48
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["precisionlist"]) ? $context["precisionlist"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 49
            echo "                    ";
            if (((isset($context["key"]) ? $context["key"] : null) == (isset($context["search_precision"]) ? $context["search_precision"] : null))) {
                // line 50
                echo "                    <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                    ";
            } else {
                // line 52
                echo "                    <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                    ";
            }
            // line 54
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "                </select>
            </div>
        </div>
        <div class=\"dataTables_filter\">
            <a href=\"javascript:;\" class=\"btn red\" onclick=\"doSearch()\"><i class=\"icon-search\"></i>&nbsp;查询</a>
        </div>
    </form>
    <div id=\"coins\" style=\"width:100%;height:300px;\"></div><br/><br/>
    <div id=\"main\" style=\"width:100%;height:300px;\"></div>
    <input type=\"hidden\" id=\"data\" value=\"";
        // line 64
        echo twig_escape_filter($this->env, (isset($context["data"]) ? $context["data"] : null), "html", null, true);
        echo "\" />
    <input type=\"hidden\" id=\"cheat\" value=\"";
        // line 65
        echo twig_escape_filter($this->env, (isset($context["cheat"]) ? $context["cheat"] : null), "html", null, true);
        echo "\" />
</div>
<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>

";
    }

    // line 74
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 75
        echo "<script>
    ";
        // line 76
        if (((isset($context["search_precision"]) ? $context["search_precision"] : null) == "hour")) {
            // line 77
            echo "        var delay = 60*60*1000;
        ";
        } else {
            // line 79
            echo "        var delay = 5*60*1000;
        ";
        }
        // line 81
        echo "</script>
<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/jquery.dataTables.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/DT_bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.zh-CN.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/echarts/echarts.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/private/chart_datas_robot_cheat.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/common/datas_search_form.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "chart_datas_robot_cheat.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  159 => 81,  155 => 79,  151 => 77,  149 => 76,  146 => 75,  143 => 74,  131 => 65,  127 => 64,  116 => 55,  110 => 54,  102 => 52,  94 => 50,  91 => 49,  87 => 48,  54 => 17,  51 => 16,  42 => 9,  39 => 8,  34 => 5,  31 => 4,);
    }
}
