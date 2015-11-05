<?php

/* user_list.html */
class __TwigTemplate_a5e1112cdf1b4224cd82fb2f3a0b9cb8a2277534bc5b84f4cf0e0096eb47b3df extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'css' => array($this, 'block_css'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('css', $context, $blocks);
        // line 4
        echo "
<div class=\"am-cf am-padding\">
    <div class=\"am-fl am-cf\"><strong class=\"am-text-primary am-text-lg\">用户</strong> / <small>列表</small></div>
</div>

<div class=\"am-g\">
<div class=\"am-u-md-12 am-cf\">
<div class=\"am-fl am-cf\">
    <form class=\"am-form-inline\">
        <div class=\"am-form-group am-form-icon\">
            <i class=\"am-icon-user\"></i>
            <input style=\"display:none\" mce_style=\"display:none\"><!--防止默认回车提交表单 简直脑残-->
            <input type=\"text\" name=\"search_user\" id=\"search_user\" value=\"";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["search_user"]) ? $context["search_user"] : null), "html", null, true);
        echo "\" class=\"am-form-field\" placeholder=\"账号或昵称\">
        </div>

        <div class=\"am-form-group am-form-icon\">
            <select id=\"search_comissioner\" name=\"search_comissioner\" class=\"select2 span4\" select=\"-1\">
                <option value=\"-1\">全部</option>
                ";
        // line 22
        if ((((array_key_exists("search_comissioner", $context)) ? (_twig_default_filter((isset($context["search_comissioner"]) ? $context["search_comissioner"] : null), (-1))) : ((-1))) == 1)) {
            // line 23
            echo "                    <option value=\"1\" selected=\"selected\">专员</option>
                    <option value=\"0\">普通</option>
                ";
        } elseif ((((array_key_exists("search_comissioner", $context)) ? (_twig_default_filter((isset($context["search_comissioner"]) ? $context["search_comissioner"] : null), (-1))) : ((-1))) == 0)) {
            // line 26
            echo "                    <option value=\"1\">专员</option>
                    <option value=\"0\" selected=\"selected\">普通</option>
                ";
        } else {
            // line 29
            echo "                    <option value=\"1\">专员</option>
                    <option value=\"0\">普通</option>
                ";
        }
        // line 32
        echo "            </select>
        </div>

        <button type=\"button\" id=\"search_btn\" class=\"am-btn am-btn-default\"><i class=\"am-icon-search\"></i>&nbsp;搜索</button>
    </form>
    </div>
    </div>
</div>
<div class=\"am-g\">
<div class=\"am-u-sm-12\">
<table class=\"am-table am-table-striped am-table-hover table-main\">
<thead>
<tr>
    <th class=\"table-check\"><input type=\"checkbox\" /></th>
    <th>UID</th>
    <th>账号</th>
    <th>昵称</th>
    <th>新蜂币</th>
    <th>可提现</th>
    <th>状态</th>
    <th>身份</th>
    <th>上级(uid 账号 昵称)</th>
    <th>操作</th>
