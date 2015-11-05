<?php

/* index.html */
class __TwigTemplate_3e256fa0196e2dd75e4948604b9b9e10a56a5a8743bcad95679333bf15fd5dc7 extends Twig_Template
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
        echo "<html>
<head>
<title>管理中心</title>
<meta http-equiv=Content-Type content=text/html;charset=utf-8>
</head>
<frameset rows=\"64,*\"  frameborder=\"NO\" border=\"0\" framespacing=\"0\">
\t<frame src=\"/iFrame/top\" noresize=\"noresize\" frameborder=\"NO\" name=\"topFrame\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"0\" target=\"main\" />
  <frameset cols=\"200,*\"  rows=\"1000,*\" id=\"frame\">
\t<frame src=\"/iFrame/left\" name=\"leftFrame\" noresize=\"noresize\" marginwidth=\"0\" marginheight=\"0\" frameborder=\"0\" scrolling=\"no\" target=\"main\" />
\t<frame src=\"/iFrame/main\" name=\"main\" marginwidth=\"0\" marginheight=\"0\" frameborder=\"0\" scrolling=\"auto\" target=\"_self\" />
  </frameset>
<noframes>
  <body></body>
    </noframes>
</html>
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
