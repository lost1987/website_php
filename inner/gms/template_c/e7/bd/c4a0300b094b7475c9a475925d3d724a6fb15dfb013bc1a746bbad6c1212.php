<?php

/* chart_datas_recharge.html */
class __TwigTemplate_e7bdc4a0300b094b7475c9a475925d3d724a6fb15dfb013bc1a746bbad6c1212 extends Twig_Template
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
        echo "付费分析
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
            付费分析
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
        <form class=\"form-actions\" action=\"/datasRecharge/recharge/67\" method=\"get\" id=\"search_form\">
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
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">渠道</b></label>
                <div class=\"controls\">
                    <select class=\"span2 m-wrap\" name=\"platform\">
                        <option value=\"-1\">全部</option>
                        ";
        // line 87
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["platformlist"]) ? $context["platformlist"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 88
            echo "                            ";
            if (((isset($context["search_platform"]) ? $context["search_platform"] : null) == (isset($context["key"]) ? $context["key"] : null))) {
                // line 89
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                            ";
            } else {
                // line 91
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                            ";
            }
            // line 93
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 94
        echo "                    </select>
                </div>
            </div>
            <div class=\"control-group search_form_wrap span2\">
                <label class=\"control-label\"></label>
                <div class=\"controls\">
                </div>
            </div>
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">查看类型</b></label>
                <div class=\"controls\">
                    <select class=\"span2 m-wrap\" name=\"see_type\">
                        ";
        // line 106
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["see_types"]) ? $context["see_types"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 107
            echo "                        ";
            if (((isset($context["search_see_type"]) ? $context["search_see_type"] : null) == (isset($context["key"]) ? $context["key"] : null))) {
                // line 108
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                        ";
            } else {
                // line 110
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                        ";
            }
            // line 112
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 113
        echo "                    </select>
                </div>
            </div>
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">付费渠道</b></label>
                <div class=\"controls\">
                    <select class=\"span2 m-wrap\" name=\"recharge_type\">
                        <option value=\"-1\">全部</option>
                        ";
        // line 121
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["recharge_platforms"]) ? $context["recharge_platforms"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 122
            echo "                        ";
            if (((isset($context["search_recharge_type"]) ? $context["search_recharge_type"] : null) == (isset($context["key"]) ? $context["key"] : null))) {
                // line 123
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                        ";
            } else {
                // line 125
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                        ";
            }
            // line 127
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
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
                    ";
        // line 152
        if (((isset($context["search_see_type"]) ? $context["search_see_type"] : null) == "money")) {
            // line 153
            echo "                    <th class=\"hidden-phone\">总用户充值金额</th>
                    <th class=\"hidden-phone\">新增用户充值金额</th>
                    <th class=\"hidden-phone\">老用户充值金额</th>
                    ";
        } elseif (((isset($context["search_see_type"]) ? $context["search_see_type"] : null) == "num")) {
            // line 157
            echo "                    <th class=\"hidden-phone\">总用户充值人数</th>
                    <th class=\"hidden-phone\">新增用户充值人数</th>
                    <th class=\"hidden-phone\">老用户充值人数</th>
                    ";
        } else {
            // line 161
            echo "                    <th class=\"hidden-phone\">总用户充值次数</th>
                    <th class=\"hidden-phone\">新增用户充值次数</th>
                    <th class=\"hidden-phone\">老用户充值次数</th>
                    ";
        }
        // line 165
        echo "                </tr>
                </thead>
                <tbody>
                ";
        // line 168
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(0, (twig_length_filter($this->env, (isset($context["dateLine"]) ? $context["dateLine"] : null)) - 1)));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 169
            echo "                ";
            if (((isset($context["search_see_type"]) ? $context["search_see_type"] : null) == "money")) {
                // line 170
                echo "                <tr>
                    <td>";
                // line 171
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dateLine"]) ? $context["dateLine"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array"), "html", null, true);
                echo "</td>
                    <td>";
                // line 172
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "rechargeMoney", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "rechargeMoney", array()), 0)) : (0)), "html", null, true);
                echo "</td>
                    <td>";
                // line 173
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "newRechargeMoney", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "newRechargeMoney", array()), 0)) : (0)), "html", null, true);
                echo "</td>
                    <td>";
                // line 174
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "oldRechargeMoney", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "oldRechargeMoney", array()), 0)) : (0)), "html", null, true);
                echo "</td>
                </tr>
                ";
            } elseif (((isset($context["search_see_type"]) ? $context["search_see_type"] : null) == "num")) {
                // line 177
                echo "                <tr>
                    <td>";
                // line 178
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dateLine"]) ? $context["dateLine"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array"), "html", null, true);
                echo "</td>
                    <td>";
                // line 179
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "rechargeNum", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "rechargeNum", array()), 0)) : (0)), "html", null, true);
                echo "</td>
                    <td>";
                // line 180
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "newRechargeNum", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "newRechargeNum", array()), 0)) : (0)), "html", null, true);
                echo "</td>
                    <td>";
                // line 181
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "oldRechargeNum", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "oldRechargeNum", array()), 0)) : (0)), "html", null, true);
                echo "</td>
                </tr>
                ";
            } else {
                // line 184
                echo "                <tr>
                    <td>";
                // line 185
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dateLine"]) ? $context["dateLine"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array"), "html", null, true);
                echo "</td>
                    <td>";
                // line 186
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "rechargeCount", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "rechargeCount", array()), 0)) : (0)), "html", null, true);
                echo "</td>
                    <td>";
                // line 187
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "newRechargeCount", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "newRechargeCount", array()), 0)) : (0)), "html", null, true);
                echo "</td>
                    <td>";
                // line 188
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "oldRechargeCount", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["recharge"]) ? $context["recharge"] : null), (isset($context["i"]) ? $context["i"] : null), array(), "array", false, true), "oldRechargeCount", array()), 0)) : (0)), "html", null, true);
                echo "</td>
                </tr>
                ";
            }
            // line 191
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 192
        echo "                </tbody>
            </table>
        </div>
    </div>

    <div id=\"main\" style=\"width:100%;height:400px;\"></div>
    <input type=\"hidden\" id=\"dateLine\" value=\"";
        // line 198
        echo twig_escape_filter($this->env, (isset($context["dateLineJson"]) ? $context["dateLineJson"] : null), "html", null, true);
        echo "\" />
    <input type=\"hidden\" id=\"recharge\" value=\"";
        // line 199
        echo twig_escape_filter($this->env, (isset($context["rechargeJson"]) ? $context["rechargeJson"] : null), "html", null, true);
        echo "\" />
    <input type=\"hidden\" id=\"see_type\" value=\"";
        // line 200
        echo twig_escape_filter($this->env, ((array_key_exists("search_see_type", $context)) ? (_twig_default_filter((isset($context["search_see_type"]) ? $context["search_see_type"] : null), 1)) : (1)), "html", null, true);
        echo "\"/>