</tr>
</thead>
<tbody>
";
        // line 58
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 59
            echo "<tr>
    <td><input type=\"checkbox\" /></td>
    <td>";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo "</td>
    <td><a href=\"javascript:;\">";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
            echo "</a></td>
    <td>";
            // line 63
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "nickname", array()), "html", null, true);
            echo "</td>
    <td>";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "newcoins", array()), "html", null, true);
            echo "</td>
    <td><i class=\"am-icon-cny\">&nbsp;</i>";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "money", array()), "html", null, true);
            echo "</td>
    <td rel=\"ajax_state\">";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "state", array()), "html", null, true);
            echo "</td>
    <td rel=\"ajax_comissioner\">

        ";
            // line 69
            if (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "comissioner", array()) == 1)) {
                // line 70
                echo "        <a href=\"javascript:;\" class=\"am-badge am-badge-danger am-radius\"  style=\"display:block;width:70px;\" >推广专员</a>
        ";
            } else {
                // line 72
                echo "        <a href=\"javascript:;\" class=\"am-badge am-badge-primary am-radius\"  style=\"display:block;width:70px;\" >普通用户</a>
        ";
            }
            // line 74
            echo "    </td>
    <td>";
            // line 75
            echo $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "parent", array());
            echo "</td>
    <td>
        <div class=\"am-dropdown  common-btn-drop\" >
            <button class=\"am-btn am-btn-default am-btn-xs am-dropdown-toggle\" data-am-dropdown-toggle><span class=\"am-icon-list-ol\"></span> <span class=\"am-icon-caret-down\"></span></button>
            <ul class=\"am-dropdown-content\">
                <li><a href=\"javascript:;\" onclick=\"detail(";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo ")\"><i class=\"am-icon-table\">&nbsp;</i>新蜂币变化</a></li>
                ";
            // line 81
            if ((($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "comissioner", array()) == 0) && ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "pid", array()) == 0))) {
                // line 82
                echo "                    <li><a href=\"javascript:;\" onclick=\"setComissioner(";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
                echo ",'";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
                echo "',this)\"><i class=\"am-icon-user\">&nbsp;</i>设为推广专员</a></li>
                ";
            } elseif ((($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "comissioner", array()) == 1) && ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "pid", array()) == 0))) {
                // line 84
                echo "                    <li><a href=\"javascript:;\" onclick=\"setComissionerRatio(";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
                echo ",'";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
                echo "')\"><i class=\"am-icon-cogs\">&nbsp;</i>设置月结算</a></li>
                    <li><a href=\"javascript:;\" onclick=\"comissionerDetail(";
                // line 85
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
                echo ",'";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
                echo "')\"><i class=\"am-icon-list-alt\">&nbsp;</i>推广员详情</a></li>
                ";
            }
            // line 87
            echo "                <li><a href=\"javascript:;\" onclick=\"findChildren(";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo ")\"><i class=\"am-icon-users\">&nbsp;</i>下线</a></li>
                <li><a href=\"javascript:;\" onclick=\"setReward(";
            // line 88
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo ")\"><i class=\"am-icon-cogs\">&nbsp;</i>设置奖励</a></li>
                <li><a href=\"javascript:;\" onclick=\"depositApply(";
            // line 89
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo ")\"><i class=\"am-icon-eye\">&nbsp;</i>提现申请</a></li>
                <li><a href=\"javascript:;\" onclick=\"forbidden(";
            // line 90
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo ",this)\"><i class=\"am-icon-ban\">&nbsp;</i>禁止提现</a></li>
                <li><a href=\"javascript:;\" onclick=\"unForbidden(";
            // line 91
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo ",this)\"><i class=\"am-icon-check\">&nbsp;</i>解禁提现</a></li>
                <li><a href=\"javascript:;\"><i class=\"am-icon-bookmark\">&nbsp;</i>兑换历史</a></li>
            </ul>
        </div>
    </td>
</tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 98
        echo "</tbody>
</table>
<div class=\"am-cf\">
    共 ";
        // line 101
        echo twig_escape_filter($this->env, (isset($context["total"]) ? $context["total"] : null), "html", null, true);
        echo " 条记录
    <div class=\"am-fr\">
        <ul class=\"am-pagination\">
            ";
        // line 104
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
        </ul>
    </div>
</div>
</div>
</div>

