<?php

/* system_clear_redis.html */
class __TwigTemplate_16e2b0b2a301903a41d171a7f6e0c5d41a071f568ff5d2eecd3d5eea410482cb extends Twig_Template
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
        echo "清理redis
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
            <small>清理redis</small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>

<div class=\"row-fluid\">
    <div class=\"span12\">
        <!-- BEGIN VALIDATION STATES-->
        <div class=\"portlet box\">

            <div class=\"portlet-title\">
                <div class=\"caption\"><i class=\"icon-reorder\">清理redis</i></div>
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
                                <label class=\"control-label span4\"><b class=\"midnight\">key(可以用*号,一行一个)</b><span class=\"required\">*</span></label>
                                <div class=\"controls\">
                                    <textarea style=\"width:600px;\" rows=\"20\" id=\"keys\"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"row-fluid\">
                        <div class=\"span4\">
                            <div class=\"control-group\">
                                <label class=\"control-label span4\"><b class=\"midnight\">redis索引</b><span class=\"required\">*</span></label>
                                <div class=\"controls\">
                                    <input type=\"text\"  id=\"idx\" class=\"span3\">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"form-actions\">
                        <button type=\"button\" class=\"btn red\" onclick=\"doClear()\">清理</button>
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

    // line 94
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 95
        echo "<script type=\"text/javascript\" src=\"/media/js/jquery.validate.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/additional-methods.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/chosen.jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.zh-CN.js\"></script>
";
    }

    // line 103
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 104
        echo "<script>
    function doClear()
    {
        var keys = \$(\"#keys\").val();
        if(keys == '')
        {
            alert('请输入要清理的key');
            return;
        }
        keys = keys.replace(/\\n|\\r\\n/gi, \",\");
        var idx = \$(\"#idx\").val();
        if(idx == '')
        {
            alert('请输入要选择的redis索引');
            return;
        }
        \$.post('/system/doClearRedis','keys='+keys+'&idx='+idx,function(data){
                    var response = eval('('+data+')');
                    if(response.error == 0)
                        alert('清理完成');
                    else
                        alert('清理出错code:'+response.error);
        });
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "system_clear_redis.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 104,  150 => 103,  140 => 95,  137 => 94,  86 => 46,  55 => 17,  52 => 16,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
