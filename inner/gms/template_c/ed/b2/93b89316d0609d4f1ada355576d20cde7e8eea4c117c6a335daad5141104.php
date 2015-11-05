<?php

/* store_category_add.html */
class __TwigTemplate_edb293b89316d0609d4f1ada355576d20cde7e8eea4c117c6a335daad5141104 extends Twig_Template
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
        echo "商品栏目
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
";
    }

    // line 15
    public function block_content($context, array $blocks = array())
    {
        // line 16
        echo "<div class=\"row-fluid\">
    <div class=\"span12\">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class=\"page-title\">
            商品管理
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
        // line 33
        echo twig_escape_filter($this->env, (isset($context["action_name"]) ? $context["action_name"] : null), "html", null, true);
        echo "商品栏目</i></div>
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
        // line 45
        echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : null), "html", null, true);
        echo "\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\" enctype=\"multipart/form-data\">
<input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 46
        echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : null), "html", null, true);
        echo "\" />
<div class=\"alert alert-error hide\">
    <button class=\"close\" data-dismiss=\"alert\"></button>
    您提交的信息有错误请更正后再保存
</div>

<div class=\"alert alert-success hide\">
    <button class=\"close\" data-dismiss=\"alert\"></button>
    保存成功!
</div>

<div class=\"control-group\">
    <label class=\"control-label\"><b class=\"midnight\">栏目名称</b><span class=\"required\">*</span></label>
    <div class=\"controls\">
        <input type=\"text\" name=\"name\" data-required=\"1\" class=\"span3 m-wrap\" value=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
        echo "\"/>
    </div>
</div>

<div class=\"control-group\">
    <label class=\"control-label\"><b class=\"midnight\">栏目排序</b><span class=\"required\">*</span></label>
    <div class=\"controls\">
        <input type=\"text\" name=\"order\" data-required=\"1\" class=\"span3 m-wrap\" value=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "order", array()), "html", null, true);
        echo "\"/>
    </div>
</div>

<div class=\"control-group\">
    <label class=\"control-label\"><b class=\"midnight\">单价</b><span class=\"required\">*</span></label>
    <div class=\"controls\">
        <input type=\"text\" name=\"unit_price\" data-required=\"1\" class=\"span3 m-wrap\" value=\"";
        // line 74
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "unit_price", array()), "html", null, true);
        echo "\"/>
    </div>
</div>

<div class=\"control-group\">
    <label class=\"control-label\"><b class=\"midnight\">价格类型</b><span class=\"required\">*</span></label>
    <div class=\"controls chzn-controls\">
        <select class=\"span4 m-wrap\" name=\"unit_price_type\">
            ";
        // line 82
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["price_types"]) ? $context["price_types"] : null));
        foreach ($context['_seq'] as $context["val"] => $context["name"]) {
            // line 83
            echo "            ";
            if (((isset($context["val"]) ? $context["val"] : null) == $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "unit_price_type", array()))) {
                // line 84
                echo "            <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "</option>
            ";
            } else {
                // line 86
                echo "            <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "</option>
            ";
            }
            // line 88
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['val'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 89
        echo "        </select>
    </div>
</div>

<div class=\"control-group\">
    <label class=\"control-label\"><b class=\"midnight\">可见</b><span class=\"required\">*</span></label>
    <div class=\"controls chzn-controls\">
            <select class=\"span1 m-wrap\" name=\"visible\">
            ";
        // line 97
        if ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "visible", array())) {
            // line 98
            echo "            <option value=\"0\" >否</option>
            <option value=\"1\" selected=\"selected\">是</option>
            ";
        } else {
            // line 101
            echo "            <option value=\"0\" selected=\"selected\">否</option>
            <option value=\"1\">是</option>
            ";
        }
        // line 104
        echo "        </select>
    </div>
</div>

<div class=\"control-group\">
    <label class=\"control-label\"><b class=\"midnight\">商品图片</b><span class=\"required\">*</span></label>
    &nbsp;&nbsp;&nbsp; &nbsp;
    <b class=\"midnight\">文件大小小于100KB</b>
    <div class=\"controls\">
        <div class=\"fileupload fileupload-new\" data-provides=\"fileupload\">
            <div class=\"fileupload-new thumbnail\" style=\"width: 200px;\">
                <img src=\"";
        // line 115
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "image", array()), "html", null, true);
        echo "\" rel=\"image-upload\" />
            </div>
            <div class=\"fileupload-preview fileupload-exists thumbnail\" style=\"max-width: 200px;  line-height: 20px;\"></div>
            <div>
                                        <span class=\"btn btn-file\"><span class=\"fileupload-new\">浏览</span>
                                        <span class=\"fileupload-exists\">重选</span>
                                        <input type=\"file\" class=\"default\" name=\"image\" id=\"image\" accept=\"image/gif,image/jpeg,image/png\" />
                                        </span>
                <a href=\"#\" class=\"btn fileupload-exists\" data-dismiss=\"fileupload\">删除</a>
            </div>
        </div>
    </div>
</div>

<div class=\"control-group\">
    <label class=\"control-label\"><b class=\"midnight\">描述</b><span class=\"required\">*</span></label>
    <div class=\"controls\">
        <textarea cols=\"40\" rows=5 name=\"desp\" >";
        // line 132
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "desp", array()), "html", null, true);
        echo "</textarea>
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

    // line 152
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 153
        echo "<script type=\"text/javascript\" src=\"/media/js/jquery.validate.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/additional-methods.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/chosen.jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-fileupload.js\"></script>
";
    }

    // line 160
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 161
        echo "<script src=\"/media/js/private/store_category_add.js\"></script>
<script>
    var success = ";
        // line 163
        echo twig_escape_filter($this->env, (isset($context["success"]) ? $context["success"] : null), "html", null, true);
        echo ";
   \$(function(){
       FormValidation.init();
        if(success == 1)
            \$('.alert-success').show();


       ";
        // line 170
        if (((isset($context["action_name"]) ? $context["action_name"] : null) == "编辑")) {
            // line 171
            echo "           //编辑时 删除图片验证规则
           \$(\"#image\").rules('remove');
           ";
        }
        // line 174
        echo "   })
</script>
";
    }

    public function getTemplateName()
    {
        return "store_category_add.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  284 => 174,  279 => 171,  277 => 170,  267 => 163,  263 => 161,  260 => 160,  251 => 153,  248 => 152,  225 => 132,  205 => 115,  192 => 104,  187 => 101,  182 => 98,  180 => 97,  170 => 89,  164 => 88,  156 => 86,  148 => 84,  145 => 83,  141 => 82,  130 => 74,  120 => 67,  110 => 60,  93 => 46,  89 => 45,  74 => 33,  55 => 16,  52 => 15,  44 => 8,  41 => 7,  35 => 4,  32 => 3,);
    }
}