<div class=\"am-modal\" tabindex=\"-1\" id=\"ComissionerRatioModal\">
    <div class=\"am-modal-dialog\">
        <div class=\"am-modal-hd\">设置[ <span id=\"SettlementUser\" style=\"color:mediumvioletred\"></span> ]的月结算比例
            <a href=\"javascript: void(0)\" class=\"am-close am-close-spin\" data-am-modal-close>&times;</a>
        </div>
        <div class=\"am-modal-bd\">
            <form class=\"am-form-horizontal am-margin-top-lg am-text-left am-margin-left-sm\">
                <div class=\"am-form-control\">
                    <label class=\"am-form-label am-margin-right-sm span4\" style=\"font-size: 12px;vertical-align: middle;margin-bottom:15px;\">下线人数为0-9</label>
                    <input type=\"text\" name=\"ratio_stage0\" id=\"ratio_stage0\" class=\"am-form-field span3 am-inline-block am-margin-bottom-sm am-margin-right-sm\"/>
                </div>

                <div class=\"am-form-control\">
                    <label class=\"am-form-label am-margin-right-sm span4\" style=\"font-size: 12px;vertical-align: middle;margin-bottom:15px;\">下线人数为10-29</label>
                    <input type=\"text\" name=\"ratio_stage0\" id=\"ratio_stage10\" class=\"am-form-field span3 am-inline-block am-margin-bottom-sm am-margin-right-sm\"/>
                </div>


                <div class=\"am-form-control\">
                    <label class=\"am-form-label am-margin-right-sm span4\" style=\"font-size: 12px;vertical-align: middle;margin-bottom:15px;\">下线人数为30-59</label>
                    <input type=\"text\" name=\"ratio_stage0\" id=\"ratio_stage30\" class=\"am-form-field span3 am-inline-block am-margin-bottom-sm am-margin-right-sm\"/>
                </div>


                <div class=\"am-form-control\">
                    <label class=\"am-form-label am-margin-right-sm span4\" style=\"font-size: 12px;vertical-align: middle;margin-bottom:15px;\">下线人数为60-99</label>
                    <input type=\"text\" name=\"ratio_stage0\" id=\"ratio_stage60\" class=\"am-form-field span3 am-inline-block am-margin-bottom-sm am-margin-right-sm\"/>
                </div>


                <div class=\"am-form-control\">
                    <label class=\"am-form-label am-margin-right-sm span4\" style=\"font-size: 12px;vertical-align: middle;margin-bottom:15px;\">下线人数为大于100</label>
                    <input type=\"text\" name=\"ratio_stage0\" id=\"ratio_stage100\" class=\"am-form-field span3 am-inline-block am-margin-bottom-sm am-margin-right-sm\"/>
                </div>
                <input type=\"submit\" id=\"comissionerRatioSubmitBtn\" class=\"submit\" style=\"display:none\"/>
            </form>
        </div>
        <div class=\"am-modal-footer\">
            <span class=\"am-modal-btn\" id=\"ComissionerRatioModal-btn-no\">取消</span>
            <span class=\"am-modal-btn\" id=\"ComissionerRatioModal-btn-yes\">确认</span>
        </div>
    </div>
</div>



<div class=\"am-modal\" tabindex=\"-1\" id=\"ComissionerProfileModal\">
    <div class=\"am-modal-dialog\">
        <div class=\"am-modal-hd\">设置[ <span id=\"SettlementProfile\" style=\"color:mediumvioletred\"></span> ]的推广专员资料
            <a href=\"javascript: void(0)\" class=\"am-close am-close-spin\" data-am-modal-close>&times;</a>
        </div>
        <div class=\"am-modal-bd\">
            <form class=\"am-form-horizontal am-margin-top-lg am-text-left am-margin-left-sm\">
                <div class=\"am-form-control\">
                    <label class=\"am-form-label am-margin-right-sm span4\" style=\"font-size: 12px;vertical-align: middle;margin-bottom:15px;\">手机号</label>
                    <input type=\"text\" name=\"profile_mobile\" id=\"profile_mobile\" class=\"am-form-field span4 am-inline-block am-margin-bottom-sm am-margin-right-sm\"/>
                </div>

                <div class=\"am-form-control\">
                    <label class=\"am-form-label am-margin-right-sm span4\" style=\"font-size: 12px;vertical-align: middle;margin-bottom:15px;\">qq</label>
                    <input type=\"text\" name=\"profile_qq\" id=\"profile_qq\" class=\"am-form-field span4 am-inline-block am-margin-bottom-sm am-margin-right-sm\"/>
                </div>
                <input type=\"submit\" id=\"comissionerProfileSubmitBtn\" class=\"submit\" style=\"display:none\"/>
            </form>

            <form class=\"am-form-horizontal am-text-left am-margin-left-sm\" id=\"upIdCardForm\" action='/comissionerProfile/uploadIDCard' method='post' enctype='multipart/form-data'>
                <div class=\"am-form-control\">
                    <label class=\"am-form-label am-margin-right-sm span4\" style=\"font-size: 12px;vertical-align: middle;margin-bottom:15px;\">身份证照</label>
                    <input type=\"file\" name=\"profile_idcard\" id=\"profile_idcard\" class=\"am-form-field span6 am-inline-block am-margin-bottom-sm am-margin-right-sm\"/>
                    <button type=\"button\" onclick=\"uploadIDCard()\" id=\"upIdCardBtn\" class=\"am-btn am-btn-default am-btn-sm am-margin-bottom-sm\"><i class=\"am-icon-cloud-upload\"></i>上传</button>
                </div>
                <input type=\"submit\" id=\"upIdCardSubmitBtn\" class=\"submit\" style=\"display:none\"/>
            </form>
        </div>
        <div class=\"am-modal-footer\">
            <span class=\"am-modal-btn\" id=\"ComissionerProfileModal-btn-no\">取消</span>
            <span class=\"am-modal-btn\" id=\"ComissionerProfileModal-btn-yes\">确认</span>
        </div>
    </div>
