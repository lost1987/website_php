<?php

/* player_list.html */
class __TwigTemplate_8b795049e47825452db00847009216df2d378f229eebc481cdff045b8ab5015d extends Twig_Template
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
        echo "玩家列表
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
             游戏管理
            <small>玩家列表</small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>


</div>


<!-- END PAGE HEADER-->


<!-- BEGIN PAGE CONTENT-->

<div class=\"row-fluid\">
<div class=\"span12\">
    <!--表格查询区-->
    <form class=\"form-actions\" action=\"/player/lists/19\" method=\"get\" id=\"search_form\">
        <div class=\"control-group search_form_wrap\">
            <label class=\"control-label\" style=\"width:100px;\"><b class=\"midnight\">账号/昵称/UID</b></label>
            <div class=\"controls chzn-controls search_form\">
                <input name=\"login_name\" type=\"text\" class=\"span2 m-wrap\" value=\"";
        // line 47
        echo twig_escape_filter($this->env, (isset($context["search_login_name"]) ? $context["search_login_name"] : null), "html", null, true);
        echo "\"/>
            </div>
        </div>
        <div class=\"control-group search_form_wrap\">
            <label class=\"control-label\" style=\"width:100px;\"><b class=\"midnight\">类型</b></label>
            <div class=\"controls chzn-controls search_form\">
                <select name=\"user_flag\">
                    <option value=\"\" >全部</option>
                    ";
        // line 55
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["user_types"]) ? $context["user_types"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 56
            echo "                        ";
            if (((isset($context["key"]) ? $context["key"] : null) == ((array_key_exists("search_user_flag", $context)) ? (_twig_default_filter((isset($context["search_user_flag"]) ? $context["search_user_flag"] : null), "-1")) : ("-1")))) {
                // line 57
                echo "                            <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                        ";
            } else {
                // line 59
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
                echo "\" >";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "</option>
                        ";
            }
            // line 61
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        echo "                </select>
            </div>
        </div>
        <div class=\"dataTables_filter\">
            <a href=\"/survey/";
        // line 66
        echo twig_escape_filter($this->env, (isset($context["surveyMethod"]) ? $context["surveyMethod"] : null), "html", null, true);
        echo "\" class=\"btn red\" ><i class=\"icon-question\"></i>&nbsp;问卷调查</a>&nbsp;&nbsp;
            <a href=\"javascript:;\" class=\"btn red\" onclick=\"addSupporter()\"><i class=\"icon-plus\"></i>&nbsp;扶持帐号</a>&nbsp;&nbsp;
            <a href=\"javascript:;\" class=\"btn black\" onclick=\"window.open('/export/excel?name=PlayerExcelExport')\"><i class=\"icon-save\"></i>&nbsp;EXCEL</a>&nbsp;&nbsp;
            <a href=\"javascript:;\" class=\"btn red\" onclick=\"\$('#search_form').submit();\"><i class=\"icon-search\"></i>&nbsp;查询</a>&nbsp;&nbsp;
        </div>
    </form>
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class=\"portlet\">
        <div class=\"portlet-title\">
            <div class=\"caption\"></div>
        </div>

        <div class=\"portlet-body\">
            <table class=\"table table-striped table-bordered table-hover table-full-width\" id=\"sample_1\">
                <thead>
                <tr>
                    <th> UID</th>
                    <th class=\"hidden-phone\">账号</th>
                    <th>昵称</th>
                    <th>状态</th>
                    <th>金币</th>
                    <th>钻石</th>
                    <th>门票</th>
                    <th>奖券</th>
                    <th style=\"text-align: center\">操作</th>
                </tr>
                </thead>
                <tbody>
                ";
        // line 94
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 95
            echo "                <tr rel=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
            echo "\">
                    <td class=\"highlight\">
                        ";
            // line 97
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
            echo "
                    </td>
                    <td class=\"hidden-phone\">
                        <a href=\"javascript:;\">";
            // line 100
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
            echo "</a>
                    </td>
                    <td class=\"hidden-phone\">
                        <a href=\"javascript:;\">";
            // line 103
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "nickname", array()), "html", null, true);
            echo "</a>
                    </td>
                    <td>
                        ";
            // line 106
            if (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "forbidden", array()) == 1)) {
                // line 107
                echo "                                封停
                        ";
            } else {
                // line 109
                echo "                                正常
                        ";
            }
            // line 111
            echo "                    </td>
                    <td>
                        ";
            // line 113
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "coins", array()), "html", null, true);
            echo "
                    </td>
                    <td>
                        ";
            // line 116
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "diamond", array()), "html", null, true);
            echo "
                    </td>
                    <td>
                        ";
            // line 119
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "ticket", array()), "html", null, true);
            echo "
                    </td>
                    <td>
                        ";
            // line 122
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "coupon", array()), "html", null, true);
            echo "
                    </td>
                    <td style=\"text-align: center\">
                        ";
            // line 125
            if (((isset($context["btn_edit_permission"]) ? $context["btn_edit_permission"] : null) == 1)) {
                // line 126
                echo "                                <a href=\"/player/add/19/edit/";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
                echo "\" class=\"btn mini grey\" style=\"width:80px;text-align:left\"><i class=\"icon-edit\"></i>编辑</a><br/>
                                ";
                // line 127
                if (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "forbidden", array()) == 0)) {
                    // line 128
                    echo "                                    <a href=\"javascript:forbidden(";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
                    echo ",'";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
                    echo "')\" class=\"btn mini grey\" style=\"width:80px;text-align:left\"><i class=\" icon-ban-circle\"></i>封停</a><br/>
                                    <a href=\"javascript:;\" class=\"btn mini grey\" style=\"width:80px;text-align:left\" disabled=\"disabled\"><i class=\"icon-ok-circle\"></i>解封</a><br/>
                               ";
                } else {
                    // line 131
                    echo "                                    <a href=\"javascript:;\" class=\"btn mini grey\" style=\"width:80px;text-align:left\" disabled=\"disabled\"><i class=\" icon-ban-circle\"></i>封停</a><br/>
                                    <a href=\"javascript:unforbidden(";
                    // line 132
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
                    echo ",'";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
                    echo "')\" class=\"btn mini grey\" style=\"width:80px;text-align:left\" ><i class=\"icon-ok-circle\"></i>解封</a><br/>
                                ";
                }
                // line 134
                echo "                                 <a href=\"javascript:reset_password(";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
                echo ",";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_number", array()), "html", null, true);
                echo ",'";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
                echo "')\" class=\"btn mini grey\" style=\"width:80px;text-align:left\"><i class=\"icon-lock\"></i>重置登陆密码</a><br/>
                                 <a href=\"javascript:reset_purchase_password(";
                // line 135
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
                echo ",";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_number", array()), "html", null, true);
                echo ",'";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
                echo "')\" class=\"btn mini grey\" style=\"width:80px;text-align:left\"><i class=\"icon-lock\"></i>重置消费密码</a><br/>
                        ";
            }
            // line 137
            echo "                        <a href=\"/userResourceLog/lists/19/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
            echo "\" class=\"btn mini grey\" style=\"width:80px;text-align:left\"><i class=\"icon-jpy\"></i>资源日志</a><br/>
                    </td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 141
        echo "                </tbody>
            </table>
        </div>
    </div>
    <div class=\"row-fluid\">
        <div class=\"span6\">
            <div class=\"dataTables_info\" id=\"sample_2_info\" style=\"padding-top:0\">共";
        // line 147
        echo twig_escape_filter($this->env, ((array_key_exists("total", $context)) ? (_twig_default_filter((isset($context["total"]) ? $context["total"] : null), 0)) : (0)), "html", null, true);
        echo "条数据</div>
        </div>
        <div class=\"span6\">
            <div class=\"dataTables_paginate paging_bootstrap pagination\">
                <ul>
                 ";
        // line 152
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
<!-- 模态框（Modal） -->
<div class=\"modal fade\" id=\"supporterModal\" tabindex=\"-1\" role=\"dialog\" style=\"display:none\"
     aria-labelledby=\"supporterModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\"
                        aria-hidden=\"true\">
                </button>
                <h4 class=\"modal-title\" id=\"supporterModalLabel\">
                    添加扶持帐号
                </h4>
            </div>
            <div class=\"modal-body\">
                <label>初始钻石</label>
                <input type=\"text\" id=\"add_diamond\" value=\"2000\" />
                <label>初始金币</label>
                <input type=\"text\" id=\"add_coins\" value=\"8000\" />
                <label>请选择生成的扶持帐号数量</label>
                <select id=\"supporter_num\" class=\"form-control span2\" onchange=\"createNickNameInputs(this)\">
                    <option value=\"1\">1</option>
                    <option value=\"5\">5</option>
                    <option value=\"10\">10</option>
                </select>
                <span>
                    <label>昵称</label>
                    <div></div>
                </span>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" onclick=\"confirm_support()\"
                        data-dismiss=\"modal\">确认
                </button>
                <button type=\"button\" class=\"btn btn-primary\" onclick=\"cancel_supporter()\">
                    取消
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 模态框（Modal） -->
<div class=\"modal fade\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\"
     aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\"
                        aria-hidden=\"true\">
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

</div>


<!-- END PAGE -->
";
    }

    // line 239
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 240
        echo "<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/jquery.dataTables.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/DT_bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/private/player_list.js\"></script>
";
    }

    // line 246
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 247
        echo "<script>
    jQuery(document).ready(function() {
        TableAdvanced.init();
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "player_list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  410 => 247,  407 => 246,  399 => 240,  396 => 239,  307 => 152,  299 => 147,  291 => 141,  278 => 137,  269 => 135,  260 => 134,  253 => 132,  250 => 131,  241 => 128,  239 => 127,  232 => 126,  230 => 125,  224 => 122,  218 => 119,  212 => 116,  206 => 113,  202 => 111,  198 => 109,  194 => 107,  192 => 106,  186 => 103,  180 => 100,  174 => 97,  168 => 95,  164 => 94,  133 => 66,  127 => 62,  121 => 61,  113 => 59,  105 => 57,  102 => 56,  98 => 55,  87 => 47,  54 => 16,  51 => 15,  43 => 9,  40 => 8,  35 => 5,  32 => 4,);
    }
}
