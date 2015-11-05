<?php

/* msg_push_task_list.html */
class __TwigTemplate_ed6a699ed7a535d502c07caa8011a48be842ae8f467f8f22affecbc86e921b92 extends Twig_Template
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
        echo "消息推送
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
";
    }

    // line 15
    public function block_content($context, array $blocks = array())
    {
        // line 16
        echo "<!-- BEGIN PAGE HEADER-->


<div class=\"row-fluid\">


    <div class=\"span12\">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class=\"page-title\">
             消息推送
            <small>任务列表</small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>


</div>


<!-- END PAGE HEADER-->


<!-- BEGIN PAGE CONTENT-->

<div class=\"row-fluid\">
<div class=\"span12\">
    <!--表格查询区-->
   <!-- <form class=\"form-actions\" action=\"/player/lists/19\" method=\"get\" id=\"search_form\">
        <div class=\"control-group search_form_wrap\">
            <label class=\"control-label\" style=\"width:100px;\"><b class=\"midnight\">账号或昵称</b></label>
            <div class=\"controls chzn-controls search_form\">
                <input name=\"login_name\" type=\"text\" class=\"span2 m-wrap\" value=\"";
        // line 47
        echo twig_escape_filter($this->env, (isset($context["search_login_name"]) ? $context["search_login_name"] : null), "html", null, true);
        echo "\"/>
            </div>
        </div>
        <div class=\"dataTables_filter\">
            <a href=\"javascript:;\" class=\"btn black\" onclick=\"window.open('/export/excel?name=PlayerExcelExport')\"><i class=\"icon-save\"></i>&nbsp;EXCEL</a>&nbsp;&nbsp;
            <a href=\"javascript:;\" class=\"btn red\" onclick=\"\$('#search_form').submit();\"><i class=\"icon-search\"></i>&nbsp;查询</a>&nbsp;&nbsp;
        </div>
    </form>
    -->
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class=\"portlet\">
        <div class=\"portlet-title\">
            <div class=\"caption\"></div>
        </div>

        <div class=\"portlet-body\">
            <table class=\"table table-striped table-bordered table-hover table-full-width\" id=\"sample_1\">
                <thead>
                <tr>
                    <th> ID</th>
                    <th class=\"hidden-phone\">标题</th>
                    <th>每天几点推送</th>
                    <th>每月几号推送(0=每天)</th>
                    <th>设备类型</th>
                    <th>创建时间</th>
                    <th style=\"text-align: center\">操作</th>
                </tr>
                </thead>
                <tbody>
                ";
        // line 76
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 77
            echo "                <tr rel=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
            echo "\">
                    <td class=\"highlight\">
                        ";
            // line 79
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "
                    </td>
                    <td class=\"hidden-phone\">
                        <a href=\"javascript:;\">";
            // line 82
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "title", array()), "html", null, true);
            echo "</a>
                    </td>
                    <td class=\"hidden-phone\">
                        <a href=\"javascript:;\">";
            // line 85
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "task_hour", array()), "html", null, true);
            echo "</a>
                    </td>
                    <td>
                       ";
            // line 88
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "task_day", array()), "html", null, true);
            echo "
                    </td>
                    <td>
                        ";
            // line 91
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "device", array()), "html", null, true);
            echo "
                    </td>
                    <td>
                        ";
            // line 94
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "create_time", array()), "Y-m-d H:i:s"), "html", null, true);
            echo "
                    </td>
                    <td style=\"text-align: center\">
                        <a href=\"javascript:;\" onclick=\"confirm_del(";
            // line 97
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo ")\" class=\"btn mini red\" style=\"width:80px;text-align:center\"><i class=\"icon-trash\"></i>删除</a>
                    </td>
                </tr>
                <tr>
                    <td>内容:</td>
                    <td colspan=\"6\">";
            // line 102
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "content", array()), "html", null, true);
            echo "</td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 105
        echo "                </tbody>
            </table>
        </div>
    </div>
    <div class=\"row-fluid\">
        <div class=\"span6\">
            <div class=\"dataTables_info\" id=\"sample_2_info\" style=\"padding-top:0\">共";
        // line 111
        echo twig_escape_filter($this->env, ((array_key_exists("total", $context)) ? (_twig_default_filter((isset($context["total"]) ? $context["total"] : null), 0)) : (0)), "html", null, true);
        echo "条数据</div>
        </div>
        <div class=\"span6\">
            <div class=\"dataTables_paginate paging_bootstrap pagination\">
                <ul>
                 ";
        // line 116
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
                </ul>
            </div>
        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>


<!-- END PAGE -->
<!-- 模态框（Modal） -->
<div class=\"modal fade\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\"
     aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\"
                        aria-hidden=\"true\">×
                </button>
                <h4 class=\"modal-title\" id=\"myModalLabel\">
                    请确认
                </h4>
            </div>
            <div class=\"modal-body\">
                确认要删除该项目吗?
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" onclick=\"del()\"
                        data-dismiss=\"modal\">确认
                </button>
                <button type=\"button\" class=\"btn btn-primary\" onclick=\"cancel_del()\">
                    取消
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
";
    }

    // line 161
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 162
        echo "<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
";
    }

    // line 165
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 166
        echo "<script type=\"text/javascript\" src=\"/media/js/private/msg_push_task_list.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "msg_push_task_list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  256 => 166,  253 => 165,  248 => 162,  245 => 161,  198 => 116,  190 => 111,  182 => 105,  173 => 102,  165 => 97,  159 => 94,  153 => 91,  147 => 88,  141 => 85,  135 => 82,  129 => 79,  123 => 77,  119 => 76,  87 => 47,  54 => 16,  51 => 15,  43 => 9,  40 => 8,  35 => 5,  32 => 4,);
    }
}
