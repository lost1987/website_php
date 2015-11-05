<?php

/* user_info_email_success.html */
class __TwigTemplate_82489b976bafa3813ccaa3eeabe197f550408709f81cfdc2d8ef8fd4bb18f928 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("basePersonnal.html");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'content' => array($this, 'block_content'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "basePersonnal.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "武汉麻将-个人中心
";
    }

    // line 7
    public function block_keywords($context, array $blocks = array())
    {
        // line 8
        echo "武汉麻将-个人中心
";
    }

    // line 11
    public function block_description($context, array $blocks = array())
    {
        // line 12
        echo "武汉麻将-个人中心
";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "<div class=\"col-xs-7\">
    <div class=\"panel p15 inner pb50\">
        <h4 class=\"mTitle\">账号信息
            <small class=\"text-blue\"><span class=\"pl5 pr5 text-grey\">|</span>邮箱认证</small>
        </h4>
        <div>
            <form class=\"form-horizontal\" role=\"form\">
                <div class=\"alert alert-info\" id=\"showArea\" >
                    <div class=\"p10\">
                        恭喜您认证成功!
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
";
    }

    // line 32
    public function block_script($context, array $blocks = array())
    {
        // line 33
        echo "<script>
  \$(function(){
     setTimeout(\"gotoIndex()\",800);
  });
  
  function gotoIndex(){
      window.location.href = '/';
  }
</script>
";
    }

    public function getTemplateName()
    {
        return "user_info_email_success.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 33,  79 => 32,  59 => 15,  56 => 14,  51 => 12,  48 => 11,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
