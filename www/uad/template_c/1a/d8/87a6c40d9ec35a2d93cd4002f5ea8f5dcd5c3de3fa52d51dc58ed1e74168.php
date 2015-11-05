<?php

/* invite_friends.html */
class __TwigTemplate_1ad887a6c40d9ec35a2d93cd4002f5ea8f5dcd5c3de3fa52d51dc58ed1e74168 extends Twig_Template
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
    <div class=\"am-fl am-cf\"><strong class=\"am-text-primary am-text-lg\">邀请好友</strong>  <small></small></div>
</div>

<div class=\"am-g am-padding\">
    <div class=\"am-u-sm-12\">
        <a class=\"am-badge am-badge-primary am-round\">新蜂币奖励:</a><br/><br/>
        <table class=\"am-table am-table-striped am-table-hover table-main\">
            <caption class=\"am-text-left\"><b style=\"font-size: 1.4rem\">1.充值返利</b></caption>
            <thead>
            <tr>
                <th></th>
                <th>一级下线</th>
                <th>二级下线</th>
                <th>三级下线</th>
                <th>四级下线</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>返现比例</td>
                <td>";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["rechargeReward"]) ? $context["rechargeReward"] : null), "ratio1", array()), "html", null, true);
        echo "</td>
                <td>";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["rechargeReward"]) ? $context["rechargeReward"] : null), "ratio2", array()), "html", null, true);
        echo "</td>
                <td>";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["rechargeReward"]) ? $context["rechargeReward"] : null), "ratio3", array()), "html", null, true);
        echo "</td>
                <td>";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["rechargeReward"]) ? $context["rechargeReward"] : null), "ratio4", array()), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <td>公式</td>
                <td>下线充值金额*10000*";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["rechargeReward"]) ? $context["rechargeReward"] : null), "ratio1", array()), "html", null, true);
        echo "</td>
                <td>下线充值金额*10000*";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["rechargeReward"]) ? $context["rechargeReward"] : null), "ratio2", array()), "html", null, true);
        echo "</td>
                <td>下线充值金额*10000*";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["rechargeReward"]) ? $context["rechargeReward"] : null), "ratio3", array()), "html", null, true);
        echo "</td>
                <td>下线充值金额*10000*";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["rechargeReward"]) ? $context["rechargeReward"] : null), "ratio4", array()), "html", null, true);
        echo "</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class=\"am-g am-padding\">
    <div class=\"am-u-sm-12\">
        <table class=\"am-table am-table-striped am-table-hover table-main\">
            <caption class=\"am-text-left\"><b style=\"font-size: 1.4rem\">2.提现奖励</b></caption>
            <thead>
            <tr>
                <th></th>
                <th>一级下线</th>
                <th>二级下线</th>
                <th>三级下线</th>
                <th>四级下线</th>
            </tr>
            </thead>
            <tbody>
                ";
        // line 53
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(1, 4));
        foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
            // line 54
            echo "                    <tr>
                        <td> 提现达到";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["depositReward"]) ? $context["depositReward"] : null), ("ratio" . (isset($context["j"]) ? $context["j"] : null)), array(), "array"), ((isset($context["j"]) ? $context["j"] : null) - 1), array(), "array"), "money", array()), "html", null, true);
            echo "元 </td>
                        ";
            // line 56
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(1, 4));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 57
                echo "                            <td>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["depositReward"]) ? $context["depositReward"] : null), ("ratio" . (isset($context["i"]) ? $context["i"] : null)), array(), "array"), ((isset($context["j"]) ? $context["j"] : null) - 1), array(), "array"), "newcoins", array()), "html", null, true);
                echo "</td>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 59
            echo "                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "            </tbody>
        </table>
    </div>
</div>


<div class=\"am-g am-padding\">
    <div class=\"am-u-sm-12\">
        <table class=\"am-table am-table-striped am-table-hover table-main\">
            <caption class=\"am-text-left\"><b style=\"font-size: 1.4rem\">3.成长奖励</b></caption>
            <thead>
            <tr>
                <th>游戏等级</th>
                <th>一级下线</th>
                <th>二级下线</th>
                <th>三级下线</th>
                <th>四级下线</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 81
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(1, 3));
        foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
            // line 82
            echo "            <tr>
                <td> ";
            // line 83
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["levelUpReward"]) ? $context["levelUpReward"] : null), ("ratio" . (isset($context["j"]) ? $context["j"] : null)), array(), "array"), ((isset($context["j"]) ? $context["j"] : null) - 1), array(), "array"), "lv", array()), "html", null, true);
            echo "级 </td>
                ";
            // line 84
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(1, 4));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 85
                echo "                <td>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["levelUpReward"]) ? $context["levelUpReward"] : null), ("ratio" . (isset($context["i"]) ? $context["i"] : null)), array(), "array"), ((isset($context["j"]) ? $context["j"] : null) - 1), array(), "array"), "newcoins", array()), "html", null, true);
                echo "</td>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 87
            echo "            </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 89
        echo "            </tbody>
        </table>
    </div>
</div>

<div class=\"am-g am-padding\">
    <div class=\"am-u-sm-12\">
        <table class=\"am-table am-table-striped am-table-hover table-main\">
            <caption class=\"am-text-left\"><b style=\"font-size: 1.4rem\">4.登录奖励</b></caption>
            <thead>
            <tr>
                <th>累计签到</th>
                <th>一级下线</th>
                <th>二级下线</th>
                <th>三级下线</th>
                <th>四级下线</th>
            </tr>
            </thead>
            <tbody>
            ";
        // line 108
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(1, 3));
        foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
            // line 109
            echo "            <tr>
                <td> ";
            // line 110
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["loginReward"]) ? $context["loginReward"] : null), ("ratio" . (isset($context["j"]) ? $context["j"] : null)), array(), "array"), ((isset($context["j"]) ? $context["j"] : null) - 1), array(), "array"), "days", array()), "html", null, true);
            echo "天 </td>
                ";
            // line 111
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(range(1, 4));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 112
                echo "                <td>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["loginReward"]) ? $context["loginReward"] : null), ("ratio" . (isset($context["i"]) ? $context["i"] : null)), array(), "array"), ((isset($context["j"]) ? $context["j"] : null) - 1), array(), "array"), "newcoins", array()), "html", null, true);
                echo "</td>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 114
            echo "            </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 116
        echo "            </tbody>
        </table>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "invite_friends.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  233 => 116,  226 => 114,  217 => 112,  213 => 111,  209 => 110,  206 => 109,  202 => 108,  181 => 89,  174 => 87,  165 => 85,  161 => 84,  157 => 83,  154 => 82,  150 => 81,  128 => 61,  121 => 59,  112 => 57,  108 => 56,  104 => 55,  101 => 54,  97 => 53,  73 => 32,  69 => 31,  65 => 30,  61 => 29,  54 => 25,  50 => 24,  46 => 23,  42 => 22,  19 => 1,);
    }
}
