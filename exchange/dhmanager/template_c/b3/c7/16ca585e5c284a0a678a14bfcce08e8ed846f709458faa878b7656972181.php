<?php

/* admin_add.html */
class __TwigTemplate_b3c716ca585e5c284a0a678a14bfcce08e8ed846f709458faa878b7656972181 extends Twig_Template
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
    <h3><small class=\"badge badge-info\">添加网点商家</small></h3>
    <div class=\"col-xs-12\">
        ";
        // line 7
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "id", array()) == false)) {
            // line 8
            echo "                <form class=\"form-horizontal\" id=\"_form\" action=\"/admin/save\" method=\"post\" enctype=\"multipart/form-data\">
        ";
        } else {
            // line 10
            echo "                <form class=\"form-horizontal\" id=\"_form\" action=\"/admin/update\" method=\"post\" enctype=\"multipart/form-data\">
        ";
        }
        // line 12
        echo "                <div class=\"form-group\">
                    <label for=\"title\" class=\"col-sm-2 control-label\">帐号<font color=\"red\">*</font></label>
                    <div class=\"col-sm-3\">
                        <input type=\"text\" class=\"form-control\" name=\"account\" id=\"account\"  value=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "account", array()), "html", null, true);
        echo "\" placeholder=\"请输入帐号(6-10位)\">
                    </div>
                </div>

            ";
        // line 19
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "id", array()) == false)) {
            // line 20
            echo "                <div class=\"form-group\">
                    <label for=\"title\" class=\"col-sm-2 control-label\">密码<font color=\"red\">*</font></label>
                    <div class=\"col-sm-3\">
                        <input type=\"password\" class=\"form-control\" name=\"password\" id=\"password\" value=\"\" placeholder=\"请输入密码(7-20位)\">
                    </div>
                </div>
            ";
        }
        // line 27
        echo "                <div class=\"form-group\">
                    <label for=\"title\" class=\"col-sm-2 control-label\">网点名<font color=\"red\">*</font></label>
                    <div class=\"col-sm-3\">
                        <input type=\"text\" class=\"form-control\" name=\"name\" value=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "name", array()), "html", null, true);
        echo "\" id=\"name\"  placeholder=\"请输入网点名\"/>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label for=\"author\" class=\"col-sm-2 control-label\">手机号<font color=\"red\">*</font></label>
                    <div class=\"col-sm-3\">
                        <input type=\"text\" class=\"form-control\" name=\"mobile\" id=\"mobile\" value=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "mobile", array()), "html", null, true);
        echo "\" placeholder=\"请输入手机号\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"col-sm-2 control-label\">地址<font color=\"red\"></font></label>
                    <div class=\"col-sm-10\">
                        <textarea class=\"form-control\" name=\"address\" style=\"height: 200px;width:500px;\" placeholder=\"请输入地址\">";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "address", array()), "html", null, true);
        echo "</textarea>
                    </div>
                </div>
                <div class=\"form-group\">
                    <hr/>
                    <div class=\"col-sm-offset-2 col-sm-10\">
                        <input type=\"hidden\" name=\"id\" value=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "id", array()), "html", null, true);
        echo "\" />
                        ";
        // line 50
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "id", array()) == false)) {
            // line 51
            echo "                        <button type=\"button\" onclick=\"doSubmit()\" class=\"btn btn-primary btn-sm\">保存</button>
                        ";
        } else {
            // line 53
            echo "                        <button type=\"button\" onclick=\"doUpdate()\" class=\"btn btn-primary btn-sm\">修改</button>
                        ";
        }
        // line 55
        echo "                        <button type=\"button\" onclick=\"window.location.href='/admin/lists';\" class=\"btn btn-danger btn-sm\">返回</button>
                    </div>
                </div>
            </form>
    </div>
</div>
<script>
     function doSubmit(){
            var account = \$(\"#account\").val().replace(/\\s+/g,'');
            var password = \$(\"#password\").val().replace(/\\s+/g,'');
           var name = \$(\"#name\").val().replace(/\\s+/g,'');
           var mobile =\$(\"#mobile\").val().replace(/\\s+/g,'');

            if(account == '' || password == '' || name == '' || mobile == ''){
                alert('请填写带*的字段!');
                return;
            }

            \$(\"#_form\").submit();
     }

    function doUpdate(){
        var account = \$(\"#account\").val().replace(/\\s+/g,'');
        var name = \$(\"#name\").val().replace(/\\s+/g,'');
        var mobile =\$(\"#mobile\").val().replace(/\\s+/g,'');

        if(account == '' || name == '' || mobile == ''){
            alert('请填写带*的字段!');
            return;
        }

        \$(\"#_form\").submit();
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "admin_add.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 55,  112 => 53,  108 => 51,  106 => 50,  102 => 49,  93 => 43,  84 => 37,  74 => 30,  69 => 27,  60 => 20,  58 => 19,  51 => 15,  46 => 12,  42 => 10,  38 => 8,  36 => 7,  31 => 4,  28 => 3,);
    }
}
