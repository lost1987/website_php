<?php

/* player_support_add.html */
class __TwigTemplate_853c0c107c35aa352de8fe00c17a2354053e870ee6392d6517163fc4617a7737 extends Twig_Template
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
        echo "添加扶持帐号
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
            游戏管理
            <small></small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>

<div class=\"row-fluid\">
    <div class=\"span12\">
        <!-- BEGIN VALIDATION STATES-->
        <div class=\"portlet box\">

            <div class=\"portlet-title\">
                <div class=\"caption\"><i class=\"icon-reorder\">添加扶持帐号</i></div>
                <div class=\"tools\">
                    <a href=\"javascript:;\" class=\"collapse\"></a>
                    <a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"></a>
                    <a href=\"javascript:;\" class=\"reload\"></a>
                    <a href=\"javascript:;\" class=\"remove\"></a>
                </div>
            </div>


            <div class=\"portlet-body form\">
                <!-- BEGIN FORM-->
                <form action=\"/player/saveSupporter/19\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\">
                    <div class=\"alert alert-error hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        您提交的信息有错误请更正后再保存
                    </div>

                    <div class=\"alert alert-success hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        保存成功!
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">帐号</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input type=\"text\" name=\"login_name\" data-required=\"1\" class=\"span3 m-wrap\" value=\"\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">密码</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input name=\"password\" type=\"text\" class=\"span3 m-wrap\" value=\"\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">重复密码</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input name=\"re-password\" type=\"text\" class=\"span3 m-wrap\" value=\"\"/>
                        </div>
                    </div>

                    <div class=\"form-actions\">
                        <button type=\"submit\" class=\"btn red\">保存</button>
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

    // line 91
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 92
        echo "<script type=\"text/javascript\" src=\"/media/js/jquery.validate.min.js\"></script>
";
    }

    // line 95
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 96
        echo "<script>
    \$(function(){

    })
</script>
";
    }

    public function getTemplateName()
    {
        return "player_support_add.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  142 => 96,  139 => 95,  134 => 92,  131 => 91,  53 => 15,  50 => 14,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
