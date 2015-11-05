<?php

/* login.html */
class __TwigTemplate_93e72571b26be02a29777885d4b1e2ccf0f8cfb30e619261b0afe37145760c0d extends Twig_Template
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
        echo "
<title>网站管理员登陆</title>
<style type=\"text/css\">
    <!--
    body {
        margin-left: 0px;
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        background-color: #1D3647;
    }
    -->
</style>
<script src=\"/js/jquery-1.10.1.min.js\"></script>
<script src=\"/js/md5.min.js\"></script>
<script language=\"JavaScript\">

   var  geeAuthDone = 0;

    function login(){
            var account = \$(\"#account\").val().replace(/\\s+/g,'');
            var password = \$(\"#password\").val().replace(/\\s+/g,'');
            if(account == '' || password == ''){
                alert('请输入帐号或密码!');return;
            }

            if(!geeAuthDone)
            {
                alert('请拖动完成验证!');
                return;
            }

            \$.post('/login/in','account='+account+'&password='+md5(password),function(data){
                        var response = eval('('+data+')');
                        if(response.errCode == 0)
                                window.location.href = '/index';
                        else if(response.errCode == 1000){
                                alert('密码错误');
                        }else if(response.errCode == 1002){
                                alert('用户不存在');
                        }else if(response.errCode == 1005){
                                alert('验证码错误');
                        }
            });
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


<link href=\"/images/skin.css\" rel=\"stylesheet\" type=\"text/css\">
<body>
<table width=\"100%\" height=\"166\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
        <td height=\"42\" valign=\"top\"><table width=\"100%\" height=\"42\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"login_top_bg\">
            <tr>
                <td width=\"1%\" height=\"21\">&nbsp;</td>
                <td height=\"42\">&nbsp;</td>
                <td width=\"17%\">&nbsp;</td>
            </tr>
        </table></td>
    </tr>
    <tr>
        <td valign=\"top\"><table width=\"100%\" height=\"532\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"login_bg\">
            <tr>
                <td width=\"49%\" align=\"right\"><table width=\"91%\" height=\"532\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"login_bg2\">
                    <tr>
                        <td height=\"138\" valign=\"top\"><table width=\"89%\" height=\"427\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                                <td height=\"149\">&nbsp;</td>
                            </tr>
                            <tr>
                                <td height=\"80\" align=\"right\" valign=\"top\"><img src=\"/images/logo.png\" width=\"279\" height=\"68\"></td>
                            </tr>
                            <tr>
                                <td height=\"198\" align=\"right\" valign=\"top\"><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                                    <tr>
                                        <td width=\"35%\">&nbsp;</td>
                                        <td height=\"25\" colspan=\"2\" class=\"left_txt\"><p>1- 地区商家信息网门户站建立的首选方案...</p></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td height=\"25\" colspan=\"2\" class=\"left_txt\"><p>2- 一站通式的整合方式，方便用户使用...</p></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td height=\"25\" colspan=\"2\" class=\"left_txt\"><p>3- 强大的后台系统，管理内容易如反掌...</p></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td width=\"30%\" height=\"40\"><img src=\"/images/icon-demo.gif\" width=\"16\" height=\"16\"><a href=\"http://www.mycodes.net\" target=\"_blank\" class=\"left_txt3\"> 使用说明</a> </td>
                                        <td width=\"35%\"><img src=\"/images/icon-login-seaver.gif\" width=\"16\" height=\"16\"><a href=\"http://www.mycodes.net\" class=\"left_txt3\"> 在线客服</a></td>
                                    </tr>
                                </table></td>
                            </tr>
                        </table></td>
                    </tr>

                </table></td>
                <td width=\"1%\" >&nbsp;</td>
                <td width=\"50%\" valign=\"bottom\"><table width=\"100%\" height=\"59\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr>
                        <td width=\"4%\">&nbsp;</td>
                        <td width=\"96%\" height=\"38\"><span class=\"login_txt_bt\">登陆信息网后台管理</span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height=\"21\"><table cellSpacing=\"0\" cellPadding=\"0\" width=\"100%\" border=\"0\" id=\"table211\" height=\"328\">
                            <tr>
                                <td height=\"164\" colspan=\"2\" align=\"middle\"><form id=\"myform\" action=\"/login/in\" method=\"post\">
                                    <table cellSpacing=\"0\" cellPadding=\"0\" width=\"100%\" border=\"0\" height=\"143\" id=\"table212\">
                                        <tr>
                                            <td width=\"13%\" height=\"38\" class=\"top_hui_text\"><span class=\"login_txt\">管理员：&nbsp;&nbsp; </span></td>
                                            <td height=\"38\" colspan=\"2\" class=\"top_hui_text\"><input name=\"account\" id=\"account\" class=\"editbox4\" value=\"\" size=\"20\">                            </td>
                                        </tr>
                                        <tr>
                                            <td width=\"13%\" height=\"35\" class=\"top_hui_text\"><span class=\"login_txt\"> 密 码： &nbsp;&nbsp; </span></td>
                                            <td height=\"35\" colspan=\"2\" class=\"top_hui_text\"><input class=\"editbox4\" type=\"password\" size=\"20\" id=\"password\" name=\"password\">
                                                <img src=\"/images/luck.gif\" width=\"19\" height=\"18\"> </td>
                                        </tr>
                                        <tr>
                                            <td width=\"13%\" height=\"35\" ><span class=\"login_txt\">验证码：</span></td>
                                            <td height=\"35\" colspan=\"2\" class=\"top_hui_text\" id=\"authcode\">
                                                <script async  type=\"text/javascript\" src=\"http://api.geetest.com/get.php?gt=ea7205c9dd731fca3e0a6c4985c1560a&mobile=0\"></script>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height=\"35\" >&nbsp;</td>
                                            <td width=\"20%\" height=\"35\" ><input name=\"Submit\" type=\"button\" class=\"button\"  onclick=\"login()\"  value=\"登 陆\"> </td>
                                            <td width=\"67%\" class=\"top_hui_text\"><input name=\"cs\" type=\"button\" class=\"button\" id=\"cs\" value=\"取 消\" onClick=\"showConfirmMsg1()\"></td>
                                        </tr>
                                    </table>
                                    <br>
                                </form></td>
                            </tr>
                            <tr>
                                <td width=\"433\" height=\"164\" align=\"right\" valign=\"bottom\"><img src=\"/images/login-wel.gif\" width=\"242\" height=\"138\"></td>
                                <td width=\"57\" align=\"right\" valign=\"bottom\">&nbsp;</td>
                            </tr>
                        </table></td>
                    </tr>
                </table>
                </td>
            </tr>
        </table></td>
    </tr>
    <tr>
        <td height=\"20\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"login-buttom-bg\">
            <tr>
                <td align=\"center\"><span class=\"login-buttom-txt\">Copyright &copy; 2009-2010 www.mycodes.net</span></td>
            </tr>
        </table></td>
    </tr>
</table>
";
    }

    public function getTemplateName()
    {
        return "login.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}