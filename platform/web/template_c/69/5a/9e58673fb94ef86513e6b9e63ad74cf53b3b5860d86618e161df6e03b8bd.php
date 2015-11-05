<?php

/* floatCode.html */
class __TwigTemplate_695a9e58673fb94ef86513e6b9e63ad74cf53b3b5860d86618e161df6e03b8bd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"floatCode\" data-spy=\"affix\" data-offset-top=\"445\">
    <div class=\"p5\">
        <img src=\"";
        // line 3
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/android_code.png\" alt=\"\" width=\"110\" height=\"110\">
    </div>
    <a href=\"http://7xnzj3.dl1.z0.glb.clouddn.com/NBgame.apk\" class=\"btn btn-block btn-info\">安卓版下载</a>
</div>


<div class=\"floatCode\" data-spy=\"affix\" data-offset-top=\"445\" style=\"top:170px;\">
<div class=\"p5\">
    <img src=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/ios_code.png\" alt=\"\" width=\"110\" height=\"110\">
</div>
    <a href=\"itms-services://?action=download-manifest&url=https://dn-newbee299.qbox.me/Nbgame.plist\" class=\"btn btn-block btn-info\" style=\"background-color:rgb(247,170,65) !important;border-color:rgb(247,170,65) !important\">ios版下载</a>
</div>


<div class=\"floatCode\" data-spy=\"affix\" data-offset-top=\"445\" style=\"top:340px;\">
    <div class=\"p5\">
        <img src=\"";
        // line 19
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/readme.png\" alt=\"\">
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "floatCode.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 19,  34 => 11,  23 => 3,  19 => 1,);
    }
}
