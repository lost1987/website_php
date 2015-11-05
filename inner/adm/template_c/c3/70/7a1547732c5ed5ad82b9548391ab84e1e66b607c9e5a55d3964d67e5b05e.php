<?php

/* comissionerApplyChild_list.html */
class __TwigTemplate_c3707a1547732c5ed5ad82b9548391ab84e1e66b607c9e5a55d3964d67e5b05e extends Twig_Template
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
    <div class=\"am-fl am-cf\"><strong class=\"am-text-primary am-text-lg\">奖励申请</strong> / <small>专员一级下线</small></div>
</div>

<div class=\"am-g\">
<div class=\"am-u-sm-12\">
<table class=\"am-table am-table-striped am-table-hover table-main\">
<thead>
<tr>
    <th class=\"table-check\"><input type=\"checkbox\" /></th>
    <th>UID</th>
    <th>上线账号</th>
    <th>账号</th>
    <th>昵称</th>
    <th>下线人数</th>
    <th>当前提成比例</th>
    <th>可提升提成比例</th>
    <th>申请时间</th>
    <th>处理时间</th>
    <th>状态</th>
    <th>操作</th>
</tr>
</thead>
<tbody>
";
        // line 29
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 30
            echo "<tr>
    <td><input type=\"checkbox\" /></td>
    <td>";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo "</td>
    <td><a href=\"javascript:;\">";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "parent", array()), "html", null, true);
            echo "</a></td>
    <td><a href=\"javascript:;\">";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
            echo "</a></td>
    <td>";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "nickname", array()), "html", null, true);
            echo "</td>
    <td>";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "childNum", array()), "html", null, true);
            echo "</td>
    <td rel=\"ajax_curRatio\">";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "curStageRatio", array()), "html", null, true);
            echo "</td>
    <td>";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "reachableStageRatio", array()), "html", null, true);
            echo "</td>
    <td>";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "apply_time", array()), "html", null, true);
            echo "</td>
    <td rel=\"ajax_handle_time\">";
            // line 40
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "handle_time", array()), "html", null, true);
            echo "</td>
    <td rel=\"ajax_state\">";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "stateName", array()), "html", null, true);
            echo "</td>
    <td>
        <div class=\"am-btn-toolbar\" style=\"width:225px;\">
            <div class=\"am-btn-group am-btn-group-xs\">
                <button class=\"am-btn am-btn-default am-btn-xs am-text-secondary\" ";
            // line 45
            if (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "state", array()) != 0)) {
                echo "disabled=\"true\"";
            }
            echo " onclick=\"agree(";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo ",'";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
            echo "',this)\"><span class=\"am-icon-check\"></span> 批准</button>
                <button class=\"am-btn am-btn-default am-btn-xs am-text-danger\" ";
            // line 46
            if (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "state", array()) != 0)) {
                echo "disabled=\"true\"";
            }
            echo "  onclick=\"disagree(";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo ",'";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
            echo "',this)\"><span class=\"am-icon-ban\"></span> 驳回</button>
                <button class=\"am-btn am-btn-default am-btn-xs am-text-secondary\" ";
            // line 47
            if (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "comment", array()) == "")) {
                echo "disabled=\"true\"";
            }
            echo " onclick=\"commentDetail(this)\"><span class=\"am-icon-pencil-square-o\"></span> 驳回原因</button>
                <input type=\"hidden\" value=\"";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "comment", array()), "html", null, true);
            echo "\" />
            </div>
        </div>
    </td>
</tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "</tbody>
</table>
<div class=\"am-cf\">
    共 ";
        // line 57
        echo twig_escape_filter($this->env, (isset($context["total"]) ? $context["total"] : null), "html", null, true);
        echo " 条记录
    <div class=\"am-fr\">
        <ul class=\"am-pagination\">
            ";
        // line 60
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
        </ul>
    </div>
</div>
</div>
</div>

<div class=\"am-modal\" tabindex=\"-1\" id=\"ComissionerApplyModal\">
    <div class=\"am-modal-dialog\">
        <div class=\"am-modal-hd\">驳回[ <span id=\"SettlementUser\" style=\"color:mediumvioletred\"></span> ]的奖励申请
            <a href=\"javascript: void(0)\" class=\"am-close am-close-spin\" data-am-modal-close>&times;</a>
        </div>
        <div class=\"am-modal-bd\">
           <form class=\"am-form-horizontal am-margin-top-lg am-text-left am-margin-left-sm\">
               <div class=\"am-form-control\">
               <label class=\"am-form-label am-margin-right-sm span4\" style=\"font-size: 12px;vertical-align: middle;margin-bottom:15px;\">驳回原因</label>
                   <textarea id=\"comment\" style=\"width:300px;height:70px;\"></textarea>
               </div>
               <input type=\"submit\" id=\"ComissionerApplySubmitBtn\" class=\"submit\" style=\"display:none\"/>
           </form>
        </div>
        <div class=\"am-modal-footer\">
            <span class=\"am-modal-btn\" id=\"ComissionerApplyModal-btn-no\">取消</span>
            <span class=\"am-modal-btn\" id=\"ComissionerApplyModal-btn-yes\">确认</span>
        </div>
    </div>
</div>

";
        // line 88
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

    // line 88
    public function block_script($context, array $blocks = array())
    {
        // line 89
        echo "<script src=\"";
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/jquery.validate.min.js\"></script>
<script src=\"";
        // line 90
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/select2.min.js\"></script>
<script src=\"";
        // line 91
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/standalone/comissionerApplyChild_list.js\"></script>
<script src=\"";
        // line 92
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/common-list.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "comissionerApplyChild_list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  213 => 92,  209 => 91,  205 => 90,  200 => 89,  197 => 88,  190 => 2,  187 => 1,  183 => 88,  152 => 60,  146 => 57,  141 => 54,  129 => 48,  123 => 47,  113 => 46,  101 => 45,  94 => 41,  90 => 40,  86 => 39,  82 => 38,  78 => 37,  74 => 36,  70 => 35,  66 => 34,  62 => 33,  58 => 32,  54 => 30,  50 => 29,  23 => 4,  21 => 1,);
    }
}