</div>


<div class=\"am-modal\" tabindex=\"-1\" id=\"ComissionerDetailModal\">
    <div class=\"am-modal-dialog\">
        <div class=\"am-modal-hd\">[ <span id=\"SettlementDetailProfile\" style=\"color:mediumvioletred\"></span> ]的推广专员详情
            <a href=\"javascript: void(0)\" class=\"am-close am-close-spin\" data-am-modal-close>&times;</a>
        </div>
        <div class=\"am-modal-bd\">
            <table class=\"am-table\">
                <tbody>
                <tr class=\"am-warning\">
                    <th>一级下线人数</th>
                    <td id=\"profile-childNum\"></td>
                </tr>
                <tr class=\"am-warning\">
                    <th>手机号</th>
                    <td id=\"profile-mobile\"></td>
                </tr>
                <tr class=\"am-warning\">
                    <th>QQ号</th>
                    <td id=\"profile-qq\"></td>
                </tr>
                <tr class=\"am-warning\">
                    <th>身份证</th>
                    <td>
                        <div id=\"profile-idCard\" style=\"height:200px;overflow-y:auto\"></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

";
        // line 225
        $this->displayBlock('script', $context, $blocks);
    }

    // line 1
    public function block_css($context, array $blocks = array())
    {
        // line 2
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/css/select2.min.css\">
";
    }

    // line 225
    public function block_script($context, array $blocks = array())
    {
        // line 226
        echo "<script src=\"";
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/jquery.validate.min.js\"></script>
<script src=\"";
        // line 227
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/jquery.form.min.js\"></script>
<script src=\"";
        // line 228
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/select2.min.js\"></script>
<script src=\"";
        // line 229
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/standalone/user_list.js\"></script>
<script src=\"";
        // line 230
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/common-list.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "user_list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  373 => 230,  369 => 229,  365 => 228,  361 => 227,  356 => 226,  353 => 225,  346 => 2,  343 => 1,  339 => 225,  215 => 104,  209 => 101,  204 => 98,  191 => 91,  187 => 90,  183 => 89,  179 => 88,  174 => 87,  167 => 85,  160 => 84,  152 => 82,  150 => 81,  146 => 80,  138 => 75,  135 => 74,  131 => 72,  127 => 70,  125 => 69,  119 => 66,  115 => 65,  111 => 64,  107 => 63,  103 => 62,  99 => 61,  95 => 59,  91 => 58,  63 => 32,  58 => 29,  53 => 26,  48 => 23,  46 => 22,  37 => 16,  23 => 4,  21 => 1,);
    }
}
