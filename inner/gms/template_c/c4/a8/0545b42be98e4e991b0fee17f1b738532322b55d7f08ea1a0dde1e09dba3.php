<?php

/* chart_datas_diamond_table.html */
class __TwigTemplate_c4a80545b42be98e4e991b0fee17f1b738532322b55d7f08ea1a0dde1e09dba3 extends Twig_Template
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

    // line 4
    public function block_title($context, array $blocks = array())
    {
        // line 5
        echo "钻石场统计
";
    }

    // line 8
    public function block_css($context, array $blocks = array())
    {
        // line 9
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/select2_metro.css\"/>
<link rel=\"stylesheet\" href=\"/media/css/DT_bootstrap.css\"/>
<link rel=\"stylesheet\" href=\"/media/css/common/form_search.css\"/>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/addtional.css\"/>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/datepicker.css\"/>
";
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "<!-- BEGIN PAGE HEADER-->


<div class=\"row-fluid\">


    <div class=\"span12\">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class=\"page-title\">
            钻石场统计
            <small></small>
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>


</div>


<!-- END PAGE HEADER-->


<!-- BEGIN PAGE CONTENT-->

<div class=\"row-fluid\">
    <div class=\"portlet\">
        <div class=\"portlet-title\">
            <div class=\"caption\"></div>
            <div class=\"tools\">
                <a href=\"javascript:;\" class=\"collapse\"></a>
            </div>
        </div>

        <span class=\"label label-important\">总览:</span><br/><br/>
        <div class=\"portlet-body\">
            <table class=\"table table-striped table-bordered table-hover\">
                <thead>
                <tr>
                    <th>钻石场总收入</th>
                    <th class=\"hidden-phone\">台位费总收入</th>
                    <th>奖券总支出</th>
                    <th>大奖中奖几率</th>
                    <th>小奖中奖几率</th>
                </tr>
                </thead>
                <tbody>
                <td>";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "total_in", array()), "html", null, true);
        echo "</td>
                <td class=\"hidden-phone\">";
        // line 64
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "total_table_in", array()), "html", null, true);
        echo "</td>
                <td>";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "total_out", array()), "html", null, true);
        echo "</td>
                <td>";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "bigLotteryRatio", array()), "html", null, true);
        echo "</td>
                <td>";
        // line 67
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["total"]) ? $context["total"] : null), "smallLotteryRatio", array()), "html", null, true);
        echo "</td>
                </tbody>
            </table>
        </div>
        <br/><br/>

        <span class=\"label label-important\">开奖明细-大奖:</span><br/><br/>
        <div class=\"portlet-body\">
            <table class=\"table table-striped table-bordered table-hover\">
                <thead>
                <tr>
                    <th>uid</th>
                    <th class=\"hidden-phone\">昵称</th>
                    <th>时间</th>
                    <th>奖券</th>
                </tr>
                </thead>
                <tbody id=\"bigTbody\">

                </tbody>
            </table>
            <div class=\"pagination\">
                    <ul   id=\"page-big\"></ul>
            </div>
        </div>
        <br/><br/>

        <span class=\"label label-important\">开奖明细-小奖:</span><br/><br/>
        <div class=\"portlet-body\">
            <table class=\"table table-striped table-bordered table-hover\">
                <thead>
                <tr>
                    <th>uid</th>
                    <th class=\"hidden-phone\">昵称</th>
                    <th>时间</th>
                    <th>奖券</th>
                </tr>
                </thead>
                <tbody id=\"smallTbody\">
                </tbody>
            </table>
            <div class=\"pagination\">
                    <ul  id=\"page-small\"></ul>
            </div>
        </div>
        <br/><br/>

        <div class=\"portlet-body\">
            <form action=\"/datas/diamondTable\" method=\"post\" class=\"form-inline\">
       <label> 间隔:</label>
         <select name=\"precision\" class=\"span1\">
             ";
        // line 118
        if (((isset($context["precision"]) ? $context["precision"] : null) == "minute")) {
            // line 119
            echo "                <option value=\"minute\" selected=\"selected\">5分钟</option>
                <option value=\"day\">天</option>
             ";
        } else {
            // line 122
            echo "                 <option value=\"minute\">5分钟</option>
                 <option value=\"day\" selected=\"selected\">天</option>
             ";
        }
        // line 125
        echo "         </select>
        <input type=\"submit\" value=\"查询\" class=\"btn btn-default\"/>
            </form>
        </div>
        <br/><br/>

        <span class=\"label label-important\">场数:</span><br/><br/>
        <div class=\"portlet-body\">
            <div id=\"chart1\" style=\"width:100%;height:230px;\"></div>
        </div>
        <br/><br/>

        <span class=\"label label-important\">奖池变化:</span><br/><br/>
        <div class=\"portlet-body\">
            <div id=\"chart2\" style=\"width:100%;height:230px;\"></div>
        </div>
        <br/><br/>
    </div>
</div>


<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>
<input type=\"hidden\" id=\"dateLine\" value=\"";
        // line 150
        echo twig_escape_filter($this->env, (isset($context["dateLine"]) ? $context["dateLine"] : null), "html", null, true);
        echo "\" /><!--时间线-->
<input type=\"hidden\" id=\"data\" value=\"";
        // line 151
        echo twig_escape_filter($this->env, (isset($context["diamondTable"]) ? $context["diamondTable"] : null), "html", null, true);
        echo "\" /><!--数据-->
";
    }

    // line 155
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 156
        echo "<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/jquery.dataTables.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/DT_bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datepicker.zh-CN.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/echarts/echarts.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/private/chart_datas_diamond_table.js\"></script>
";
    }

    // line 165
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 166
        echo "<script>

    var coupon = ";
        // line 168
        echo twig_escape_filter($this->env, (isset($context["coupon"]) ? $context["coupon"] : null), "html", null, true);
        echo ";

    \$(function(){
        bigLotteryPage();
        smallLotteryPage();
    })

    function bigLotteryPage(){
            nextPage(1,3);
    }

    function smallLotteryPage(){
            nextPage(1,2);
    }

    function nextPage(page,search_type){
        \$.get('/datas/diamondTableDetail/'+page,'search_type='+search_type,function(data){
                var response = eval('('+data+')');
                console.log(response.data);
                var tbody = '';
                \$.each(response.data.list,function(i){
                    var json = eval('('+response.data.list[i].json+')');
                    tbody +=  '<tr>';
                    tbody += '<td>'+json.uid+'</td>';
                    tbody += '<td>'+json.nick+'</td>';
                    tbody += '<td>'+response.data.list[i].begin_time+'</td>';
                    tbody += '<td>'+response.data.list[i].zj_amount+'</td>';
                    tbody += '</tr>';
                });

                if(search_type == 2){
                        \$(\"#page-small\").html(response.data.pagiation);
                        \$(\"#smallTbody\").html(tbody);
                }else {
                        \$(\"#page-big\").html(response.data.pagiation);
                        \$(\"#bigTbody\").html(tbody);
                }
        });
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "chart_datas_diamond_table.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  243 => 168,  239 => 166,  236 => 165,  225 => 156,  222 => 155,  216 => 151,  212 => 150,  185 => 125,  180 => 122,  175 => 119,  173 => 118,  119 => 67,  115 => 66,  111 => 65,  107 => 64,  103 => 63,  55 => 17,  52 => 16,  43 => 9,  40 => 8,  35 => 5,  32 => 4,);
    }
}
