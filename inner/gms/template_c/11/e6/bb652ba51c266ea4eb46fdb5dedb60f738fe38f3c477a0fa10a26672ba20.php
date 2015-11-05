<?php

/* system_robot_cheat.html */
class __TwigTemplate_11e6bb652ba51c266ea4eb46fdb5dedb60f738fe38f3c477a0fa10a26672ba20 extends Twig_Template
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
        echo "机器人作弊设置
";
    }

    // line 7
    public function block_css($context, array $blocks = array())
    {
        // line 8
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/select2_metro.css\"/>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/chosen.css\"/>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/addtional.css\"/>
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
            机器人作弊设置
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
                <div class=\"caption\"><i class=\"icon-reorder\">设定</i></div>
                <div class=\"tools\">
                    <a href=\"javascript:;\" class=\"collapse\"></a>
                    <a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"></a>
                    <a href=\"javascript:;\" class=\"reload\"></a>
                    <a href=\"javascript:;\" class=\"remove\"></a>
                </div>
            </div>


            <div class=\"portlet-body form\">
                <!-- BEGIN FORM-->
                <form action=\"/system/saveRobotCheat\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\">
                    <div class=\"alert alert-error hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        您提交的信息有错误请更正后再保存
                    </div>

                    <div class=\"alert alert-success hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        保存成功!
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">作弊状态</b><span
                                class=\"required\"></span></label>

                        <div class=\"controls chzn-controls\">
                            <label class=\"control-label span1\">";
        // line 60
        if ($this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_state", array())) {
            // line 61
            echo "                                是
                            ";
        } else {
            // line 63
            echo "                                否
                            ";
        }
        // line 64
        echo "</label>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">初级场当前场数 </b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_lv1_tables\" data-required=\"1\" class=\"span3 m-wrap\" disabled
                                   value=\"";
        // line 74
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_lv1_tables", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">中级场当前场数</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_lv2_tables\" data-required=\"1\" class=\"span3 m-wrap\" disabled
                                   value=\"";
        // line 84
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_lv2_tables", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">高级场当前场数</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_lv3_tables\" data-required=\"1\" class=\"span3 m-wrap\" disabled
                                   value=\"";
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_lv3_tables", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">低级场作弊几率 0～100</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_lv1_rate\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 104
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_lv1_rate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">中级场作弊几率 0～100</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_lv2_rate\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 114
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_lv2_rate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">高级场作弊几率 0～100</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_lv3_rate\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 125
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_lv3_rate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">最低作弊圈数</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_step_begin\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 136
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_step_begin", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">最高作弊圈数</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_step_end\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 147
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_step_end", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">作弊开始阀值</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_value_begin\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 158
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_value_begin", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">作弊结束阀值</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_value_end\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 169
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_value_end", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">作弊几率自动增长率0~100</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_increase_rate\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 180
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_increase_rate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\" style=\"width:280px;text-align: left\"><b class=\"midnight\">碰,杠牌的时候给玩家的几率0~100</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_user_laizis_rate\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 190
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_user_laizis_rate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"  style=\"width:280px;text-align: left\"><b class=\"midnight\">不作弊情况下低级场作弊几率 0～100</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_free_lv1_rate\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 200
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_free_lv1_rate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\"  style=\"width:280px;text-align: left\"><b class=\"midnight\">不作弊情况下中级场作弊几率 0～100 </b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_free_lv2_rate\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 211
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_free_lv2_rate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"  style=\"width:280px;text-align: left\"><b class=\"midnight\">不作弊情况下高级场作弊几率 0～100 </b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"cheat_free_lv3_rate\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 221
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "cheat_free_lv3_rate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"  style=\"width:280px;text-align: left\"><b class=\"midnight\">黑名单启动值 </b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"RTC_BlackList_Begin_Value\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 231
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "RTC_BlackList_Begin_Value", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>

                    <div class=\"control-group\">
                        <label class=\"control-label\"  style=\"width:280px;text-align: left\"><b class=\"midnight\">黑名单结束值 </b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"RTC_BlackList_End_Value\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 241
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "RTC_BlackList_End_Value", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\"  style=\"width:280px;text-align: left\"><b class=\"midnight\">黑名单作用间隔 </b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"RTC_BlackList_Work_Interval\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 252
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "RTC_BlackList_Work_Interval", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\"  style=\"width:280px;text-align: left\"><b class=\"midnight\">黑名单遇到赖子的时候，给玩家的几率 1～100</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"RTC_BlackList_Laizi_Rate\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 263
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "RTC_BlackList_Laizi_Rate", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>


                    <div class=\"control-group\">
                        <label class=\"control-label\"  style=\"width:280px;text-align: left\"><b class=\"midnight\">黑名单玩家听牌的时候，遇到可以胡的牌，给玩家的几率 1～100</b><span
                                class=\"required\">*</span></label>

                        <div class=\"controls chzn-controls\">
                            <input type=\"text\" name=\"RTC_BlackList_Win_Rate\" data-required=\"1\" class=\"span3 m-wrap\"
                                   value=\"";
        // line 274
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["robotSet"]) ? $context["robotSet"] : null), "RTC_BlackList_Win_Rate", array()), "html", null, true);
        echo "\"/>
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
    </div>
</div>

";
    }

    // line 292
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 293
        echo "<script type=\"text/javascript\" src=\"/media/js/jquery.validate.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/additional-methods.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/chosen.jquery.min.js\"></script>
";
    }

    // line 299
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 300
        echo "<script src=\"/media/js/private/robot_cheat.js\"></script>
<script>
    var success = ";
        // line 302
        echo twig_escape_filter($this->env, ((array_key_exists("success", $context)) ? (_twig_default_filter((isset($context["success"]) ? $context["success"] : null), 0)) : (0)), "html", null, true);
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
        return "system_robot_cheat.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  418 => 302,  414 => 300,  411 => 299,  403 => 293,  400 => 292,  379 => 274,  365 => 263,  351 => 252,  337 => 241,  324 => 231,  311 => 221,  298 => 211,  284 => 200,  271 => 190,  258 => 180,  244 => 169,  230 => 158,  216 => 147,  202 => 136,  188 => 125,  174 => 114,  161 => 104,  148 => 94,  135 => 84,  122 => 74,  110 => 64,  106 => 63,  102 => 61,  100 => 60,  53 => 15,  50 => 14,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
