<?php

/* exchange_analysis.html */
class __TwigTemplate_9cdf64abb44b0d856bbae047119e03f11cb9d255f16d9edb378a2496cc0fc913 extends Twig_Template
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
    <h3><small class=\"badge badge-info\">实物兑换统计</small></h3>
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
            <th>人民币</th>
            <th>时间</th>
        </tr>
        ";
        // line 24
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["list"]) ? $context["list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 25
            echo "        <tr>
            <td>";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "rmb", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "create_time", array()), "html", null, true);
            echo "</td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "    </table>

    <div class=\"pagination\">
            ";
        // line 33
        echo (isset($context["pagiation"]) ? $context["pagiation"] : null);
        echo "
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "exchange_analysis.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 33,  72 => 30,  63 => 27,  59 => 26,  56 => 25,  52 => 24,  31 => 5,  28 => 4,);
    }
}
