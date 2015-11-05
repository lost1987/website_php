<?php

/* admin_top.html */
class __TwigTemplate_9090d95d5f134ee9c541c7289c1bf2712c83d4b4ba025d319ba49f62e31e7673 extends Twig_Template
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
<title><%= title %> - 管理页面</title>
<script language=JavaScript>
function logout(){
\tif (confirm(\"您确定要退出控制面板吗？\"))
\ttop.location = \"out.asp\";
\treturn false;
}
</script>
<script language=JavaScript1.2>
function showsubmenu(sid) {
\tvar whichEl = eval(\"submenu\" + sid);
\tvar menuTitle = eval(\"menuTitle\" + sid);
\tif (whichEl.style.display == \"none\"){
\t\teval(\"submenu\" + sid + \".style.display=\\\"\\\";\");
\t}else{
\t\teval(\"submenu\" + sid + \".style.display=\\\"none\\\";\");
\t}
}
</script>
<meta http-equiv=Content-Type content=text/html;charset=utf-8>
<meta http-equiv=\"refresh\" content=\"60\">
<script language=JavaScript1.2>
function showsubmenu(sid) {
\tvar whichEl = eval(\"submenu\" + sid);
\tvar menuTitle = eval(\"menuTitle\" + sid);
\tif (whichEl.style.display == \"none\"){
\t\teval(\"submenu\" + sid + \".style.display=\\\"\\\";\");
\t}else{
\t\teval(\"submenu\" + sid + \".style.display=\\\"none\\\";\");
\t}
}
</script>
<base target=\"main\">
<link href=\"/images/skin.css\" rel=\"stylesheet\" type=\"text/css\">
</head>
<body leftmargin=\"0\" topmargin=\"0\">
<table width=\"100%\" height=\"64\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"admin_topbg\">
  <tr>
    <td width=\"61%\" height=\"64\"><img src=\"/images/logo.gif\" width=\"262\" height=\"64\"></td>
    <td width=\"39%\" valign=\"top\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"74%\" height=\"38\" class=\"admin_txt\">管理员：<b>";
        // line 44
        echo twig_escape_filter($this->env, (isset($context["account"]) ? $context["account"] : null), "html", null, true);
        echo "</b> 您好,感谢登陆使用！</td>
        <td width=\"22%\"><a href=\"/login/out\" target=\"_self\" ><img src=\"/images/out.gif\" alt=\"安全退出\" width=\"46\" height=\"20\" border=\"0\"></a></td>
        <td width=\"4%\">&nbsp;</td>
      </tr>
      <tr>
        <td height=\"19\" colspan=\"3\">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "admin_top.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 44,  19 => 1,);
    }
}
