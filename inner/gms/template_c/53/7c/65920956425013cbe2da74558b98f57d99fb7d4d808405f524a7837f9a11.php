<?php

/* game_server.html */
class __TwigTemplate_537c65920956425013cbe2da74558b98f57d99fb7d4d808405f524a7837f9a11 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'css' => array($this, 'block_css'),
            'content' => array($this, 'block_content'),
            'javascript_plugins' => array($this, 'block_javascript_plugins'),
            'javascript_custom' => array($this, 'block_javascript_custom'),
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
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "游戏服务器设定
";
    }

    // line 7
    public function block_css($context, array $blocks = array())
    {
        // line 8
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/select2_metro.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/chosen.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/addtional.css\" />
";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "<div class=\"row-fluid\">
    <div class=\"span12\">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class=\"page-title\">
            游戏服务器设定
            <small></small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>

<div class=\"row-fluid\">
    <div class=\"span12\">
        <!-- BEGIN VALIDATION STATES-->
        <div class=\"portlet box\">

            <div class=\"portlet-title\">
                <div class=\"caption\"><i class=\"icon-reorder\">基本设定</i></div>
                <div class=\"tools\">
                    <a href=\"javascript:;\" class=\"collapse\"></a>
                    <a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"></a>
                    <a href=\"javascript:;\" class=\"reload\"></a>
                    <a href=\"javascript:;\" class=\"remove\"></a>
                </div>
            </div>

            <div class=\"portlet-body form\">
                <!-- BEGIN FORM-->
                <form action=\"/system/save_server1\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\">
                    <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 44
        echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : null), "html", null, true);
        echo "\" />
                    <div class=\"alert alert-error hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        您提交的信息有错误请更正后再保存
                    </div>

                    <div class=\"alert alert-success hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        保存成功!
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">新手引导得到的金币</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input type=\"text\" name=\"RTC_tutorialBonus\" data-required=\"1\" class=\"span3 m-wrap\" value=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_tutorialBonus", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">每次给好友的金币</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_coinsGivenPerTime\" value=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_coinsGivenPerTime", array()), "html", null, true);
        echo "\" />
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">基本低保金币</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_BasicLivingCoins\" value=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_BasicLivingCoins", array()), "html", null, true);
        echo "\" />
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">每日基本低保次数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_BasicLivingCount\" value=\"";
        // line 79
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_BasicLivingCount", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">包房最小时间[分钟]</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_MinRoomDur\" value=\"";
        // line 86
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_MinRoomDur", array()), "html", null, true);
        echo "\" />
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">包房最大时间[分钟]</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_MaxRoomDur\" value=\"";
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_MaxRoomDur", array()), "html", null, true);
        echo "\" />
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">积分赛默认排名个数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_pointMatchRanksTotal\" value=\"";
        // line 102
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_pointMatchRanksTotal", array()), "html", null, true);
        echo "\" />
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">积分赛积分封顶值</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_PointTOP\" value=\"";
        // line 110
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_PointTOP", array()), "html", null, true);
        echo "\" />
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">房间最大容纳的人数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_MaxRoomUsers\" value=\"";
        // line 118
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_MaxRoomUsers", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">房间最大的剩余时间</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_MaxMinutesLeft\" value=\"";
        // line 125
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_MaxMinutesLeft", array()), "html", null, true);
        echo "\" />
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">房间报警时间</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_MinutesAlert\" value=\"";
        // line 132
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_MinutesAlert", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">包房最小续时</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_MinAddMinutes\" value=\"";
        // line 139
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_MinAddMinutes", array()), "html", null, true);
        echo "\" />
                        </div>
                    </div>

                    <div class=\"form-actions\">
                        <button type=\"submit\" class=\"btn red\">保存</button>
                        <button type=\"reset\" class=\"btn\">重置</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END VALIDATION STATES-->



        <div class=\"portlet box\">

            <div class=\"portlet-title\">
                <div class=\"caption\"><i class=\"icon-reorder\">游戏场设定</i></div>
                <div class=\"tools\">
                    <a href=\"javascript:;\" class=\"collapse\"></a>
                    <a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"></a>
                    <a href=\"javascript:;\" class=\"reload\"></a>
                    <a href=\"javascript:;\" class=\"remove\"></a>
                </div>
            </div>

            <div class=\"portlet-body form\">
                <!-- BEGIN FORM-->
                <form action=\"/system/save_server1\" id=\"form_sample_game\" class=\"form-horizontal\" method=\"post\">
                    <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 170
        echo twig_escape_filter($this->env, (isset($context["token"]) ? $context["token"] : null), "html", null, true);
        echo "\" />
                    <div class=\"alert alert-error hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        您提交的信息有错误请更正后再保存
                    </div>

                    <div class=\"alert alert-success hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        保存成功!
                    </div>

                    <br/><br/><span class=\"label label-important\">奖励设置-初级</span><br/><br/>
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">最小胜利局数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Junior_Prize_Begin_Min\" value=\"";
        // line 185
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Begin_Min", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Begin_Min", array()), 3)) : (3)), "html", null, true);
        echo "\"/>
                            <br/><code>默认3</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">最大胜利局数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Junior_Prize_Begin_MAX\" value=\"";
        // line 193
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Begin_MAX", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Begin_MAX", array()), 17)) : (17)), "html", null, true);
        echo "\"/>
                            <br/><code>默认17</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">局数间隔</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DidTable_Enter_Diamonds\" value=\"";
        // line 201
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array()), 800)) : (800)), "html", null, true);
        echo "\"/>
                            <br/><code>数量>=0</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">获得奖励类型</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <select name=\"RTC_Junior_Prize_Type\">
                                ";
        // line 210
        if (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Type", array()) == 52)) {
            // line 211
            echo "                                <option value=\"52\" selected=\"selected\">一块钱电话充值卡</option>
                                ";
        } else {
            // line 213
            echo "                                <option value=\"52\">一块钱电话充值卡</option>
                                ";
        }
        // line 215
        echo "
                                ";
        // line 216
        if (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Type", array()) == 53)) {
            // line 217
            echo "                                <option value=\"53\" selected=\"selected\">两块钱电话充值卡</option>
                                ";
        } else {
            // line 219
            echo "                                <option value=\"53\">两块钱电话充值卡</option>
                                ";
        }
        // line 221
        echo "                            </select>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">获得奖励数量</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Junior_Prize_Num\" value=\"";
        // line 228
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Num", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Num", array()), 1)) : (1)), "html", null, true);
        echo "\"/>
                            <br/><code>默认1</code>
                        </div>
                    </div>

                    <br/><br/><span class=\"label label-important\">奖励设置-中级</span><br/><br/>
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">最小胜利局数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Medium_Prize_Begin_Min\" value=\"";
        // line 237
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Begin_Min", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Begin_Min", array()), 15)) : (15)), "html", null, true);
        echo "\"/>
                            <br/><code>默认15</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">最大胜利局数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Medium_Prize_Begin_MAX\" value=\"";
        // line 245
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Begin_MAX", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Begin_MAX", array()), 15)) : (15)), "html", null, true);
        echo "\"/>
                            <br/><code>默认15</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">最大胜利局数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DidTable_Enter_Diamonds\" value=\"";
        // line 253
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array()), 800)) : (800)), "html", null, true);
        echo "\"/>
                            <br/><code>数量>=0</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">获得奖励类型</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <select name=\"RTC_Medium_Prize_Type\">
                                ";
        // line 262
        if (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Type", array()) == 52)) {
            // line 263
            echo "                                <option value=\"52\" selected=\"selected\">一块钱电话充值卡</option>
                                ";
        } else {
            // line 265
            echo "                                <option value=\"52\">一块钱电话充值卡</option>
                                ";
        }
        // line 267
        echo "
                                ";
        // line 268
        if (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Type", array()) == 53)) {
            // line 269
            echo "                                <option value=\"53\" selected=\"selected\">两块钱电话充值卡</option>
                                ";
        } else {
            // line 271
            echo "                                <option value=\"53\">两块钱电话充值卡</option>
                                ";
        }
        // line 273
        echo "                            </select>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">获得奖励数量</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Medium_Prize_Num\" value=\"";
        // line 280
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Num", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Num", array()), 1)) : (1)), "html", null, true);
        echo "\"/>
                            <br/><code>默认1</code>
                        </div>
                    </div>

                    <br/><br/> <span class=\"label label-important\">税点</span><br/><br/>
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">红中发财杠</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DidTable_Enter_Diamonds\" value=\"";
        // line 289
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array()), "html", null, true);
        echo "\"/>
                            <br/><code>数量>=0</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">赖子皮杠-初级</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DidTable_Enter_Diamonds\" value=\"";
        // line 297
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array()), "html", null, true);
        echo "\"/>
                            <br/><code>数量>=0</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">赖子皮杠-中级</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DidTable_Enter_Diamonds\" value=\"";
        // line 305
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array()), "html", null, true);
        echo "\"/>
                            <br/><code>数量>=0</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DiaTable_TaxRate\" value=\"";
        // line 313
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_TaxRate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <br/><br/> <span class=\"label label-important\">钻石场设置</span><br/><br/>
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场准入数量</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DidTable_Enter_Diamonds\" value=\"";
        // line 321
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array()), 800)) : (800)), "html", null, true);
        echo "\"/>
                            <br/><code>数量>=0</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场起胡番数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DiaTable_CanWin_Double\" value=\"";
        // line 329
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_CanWin_Double", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_CanWin_Double", array()), 5)) : (5)), "html", null, true);
        echo "\"/>
                            <br/><code>番数范围0-10</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场倍数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DiaTable_Rate\" value=\"";
        // line 337
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_Rate", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_Rate", array()), 1)) : (1)), "html", null, true);
        echo "\"/>
                            <br/><code>倍数1-88</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场底</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DiaTable_BasePoint\" value=\"";
        // line 345
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_BasePoint", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_BasePoint", array()), 1)) : (1)), "html", null, true);
        echo "\"/>
                            <br/><code>1-100</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场封顶</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DiaTable_WinTop\" value=\"";
        // line 353
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_WinTop", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_WinTop", array()), 400)) : (400)), "html", null, true);
        echo "\"/>
                            <br/><code>大于0</code>
                        </div>
                    </div>


                    <div class=\"form-actions\">
                        <button type=\"submit\" class=\"btn red\">保存</button>
                        <button type=\"reset\" class=\"btn\">重置</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>

