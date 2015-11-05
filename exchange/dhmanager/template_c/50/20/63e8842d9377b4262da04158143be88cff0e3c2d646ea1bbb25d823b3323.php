<?php

/* excode_add.html */
class __TwigTemplate_502063e8842d9377b4262da04158143be88cff0e3c2d646ea1bbb25d823b3323 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
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
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"row\" >
    <h3><small class=\"badge badge-info\">添加购物券</small></h3>
    <div class=\"col-xs-12\">
                <form class=\"form-horizontal\" id=\"_form\" action=\"/excode/save\" method=\"post\" enctype=\"multipart/form-data\">
                <div class=\"form-group\">
                    <label for=\"title\" class=\"col-sm-2 control-label\">金额<font color=\"red\">*</font></label>
                    <div class=\"col-sm-3\">
                        <select  name=\"price\">
                            <option value=\"100\">100元</option>
                            <option value=\"500\">500元</option>
                        </select>
                    </div>
                </div>

                    <div class=\"form-group\">
                        <label for=\"title\" class=\"col-sm-2 control-label\">个数<font color=\"red\">*</font></label>
                        <div class=\"col-sm-3\">
                            <select  name=\"num\">
                                <option value=\"10\">10个</option>
                                <option value=\"100\">100个</option>
                            </select>
                        </div>
                    </div>

                <div class=\"form-group\">
                    <hr/>
                    <div class=\"col-sm-offset-2 col-sm-10\">
                        <button type=\"button\" onclick=\"doSubmit()\" class=\"btn btn-primary btn-sm\">保存</button>
                        <button type=\"button\" onclick=\"window.location.href='/excode/lists';\" class=\"btn btn-danger btn-sm\">返回</button>
                    </div>
                </div>
            </form>
    </div>
</div>
<script>
     function doSubmit(){
            \$(\"#_form\").submit();
     }
</script>
";
    }

    public function getTemplateName()
    {
        return "excode_add.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,);
    }
}
