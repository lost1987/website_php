<?php

/* services_exchange_list.html */
class __TwigTemplate_84eb7a1c8ec7a72eecbeb77454286d89d5f617a7d1ac865315d0b0b5cd8594df extends Twig_Template
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
        echo "玩家兑换
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
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/datetimepicker.css\" />
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
            客服管理
            <small>玩家兑换</small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>


</div>


<!-- END PAGE HEADER-->


<!-- BEGIN PAGE CONTENT-->

<div class=\"row-fluid\">
    <div class=\"span12\">
        <!--表格查询区-->
        <form class=\"form-actions\" action=\"/services/lists_exchange/22\" method=\"get\" id=\"search_form\">
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">账号</b>&nbsp;&nbsp;</label>
                <div class=\"controls chzn-controls search_form\">
                    <input name=\"reporter_name\" type=\"text\" class=\"span2 m-wrap\" value=\"";
        // line 48
        echo twig_escape_filter($this->env, (isset($context["search_reporter_name"]) ? $context["search_reporter_name"] : null), "html", null, true);
        echo "\"/>
                </div>
            </div>
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">处理状态</b></label>
                <div class=\"controls chzn-controls\">
                    <select class=\"span2 m-wrap\" name=\"result\">
                        <option value=\"-1\">全部</option>
                        ";
        // line 56
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["handle_result_list"]) ? $context["handle_result_list"] : null));
        foreach ($context['_seq'] as $context["val"] => $context["name"]) {
            // line 57
            echo "                        ";
            if ((((isset($context["val"]) ? $context["val"] : null) == (isset($context["search_result"]) ? $context["search_result"] : null)) && ((isset($context["search_result"]) ? $context["search_result"] : null) != ""))) {
                // line 58
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "</option>
                        ";
            } else {
                // line 60
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "</option>
                        ";
            }
            // line 62
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['val'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        echo "                    </select>
                </div>
            </div>
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">兑换时间起始</b></label>
                <div class=\"controls\">
                    <div class=\"input-append date form_datetime\">
                        <input size=\"16\" type=\"text\" value=\"";
        // line 70
        echo twig_escape_filter($this->env, (isset($context["search_start_time"]) ? $context["search_start_time"] : null), "html", null, true);
        echo "\" name=\"start_time\" readonly class=\"m-wrap span2\">
                        <span class=\"add-on\"><i class=\"icon-calendar\"></i></span>
                    </div>
                </div>
            </div>
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">兑换时间结束</b></label>
                <div class=\"controls\">
                    <div class=\"input-append date form_datetime\">
                        <input size=\"16\" type=\"text\" value=\"";
        // line 79
        echo twig_escape_filter($this->env, (isset($context["search_end_time"]) ? $context["search_end_time"] : null), "html", null, true);
        echo "\" name=\"end_time\" readonly class=\"m-wrap span2\">
                        <span class=\"add-on\"><i class=\"icon-calendar\"></i></span>
                    </div>
                </div>
            </div>
            <div class=\"control-group search_form_wrap span4\">
                <label class=\"control-label span2\"><b class=\"midnight\">兑换分类</b></label>
                <div class=\"controls chzn-controls\">
                    <select class=\"span2 m-wrap\" name=\"category_id\">
                        <option value=\"-1\">全部</option>
                        ";
        // line 89
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 90
            echo "                        ";
            if (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()) == (isset($context["search_category_id"]) ? $context["search_category_id"] : null))) {
                // line 91
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
                echo "</option>
                        ";
            } else {
                // line 93
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
                echo "</option>
                        ";
            }
            // line 95
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "                    </select>
                </div>
            </div>
            <div class=\"dataTables_filter\">
                <a href=\"javascript:;\" class=\"btn red\" onclick=\"\$('#search_form').submit();\"><i class=\"icon-search\"></i>&nbsp;查询</a>
            </div>
        </form>
        <br/>
        <div class=\"alert alert-error hide\">
            <button class=\"close\" data-dismiss=\"alert\"></button>
            请选择要处理的项目
        </div>
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class=\"portlet\" style=\"overflow-x: scroll\">
            <div class=\"portlet-title\">
                <div class=\"caption\"></div>
            </div>

            <div class=\"portlet-body\" style=\"width:1500px;\">
                <table class=\"table table-striped table-bordered table-hover table-full-width\" id=\"sample_1\" >
                    <thead>
                    <tr>
                        <th><input type=\"checkbox\" class=\"group-checkable\" data-set=\"#sample_1 .checkboxes\" /></th>
                        <th class=\"hidden-phone\">账号</th>
                        <th>兑换分类</th>
                        <th>ip</th>
                        <th>提交时间</th>
                        <th>姓名</th>
                        <th>电话</th>
                        <th>地址</th>
                        <th>处理人</th>
                        <th>处理时间</th>
                        <th>状态</th>
                        <th style=\"text-align: center\">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    ";
        // line 133
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 134
            echo "                    <tr rel=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\" rel_c=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "product_id", array()), "html", null, true);
            echo "#";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "\">
                        <td><input type=\"checkbox\" class=\"checkboxes\" value=\"";
            // line 135
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "#";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
            echo "\" /></td>
                        <td class=\"hidden-phone\">
                            <a href=\"javascript:;\">";
            // line 137
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "reporter_name", array()), "html", null, true);
            echo "</a>
                        </td>
                        <td>
                            ";
            // line 140
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "category_name", array()), "html", null, true);
            echo "
                        </td>
                        <td class=\"hidden-phone\">
                            <a href=\"javascript:;\">";
            // line 143
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "ip", array()), "html", null, true);
            echo "</a>
                        </td>
                        <td>
                            ";
            // line 146
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "create_at", array()), "html", null, true);
            echo "
                        </td>
                        <td>
                            ";
            // line 149
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uname", array()), "html", null, true);
            echo "
                        </td>
                        <td>
                            ";
            // line 152
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "mobile", array()), "html", null, true);
            echo "
                        </td>
                        <td>
                            ";
            // line 155
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "address", array()), "html", null, true);
            echo "
                        </td>
                        <td>
                            ";
            // line 158
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "assign_to", array()), "html", null, true);
            echo "
                        </td>
                        <td>
                            ";
            // line 161
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "handle_time", array()), "html", null, true);
            echo "
                        </td>
                        <td>
                            ";
            // line 164
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "result_name", array()), "html", null, true);
            echo "
                        </td>
                        <td style=\"text-align: center\">
                            ";
            // line 167
            if (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "category_id", array()) == 3)) {
                // line 168
                echo "                                    ";
                if (((((isset($context["btn_fahuo_permission"]) ? $context["btn_fahuo_permission"] : null) == 1) && ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "result", array()) != 4)) && ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "result", array()) != 2))) {
                    // line 169
                    echo "                                        <a href=\"javascript:;\" onclick=\"consignment(this)\" class=\"btn mini grey\" ><i class=\"icon-edit\"></i> 发货</a>
                                        <input type=\"hidden\" name=\"params\"  value=\"";
                    // line 170
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "address", array()), "html", null, true);
                    echo "#";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
                    echo "#";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "reporter_name", array()), "html", null, true);
                    echo "#";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                    echo "#";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "product_id", array()), "html", null, true);
                    echo "\"/>
                                    ";
                } elseif (((((isset($context["btn_handle_permission"]) ? $context["btn_handle_permission"] : null) == 1) && ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "result", array()) != 2)) && ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "result", array()) == 4))) {
                    // line 172
                    echo "                                         <a href=\"javascript:;\" onclick=\"handle(this)\" class=\"btn mini grey\" ><i class=\"icon-edit\"></i> 处理</a>
                                        <input type=\"hidden\" name=\"params\"  value=\"";
                    // line 173
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                    echo "#";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "product_id", array()), "html", null, true);
                    echo "\"/>
                                    ";
                } else {
                    // line 175
                    echo "                                        /
                                    ";
                }
                // line 177
                echo "                            ";
            } elseif (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "category_id", array()) == 2)) {
                // line 178
                echo "                                    ";
                if ((((isset($context["btn_fahuo_permission"]) ? $context["btn_fahuo_permission"] : null) == 1) && ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "result", array()) != 2))) {
                    // line 179
                    echo "                                        <a href=\"javascript:;\" onclick=\"mobilement(this)\" class=\"btn mini grey\" ><i class=\"icon-edit\"></i> 充值</a>
                                        <input type=\"hidden\" name=\"params\"  value=\"";
                    // line 180
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "mobile", array()), "html", null, true);
                    echo "#";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "user_id", array()), "html", null, true);
                    echo "#";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "reporter_name", array()), "html", null, true);
                    echo "#";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                    echo "#";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "product_id", array()), "html", null, true);
                    echo "\"/>
                                    ";
                } else {
                    // line 182
                    echo "                                        /
                                    ";
                }
                // line 184
                echo "                            ";
            } else {
                // line 185
                echo "                                    /
                            ";
            }
            // line 187
            echo "                    </td>
                    </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 190
        echo "                    </tbody>
                </table>
            </div>
        </div>
        <div class=\"row-fluid\">
            <div class=\"span6\">
                <div class=\"dataTables_info\" id=\"sample_2_info\" style=\"padding-top:0\">共";
        // line 196
        echo twig_escape_filter($this->env, ((array_key_exists("total", $context)) ? (_twig_default_filter((isset($context["total"]) ? $context["total"] : null), 0)) : (0)), "html", null, true);
        echo "条数据</div>
            </div>
            <div class=\"span6\">
                <div class=\"dataTables_paginate paging_bootstrap pagination\">
                    <ul>
                        ";
        // line 201
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
                确认要将该发货单设为完成吗?<b class=\"red\">(请务必确认玩家收到物品后再进行该操作)</b>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" onclick=\"confirm_done()\"
                        data-dismiss=\"modal\">确认
                </button>
                <button type=\"button\" class=\"btn btn-primary\" onclick=\"cancel_done()\">
                    取消
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 模态框（Modal）发货单 -->
<div class=\"modal fade\" id=\"sendModal\" tabindex=\"-1\" role=\"dialog\" style=\"display:none\"
     aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\"
                        aria-hidden=\"true\">×
                </button>
                <h4 class=\"modal-title\" id=\"sendModalLabel\">
                    提交发货单
                </h4>
            </div>
            <form action=\"\" id=\"consignmentForm\" class=\"form-inline\" >
            <div class=\"modal-body\" style=\"max-height:800px;\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">快递公司</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input type=\"text\" name=\"express_name\" data-required=\"1\" class=\"span4\" />
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">快递单号</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input name=\"express_no\" type=\"text\" class=\"span4\" />
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">发往地址</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <textarea rows=\"3\" cols=\"5\"  class=\"span4\" name=\"address\"></textarea>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">备注</b>&nbsp;&nbsp;</label>
                        <div class=\"controls\">
                            <textarea rows=\"3\" cols=\"5\"  class=\"span4\" name=\"desp\"></textarea>
                        </div>
                    </div>
                <button type=\"submit\" class=\"btn red\">提交</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 模态框（Modal）手机充值单 -->
