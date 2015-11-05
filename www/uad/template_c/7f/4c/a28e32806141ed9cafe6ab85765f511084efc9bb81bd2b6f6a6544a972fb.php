<?php

/* deposit.html */
class __TwigTemplate_7f4ca28e32806141ed9cafe6ab85765f511084efc9bb81bd2b6f6a6544a972fb extends Twig_Template
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
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/css/select2.min.css\" />

<div class=\"am-cf am-padding\">
    <div class=\"am-fl am-cf\"><strong class=\"am-text-primary am-text-lg\">申请提现</strong>  <small></small></div>
</div>

<div class=\"am-g am-padding\">
    <div class=\"am-u-md-12 am-cf\">
        <div class=\"am-fl am-cf\">
            <label>可提现:&nbsp;&nbsp;</label>
            ";
        // line 11
        if (((isset($context["money"]) ? $context["money"] : null) <= 2)) {
            // line 12
            echo "             <a class=\"am-badge am-badge-danger am-round\" id=\"availDeposit\">￥";
            echo twig_escape_filter($this->env, (isset($context["depositMoney"]) ? $context["depositMoney"] : null), "html", null, true);
            echo "</a><br/><br/>
            ";
        } else {
            // line 14
            echo "             <a class=\"am-badge am-badge-success am-round\" id=\"availDeposit\">￥";
            echo twig_escape_filter($this->env, (isset($context["depositMoney"]) ? $context["depositMoney"] : null), "html", null, true);
            echo "</a><br/><br/>
            ";
        }
        // line 16
        echo "            <form class=\"am-form\" id=\"depositForm\">
                <fieldset>
                <div class=\"am-radio-inline\">
                    <label class=\"am-margin-right-lg\">
                        <input type=\"radio\" name=\"type\" id=\"rdBank\" onclick=\"checkBank(";
        // line 20
        echo twig_escape_filter($this->env, (isset($context["uid"]) ? $context["uid"] : null), "html", null, true);
        echo ")\" value=\"0\" /><img src=\"";
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/images/yinlian.jpg\" width=\"100\">
                    </label>

                    <label>
                        <input type=\"radio\" name=\"type\" id=\"rdAlipay\" onclick=\"checkAlipay(";
        // line 24
        echo twig_escape_filter($this->env, (isset($context["uid"]) ? $context["uid"] : null), "html", null, true);
        echo ")\" value=\"1\"/><img src=\"";
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/images/alipay.jpg\" width=\"100\">
                    </label>
                </div>
                <div class=\"am-form-group am-form-icon am-margin-right-sm\">
                    <label>收款账户</label>
                    <input type=\"text\" name=\"account\" id=\"account\" value=\"\" class=\"am-form-field\" disabled>
                    <span id=\"binding\"></span>
                </div>

                <div class=\"span7 am-margin-bottom-lg\">
                    <label>提现金额</label><br/>
                    <input type=\"text\" name=\"money\" id=\"money\" value=\"\" class=\"am-form-field am-inline-block am-margin-right-sm span5\" placeholder=\"提现金额最低";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["min_deposit_money"]) ? $context["min_deposit_money"] : null), "html", null, true);
        echo "元\">
                    <input type=\"hidden\" id=\"minDepositMoney\" value=\"";
        // line 36
        echo twig_escape_filter($this->env, (isset($context["min_deposit_money"]) ? $context["min_deposit_money"] : null), "html", null, true);
        echo "\" />
                </div>

                <div class=\"span7 am-margin-bottom-lg\">
                    <label>消费密码</label><br/>
                    <input type=\"password\" name=\"purchasePasswd\" id=\"purchasePasswd\" value=\"\" class=\"am-form-field am-inline-block am-margin-right-sm span4\" >
                    <br/><a href=\"";
        // line 42
        echo twig_escape_filter($this->env, twig_constant("WWW_HOST"), "html", null, true);
        echo "/user/payPassword\" target=\"_blank\">找回消费密码</a>
                </div>

                <button type=\"submit\" id=\"search_btn\"  class=\"am-btn am-btn-default submit\">&nbsp;提交</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<div class=\"am-modal am-modal-confirm\" tabindex=\"-1\" id=\"bank-bind-alert\">
    <div class=\"am-modal-dialog\">
        <div class=\"am-modal-hd\" id=\"bank-bind-title\">账户绑定</div>
        <div class=\"am-modal-bd\" id=\"bank-bind-content\">
            <div class=\"am-tabs\" id=\"bind-tabs\">
                <ul class=\"am-tabs-nav am-nav am-nav-tabs\">
                    <li class=\"am-active\"><a href=\"#tab1\">银行卡</a></li>
                </ul>

                <div class=\"am-tabs-bd\">
                    <div class=\"am-tab-panel am-fade am-in am-active\" id=\"tab1\" style=\"background-color: #ffffff\">
                        <form class=\"am-form am-text-left\" id=\"bankForm\">
                            <div class=\"am-margin-right-sm\">
                                <label>开户银行</label><br/>
                                <select name=\"bank_name\" id=\"bank_name\" style=\"font-size: 12px;\" class=\"select2 am-form-field span6 am-inline-block am-margin-bottom-sm am-margin-right-sm\">
                                    ";
        // line 67
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["banks"]) ? $context["banks"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 68
            echo "                                    <option  value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "bank_name", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "bank_name", array()), "html", null, true);
            echo "</option>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "                                </select>
                            </div>

                            <div class=\"am-margin-right-sm\">
                                <label>银行卡号(请输入16或19位银行账号)</label><br/>
                                <input type=\"text\" name=\"card_no\" id=\"card_no\" value=\"\" style=\"width:300px;\" class=\"am-form-field  am-inline-block am-margin-bottom-sm am-margin-right-sm\" >
                            </div>

                            <div class=\"am-margin-right-sm\">
                                <label>收款人姓名</label><br/>
                                <input type=\"text\" name=\"bank_owner_name\" id=\"bank_owner_name\" value=\"\" class=\"am-form-field span4 am-inline-block am-margin-bottom-sm am-margin-right-sm\" >
                            </div>
                            <input type=\"submit\" class=\"submit\" style=\"display:none\" id=\"bankFormSubmit\" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"am-modal-footer\">
            <span class=\"am-modal-btn\" id=\"bank-bind-btn-no\">取消</span>
            <span class=\"am-modal-btn\" id=\"bank-bind-btn-yes\">绑定</span>
        </div>
    </div>
</div>

<div class=\"am-modal am-modal-confirm\" tabindex=\"-1\" id=\"alipay-bind-alert\">
    <div class=\"am-modal-dialog\">
        <div class=\"am-modal-hd\" id=\"alipay-bind-title\">账户绑定支付宝</div>
        <div class=\"am-modal-bd\" id=\"alipay-bind-content\">
            <div class=\"am-tabs\" id=\"bank-bind-tabs\">
                <ul class=\"am-tabs-nav am-nav am-nav-tabs\">
                    <li class=\"am-active\"><a href=\"#tab2\">支付宝</a></li>
                </ul>

                <div class=\"am-tabs-bd\">
                    <div class=\"am-tab-panel am-fade am-in am-active\" id=\"tab2\" style=\"background-color: #ffffff\">
                        <form class=\"am-form am-text-left\" id=\"alipayForm\">
                            <div class=\" am-margin-right-sm\">
                                <label>支付宝账户</label><br/>
                                <input type=\"text\" name=\"alipay_account\" id=\"alipay_account\" value=\"\" class=\"am-form-field span6 am-inline-block am-margin-bottom-sm am-margin-right-sm\" >
                            </div>

                            <div class=\"am-margin-right-sm\">
                                <label>收款人姓名</label><br/>
                                <input type=\"text\" name=\"alipay_owner_name\" id=\"alipay_owner_name\" value=\"\" class=\"am-form-field span4 am-inline-block am-margin-bottom-sm am-margin-right-sm\" >
                            </div>
                            <input type=\"submit\" class=\"submit\" style=\"display:none\" id=\"alipayFormSubmit\" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"am-modal-footer\">
            <span class=\"am-modal-btn\" id=\"alipay-bind-btn-no\">取消</span>
            <span class=\"am-modal-btn\" id=\"alipay-bind-btn-yes\">绑定</span>
        </div>
    </div>
</div>

<script src=\"";
        // line 129
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/md5.min.js\"></script>
<script src=\"";
        // line 130
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/jquery.validate.min.js\"></script>
<script src=\"";
        // line 131
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/lib/select2.min.js\"></script>
<script src=\"";
        // line 132
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/assets/standalone/deposit.js\"></script>";
    }

    public function getTemplateName()
    {
        return "deposit.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  207 => 132,  203 => 131,  199 => 130,  195 => 129,  134 => 70,  123 => 68,  119 => 67,  91 => 42,  82 => 36,  78 => 35,  62 => 24,  53 => 20,  47 => 16,  41 => 14,  35 => 12,  33 => 11,  19 => 1,);
    }
}
