<?php

/* msg_push_broadcast.html */
class __TwigTemplate_6120aeead89108bc59b5d241e8b3fa633a799eaf814e8bd894f785128554d89b extends Twig_Template
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
            消息推送
            <small>广播</small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>

<div class=\"row-fluid\">
<div class=\"span12\">
<!-- BEGIN VALIDATION STATES-->
<div class=\"portlet box\">

<div class=\"portlet-title\">
    <div class=\"caption\"><i class=\"icon-reorder\">广播</i></div>
    <div class=\"tools\">
        <a href=\"javascript:;\" class=\"collapse\"></a>
        <a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"></a>
        <a href=\"javascript:;\" class=\"reload\"></a>
        <a href=\"javascript:;\" class=\"remove\"></a>
    </div>
</div>


<div class=\"portlet-body form\">
<!-- BEGIN FORM-->
<form action=\"/service/goPush\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\" >
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
                <select class=\"span5 m-wrap\" name=\"device_type\"  id=\"device_type\">
                    <option value=\"0\">所有</option>
                    <option value=\"1\">安卓</option>
                    <option value=\"2\">ios</option>
                </select>
            </div>
        </div>
    </div>

<div class=\"row-fluid\">
    <div class=\"span12\">
        <div class=\"control-group\">
            <label class=\"control-label\"><b class=\"midnight\">标题</b><span class=\"required\">*</span></label>
            <div class=\"controls\">
                <input name=\"title\" id=\"title\" type=\"text\" class=\"span4 m-wrap\" />
            </div>
        </div>
    </div>
</div>

    <div class=\"row-fluid\">
    <div class=\"span6\">
        <div class=\"control-group\">
            <label class=\"control-label\"><b class=\"midnight\">内容</b><span class=\"required\">*</span></label>
            <div class=\"controls\">
                <textarea  id=\"content\" name=\"content\" rows=\"10\" style=\"width:400px\" ></textarea>
            </div>
        </div>
    </div>
        </div>

<div class=\"form-actions\">
    <button type=\"button\" id=\"sendbtn\" class=\"btn red\" onclick=\"send()\">发送</button>
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

    // line 108
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 109
        echo "<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/chosen.jquery.min.js\"></script>
";
    }

    // line 113
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 114
        echo "<script>
    \$(function()
    {

        \$(\"#msg_type\").change(function()
        {
            var msg_type = parseInt(\$(this).val());
            if(msg_type == 2)
                \$(\"#alias\").attr('disabled',false);
            else {
                \$(\"#alias\").val('');
                \$(\"#alias\").attr('disabled', true);
            }
        });

    })

    function send(){
        var params  = {};
        params.device_type = \$(\"#device_type\").val();
        params. title = \$(\"#title\").val();
        params.content = \$(\"#content\").val();

        if(params.title.replace(/\\s+/g,'') == '')
        {
            alert('请填写标题!');
            return;
        }

        if(params.content.replace(/\\s+/g,'') == '')
        {
            alert('请填写内容!');
            return;
        }

        \$(\"#sendbtn\").attr('disabled',true);
        \$.post('/msgPush/goPush',params,function(data){
               var response = eval('('+data+')');
              alert(response.data);
              if(parseInt(response.error) == 0){
                  \$(\"#title\").val('');
                  \$(\"#content\").val('');
                  \$(\"#alias\").val('');
              }
            \$(\"#sendbtn\").attr('disabled',false);
        });

    }
</script>
";
    }

    public function getTemplateName()
    {
        return "msg_push_broadcast.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 114,  157 => 113,  151 => 109,  148 => 108,  55 => 17,  52 => 16,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
