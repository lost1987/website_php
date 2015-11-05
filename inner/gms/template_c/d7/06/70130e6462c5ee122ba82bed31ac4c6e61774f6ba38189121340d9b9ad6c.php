<?php

/* game_help.html */
class __TwigTemplate_d70670130e6462c5ee122ba82bed31ac4c6e61774f6ba38189121340d9b9ad6c extends Twig_Template
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
        echo "游戏帮助
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
    <div class=\"caption\"><i class=\"icon-reorder\">游戏帮助</i></div>
    <div class=\"tools\">
        <a href=\"javascript:;\" class=\"collapse\"></a>
        <a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"></a>
        <a href=\"javascript:;\" class=\"reload\"></a>
        <a href=\"javascript:;\" class=\"remove\"></a>
    </div>
</div>


<div class=\"portlet-body form\">
<!-- BEGIN FORM-->
<form action=\"/game/saveHelp\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\" enctype=\"multipart/form-data\">
<div class=\"alert alert-error hide\">
    <button class=\"close\" data-dismiss=\"alert\"></button>
    您提交的信息有错误请更正后再保存
</div>

<div class=\"alert alert-success hide\">
    <button class=\"close\" data-dismiss=\"alert\"></button>
    保存成功!
</div>

<div class=\"row-fluid\">
    <div class=\"span12\">
        <div class=\"control-group\">
            <label class=\"control-label\"><b class=\"midnight\">帮助1</b><span class=\"required\"></span></label>
            &nbsp;&nbsp;&nbsp; &nbsp;
            <b class=\"midnight\">(720px * 任意高度<2048px)并且文件大小小于512KB</b>
            <div class=\"controls\">
                <input type=\"file\" name=\"help_image1\" />
                <br/>
            </div>
        </div>
    </div>
</div>

    <div class=\"row-fluid\">
        <div class=\"span12\">
            <div class=\"control-group\">
                <label class=\"control-label\"><b class=\"midnight\">帮助2</b><span class=\"required\"></span></label>
                &nbsp;&nbsp;&nbsp; &nbsp;
                <b class=\"midnight\">(720px * 任意高度<2048px)并且文件大小小于512KB</b>
                <div class=\"controls\">
                    <input type=\"file\" name=\"help_image2\" />
                    <br/>
                </div>
            </div>
        </div>
    </div>

    <div class=\"row-fluid\">
        <div class=\"span12\">
            <div class=\"control-group\">
                <label class=\"control-label\"><b class=\"midnight\">帮助3</b><span class=\"required\"></span></label>
                &nbsp;&nbsp;&nbsp; &nbsp;
                <b class=\"midnight\">(720px * 任意高度<2048px)并且文件大小小于512KB</b>
                <div class=\"controls\">
                    <input type=\"file\" name=\"help_image3\" />
                    <br/>
                </div>
            </div>
        </div>
    </div>

    <div class=\"row-fluid\">
        <div class=\"span12\">
            <div class=\"control-group\">
                <label class=\"control-label\"><b class=\"midnight\">帮助4</b><span class=\"required\"></span></label>
                &nbsp;&nbsp;&nbsp; &nbsp;
                <b class=\"midnight\">(720px * 任意高度<2048px)并且文件大小小于512KB</b>
                <div class=\"controls\">
                    <input type=\"file\" name=\"help_image4\" />
                    <br/>
                </div>
            </div>
        </div>
    </div>

    <div class=\"row-fluid\">
        <div class=\"span12\">
            <div class=\"control-group\">
                <label class=\"control-label\"><b class=\"midnight\">帮助5</b><span class=\"required\"></span></label>
                &nbsp;&nbsp;&nbsp; &nbsp;
                <b class=\"midnight\">(720px * 任意高度<2048px)并且文件大小小于512KB</b>
                <div class=\"controls\">
                    <input type=\"file\" name=\"help_image5\" />
                    <br/>
                </div>
            </div>
        </div>
    </div>


