<?php

/* gift.html */
class __TwigTemplate_b04c0803948b2d7afdb65cec78783f271a987a16d72667ae947160702dc1ece0 extends Twig_Template
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
        echo "<div class=\"am-cf am-padding\">
    <div class=\"am-fl am-cf\"><strong class=\"am-text-primary am-text-lg\">礼包</strong> / <small>设置</small></div>
</div>

<div class=\"am-cf am-padding\">
    <code>格式说明:符号均为英文</code>
</div>


<form class=\"am-form-inline\" id=\"Form1\">
    <input type=\"hidden\" id=\"giftID1\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "id", array()), "html", null, true);
        echo "\"/>
    <fieldset>
        <legend>新手礼包</legend>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">金币</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "c", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"c\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">钻石</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "d", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"d\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">门票</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "t", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"t\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">奖券</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "cp", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"cp\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">鲜花</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "f", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"f\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">鸡蛋</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "e", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"e\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">喇叭</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "h", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"h\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">包房卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "r", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"r\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">赢牌金币加倍卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "cwd", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"cwd\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">输牌金币减半卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "clh", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"clh\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">用户经验加倍卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "ced", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"ced\" placeholder=\"输入数量\"/>
            </div>
        </div>
    </fieldset>
    <div class=\"am-g am-margin-top  am-margin-bottom\">
        <button type=\"submit\" class=\"submit am-btn am-btn-primary am-btn-xs\" style=\"margin-left:200px;\" >提交保存</button>
    </div>
</form>

    <form class=\"am-form-inline\" id=\"Form2\">
        <input type=\"hidden\" id=\"giftID2\" value=\"";
        // line 87
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "id", array()), "html", null, true);
        echo "\"/>
    <fieldset>
        <legend>普通礼包</legend>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">金币</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "c", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"c\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">钻石</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 99
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "d", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"d\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">门票</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 105
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "t", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"t\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">奖券</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 111
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "cp", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"cp\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">鲜花</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 117
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "f", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"f\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">鸡蛋</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 123
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "e", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"e\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">喇叭</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 129
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "h", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"h\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">包房卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 135
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "r", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"r\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">赢牌金币加倍卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 141
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "cwd", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"cwd\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">输牌金币减半卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 147
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "clh", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"clh\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">用户经验加倍卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 153
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 2, array(), "array"), "items", array()), "ced", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"ced\" placeholder=\"输入数量\"/>
            </div>
        </div>
    </fieldset>
        <div class=\"am-g am-margin-top  am-margin-bottom\">
            <button type=\"submit\" class=\"submit am-btn am-btn-primary am-btn-xs\" style=\"margin-left:200px;\">提交保存</button>
        </div>
</form>

<form class=\"am-form-inline\" id=\"Form3\">
    <input type=\"hidden\" id=\"giftID3\" value=\"";
        // line 163
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "id", array()), "html", null, true);
        echo "\"/>
    <fieldset>
        <legend>累计邀请礼包</legend>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">金币</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 169
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "items", array()), "c", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"c\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">钻石</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 175
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "items", array()), "d", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"d\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">门票</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 181
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "items", array()), "t", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"t\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">奖券</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 187
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 1, array(), "array"), "items", array()), "cp", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"cp\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">鲜花</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 193
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "items", array()), "f", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"f\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">鸡蛋</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 199
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "items", array()), "e", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"e\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">喇叭</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 205
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "items", array()), "h", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"h\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">包房卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 211
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "items", array()), "r", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"r\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">赢牌金币加倍卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 217
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "items", array()), "cwd", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"cwd\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">输牌金币减半卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 223
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "items", array()), "clh", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"clh\" placeholder=\"输入数量\"/>
            </div>
        </div>
        <div class=\"am-g am-margin-top\">
            <div class=\"am-u-sm-2 am-text-right\"><label class=\"am-form-label fix-height\">用户经验加倍卡</label></div>
            <div class=\"am-u-sm-10 am-form-group\">
                <input type=\"text\" value=\"";
        // line 229
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gifts"]) ? $context["gifts"] : null), 3, array(), "array"), "items", array()), "ced", array()), "html", null, true);
        echo "\" class=\"am-form-field span3 am-margin-right-sm\" name=\"ced\" placeholder=\"输入数量\"/>
            </div>
        </div>
    </fieldset>
    <div class=\"am-g am-margin-top  am-margin-bottom\">
        <button type=\"submit\" class=\"submit am-btn am-btn-primary am-btn-xs\" style=\"margin-left:200px;\">提交保存</button>
    </div>
</form>

<script src=\"";
        // line 238
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/jquery.validate.min.js\"></script>
<script src=\"";
        // line 239
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/standalone/gift.js\"></script>";
    }

    public function getTemplateName()
    {
        return "gift.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  370 => 239,  366 => 238,  354 => 229,  345 => 223,  336 => 217,  327 => 211,  318 => 205,  309 => 199,  300 => 193,  291 => 187,  282 => 181,  273 => 175,  264 => 169,  255 => 163,  242 => 153,  233 => 147,  224 => 141,  215 => 135,  206 => 129,  197 => 123,  188 => 117,  179 => 111,  170 => 105,  161 => 99,  152 => 93,  143 => 87,  130 => 77,  121 => 71,  112 => 65,  103 => 59,  94 => 53,  85 => 47,  76 => 41,  67 => 35,  58 => 29,  49 => 23,  40 => 17,  31 => 11,  19 => 1,);
    }
}
