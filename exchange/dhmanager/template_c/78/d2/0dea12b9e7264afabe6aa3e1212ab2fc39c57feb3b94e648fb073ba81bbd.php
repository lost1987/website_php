<?php

/* exchange_lists.html */
class __TwigTemplate_78d20dea12b9e7264afabe6aa3e1212ab2fc39c57feb3b94e648fb073ba81bbd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base.html");

        $this->blocks = array(
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

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "<div class=\"row\" >
    <h3><small class=\"badge badge-info\">实物兑换列表</small></h3>
    <div class=\"col-xs-10\">
       <!-- <form class=\"form-inline\" action=\"/articles/list\">
            <div class=\"form-group\">
                <label style=\"font-weight: bold;\"  for=\"category_id\">栏目&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <select name=\"search_category_id\" class=\"form-control\" style=\"width: 100px;height:30px;\" >
                    <option value=\"-1\">全部</option>
                </select>
            </div>
            <div class=\"form-group\"><input type=\"hidden\" value=\"1005\" name=\"r\"/></div>
            <button type=\"submit\"  class=\"btn btn-default btn-sm\"><span class=\"glyphicon glyphicon-search\" aria-hidden=\"true\"></span>搜索</button>
        </form>-->
    </div>
    <table class=\"table table-hover table-bordered table-striped\">
        <tr>
            <th>实物</th>
            <th>状态</th>
            <th>玩家UID</th>
            <th>玩家昵称</th>
            <th>玩家帐号</th>
            <th >玩家手机</th>
            <th >玩家qq</th>
            <th >人民币价值</th>
            <th>兑换方式</th>
            <th>支付宝帐号</th>
            <th>支付宝收款人</th>
            <th>银行卡号</th>
           <th>开户银行</th>
            <th>开户姓名</th>
            <th>收货地址</th>
            <th>快递信息</th>
            <th>操作</th>
        </tr>
        ";
        // line 39
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 40
            echo "        <tr>
            <td>";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "product_name", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "status_name", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uid", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "nickname", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "login_name", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "mobile", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "qq", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "product_rmb", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 49
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "typename", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "alipay_account", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 51
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "alipay_name", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 52
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "bank_no", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 53
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "bank_name", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 54
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "address", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "express", array()), "html", null, true);
            echo "</td>
            <td>
                ";
            // line 58
            if (($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "status", array()) == 0)) {
                // line 59
                echo "                    <button class=\"btn btn-default btn-xs\" onclick=\"handle(";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
                echo ",";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "type", array()), "html", null, true);
                echo ",this)\">处理</button>
                ";
            } else {
                // line 61
                echo "                    /
                ";
            }
            // line 63
            echo "            </td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        echo "    </table>

    <div class=\"pagination\">
            ";
        // line 69
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
    </div>
</div>
<script>
    function handle(orderid,type,node)
    {
            if(!confirm('确定要处理嘛?'))
                return;

            var params = \"type=\"+type+\"&orderid=\"+orderid;
            if(type != 1 &&  type != 2){
                    var express = window.prompt('请输入快递信息',\"\");
                    if(express == ''){
                        alert('请输入快递信息');
                        return;
                    }
                    params += \"&express=\"+express;
            }
            \$.post('/exchange/handle',params,function(data){
                        var response = eval( '(' +data+ ')');
                        if(response.errCode == 0)
                                window.location.reload();
                        else
                                alert('出错了');
            });
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "exchange_lists.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  166 => 69,  161 => 66,  153 => 63,  149 => 61,  141 => 59,  139 => 58,  134 => 56,  130 => 55,  126 => 54,  122 => 53,  118 => 52,  114 => 51,  110 => 50,  106 => 49,  102 => 48,  98 => 47,  94 => 46,  90 => 45,  86 => 44,  82 => 43,  78 => 42,  74 => 41,  71 => 40,  67 => 39,  31 => 5,  28 => 4,);
    }
}