<div class=\"row-fluid\">
    <div class=\"span12\">
        <div class=\"control-group\">
            <label class=\"control-label\"><b class=\"midnight\">规则1</b><span class=\"required\"></span></label>
            &nbsp;&nbsp;&nbsp; &nbsp;
            <b class=\"midnight\">(720px * 任意高度<2048px)并且文件大小小于512KB</b>
            <div class=\"controls\">
                <input type=\"file\" name=\"guihua_image1\" />
\t\t\t\t<br/>
            </div>
        </div>
    </div>
</div>

    <div class=\"row-fluid\">
        <div class=\"span12\">
            <div class=\"control-group\">
                <label class=\"control-label\"><b class=\"midnight\">规则2</b><span class=\"required\"></span></label>
                &nbsp;&nbsp;&nbsp; &nbsp;
                <b class=\"midnight\">(720px * 任意高度<2048px)并且文件大小小于512KB</b>
                <div class=\"controls\">
                    <input type=\"file\" name=\"guihua_image2\" />
                    <br/>
                </div>
            </div>
        </div>
    </div>

    <div class=\"row-fluid\">
        <div class=\"span12\">
            <div class=\"control-group\">
                <label class=\"control-label\"><b class=\"midnight\">规则3</b><span class=\"required\"></span></label>
                &nbsp;&nbsp;&nbsp; &nbsp;
                <b class=\"midnight\">(720px * 任意高度<2048px)并且文件大小小于512KB</b>
                <div class=\"controls\">
                    <input type=\"file\" name=\"guihua_image3\" />
                    <br/>
                </div>
            </div>
        </div>
    </div>


    <div class=\"row-fluid\">
        <div class=\"span12\">
            <div class=\"control-group\">
                <label class=\"control-label\"><b class=\"midnight\">规则4</b><span class=\"required\"></span></label>
                &nbsp;&nbsp;&nbsp; &nbsp;
                <b class=\"midnight\">(720px * 任意高度<2048px)并且文件大小小于512KB</b>
                <div class=\"controls\">
                    <input type=\"file\" name=\"guihua_image4\" />
                    <br/>
                </div>
            </div>
        </div>
    </div>

    <div class=\"row-fluid\">
        <div class=\"span12\">
            <div class=\"control-group\">
                <label class=\"control-label\"><b class=\"midnight\">规则5</b><span class=\"required\"></span></label>
                &nbsp;&nbsp;&nbsp; &nbsp;
                <b class=\"midnight\">(720px * 任意高度<2048px)并且文件大小小于512KB</b>
                <div class=\"controls\">
                    <input type=\"file\" name=\"guihua_image5\" />
                    <br/>
                </div>
            </div>
        </div>
    </div>

    <div class=\"form-actions\">
        <button type=\"submit\" class=\"btn red\" >保存</button>
        <button type=\"reset\" class=\"btn\">重置</button>
    </div>
</form>

<form class=\"form-horizontal\" style=\"margin-bottom:25px;margin-top:25px !important;\">
    <div class=\"form-group\" >
    <label class=\"control-label\">帮助图片:</label>
        <div class=\"controls\" style=\"float:left\">
         ";
        // line 209
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["help_image"]) ? $context["help_image"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
            // line 210
            echo "          <p><img src=\"";
            echo twig_escape_filter($this->env, (isset($context["img"]) ? $context["img"] : null), "html", null, true);
            echo "\" width=\"220\" /></p>
         ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['img'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 212
        echo "        </div>
 </div>

     <div class=\"form-group\">
     <label class=\"control-label\">规划图片:</label>
         <div class=\"controls\" style=\"float:left\">
         ";
        // line 218
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["guize_image"]) ? $context["guize_image"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["img"]) {
            // line 219
            echo "         <p><img src=\"";
            echo twig_escape_filter($this->env, (isset($context["img"]) ? $context["img"] : null), "html", null, true);
            echo "\" width=\"220\" /></p>
             ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['img'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 221
        echo "         </div>
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

    // line 233
    public function block_javascript_plugins($context, array $blocks = array())
    {
    }

    // line 236
    public function block_javascript_custom($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "game_help.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  303 => 236,  298 => 233,  284 => 221,  275 => 219,  271 => 218,  263 => 212,  254 => 210,  250 => 209,  56 => 17,  53 => 16,  44 => 8,  41 => 7,  35 => 4,  32 => 3,);
    }
}
