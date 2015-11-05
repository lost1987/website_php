<?php

/* left.html */
class __TwigTemplate_18b632d39c65e8f9c225f75a9e74bac748935828c0f5233915a7c8a1f03cd0f4 extends Twig_Template
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
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>管理页面</title>

<script src=\"/js/prototype.lite.js\" type=\"text/javascript\"></script>
<script src=\"/js/moo.fx.js\" type=\"text/javascript\"></script>
<script src=\"/js/moo.fx.pack.js\" type=\"text/javascript\"></script>
<style>
body {
\tfont:12px Arial, Helvetica, sans-serif;
\tcolor: #000;
\tbackground-color: #EEF2FB;
\tmargin: 0px;
}
#container {
\twidth: 182px;
}
H1 {
\tfont-size: 12px;
\tmargin: 0px;
\twidth: 182px;
\tcursor: pointer;
\theight: 30px;
\tline-height: 20px;\t
}
H1 a {
\tdisplay: block;
\twidth: 182px;
\tcolor: #000;
\theight: 30px;
\ttext-decoration: none;
\tmoz-outline-style: none;
\tbackground-image: url(/images/menu_bgS.gif);
\tbackground-repeat: no-repeat;
\tline-height: 30px;
\ttext-align: center;
\tmargin: 0px;
\tpadding: 0px;
}
.content{
\twidth: 182px;
\theight: 26px;
\t
}
.MM ul {
\tlist-style-type: none;
\tmargin: 0px;
\tpadding: 0px;
\tdisplay: block;
}
.MM li {
\tfont-family: Arial, Helvetica, sans-serif;
\tfont-size: 12px;
\tline-height: 26px;
\tcolor: #333333;
\tlist-style-type: none;
\tdisplay: block;
\ttext-decoration: none;
\theight: 26px;
\twidth: 182px;
\tpadding-left: 0px;
}
.MM {
\twidth: 182px;
\tmargin: 0px;
\tpadding: 0px;
\tleft: 0px;
\ttop: 0px;
\tright: 0px;
\tbottom: 0px;
\tclip: rect(0px,0px,0px,0px);
}
.MM a:link {
\tfont-family: Arial, Helvetica, sans-serif;
\tfont-size: 12px;
\tline-height: 26px;
\tcolor: #333333;
\tbackground-image: url(/images/menu_bg1.gif);
\tbackground-repeat: no-repeat;
\theight: 26px;
\twidth: 182px;
\tdisplay: block;
\ttext-align: center;
\tmargin: 0px;
\tpadding: 0px;
\toverflow: hidden;
\ttext-decoration: none;
}
.MM a:visited {
\tfont-family: Arial, Helvetica, sans-serif;
\tfont-size: 12px;
\tline-height: 26px;
\tcolor: #333333;
\tbackground-image: url(/images/menu_bg1.gif);
\tbackground-repeat: no-repeat;
\tdisplay: block;
\ttext-align: center;
\tmargin: 0px;
\tpadding: 0px;
\theight: 26px;
\twidth: 182px;
\ttext-decoration: none;
}
.MM a:active {
\tfont-family: Arial, Helvetica, sans-serif;
\tfont-size: 12px;
\tline-height: 26px;
\tcolor: #333333;
\tbackground-image: url(/images/menu_bg1.gif);
\tbackground-repeat: no-repeat;
\theight: 26px;
\twidth: 182px;
\tdisplay: block;
\ttext-align: center;
\tmargin: 0px;
\tpadding: 0px;
\toverflow: hidden;
\ttext-decoration: none;
}
.MM a:hover {
\tfont-family: Arial, Helvetica, sans-serif;
\tfont-size: 12px;
\tline-height: 26px;
\tfont-weight: bold;
\tcolor: #006600;
\tbackground-image: url(/images/menu_bg2.gif);
\tbackground-repeat: no-repeat;
\ttext-align: center;
\tdisplay: block;
\tmargin: 0px;
\tpadding: 0px;
\theight: 26px;
\twidth: 182px;
\ttext-decoration: none;
}
</style>
</head>

<body>
<table width=\"100%\" height=\"280\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#EEF2FB\">
  <tr>
    <td width=\"182\" valign=\"top\">
\t\t<div id=\"container\">
\t\t\t";
        // line 146
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["trees"]) ? $context["trees"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["tree"]) {
            // line 147
            echo "\t\t\t\t<h1 class=\"type\"><a href=\"javascript:void(0)\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tree"]) ? $context["tree"] : null), "name", array()), "html", null, true);
            echo "</a></h1>
\t\t\t\t<div class=\"content\">
\t\t\t\t\t<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<td><img src=\"/images/menu_topline.gif\" width=\"182\" height=\"5\" /></td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t</table>
\t\t\t\t\t<ul class=\"MM\">
\t\t\t\t\t\t";
            // line 155
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["tree"]) ? $context["tree"] : null), "data", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 156
                echo "\t\t\t\t\t\t<li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "url", array()), "html", null, true);
                echo "\" target=\"main\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
                echo "</a></li>
\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 158
            echo "\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tree'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 161
        echo "

\t\t\t<!--<h1 class=\"type\"><a href=\"javascript:void(0)\">管理员项</a></h1>
      <div class=\"content\">
        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
          <tr>
            <td><img src=\"/images/menu_topline.gif\" width=\"182\" height=\"5\" /></td>
          </tr>
        </table>
        <ul class=\"MM\">
          <li><a href=\"/admin/lists\" target=\"main\">用户管理</a></li>
        </ul>
      </div>

      <h1 class=\"type\"><a href=\"javascript:void(0)\">用户项</a></h1>
      <div class=\"content\">
        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
          <tr>
            <td><img src=\"/images/menu_topline.gif\" width=\"182\" height=\"5\" /></td>
          </tr>
        </table>
        <ul class=\"MM\">
          <li><a href=\"http://www.mycodes.net\" target=\"main\">信息分类</a></li>
        </ul>
      </div>-->
      </div>
        <script type=\"text/javascript\">
\t\tvar contents = document.getElementsByClassName('content');
\t\tvar toggles = document.getElementsByClassName('type');
\t
\t\tvar myAccordion = new fx.Accordion(
\t\t\ttoggles, contents, {opacity: true, duration: 400}
\t\t);
\t\tmyAccordion.showThisHideOpen(contents[0]);
\t</script>
        </td>
  </tr>
</table>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "left.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 161,  197 => 158,  186 => 156,  182 => 155,  170 => 147,  166 => 146,  19 => 1,);
    }
}
