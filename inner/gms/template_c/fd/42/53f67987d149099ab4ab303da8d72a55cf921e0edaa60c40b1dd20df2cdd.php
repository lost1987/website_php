<?php

/* msg_push_task_add.html */
class __TwigTemplate_fd4253f67987d149099ab4ab303da8d72a55cf921e0edaa60c40b1dd20df2cdd extends Twig_Template
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

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "推送消息
";
    }

    // line 7
    public function block_css($context, array $blocks = array())
    {
        // line 8
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/select2_metro.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/chosen.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/addtional.css\" />
";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "<div class=\"row-fluid\">
    <div class=\"span12\">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class=\"page-title\">
            推送任务
            <small>添加</small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>

<div class=\"row-fluid\">
    <div class=\"span12\">
        <!-- BEGIN VALIDATION STATES-->
        <div class=\"portlet box\">

            <div class=\"portlet-title\">
                <div class=\"caption\"><i class=\"icon-reorder\">推送任务</i></div>
                <div class=\"tools\">
                    <a href=\"javascript:;\" class=\"collapse\"></a>
                    <a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"></a>
                    <a href=\"javascript:;\" class=\"reload\"></a>
                    <a href=\"javascript:;\" class=\"remove\"></a>
                </div>
            </div>


            <div class=\"portlet-body form\">
                <!-- BEGIN FORM-->
                <form action=\"/msgPush/taskSave\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\" >
                    <div class=\"alert alert-error hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        您提交的信息有错误请更正后再保存
                    </div>

                    <div class=\"alert alert-success hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        保存成功!
                    </div>


                    <div class=\"row-fluid\">
                        <div class=\"span6\">
                            <div class=\"control-group\">
                                <label class=\"control-label\"><b class=\"midnight\">设备类型</b><span class=\"required\">*</span></label>
                                <div class=\"controls\">
                                    <select class=\"span5 m-wrap\" name=\"device\"  id=\"device\">
                                        <option value=\"0\">所有</option>
                                        <option value=\"1\">安卓</option>
                                        <option value=\"2\">ios</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class=\"row-fluid\">
                            <div class=\"span12\">
                            <div class=\"control-group\">
                                <label class=\"control-label\"><b class=\"midnight\">消息类型</b><span class=\"required\">*</span></label>
                                <div class=\"controls\">
                                    <select class=\"span5 m-wrap\" name=\"users_type\" >
                                        ";
        // line 77
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["user_groups"]) ? $context["user_groups"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 78
            echo "                                            <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"row-fluid\">
                        <div class=\"span12\">
                            <div class=\"control-group\">
                                <label class=\"control-label\"><b class=\"midnight\">标题</b><span class=\"required\">*</span></label>
                                <div class=\"controls\">
                                    <input name=\"title\"  type=\"text\" class=\"span4 m-wrap\" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"row-fluid\">
                        <div class=\"span6\">
                            <div class=\"control-group\">
                                <label class=\"control-label\"><b class=\"midnight\">内容</b><span class=\"required\">*</span></label>
                                <div class=\"controls\">
                                    <textarea   name=\"content\" rows=\"10\" style=\"width:400px\" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"row-fluid\">
                        <div class=\"span4\">
                            <div class=\"control-group\">
                                <label class=\"control-label\"><b class=\"midnight\">每天几点推送</b><span class=\"required\">*</span></label>
                                <div class=\"controls\">
                                    <input name=\"task_hour\"  type=\"text\" class=\"span4 m-wrap\" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"row-fluid\">
                        <div class=\"span4\">
                            <div class=\"control-group\">
                                <label class=\"control-label\"><b class=\"midnight\">每月几号推送(0为每天)</b><span class=\"required\">*</span></label>
                                <div class=\"controls\">
                                    <input name=\"task_day\"  type=\"text\" class=\"span4 m-wrap\" value=\"0\" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"form-actions\">
                        <button type=\"submit\"  class=\"btn red\" >发送</button>
                        <button type=\"reset\" class=\"btn\">重置</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>

";
    }

    // line 144
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 145
        echo "<script type=\"text/javascript\" src=\"/media/js/jquery.validate.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/additional-methods.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/chosen.jquery.min.js\"></script>
";
    }

    // line 151
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 152
        echo "<script type=\"text/javascript\" src=\"/media/js/private/msg_push_task_add.js\"></script>
<script>
    var success = ";
        // line 154
        echo twig_escape_filter($this->env, (isset($context["success"]) ? $context["success"] : null), "html", null, true);
        echo ";
    \$(function(){
        FormValidation.init();
        if(success == 1)
            \$('.alert-success').show();
    })
</script>
";
    }

    public function getTemplateName()
    {
        return "msg_push_task_add.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 154,  212 => 152,  209 => 151,  201 => 145,  198 => 144,  132 => 80,  121 => 78,  117 => 77,  53 => 15,  50 => 14,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
