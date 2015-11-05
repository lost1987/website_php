<?php

/* login.html */
class __TwigTemplate_d3c8f8a757e69320b133909ab9bec4961755c9ed0c2519ce7406701b7dfb7cb5 extends Twig_Template
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
  <meta charset=\"UTF-8\">
  <title>武汉新蜂乐众推广系统</title>
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no\">
  <meta name=\"format-detection\" content=\"telephone=no\">
  <meta name=\"renderer\" content=\"webkit\">
  <meta http-equiv=\"Cache-Control\" content=\"no-siteapp\" />
  <!--<link rel=\"alternate icon\" type=\"image/png\" href=\"assets/i/favicon.png\">-->
  <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/css/amazeui.min.css\"/>
    <link rel=\"stylesheet\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/css/app.css\"/>
    <script src=\"";
        // line 14
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/js/jquery.min.js\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 15
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/js/amazeui.js\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 16
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/amazeui.extend.js\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 17
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/md5.min.js\" type=\"text/javascript\"></script>
  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class=\"header\">
  <div class=\"am-g\">
    <h1>武汉新蜂乐众推广系统后台</h1>
    <p>Integrated Development Environment<br/>代码编辑，代码生成，界面设计，调试，编译</p>
  </div>
  <hr />
</div>
<div class=\"am-g\">
  <div class=\"am-u-lg-6 am-u-md-8 am-u-sm-centered\">
    <h3>登录</h3>
    <hr>
    <div class=\"am-btn-group\">
      <a href=\"#\" class=\"am-btn am-btn-secondary am-btn-sm\"><i class=\"am-icon-github am-icon-sm\"></i> Github</a>
      <a href=\"#\" class=\"am-btn am-btn-success am-btn-sm\"><i class=\"am-icon-google-plus-square am-icon-sm\"></i> Google+</a>
      <a href=\"#\" class=\"am-btn am-btn-primary am-btn-sm\"><i class=\"am-icon-stack-overflow am-icon-sm\"></i> stackOverflow</a>
    </div>
    <br>
    <br>

    <form  method=\"post\" class=\"am-form\" id=\"login_form\">
      <label for=\"email\">邮箱:</label>
      <input type=\"email\" name=\"email\" id=\"email\" value=\"\">
      <br>
      <label for=\"password\">密码:</label>
      <input type=\"password\" name=\"password\" id=\"password\" value=\"\">
      <br>
        <span id=\"authcode\"><script async  type=\"text/javascript\" src=\"http://api.geetest.com/get.php?gt=58d599e70486afdb23017cedecdf4056&mobile=0\"></script></span>
      <br/><br/><br/>
      <div class=\"am-cf\">
        <input type=\"button\" name=\"\" value=\"登 录\" onclick=\"login()\" class=\"am-btn am-btn-primary am-btn-sm am-fl\">
        <input type=\"button\" name=\"\" value=\"忘记密码 ^_^? \" class=\"am-btn am-btn-default am-btn-sm am-fr\">
      </div>
    </form>
    <hr>
    <p>© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
  </div>
</div>
<script>
    var geeAuthDone = 0;

    \$(\"#login_form\").on('keydown',function(e){
        event = window.event || e;
        if(event.keyCode == 13)
            login();
    });

    function login(){
        var email = \$(\"#email\").val();
        var password = \$(\"#password\").val();

        if(geeAuthDone != 1)
        {
            alert('请拖动验证滑块完成验证!');
            return;
        }

        if(email != '' && password != '') {
            password = md5(password);
            \$.iAjax('/login/doo','email='+email+'&password='+password,function(data){
                        \$.redirect('/index');
            },'POST');
        }
    }

    //geetest验证
    window.gt_custom_ajax = function(result, id, message) {
        if(result) {
            var inputs = \$('#authcode').find('input');
            \$.ajax({
                type:'POST',
                url:'/login/authCode',
                data:\"geetest_challenge=\"+inputs.eq(0).val()+\"&geetest_validate=\"+inputs.eq(1).val()+\"&geetest_seccode=\"+inputs.eq(2).val(),
                success:function(response){
                    if(response != 'Yes!')
                        alert('验证码错误');
                    else{
                        geeAuthDone = 1;
                    }
                }
            });
        }
    }
</script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "login.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 17,  48 => 16,  44 => 15,  40 => 14,  36 => 13,  32 => 12,  19 => 1,);
    }
}