<div class=\"modal fade\" id=\"mobileModal\" tabindex=\"-1\" role=\"dialog\" style=\"display:none\"
     aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\"
                        aria-hidden=\"true\">×
                </button>
                <h4 class=\"modal-title\" id=\"mobileModalLabel\">
                    提交发货单
                </h4>
            </div>
            <form action=\"\" id=\"mobileForm\" class=\"form-inline\" >
                <div class=\"modal-body\" style=\"max-height:800px;\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">充值手机号</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input type=\"text\" name=\"mobile\" data-required=\"1\" class=\"span4\" />
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">充值卡号或订单号</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input name=\"order_num\" type=\"text\" class=\"span4\" />
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">金额(元)</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input  type=\"text\"  class=\"span1\" name=\"money\"></textarea>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">备注</b>&nbsp;&nbsp;</label>
                        <div class=\"controls\">
                            <textarea rows=\"3\" cols=\"5\"  class=\"span4\" name=\"desp\"></textarea>
                        </div>
                    </div>
                    <button type=\"submit\" class=\"btn red\">提交</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
";
    }

    // line 344
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 345
        echo "<script type=\"text/javascript\" src=\"/media/js/jquery.validate.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/jquery.dataTables.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/DT_bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datetimepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datetimepicker.zh-CN.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/private/exchange.js\"></script>
";
    }

    // line 354
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 355
        echo "<script>
    jQuery(document).ready(function() {
        TableAdvanced.init();
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "services_exchange_list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  564 => 355,  561 => 354,  550 => 345,  547 => 344,  402 => 201,  394 => 196,  386 => 190,  378 => 187,  374 => 185,  371 => 184,  367 => 182,  354 => 180,  351 => 179,  348 => 178,  345 => 177,  341 => 175,  334 => 173,  331 => 172,  318 => 170,  315 => 169,  312 => 168,  310 => 167,  304 => 164,  298 => 161,  292 => 158,  286 => 155,  280 => 152,  274 => 149,  268 => 146,  262 => 143,  256 => 140,  250 => 137,  243 => 135,  234 => 134,  230 => 133,  191 => 96,  185 => 95,  177 => 93,  169 => 91,  166 => 90,  162 => 89,  149 => 79,  137 => 70,  128 => 63,  122 => 62,  114 => 60,  106 => 58,  103 => 57,  99 => 56,  88 => 48,  55 => 17,  52 => 16,  43 => 9,  40 => 8,  35 => 5,  32 => 4,);
    }
}
