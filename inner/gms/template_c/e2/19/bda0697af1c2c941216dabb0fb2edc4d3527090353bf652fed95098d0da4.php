<?php

/* chart_datas_user_regress.html */
class __TwigTemplate_e219bda0697af1c2c941216dabb0fb2edc4d3527090353bf652fed95098d0da4 extends Twig_Template
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
        echo "
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
            用户回归
            <small></small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>


</div>


<!-- END PAGE HEADER-->


<!-- BEGIN PAGE CONTENT-->

<div class=\"row-fluid\">
    <div class=\"span12\">
        <!--表格查询区-->
        <form class=\"form-actions\" action=\"/datas/userRegress/53\" method=\"get\" id=\"search_form\">
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">时间起始</b></label>
                <div class=\"controls\">
                    <div class=\"input-append date form_datetime\">
                        <input size=\"16\" type=\"text\" value=\"";
        // line 49
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["search_start_time"]) ? $context["search_start_time"] : null), "Y-m-d"), "html", null, true);
        echo "\" name=\"start_time\" id=\"start_time\" readonly class=\"m-wrap span2\">
                        <span class=\"add-on\"><i class=\"icon-calendar\"></i></span>
                    </div>
                </div>
            </div>
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">时间结束</b></label>
                <div class=\"controls\">
                    <div class=\"input-append date form_datetime\">
                        <input size=\"16\" type=\"text\" value=\"";
        // line 58
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["search_end_time"]) ? $context["search_end_time"] : null), "Y-m-d"), "html", null, true);
        echo "\" name=\"end_time\" id=\"end_time\" readonly class=\"m-wrap span2\">
                        <span class=\"add-on\"><i class=\"icon-calendar\"></i></span>
                    </div>
                </div>
            </div>
            <div class=\"control-group search_form_wrap span2\">
                <label class=\"control-label\"></label>
                <div class=\"controls\">
                </div>
            </div>
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">精度</b></label>
                <div class=\"controls\">
                    <select class=\"span2 m-wrap\" name=\"precision\" id=\"precision\">
                        ";
        // line 72
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["precisionlist"]) ? $context["precisionlist"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 73
            echo "                            ";
            if (((isset($context["key"]) ? $context["key"] : null) == (isset($context["search_precision"]) ? $context["search_precision"] : null))) {
                // line 74
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                            ";
            } else {
                // line 76
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                            ";
            }
            // line 78
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        echo "                    </select>
                 </div>
            </div>
            <div class=\"dataTables_filter\">
                <a href=\"javascript:;\" class=\"btn red\" onclick=\"doSearch()\"><i class=\"icon-search\"></i>&nbsp;查询</a>
            </div>
        </form>
        <br/>
    </div>

    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class=\"portlet box grey\">
        <div class=\"portlet-title\">
            <div class=\"caption\"></div>
            <div class=\"tools\">
                <a href=\"javascript:;\" class=\"collapse\"></a>
            </div>
        </div>

        <div class=\"portlet-body\">
            <table class=\"table table-striped table-bordered table-hover table-full-width\">
                <thead>
                <tr>
                    <th>日期</th>
                    <th class=\"hidden-phone\">回归用户</th>
                    <th>回归率</th>
                </tr>
                </thead>
                <tbody>
                ";
        // line 108
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(0, (twig_length_filter($this->env, (isset($context["dateLine"]) ? $context["dateLine"] : null)) - 1)));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 109
            echo "                    <tr>
                        <td>";
            // line 110
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dateLine"]) ? $context["dateLine"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array"), "html", null, true);
            echo "</td>
                        <td>";
            // line 111
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["loginNumList"]) ? $context["loginNumList"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "regressNum", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["loginNumList"]) ? $context["loginNumList"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "regressNum", array()), 0)) : (0)), "html", null, true);
            echo "</td>
                        <td>";
            // line 112
            echo twig_escape_filter($this->env, (twig_number_format_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["loginNumList"]) ? $context["loginNumList"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array"), "regressNum", array()) / $this->getAttribute($this->getAttribute((isset($context["vigorousList"]) ? $context["vigorousList"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array"), "vigorousNum", array())), 2) * 100), "html", null, true);
            echo "%</td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 115
        echo "                </tbody>
            </table>
        </div>
    </div>
    <div id=\"main\" style=\"width:100%;height:400px;\"></div>
    <input type=\"hidden\" id=\"dateLine\" value=\"";
        // line 120
        echo twig_escape_filter($this->env, (isset($context["dateLineJson"]) ? $context["dateLineJson"] : null), "html", null, true);
        echo "\" />
    <input type=\"hidden\" id=\"loginNum\" value=\"";
        // line 121
        echo twig_escape_filter($this->env, (isset($context["loginNumJson"]) ? $context["loginNumJson"] : null), "html", null, true);
        echo "\" />
    <input type=\"hidden\" id=\"vigorous\" value=\"";
        // line 122
        echo twig_escape_filter($this->env, (isset($context["vigorousJson"]) ? $context["vigorousJson"] : null), "html", null, true);
        echo "\" />
</div>
<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>

";
    }

    // line 132
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 133
        echo "<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/jquery.dataTables.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/DT_bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.zh-CN.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/echarts/echarts.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/private/chart_datas_user_regress.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/common/datas_search_form.js\"></script>
";
    }

    // line 143
    public function block_javascript_custom($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "chart_datas_user_regress.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  244 => 143,  232 => 133,  229 => 132,  217 => 122,  213 => 121,  209 => 120,  202 => 115,  193 => 112,  189 => 111,  185 => 110,  182 => 109,  178 => 108,  147 => 79,  141 => 78,  133 => 76,  125 => 74,  122 => 73,  118 => 72,  101 => 58,  89 => 49,  55 => 17,  52 => 16,  43 => 9,  40 => 8,  35 => 5,  32 => 4,);
    }
}
