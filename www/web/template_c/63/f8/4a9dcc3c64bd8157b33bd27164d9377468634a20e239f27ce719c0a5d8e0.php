<?php

/* service.html */
class __TwigTemplate_63f84a9dcc3c64bd8157b33bd27164d9377468634a20e239f27ce719c0a5d8e0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html");

        $this->blocks = array(
            'seo' => array($this, 'block_seo'),
            'head' => array($this, 'block_head'),
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
    public function block_seo($context, array $blocks = array())
    {
        // line 4
        echo "<title>武汉麻将-客户服务</title>
<meta name=\"keywords\" content=\"武汉麻将-客户服务\" />
<meta name=\"description\" content=\"武汉麻将-客户服务\" />
";
    }

    // line 9
    public function block_head($context, array $blocks = array())
    {
        // line 10
        echo "<script>
    var token = '";
        // line 11
        echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : null), "html", null, true);
        echo "',pay_failed=";
        echo twig_escape_filter($this->env, (isset($context["pay_failed"]) ? $context["pay_failed"] : null), "html", null, true);
        echo ",is_login=";
        echo twig_escape_filter($this->env, (isset($context["is_login"]) ? $context["is_login"] : null), "html", null, true);
        echo ";
</script>
<link href=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/img/secondary_Style.css\" rel=\"stylesheet\" type=\"text/css\" />
<script type=\"text/javascript\" src=\"";
        // line 14
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/jquery.ext.js\" ></script>
<script type=\"text/javascript\" src=\"";
        // line 15
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/My97DatePicker/WdatePicker.js\" ></script>
<script type=\"text/javascript\" src=\"";
        // line 16
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/service.js\" ></script>
";
    }

    // line 19
    public function block_content($context, array $blocks = array())
    {
        // line 20
        echo "<!--pop-up box-->
<div class=\"tck\" style=\"display:none\">
    <div class=\"tck_top\"><h3>创建包房</h3></div>
    <div class=\"tck_mid\">1111</div>
    <div class=\"tck_btm\"></div>
</div>
<div class=\"tck\" style=\"display:none\">
    <div class=\"tck_top\"><h3>进入包房</h3></div>
    <div class=\"tck_mid\">1111</div>
    <div class=\"tck_btm\"></div>
</div>
<!--content-->
<div id=\"m_content_2\">
    <h3><a href=\"/\"><em></em></a><b class=\"tgxx\">客户服务</b></h3>
    <div class=\"khfw_box\">
        <div class=\"question_box\">
            <h4>请选择您要处理的问题</h4>
            <select name=\"\" class=\"select\" onchange=\"sel_service(this)\">
                <option  selected=\"selected\">--------------------------------</option>
                ";
        // line 39
        if (((isset($context["is_login"]) ? $context["is_login"] : null) == 1)) {
            // line 40
            echo "                <option value=\"q_2\">查询充值记录</option>
                <option value=\"q_3\">我要反馈一个问题</option>
                <option value=\"q_4\">有人作弊，我要举报他</option>
                ";
        }
        // line 44
        echo "                <option value=\"q_1\">我忘记了账号或密码</option>
                <option value=\"q_5\">帐号封停申诉</option>
            </select>

            <div class=\"q_1\" rel=\"box\" style=\"display:none\">
                <form action=\"/user/password/2\" method=\"post\" id=\"password_form\">
                <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 50
        echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : null), "html", null, true);
        echo "\" />
                <table width=\"500\" border=\"0\" cellspacing=\"5\" cellpadding=\"0\">
                    <tr>
                        <td width=\"65\" align=\"right\" class=\"bold\" height=\"40\">* 账号</td>
                        <td width=\"405\"><input type=\"text\" name=\"login_name\" id=\"login_name\" class=\"input\" /><label class=\"error\" style=\"display:none\">账号不存在</label></td>
                    </tr>
                    <tr>
                        <td class=\"bold\" align=\"right\" height=\"40\">* 注册邮箱</td>
                        <td><input type=\"text\" name=\"email\" id=\"email\" class=\"input\" /><label class=\"error\" style=\"display:none\">邮箱格式错误</label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type=\"button\" id=\"\" onclick=\"q_1_checkform()\" class=\"submit_3\" value=\"下一步\" /></td>
                    </tr>
                </table>
                </form>
            </div>

            <div class=\"q_2\" rel=\"box\" style=\"display:none\">
                <div class=\"time_box\">
                    <input id=\"start_time\" type=\"text\" class=\"input_2\"  onfocus=\"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})\"/>
                    &nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;
                    <input id=\"end_time\" type=\"text\" class=\"input_2\" onfocus=\"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})\"/>
                    <input type=\"button\" value=\"查询\" name=\"\" id=\"\" onclick=\"recharge_search()\" class=\"input_3\" />
                </div>
                <table width=\"370\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" id=\"q_2_table\">
                </table>
                <div class=\"page\" id=\"recharge_pagiation\">
                </div>
                <!--一页最多显示10条，超过10条翻页-->
            </div>

            <div class=\"q_3\" style=\"display:none\" rel=\"box\" >
                <form action=\"/service/feedback\" method=\"post\" id=\"q_3_form\">
                    <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 84
        echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : null), "html", null, true);
        echo "\" />
                <p>您要反馈的问题类型是：
                <div class=\"qs_box\">
                    <input name=\"feedtype\" type=\"radio\" checked=\"checked\"  value=\"0\"/><label for=\"q1\">游戏bug</label>
                    <input name=\"feedtype\" type=\"radio\" value=\"1\" /><label for=\"q2\">商城兑换错误</label>
                    <input name=\"feedtype\" type=\"radio\" value=\"2\" /><label for=\"q3\">充值失败</label>
                    <input name=\"feedtype\" type=\"radio\" value=\"3\" /><label for=\"q4\">游戏记录错误</label>
                    <input name=\"feedtype\" type=\"radio\" value=\"4\" /><label for=\"q5\">处罚申诉</label>
                    <input name=\"feedtype\" type=\"radio\" value=\"5\" /><label for=\"q6\">其他问题</label>
                </div>
                <p>请详细描述您遇到的问题(限500字) *：</p>
                <p><textarea rows=\"5\" name=\"content\" class=\"textarea\" id=\"q_3_content\" ></textarea></p>
                    <p style=\"margin-top:10px\"><input type=\"button\" id=\"\" class=\"submit_3\" value=\"提交\" onclick=\"q_3_checkform()\"/></p>
                </form>
            </div>

            <div class=\"q_4\" style=\"display:none\" rel=\"box\" >
                <form action=\"/service/tipoff\" method=\"post\" id=\"q_4_form\" enctype=\"multipart/form-data\">
                    <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 102
        echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : null), "html", null, true);
        echo "\" />
                <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                    <tr>
                        <td width=\"100\" align=\"right\">被举报人名称 *</td>
                        <td width=\"400\"><input type=\"text\" name=\"tipoff_name\" id=\"tipoff_name\" class=\"input_4\" /></td>
                    </tr>
                    <tr>
                        <td align=\"right\">发现时间 *</td>
                        <td><input type=\"text\" name=\"tipoff_time\" id=\"tipoff_time\" class=\"input_4\"  onfocus=\"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})\"/></td>
                    </tr>
                    <tr>
                        <td align=\"right\">详细描述 *</td>
                        <td><textarea name=\"tipoff_content\" cols=\"\" rows=\"5\" class=\"textarea\" id=\"tipoff_content\" style=\"margin:0\"></textarea></td>
                    </tr>
                    <tr><td></td><td>限500字</td></tr>
                    <tr>
                        <td align=\"right\" valign=\"top\">上传截图 *</td>
                        <td><input type=\"file\" class=\"upload\" accept=\"image/jpg, image/png\"  name=\"file\" id=\"q_4_file\"/><label style=\"clear:both; padding-left:0; margin-left:2px; width:200px\">请上传jpg,png图片，最大2M</label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type=\"button\" id=\"\" class=\"submit_3\" value=\"提交\" onclick=\"q_4_checkform()\" /></td>
                    </tr>
                </table>
                </form>
            </div>

            <div class=\"q_5\" style=\"display:none\" rel=\"box\" >
                <form action=\"/service/usersuspend\" method=\"post\" id=\"q_5_form\">
                <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 131
        echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : null), "html", null, true);
        echo "\" />
                <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                    <tr>
                        <td width=\"75\" align=\"right\">用户名 *</td>
                        <td width=\"434\"><input type=\"text\" name=\"suspend_name\" id=\"suspend_name\" class=\"input_4\" /></td>
                    </tr>
                    <tr>
                        <td align=\"right\">封停时间 *</td>
                        <td><input type=\"text\" name=\"suspend_time\" id=\"suspend_time\" class=\"input_4\" onfocus=\"WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})\"/></td>
                    </tr>
                    <tr>
                        <td align=\"right\">手机号 *</td>
                        <td><input type=\"text\" name=\"suspend_mobile\" id=\"suspend_mobile\" class=\"input_4\" /></td>
                    </tr>
                    <tr>
                        <td align=\"right\">详细描述 *</td>
                        <td><textarea name=\"suspend_content\" cols=\"\" id=\"suspend_content\" rows=\"5\" class=\"textarea\"></textarea></td>
                    </tr>
                    <tr><td></td><td>限500字</td></tr>
                    <tr>
                        <td></td>
                        <td><input type=\"button\" id=\"\" class=\"submit_3\" value=\"提交\"  onclick=\"q_5_checkform()\"/></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class=\"faq_box\">
            <h4>FAQ</h4>
            <h5>问：为什么登录时提示账号错误？</h5>
            <p>用户名：注册时填写的，是登录游戏时需要输入的。<br />
                昵称：游戏里的名字，官网注册后，自己起的名字。<br />
                登录时，需要输入的是用户名，而不是昵称。<br />
                如果实在想不起用户名或者密码，可以申请账号找回，我们会把账号及密码发送到您绑定的邮箱中。</p>
            <h5>问：金币、金钻、门票、奖券都是干什么用的？怎么获得？</h5>
            <p>金币：金币可以通过在游戏中胜利时赢取，或者用金钻、奖券来兑换。<br />
                金钻：游戏中的任务奖励，此外，通过充值也可以快速获取大量金钻。<br />
                门票：通过游戏中的日常比赛赢取，是参加高级比赛的入场券。<br />
                奖券：游戏中比赛的奖励，可以用奖券来兑换金币、充值卡甚至是iPhone5S手机！</p>
            <h5>问：VIP有什么用？怎么变成VIP？</h5>
            <p>VIP在游戏中是一种身份的象征，而且VIP在开包房时也会享受一定的优惠。<br />
                VIP可以通过在游戏中充值或者帮助我们开展游戏活动获得。</p>
            <h5>问：注册账号收费吗？注册过程是不是很麻烦？</h5>
            <p>注册账号是完全免费的，而且今后也不会收取任何费用。<br />
                注册账号的过程非常简单：<br />
                1． 在注册栏输入你的用户名<br />
                2． 设置你的游戏密码和昵称<br />
                3． 选择你所在的地区<br />
                注册就这样完成了，整个过程不过30秒左右。</p>
            <h5>问：试玩账号和注册账号有什么区别？</h5>
            <p>\"游客试玩\"是我们为第一次接触我们游戏，暂时不想注册账号的玩家提供的体验机会。<br />
                进入游戏后，在登录界面可以点击\"游客试玩\"选项以游客身份来体验游戏。<br />
                游客账号上有少量的金币，但这些金币不能保存，退出游戏后将自动还原为初始数，此外，有很多游戏、功能和服务只针对注册用户开放，游客账号是无法享受的。<br />
                所以建议大家，在使用游客账号体验游戏后，不妨花上几十秒的时间注册账号，以便能更好的享受游戏带给你的更多乐趣。</p>
            <h5>问：我的账号能同时在电脑和手机上用么？</h5>
            <p>同一个游戏账号在电脑和手机上都可以用，而且账号中的数据也是互通的。<br />
                但是同一账号无法同时在两个地方登陆。</p>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "service.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  203 => 131,  171 => 102,  150 => 84,  113 => 50,  105 => 44,  99 => 40,  97 => 39,  76 => 20,  73 => 19,  67 => 16,  63 => 15,  59 => 14,  55 => 13,  46 => 11,  43 => 10,  40 => 9,  33 => 4,  30 => 3,);
    }
}
