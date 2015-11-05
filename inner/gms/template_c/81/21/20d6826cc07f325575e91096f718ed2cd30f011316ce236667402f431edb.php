<?php

/* system_guide_add.html */
class __TwigTemplate_812120d6826cc07f325575e91096f718ed2cd30f011316ce236667402f431edb extends Twig_Template
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
        echo twig_escape_filter($this->env, (isset($context["action_name"]) ? $context["action_name"] : null), "html", null, true);
        echo "引导公告
";
    }

    // line 7
    public function block_css($context, array $blocks = array())
    {
        // line 8
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/select2_metro.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/chosen.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/addtional.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/bootstrap-fileupload.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/datetimepicker.css\" />
";
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "<div class=\"row-fluid\">
    <div class=\"span12\">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class=\"page-title\">
            系统信息
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
    <div class=\"caption\"><i class=\"icon-reorder\">";
        // line 34
        echo twig_escape_filter($this->env, (isset($context["action_name"]) ? $context["action_name"] : null), "html", null, true);
        echo "引导公告</i></div>
    <div class=\"tools\">
        <a href=\"javascript:;\" class=\"collapse\"></a>
        <a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"></a>
        <a href=\"javascript:;\" class=\"reload\"></a>
        <a href=\"javascript:;\" class=\"remove\"></a>
    </div>
</div>


<div class=\"portlet-body form\">
<!-- BEGIN FORM-->
<form action=\"";
        // line 46
        echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : null), "html", null, true);
        echo "\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\" enctype=\"multipart/form-data\">
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
            <label class=\"control-label\"><b class=\"midnight\">公告名称</b><span class=\"required\">*</span></label>
            <div class=\"controls\">
                <input type=\"text\" name=\"name\" id=\"name\" data-required=\"1\" class=\"span6 m-wrap\" value=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
        echo "\"/>
            </div>
        </div>
    </div>
</div>

<div class=\"row-fluid\">
    <div class=\"span6\">
        <div class=\"control-group\">
            <label class=\"control-label\"><b class=\"midnight\">类型(0:版本更新,1:活动,2:提示)</b><span class=\"required\">*</span></label>
            <div class=\"controls\">
                <input type=\"text\" name=\"squeue\" id=\"squeue\" data-required=\"1\" class=\"span6 m-wrap\" value=\"";
        // line 74
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "squeue", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "squeue", array()), 0)) : (0)), "html", null, true);
        echo "\"/>
            </div>
        </div>
    </div>
</div>

<div class=\"row-fluid\">
<div class=\"span6\">
<div class=\"control-group\">
    <label class=\"control-label\"><b class=\"midnight\">过期时间</b><span class=\"required\">*</span></label>
    <div class=\"controls\">
        <div class=\"input-append date form_datetime\">
            <input  type=\"text\" name=\"expired_time\" id=\"expired_time\" readonly class=\"m-wrap span6\">
            <span class=\"add-on\"><i class=\"icon-calendar\"></i></span>
        </div>
    </div>
</div>
</div>
</div>

<div class=\"row-fluid\">
    <div class=\"span12\">
        <div class=\"control-group\">
            <label class=\"control-label\"><b class=\"midnight\">图片</b><span class=\"required\">*</span></label>
            &nbsp;&nbsp;&nbsp; &nbsp;
            <b class=\"midnight\">(720px * 430px)并且文件大小小于512KB</b>
            <div class=\"controls\">
                <input type=\"file\" name=\"image[]\" /><a href=\"javascript:;\" class=\"popovers red\" data-trigger=\"hover\" data-content=\"点我添加一张图片\" data-original-title=\"说明\" onclick=\"addImage()\"><i class=\"icon-plus\" ></i></a>
\t\t\t\t<br/>
                <input type=\"text\" name=\"url[]\" value=\"\" placeHolder=\"url地址\" />
            </div>
        </div>
    </div>
</div>

<div class=\"form-actions\">
    <button type=\"button\" class=\"btn red\" onclick=\"doSubmit()\">保存</button>
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

    // line 123
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 124
        echo "<script type=\"text/javascript\" src=\"/media/js/jquery.validate.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/additional-methods.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/chosen.jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.zh-CN.js\"></script>
";
    }

    // line 132
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 133
        echo "<script type=\"text/javascript\" src=\"/media/js/private/system_guide_add.js\"></script>
<script>
    var action_name = '";
        // line 135
        echo twig_escape_filter($this->env, (isset($context["action_name"]) ? $context["action_name"] : null), "html", null, true);
        echo "';
    var success = ";
        // line 136
        echo twig_escape_filter($this->env, ((array_key_exists("success", $context)) ? (_twig_default_filter((isset($context["success"]) ? $context["success"] : null), 0)) : (0)), "html", null, true);
        echo ";
    \$(function(){
        if(success == 1)
            \$('.alert-success').show();

        ";
        // line 141
        if (((isset($context["action_name"]) ? $context["action_name"] : null) == "编辑")) {
            // line 142
            echo "            //编辑时 删除图片验证规则
            \$(\"#image\").rules('remove');
            ";
        }
        // line 145
        echo "        })
</script>
";
    }

    public function getTemplateName()
    {
        return "system_guide_add.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  215 => 145,  210 => 142,  208 => 141,  200 => 136,  196 => 135,  192 => 133,  189 => 132,  179 => 124,  176 => 123,  124 => 74,  110 => 63,  90 => 46,  75 => 34,  56 => 17,  53 => 16,  44 => 8,  41 => 7,  35 => 4,  32 => 3,);
    }
}
