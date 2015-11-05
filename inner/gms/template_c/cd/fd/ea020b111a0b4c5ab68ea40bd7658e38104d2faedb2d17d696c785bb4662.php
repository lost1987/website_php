<?php

/* payment_order_list.html */
class __TwigTemplate_cdfdea020b111a0b4c5ab68ea40bd7658e38104d2faedb2d17d696c785bb4662 extends Twig_Template
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
        echo "充值订单列表
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
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/component.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/datepicker.css\" />
";
    }

    // line 17
    public function block_content($context, array $blocks = array())
    {
        // line 18
        echo "<!-- BEGIN PAGE HEADER-->


<div class=\"row-fluid\">


    <div class=\"span12\">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class=\"page-title\">
            充值
            <small>订单</small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>


</div>


<!-- END PAGE HEADER-->


<!-- BEGIN PAGE CONTENT-->

<div class=\"row-fluid\">
    <div class=\"span12\">
        <!--表格查询区-->
        <form class=\"form-actions\" action=\"/services/payment_order/22\" method=\"get\" id=\"search_form\">
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">时间起始</b></label>
                <div class=\"controls\">
                    <div class=\"input-append date form_datetime\">
                        <input size=\"16\" type=\"text\" value=\"";
        // line 50
        echo twig_escape_filter($this->env, (isset($context["search_start_time"]) ? $context["search_start_time"] : null), "html", null, true);
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
        // line 59
        echo twig_escape_filter($this->env, (isset($context["search_end_time"]) ? $context["search_end_time"] : null), "html", null, true);
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
                <label class=\"control-label span2\"><b class=\"midnight\">昵称</b></label>
                <div class=\"controls\">
                            <input type=\"text\" class=\"form-control span2\" name=\"nickname\" value=\"";
        // line 72
        echo twig_escape_filter($this->env, (isset($context["search_nickname"]) ? $context["search_nickname"] : null), "html", null, true);
        echo "\" />
                 </div>
            </div>
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">渠道</b></label>
                <div class=\"controls\">
                    <select class=\"span2 m-wrap\" name=\"platform\">
                        <option value=\"\">全部</option>
                        ";
        // line 80
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["platforms"]) ? $context["platforms"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 81
            echo "                            ";
            if (((isset($context["search_platform"]) ? $context["search_platform"] : null) == (isset($context["key"]) ? $context["key"] : null))) {
                // line 82
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                            ";
            } else {
                // line 84
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                            ";
            }
            // line 86
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        echo "                    </select>
                </div>
            </div>
            <div class=\"control-group search_form_wrap span2\">
                <label class=\"control-label\"></label>
                <div class=\"controls\">
                </div>
            </div>
            <div class=\"control-group search_form_wrap span6\">
                <label class=\"control-label span2\"><b class=\"midnight\">订单号</b></label>
                <div class=\"controls\">
                    <input type=\"text\" class=\"form-control span4\" name=\"order_no\" value=\"";
        // line 98
        echo twig_escape_filter($this->env, (isset($context["search_order_no"]) ? $context["search_order_no"] : null), "html", null, true);
        echo "\" />
                </div>
            </div>
            <div class=\"control-group search_form_wrap span2\">
                <label class=\"control-label\"></label>
                <div class=\"controls\">
                </div>
            </div>
            <div class=\"control-group search_form_wrap span6\">
                <label class=\"control-label span2\"><b class=\"midnight\">流水号</b></label>
                <div class=\"controls\">
                    <input type=\"text\" class=\"form-control span4\" name=\"serial_number\" value=\"";
        // line 109
        echo twig_escape_filter($this->env, (isset($context["search_serial_number"]) ? $context["search_serial_number"] : null), "html", null, true);
        echo "\" />
                </div>
            </div>
            <div class=\"dataTables_filter\">
                <a href=\"javascript:;\" class=\"btn red\" onclick=\"doSearch()\"><i class=\"icon-search\"></i>&nbsp;查询</a>
            </div>
        </form>
        <br/>
    </div>

        <div class=\"portlet-body\">
            <table class=\"table table-striped table-bordered table-hover table-full-width\">
                <thead>
                <tr>
                    <th class=\"hidden-phone\">uid</th>
                    <th>昵称</th>
                    <th>账号</th>
                    <th>创建日期</th>
                    <th>支付日期</th>
                    <th>支付方式</th>
                    <th>渠道</th>
                    <th class=\"hidden-phone\">订单号</th>
                    <th>流水号</th>
                    <th>金额</th>
                    <th>钻石</th>
                    <th>ip</th>
                </tr>
                </thead>
                <tbody>
                ";
        // line 138
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 139
            echo "                <tr>
                    <td>";
            // line 140
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 141
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "nickname", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 142
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 143
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "create_at", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 144
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "pay_at", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 145
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "pay_type", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 146
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "platform", array()), "html", null, true);
            echo "</td>
                    <td class=\"info\">";
            // line 147
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "order_no", array()), "html", null, true);
            echo "</td>
                    <td class=\"success\">";
            // line 148
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "serial_number", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "serial_number", array()), "/")) : ("/")), "html", null, true);
            echo "</td>
                    <td><label class=\"label label-sm label-danger\" >￥";
            // line 149
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "money", array()), "html", null, true);
            echo "</label></td>
                    <td>";
            // line 150
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "diamond", array()), "html", null, true);
            echo "</td>
                    <td>";
            // line 151
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "ip", array()), "html", null, true);
            echo "</td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 154
        echo "                </tbody>
            </table>
        </div>
</div>
<div class=\"row-fluid\">
    <div class=\"span6\">
        <div class=\"dataTables_info\" id=\"sample_2_info\" style=\"padding-top:0\">共";
        // line 160
        echo twig_escape_filter($this->env, ((array_key_exists("total", $context)) ? (_twig_default_filter((isset($context["total"]) ? $context["total"] : null), 0)) : (0)), "html", null, true);
        echo "条数据 <code>总计:";
        echo twig_escape_filter($this->env, (isset($context["totalMoney"]) ? $context["totalMoney"] : null), "html", null, true);
        echo "元</code></div>
    </div>
    <div class=\"span6\">
        <div class=\"dataTables_paginate paging_bootstrap pagination\">
            <ul>
                ";
        // line 165
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
            </ul>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>

";
    }

    // line 178
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 179
        echo "<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/jquery.dataTables.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/DT_bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.zh-CN.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/private/payment_order_list.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/common/datas_search_form.js\"></script>
";
    }

    // line 188
    public function block_javascript_custom($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "payment_order_list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  324 => 188,  313 => 179,  310 => 178,  295 => 165,  285 => 160,  277 => 154,  268 => 151,  264 => 150,  260 => 149,  256 => 148,  252 => 147,  248 => 146,  244 => 145,  240 => 144,  236 => 143,  232 => 142,  228 => 141,  224 => 140,  221 => 139,  217 => 138,  185 => 109,  171 => 98,  158 => 87,  152 => 86,  144 => 84,  136 => 82,  133 => 81,  129 => 80,  118 => 72,  102 => 59,  90 => 50,  56 => 18,  53 => 17,  43 => 9,  40 => 8,  35 => 5,  32 => 4,);
    }
}
