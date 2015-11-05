<?php

/* game_server.html */
class __TwigTemplate_7180931c21178150540df191bffc19cb2fd9df444e9ad7bc0ac1b9aa514b6b14 extends Twig_Template
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
                <form action=\"/system/save_server\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\">
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

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">初级场金币数准入</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_MinCoinsJunior\" value=\"";
        // line 146
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_MinCoinsJunior", array()), "html", null, true);
        echo "\" />
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">中级场最小金币准入</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_MinCoinsMedium\" value=\"";
        // line 153
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_MinCoinsMedium", array()), "html", null, true);
        echo "\" />
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">赢牌送电话卡</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                          <select name=\"RTC_Send_TelCard_OnOff\" class=\"span1\">
                              ";
        // line 161
        if (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Send_TelCard_OnOff", array()) == 1)) {
            // line 162
            echo "                              <option value=\"1\" selected=\"selected\">是</option>
                              <option value=\"0\">否</option>
                              ";
        } else {
            // line 165
            echo "                              <option value=\"1\" >是</option>
                              <option value=\"0\" selected=\"selected\">否</option>
                              ";
        }
        // line 168
        echo "                          </select>
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
                <form action=\"/system/save_server\" id=\"form_sample_game\" class=\"form-horizontal\" method=\"post\">
                    <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 199
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
        // line 214
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Begin_Min", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Begin_Min", array()), 3)) : (3)), "html", null, true);
        echo "\"/>
                            <br/><code>默认3</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">最大胜利局数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Junior_Prize_Begin_MAX\" value=\"";
        // line 222
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Begin_MAX", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Begin_MAX", array()), 17)) : (17)), "html", null, true);
        echo "\"/>
                            <br/><code>默认17</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">局数间隔</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Junior_Prize_Begin_INC\" value=\"";
        // line 230
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Begin_INC", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Begin_INC", array()), 1)) : (1)), "html", null, true);
        echo "\"/>
                            <br/><code>默认1</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">获得奖励类型</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <select name=\"RTC_Junior_Prize_Type\">
                                ";
        // line 239
        if (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Type", array()) == 52)) {
            // line 240
            echo "                                <option value=\"52\" selected=\"selected\">一块钱电话充值卡</option>
                                ";
        } else {
            // line 242
            echo "                                <option value=\"52\">一块钱电话充值卡</option>
                                ";
        }
        // line 244
        echo "
                                ";
        // line 245
        if (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_Prize_Type", array()) == 53)) {
            // line 246
            echo "                                <option value=\"53\" selected=\"selected\">两块钱电话充值卡</option>
                                ";
        } else {
            // line 248
            echo "                                <option value=\"53\">两块钱电话充值卡</option>
                                ";
        }
        // line 250
        echo "                            </select>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">获得奖励数量</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Junior_Prize_Num\" value=\"";
        // line 257
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
        // line 266
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Begin_Min", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Begin_Min", array()), 15)) : (15)), "html", null, true);
        echo "\"/>
                            <br/><code>默认15</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">最大胜利局数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Medium_Prize_Begin_MAX\" value=\"";
        // line 274
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Begin_MAX", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Begin_MAX", array()), 15)) : (15)), "html", null, true);
        echo "\"/>
                            <br/><code>默认15</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">局数间隔</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Medium_Prize_Begin_INC\" value=\"";
        // line 282
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Begin_INC", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Begin_INC", array()), 1)) : (1)), "html", null, true);
        echo "\"/>
                            <br/><code>默认1</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">获得奖励类型</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <select name=\"RTC_Medium_Prize_Type\">
                                ";
        // line 291
        if (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Type", array()) == 52)) {
            // line 292
            echo "                                <option value=\"52\" selected=\"selected\">一块钱电话充值卡</option>
                                ";
        } else {
            // line 294
            echo "                                <option value=\"52\">一块钱电话充值卡</option>
                                ";
        }
        // line 296
        echo "
                                ";
        // line 297
        if (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Type", array()) == 53)) {
            // line 298
            echo "                                <option value=\"53\" selected=\"selected\">两块钱电话充值卡</option>
                                ";
        } else {
            // line 300
            echo "                                <option value=\"53\">两块钱电话充值卡</option>
                                ";
        }
        // line 302
        echo "                            </select>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">获得奖励数量</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Medium_Prize_Num\" value=\"";
        // line 309
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Num", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_Prize_Num", array()), 1)) : (1)), "html", null, true);
        echo "\"/>
                            <br/><code>默认1</code>
                        </div>
                    </div>

                    <br/><br/> <span class=\"label label-important\">税点</span><br/><br/>
               <!--     <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">红中发财杠</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"\" value=\"\"/>
                            <br/><code>数量>=0</code>
                        </div>
                    </div>-->

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">赖子皮杠-初级</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Junior_TaxRate\" value=\"";
        // line 326
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Junior_TaxRate", array()), "html", null, true);
        echo "\"/>
                            <br/><code>数量>=0</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">赖子皮杠-中级</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_Medium_TaxRate\" value=\"";
        // line 334
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_Medium_TaxRate", array()), "html", null, true);
        echo "\"/>
                            <br/><code>数量>=0</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DiaTable_TaxRate\" value=\"";
        // line 342
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_TaxRate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <br/><br/> <span class=\"label label-important\">钻石场设置</span><br/><br/>
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场准入数量</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DidTable_Enter_Diamonds\" value=\"";
        // line 350
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DidTable_Enter_Diamonds", array()), 800)) : (800)), "html", null, true);
        echo "\"/>
                            <br/><code>数量>=0</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场起胡番数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DiaTable_CanWin_Double\" value=\"";
        // line 358
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_CanWin_Double", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_CanWin_Double", array()), 5)) : (5)), "html", null, true);
        echo "\"/>
                            <br/><code>番数范围0-10</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场倍数</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DiaTable_Rate\" value=\"";
        // line 366
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_Rate", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_Rate", array()), 1)) : (1)), "html", null, true);
        echo "\"/>
                            <br/><code>倍数1-88</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场底</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DiaTable_BasePoint\" value=\"";
        // line 374
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_BasePoint", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_BasePoint", array()), 1)) : (1)), "html", null, true);
        echo "\"/>
                            <br/><code>1-100</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场封顶</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"RTC_DiaTable_WinTop\" value=\"";
        // line 382
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_WinTop", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "RTC_DiaTable_WinTop", array()), 400)) : (400)), "html", null, true);
        echo "\"/>
                            <br/><code>大于0</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场作弊开始阀值</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"cheat_value_begin_dia\" value=\"";
        // line 390
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "cheat_value_begin_dia", array()), "html", null, true);
        echo "\"/>
                            <br/><code>-99999999～99999999</code>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">钻石场作弊停止阀值</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input class=\"span3 m-wrap\" name=\"cheat_value_end_dia\" value=\"";
        // line 398
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["runtimeConfig"]) ? $context["runtimeConfig"] : null), "cheat_value_end_dia", array()), "html", null, true);
        echo "\"/>
                            <br/><code>-99999999～99999999</code>
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

    // line 416
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 417
        echo "<script type=\"text/javascript\" src=\"/media/js/jquery.validate.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/additional-methods.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/chosen.jquery.min.js\"></script>
";
    }

    // line 423
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 424
        echo "<script src=\"/media/js/private/game_server.js\"></script>
<script>
    var success = ";
        // line 426
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
        return array (  611 => 426,  607 => 424,  604 => 423,  596 => 417,  593 => 416,  572 => 398,  561 => 390,  550 => 382,  539 => 374,  528 => 366,  517 => 358,  506 => 350,  495 => 342,  484 => 334,  473 => 326,  453 => 309,  444 => 302,  440 => 300,  436 => 298,  434 => 297,  431 => 296,  427 => 294,  423 => 292,  421 => 291,  409 => 282,  398 => 274,  387 => 266,  375 => 257,  366 => 250,  362 => 248,  358 => 246,  356 => 245,  353 => 244,  349 => 242,  345 => 240,  343 => 239,  331 => 230,  320 => 222,  309 => 214,  291 => 199,  258 => 168,  253 => 165,  248 => 162,  246 => 161,  235 => 153,  225 => 146,  215 => 139,  205 => 132,  195 => 125,  185 => 118,  174 => 110,  163 => 102,  152 => 94,  141 => 86,  131 => 79,  121 => 72,  111 => 65,  101 => 58,  84 => 44,  53 => 15,  50 => 14,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
