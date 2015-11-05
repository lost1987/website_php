<?php

/* store_products_add.html */
class __TwigTemplate_ce061ce8af38ba3e710cde68d895b0b1ddba52275b915cbc1a37dffb519af0f9 extends Twig_Template
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
        echo twig_escape_filter($this->env, (isset($context["action_name"]) ? $context["action_name"] : null), "html", null, true);
        echo "商品
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
            商品管理
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
                <div class=\"caption\"><i class=\"icon-reorder\">";
        // line 34
        echo twig_escape_filter($this->env, (isset($context["action_name"]) ? $context["action_name"] : null), "html", null, true);
        echo "商品</i></div>
                <div class=\"tools\">
                    <a href=\"javascript:;\" class=\"collapse\"></a>
                    <a href=\"#portlet-config\" data-toggle=\"modal\" class=\"config\"></a>
                    <a href=\"javascript:;\" class=\"reload\"></a>
                    <a href=\"javascript:;\" class=\"remove\"></a>
                </div>
            </div>


            <div class=\"portlet-body form\">
                <!-- BEGIN FORM-->
                <form action=\"";
        // line 46
        echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : null), "html", null, true);
        echo "\" id=\"form_sample_2\" class=\"form-horizontal\" method=\"post\" enctype=\"multipart/form-data\">
                    <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 47
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


                <div class=\"row-fluid\">
                    <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">商品名称</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input type=\"text\" name=\"name\" id=\"name\" data-required=\"1\" class=\"span6 m-wrap\" value=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "name", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>
                    </div>

                    <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">商品类型</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <select class=\"span4 m-wrap\" name=\"product_type\" >
                                ";
        // line 74
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["product_types"]) ? $context["product_types"] : null));
        foreach ($context['_seq'] as $context["val"] => $context["name"]) {
            // line 75
            echo "                                    ";
            if (((isset($context["val"]) ? $context["val"] : null) == $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "product_type", array()))) {
                // line 76
                echo "                                        <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "</option>
                                    ";
            } else {
                // line 78
                echo "                                        <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "</option>
                                    ";
            }
            // line 80
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['val'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        echo "                            </select>
                        </div>
                    </div>
                    </div>
                </div>

            <div class=\"row-fluid\">
                <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">商品栏目</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <select class=\"span5 m-wrap\" name=\"category_id\" >
                                ";
        // line 93
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["val"] => $context["category"]) {
            // line 94
            echo "                                ";
            if (($this->getAttribute((isset($context["category"]) ? $context["category"] : null), "id", array()) == $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "category_id", array()))) {
                // line 95
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["category"]) ? $context["category"] : null), "name", array()), "html", null, true);
                echo "</option>
                                ";
            } else {
                // line 97
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["category"]) ? $context["category"] : null), "name", array()), "html", null, true);
                echo "</option>
                                ";
            }
            // line 99
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['val'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 100
        echo "                            </select>
                        </div>
                    </div>
                    </div>

                <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">赠送数量</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input type=\"text\" name=\"additional_num\" id=\"additional_num\" data-required=\"1\" class=\"span6 m-wrap\" value=\"";
        // line 109
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "additional_num", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>
                </div>
                </div>


            <div class=\"row-fluid\">
                <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">价格</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input name=\"price\" type=\"text\" class=\"span4 m-wrap\" value=\"";
        // line 121
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "price", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>
                    </div>

                <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">价格类型</b><span class=\"required\">*</span></label>
                        <div class=\"controls chzn-controls\">
                            <select class=\"span4 m-wrap\" name=\"price_type\">
                                ";
        // line 131
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["price_types"]) ? $context["price_types"] : null));
        foreach ($context['_seq'] as $context["val"] => $context["name"]) {
            // line 132
            echo "                                ";
            if (((isset($context["val"]) ? $context["val"] : null) == $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "price_type", array()))) {
                // line 133
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "</option>
                                ";
            } else {
                // line 135
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "</option>
                                ";
            }
            // line 137
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['val'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 138
        echo "                            </select>
                        </div>
                    </div>
                    </div>
                </div>

            <div class=\"row-fluid\">
                <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">获取</b><span class=\"required\">*</span></label>
                        <div class=\"controls\">
                            <input name=\"tool\" type=\"text\" class=\"span4 m-wrap\" value=\"";
        // line 149
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "tool", array()), "html", null, true);
        echo "\"/>
                        </div>
                    </div>
                    </div>

                <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">获取类型</b><span class=\"required\">*</span></label>
                        <div class=\"controls chzn-controls\">
                            <select class=\"span4 m-wrap\" name=\"tool_type\" >
                                ";
        // line 159
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tool_types"]) ? $context["tool_types"] : null));
        foreach ($context['_seq'] as $context["val"] => $context["name"]) {
            // line 160
            echo "                                ";
            if (((isset($context["val"]) ? $context["val"] : null) == $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "tool_type", array()))) {
                // line 161
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\" selected=\"selected\">";
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "</option>
                                ";
            } else {
                // line 163
                echo "                                <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["val"]) ? $context["val"] : null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
                echo "</option>
                                ";
            }
            // line 165
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['val'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 166
        echo "                            </select>
                        </div>
                    </div>
                    </div>
                </div>


            <div class=\"row-fluid\">
                <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">可见</b></label>
                        <div class=\"controls chzn-controls\">
                            <select class=\"span4 m-wrap\" name=\"is_visible\" >
                                ";
        // line 179
        if ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "is_visible", array())) {
            // line 180
            echo "                                <option value=\"0\" >否</option>
                                <option value=\"1\" selected=\"selected\">是</option>
                                ";
        } else {
            // line 183
            echo "                                <option value=\"0\" selected=\"selected\">否</option>
                                <option value=\"1\">是</option>
                                ";
        }
        // line 186
        echo "                            </select>
                        </div>
                    </div>
                </div>

                <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">置顶</b></label>
                        <div class=\"controls chzn-controls\">
                            <select class=\"span4 m-wrap\" name=\"is_top\" >
                                ";
        // line 196
        if ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "is_top", array())) {
            // line 197
            echo "                                <option value=\"0\" >否</option>
                                <option value=\"1\" selected=\"selected\">是</option>
                                ";
        } else {
            // line 200
            echo "                                <option value=\"0\" selected=\"selected\">否</option>
                                <option value=\"1\">是</option>
                                ";
        }
        // line 203
        echo "                            </select>
                        </div>
                    </div>
                    </div>
                </div>

            <div class=\"row-fluid\">
                <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">推荐</b></label>
                        <div class=\"controls chzn-controls\">
                            <select class=\"span4 m-wrap\" name=\"is_promote\" >
                                ";
        // line 215
        if ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "is_promote", array())) {
            // line 216
            echo "                                <option value=\"0\" >否</option>
                                <option value=\"1\" selected=\"selected\">是</option>
                                ";
        } else {
            // line 219
            echo "                                <option value=\"0\" selected=\"selected\">否</option>
                                <option value=\"1\">是</option>
                                ";
        }
        // line 222
        echo "                            </select>
                        </div>
                    </div>
                </div>

                <div class=\"span6\">
                    <div class=\"control-group\">
                        <label class=\"control-label\"><b class=\"midnight\">置顶时间</b></label>
                        <div class=\"controls\">
                            <div class=\"input-append date form_datetime\">
                                <input size=\"16\" type=\"text\" value=\"";
        // line 232
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "top_timestamp", array()), "html", null, true);
        echo "\" name=\"top_timestamp\" readonly class=\"m-wrap\">
                                <span class=\"add-on\"><i class=\"icon-calendar\"></i></span>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                  <div class=\"row-fluid\">
                      <div class=\"span6\">
                          <div class=\"control-group\">
                              <label class=\"control-label\"><b class=\"midnight\">商品图片</b><span class=\"required\">*</span></label>
                              &nbsp;&nbsp;&nbsp; &nbsp;
                              <b class=\"midnight\">(206px * 183px)并且文件大小小于100KB</b>
                              <div class=\"controls\">
                                  <div class=\"fileupload fileupload-new\" data-provides=\"fileupload\">
                                      <div class=\"fileupload-new thumbnail\" style=\"width: 200px;\">
                                          <img src=\"";
        // line 249
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "image", array()), "html", null, true);
        echo "\" rel=\"image-upload\" />
                                      </div>
                                      <div class=\"fileupload-preview fileupload-exists thumbnail\" style=\"max-width: 200px;  line-height: 20px;\"></div>
                                      <div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"btn btn-file\"><span class=\"fileupload-new\">浏览</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"fileupload-exists\">重选</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"file\" class=\"default\" name=\"image\" id=\"image\" accept=\"image/gif,image/jpeg,image/png\" />
                                                    </span>
                                          <a href=\"#\" class=\"btn fileupload-exists\" data-dismiss=\"fileupload\">删除</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class=\"span6\">
                          <div class=\"control-group\">
                              <label class=\"control-label\"><b class=\"midnight\">vip打折</b></label>
                              <div class=\"controls chzn-controls\">
                                  <select class=\"span4 m-wrap\" name=\"is_promote\" >
                                      ";
        // line 269
        if ($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "vip_discount", array())) {
            // line 270
            echo "                                      <option value=\"0\" >否</option>
                                      <option value=\"1\" selected=\"selected\">是</option>
                                      ";
        } else {
            // line 273
            echo "                                      <option value=\"0\" selected=\"selected\">否</option>
                                      <option value=\"1\">是</option>
                                      ";
        }
        // line 276
        echo "                                  </select>
                              </div>
                          </div>
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

    // line 296
    public function block_javascript_plugins($context, array $blocks = array())
    {
        // line 297
        echo "<script type=\"text/javascript\" src=\"/media/js/jquery.validate.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/additional-methods.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/select2.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/chosen.jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datetimepicker.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-datetimepicker.zh-CN.js\"></script>
<script type=\"text/javascript\" src=\"/media/js/bootstrap-fileupload.js\"></script>
";
    }

    // line 306
    public function block_javascript_custom($context, array $blocks = array())
    {
        // line 307
        echo "<script type=\"text/javascript\" src=\"/media/js/private/store_products_add.js\"></script>
<script>
    var action_name = '";
        // line 309
        echo twig_escape_filter($this->env, (isset($context["action_name"]) ? $context["action_name"] : null), "html", null, true);
        echo "';
    var success = ";
        // line 310
        echo twig_escape_filter($this->env, (isset($context["success"]) ? $context["success"] : null), "html", null, true);
        echo ";
    \$(function(){
        FormValidation.init();
        handleDatetimePicker();
        if(success == 1)
            \$('.alert-success').show();

        ";
        // line 317
        if (((isset($context["action_name"]) ? $context["action_name"] : null) == "编辑")) {
            // line 318
            echo "            //编辑时 删除图片验证规则
            \$(\"#image\").rules('remove');
            ";
        }
        // line 321
        echo "    })
</script>
";
    }

    public function getTemplateName()
    {
        return "store_products_add.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  530 => 321,  525 => 318,  523 => 317,  513 => 310,  509 => 309,  505 => 307,  502 => 306,  491 => 297,  488 => 296,  466 => 276,  461 => 273,  456 => 270,  454 => 269,  431 => 249,  411 => 232,  399 => 222,  394 => 219,  389 => 216,  387 => 215,  373 => 203,  368 => 200,  363 => 197,  361 => 196,  349 => 186,  344 => 183,  339 => 180,  337 => 179,  322 => 166,  316 => 165,  308 => 163,  300 => 161,  297 => 160,  293 => 159,  280 => 149,  267 => 138,  261 => 137,  253 => 135,  245 => 133,  242 => 132,  238 => 131,  225 => 121,  210 => 109,  199 => 100,  193 => 99,  185 => 97,  177 => 95,  174 => 94,  170 => 93,  156 => 81,  150 => 80,  142 => 78,  134 => 76,  131 => 75,  127 => 74,  114 => 64,  94 => 47,  90 => 46,  75 => 34,  56 => 17,  53 => 16,  44 => 8,  41 => 7,  35 => 4,  32 => 3,);
    }
}
