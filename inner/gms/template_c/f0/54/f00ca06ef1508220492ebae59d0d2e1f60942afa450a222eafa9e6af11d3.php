<?php

/* player_user_messages.html */
class __TwigTemplate_f054f00ca06ef1508220492ebae59d0d2e1f60942afa450a222eafa9e6af11d3 extends Twig_Template
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
        echo "物品消息发放
";
    }

    // line 7
    public function block_css($context, array $blocks = array())
    {
        // line 8
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/select2_metro.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/chosen.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/addtional.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/bootstrap-fileupload.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"/media/css/datetimepicker.css\" />
";
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "<div class=\"row-fluid\">
    <div class=\"span12\">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class=\"page-title\">
            物品消息发放
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
                <div class=\"caption\"><i class=\"icon-reorder\"></i></div>
                <div class=\"tools\">
                    <a href=\"javascript:;\" class=\"collapse\"></a>
                    <a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"></a>
                    <a href=\"javascript:;\" class=\"reload\"></a>
                    <a href=\"javascript:;\" class=\"remove\"></a>
                </div>
            </div>




            <div class=\"portlet-body form\">
                <!-- BEGIN FORM-->
                <form action=\"/player/sendUserMessage\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\"  >
                    <div class=\"alert alert-error hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        您提交的信息有错误请更正后再保存
                    </div>

                    <div class=\"alert alert-success hide\">
                        <button class=\"close\" data-dismiss=\"alert\"></button>
                        发送成功!
                    </div>

                    <div class=\"row-fluid\">
                        <div class=\"span6\">
                            <div class=\"control-group\">
                                <label class=\"control-label\"><b class=\"midnight\">玩家(uid分割)</b><span class=\"required\">*</span></label>
                                <div class=\"controls\">
                                    <textarea  id=\"players\" name=\"players\" rows=\"10\" style=\"width:400px\" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class=\"row-fluid\">
                            <div class=\"span12\">
                                <div class=\"control-group\">
                                    <label class=\"control-label\"><b class=\"midnight\">标题</b><span class=\"required\">*</span></label>
                                    <div class=\"controls\">
                                        <input name=\"title\" id=\"title\" type=\"text\" class=\"span4 m-wrap\" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row-fluid\">
                            <div class=\"span6\">
                                <div class=\"control-group\">
                                    <label class=\"control-label\"><b class=\"midnight\">内容</b><span class=\"required\">*</span></label>
                                    <div class=\"controls\">
                                        <textarea  id=\"content\" name=\"content\" rows=\"10\" style=\"width:400px\" ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row-fluid\">
                            <div class=\"span6\">
                                <div class=\"control-group\">
                                    <label class=\"control-label\"><b class=\"midnight\">物品1</b><span class=\"required\"></span></label>
                                    <div class=\"controls\">
                                      <select name=\"item_id[]\" class=\"span5\">
                                          ";
        // line 98
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        foreach ($context['_seq'] as $context["item_id"] => $context["name"]) {
            // line 99
            echo "                                            <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["item_id"]) ? $context["item_id"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo "</option>
                                          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['item_id'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 101
        echo "                                      </select>
                                        <input type=\"text\" name=\"item_num[]\"  class=\"span3\" placeholder=\"数量\"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class=\"row-fluid\">
                        <div class=\"span6\">
                            <div class=\"control-group\">
                                <label class=\"control-label\"><b class=\"midnight\">物品2</b><span class=\"required\"></span></label>
                                <div class=\"controls\">
                                    <select name=\"item_id[]\" class=\"span5\">
                                        ";
        // line 114
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        foreach ($context['_seq'] as $context["item_id"] => $context["name"]) {
            // line 115
            echo "                                        <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["item_id"]) ? $context["item_id"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['item_id'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 117
        echo "                                    </select>
                                    <input type=\"text\" name=\"item_num[]\"  class=\"span3\" placeholder=\"数量\"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"row-fluid\">
                        <div class=\"span6\">
                            <div class=\"control-group\">
                                <label class=\"control-label\"><b class=\"midnight\">物品3</b><span class=\"required\"></span></label>
                                <div class=\"controls\">
                                    <select name=\"item_id[]\" class=\"span5\">
                                        ";
        // line 130
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        foreach ($context['_seq'] as $context["item_id"] => $context["name"]) {
            // line 131
            echo "                                        <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["item_id"]) ? $context["item_id"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['item_id'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 133
        echo "                                    </select>
                                    <input type=\"text\" name=\"item_num[]\"  class=\"span3\" placeholder=\"数量\"/>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class=\"row-fluid\">
                        <div class=\"span6\">
                            <div class=\"control-group\">
                                <label class=\"control-label\"><b class=\"midnight\">物品4</b><span class=\"required\"></span></label>
                                <div class=\"controls\">
                                    <select name=\"item_id[]\" class=\"span5\">
                                        ";
        // line 147
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
        foreach ($context['_seq'] as $context["item_id"] => $context["name"]) {
            // line 148
            echo "                                        <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["item_id"]) ? $context["item_id"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['item_id'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 150
        echo "                                    </select>
                                    <input type=\"text\" name=\"item_num[]\"  class=\"span3\" placeholder=\"数量\"/>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class=\"form-actions\">
                            <button type=\"button\" id=\"sendbtn\" class=\"btn red\" onclick=\"send()\">发送</button>
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

    // line 171
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 172
        echo "<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/chosen.jquery.min.js\"></script>
";
    }

    // line 176
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 177
        echo "<script>
    var success = ";
        // line 178
        echo twig_escape_filter($this->env, ((array_key_exists("success", $context)) ? (_twig_default_filter((isset($context["success"]) ? $context["success"] : null), 0)) : (0)), "html", null, true);
        echo ";
    \$(function(){
        if(success == 1)
            \$('.alert-success').show();
    })

    function send(){
            var players = \$(\"#players\").val().replace(/\\s+/g,'');
            if(players == ''){
                alert('请填写玩家uid,逗号分割');
                return;
            }

            var title = \$(\"#title\").val().replace(/\\s+/g,'');
            if(title == ''){
                alert('请填标题');
                return;
            }

            var content = \$(\"#content\").val().replace(/\\s+/g,'');
            if(content == ''){
                alert('请填内容');
                return;
            }

            \$(\"#form_sample_2\").submit();
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "player_user_messages.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  282 => 178,  279 => 177,  276 => 176,  270 => 172,  267 => 171,  244 => 150,  233 => 148,  229 => 147,  213 => 133,  202 => 131,  198 => 130,  183 => 117,  172 => 115,  168 => 114,  153 => 101,  142 => 99,  138 => 98,  55 => 17,  52 => 16,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