</div>
<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>

";
    }

    // line 210
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 211
        echo "<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/jquery.dataTables.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/DT_bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.zh-CN.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/echarts/echarts.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/private/chart_datas_recharge.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/common/datas_search_form.js\"></script>
";
    }

    // line 221
    public function block_javascript_custom($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "chart_datas_recharge.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  438 => 221,  426 => 211,  423 => 210,  411 => 200,  407 => 199,  403 => 198,  395 => 192,  389 => 191,  383 => 188,  379 => 187,  375 => 186,  371 => 185,  368 => 184,  362 => 181,  358 => 180,  354 => 179,  350 => 178,  347 => 177,  341 => 174,  337 => 173,  333 => 172,  329 => 171,  326 => 170,  323 => 169,  319 => 168,  314 => 165,  308 => 161,  302 => 157,  296 => 153,  294 => 152,  268 => 128,  262 => 127,  254 => 125,  246 => 123,  243 => 122,  239 => 121,  229 => 113,  223 => 112,  215 => 110,  207 => 108,  204 => 107,  200 => 106,  186 => 94,  180 => 93,  172 => 91,  164 => 89,  161 => 88,  157 => 87,  147 => 79,  141 => 78,  133 => 76,  125 => 74,  122 => 73,  118 => 72,  101 => 58,  89 => 49,  55 => 17,  52 => 16,  43 => 9,  40 => 8,  35 => 5,  32 => 4,);
    }
}