";
    }

    // line 372
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 373
        echo "<script type=\"text/javascript\" src=\"/media/js/jquery.validate.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/additional-methods.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/chosen.jquery.min.js\"></script>
";
    }

    // line 379
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 380
        echo "<script src=\"/media/js/private/game_server.js\"></script>
<script>
    var success = ";
        // line 382
        echo twig_escape_filter($this->env, ((array_key_exists("success", $context)) ? (_twig_default_filter((isset($context["success"]) ? $context["success"] : null), "-1")) : ("-1")), "html", null, true);
        echo ";
    \$(function(){
        FormValidation.init();
        if(success == 1)
            \$('.alert-success').show();
    })
</script>
";
    }

    public function getTemplateName()
    {
        return "game_server.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  551 => 382,  547 => 380,  544 => 379,  536 => 373,  533 => 372,  511 => 353,  500 => 345,  489 => 337,  478 => 329,  467 => 321,  456 => 313,  445 => 305,  434 => 297,  423 => 289,  411 => 280,  402 => 273,  398 => 271,  394 => 269,  392 => 268,  389 => 267,  385 => 265,  381 => 263,  379 => 262,  367 => 253,  356 => 245,  345 => 237,  333 => 228,  324 => 221,  320 => 219,  316 => 217,  314 => 216,  311 => 215,  307 => 213,  303 => 211,  301 => 210,  289 => 201,  278 => 193,  267 => 185,  249 => 170,  215 => 139,  205 => 132,  195 => 125,  185 => 118,  174 => 110,  163 => 102,  152 => 94,  141 => 86,  131 => 79,  121 => 72,  111 => 65,  101 => 58,  84 => 44,  53 => 15,  50 => 14,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
