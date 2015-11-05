<?php

/* admin_lists.html */
class __TwigTemplate_6fa99ee682124b80147132125fee3955bd917aece04ac5b3fb3f1b9ee37c71d8 extends Twig_Template
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
    <h3><small class=\"badge badge-info\">网点商家列表</small></h3>
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
    <div class=\"col-xs-2 text-right\">
        <button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"window.location.href='/admin/add'\">添加</button>
    </div><br/><br/><br/>
    <table class=\"table table-hover table-bordered table-striped\">
        <tr>
            <th width=\"200\">帐号</th>
            <th width=\"200\">网点名称</th>
            <th>地址</th>
            <th width=\"200\">手机号</th>
            <th width=\"200\">操作</th>
        </tr>
        ";
        // line 30
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 31
            echo "        <tr>
            <td>";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "account", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "address", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "mobile", array()), "html", null, true);
            echo "</td>
            <td>
                <button  class=\"btn btn-xs  btn-primary\" type=\"button\" onclick=\"window.location.href='/admin/add/";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo "';\">编辑</button>&nbsp;&nbsp;
                <button type=\"button\" class=\"btn btn-xs  btn-danger\" onclick=\"del(";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id", array()), "html", null, true);
            echo ")\">删除</button>
            </td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "    </table>

    <div class=\"pagination\">
            ";
        // line 45
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
    </div>
</div>

<script>
    function del(id){
            if(confirm('管理员大大...真的要删除这条萌萌的数据吗?')){
                window.location.href=\"/admin/del/\"+id;
            }
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "admin_lists.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 45,  96 => 42,  86 => 38,  82 => 37,  77 => 35,  73 => 34,  69 => 33,  65 => 32,  62 => 31,  58 => 30,  31 => 5,  28 => 4,);
    }
}
