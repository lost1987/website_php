<?php

/* download-mobile.html */
class __TwigTemplate_7c39eae980558f4dc006258acd1376115049a37a209c9b7d4d5fd6bae61d134a extends Twig_Template
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
        echo "<!DOCTYPE html>
<html>
<head lang=\"en\">
    <!-- html document -->

   <meta name=\"viewport\"
          content=\"width=device-width,user-scalable=no\"/>

    <title></title>
\t<style type=\"text/css\" >
\t@media screen and (min-width:1200px) {
\t\t\t\t  .main {
\t\t\t\twidth:720px;
\t\t\t\theight:1280px;
\t\t\t\tbackground: url('../images/mobile/bg.jpg');
\t\t\t\tbackground-size:contain;
\t\t\t\tbackground-repeat:no-repeat;
\t\t\t}
\t\t\t
\t\t\t.btn{
\t\t\t\t\tmargin-top:770px;
\t\t\t\t\twidth:300px;
\t\t\t\t\theight:150px;
\t\t\t\t}
\t\t}

\t\t@media screen and (min-width:960px) and (max-width:1199px) {
\t\t\t  .main {
\t\t\t\twidth:720px;
\t\t\t\theight:1280px;
\t\t\t\tbackground: url('../images/mobile/bg.jpg');
\t\t\t\tbackground-size:contain;
\t\t\t\tbackground-repeat:no-repeat;
\t\t\t}
\t\t
\t\t\t.btn{
\t\t\t\tmargin-top:800px;
\t\t\t\twidth:300px;
\t\t\t\theight:150px;
\t\t\t}
\t\t}

\t\t@media screen and (min-width:768px) and (max-width:959px) {
\t\t\t  .main {
            width:700px;
\t\t\theight:1280px;
            background: url('../images/mobile/bg.jpg');
            background-size:contain;
            background-repeat:no-repeat;
        }
\t\t}

\t\t@media  screen and (min-width:480px) and (max-width:767px) {
\t\t\t  .main {
            width:490px;
\t\t\theight:800px;
            background: url('../images/mobile/bg.jpg');
            background-size:contain;
            background-repeat:no-repeat;
        }
\t\t
\t\t\t\t.btn{
\t\t\t\t\t\t\tmargin-top:480px;
\t\t\t\t\t\t\twidth:170px;
\t\t\t\t\t\t\theight:90px;
\t\t\t\t}
\t\t}

\t\t@media  screen and (max-width:479px) {
\t\t\t.main {
\t\t\t  height:600px;
            width:310px;
            background: url('../images/mobile/bg.jpg');
            background-size:contain;
            background-repeat:no-repeat;
\t\t\t}
\t\t\t
\t\t\t.btn{
\t\t\t\tmargin-top:345px;
\t\t\t\twidth:100px;
\t\t\t\theight:50px;
\t\t\t}
\t\t}
\t</style>


</head>
<body>
<center>
    <div class=\"main\" id=\"main\">
        <script>
            window.onload = function(){
                document.getElementById('main').onclick = function(){
                    window.location.href=\"/download\";
                }
            }
        </script>
    </div>
</center>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "download-mobile.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
