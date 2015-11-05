<?php

/* base.html */
class __TwigTemplate_5fc90bbed6dd72ebb13e314f2eb8bfdc7999c803256107ec3460188d0584bde0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head lang=\"en\">
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no\">
    <title></title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel=\"stylesheet\" href=\"/css/bootstrap.min.css\">
    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel=\"stylesheet\" href=\"/css/bootstrap-theme.min.css\">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src=\"/js/jquery-1.10.1.min.js\"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src=\"/js/bootstrap.min.js\"></script>

    <style>
            body{
                background-color: rgb(247,248,249);
                font-size:12px;
            }

            .form-control
            {
                font-size:12px;
            }
    </style>

</head>


<body>
<div class=\"container-fluid\" style=\"margin-left:10px;font-size:12px;\">
    ";
        // line 33
        $this->displayBlock('content', $context, $blocks);
        // line 35
        echo "</div>
</body>
";
    }

    // line 33
    public function block_content($context, array $blocks = array())
    {
        // line 34
        echo "    ";
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function getDebugInfo()
    {
        return array (  65 => 34,  62 => 33,  56 => 35,  54 => 33,  20 => 1,);
    }
}
