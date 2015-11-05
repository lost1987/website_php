<?php

/* excode_bank.html */
class __TwigTemplate_f379f80c71bf18404abe9472ce12d52c898077c34e8332a234a0df9e5cb1a09c extends Twig_Template
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
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\">
    <title>购物券兑换-银行卡提现</title>
    <!-- Bootstrap core CSS -->
    <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/css/bootstrap.min.css\" rel=\"stylesheet\">
    <script src=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/jquery.min.js\" ></script>
    <script src=\"";
        // line 10
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/js/common/jquery.ext.js\" ></script>
</head>
<style>
    /*媒体查询适配小屏幕**/
    @media screen and (min-width:0px) and (max-width:768px){
        .control-label{
            line-height: 30px;/**修正小屏幕label上下无法对齐**/
        }
    }

    @media screen and (min-width:0px) and (max-width:768px){
        .title{
            width: 200px;
        }

        input
        {
            height:40px !important;
            width: 200px;
            margin-top:5px !important;
            font-size:14px;
            margin-bottom: 10px;
        }

        button{
            width: 160px;
            height: 59px;
            margin-top:25px;
        }

        .btn{
            font-size: 18px !important;
        }

        .kefu{
            margin-top:40px;
            color:white;
        }

        .qq{
            color:white;
        }
    }

    @media screen and (min-width:768px) and (max-width:1080px){
        .title{
            width: 300px;
        }

        input
        {
            height:40px !important;
            width: 400px;
            margin-top:10px !important;
            font-size:20px;
            margin-bottom: 10px;
        }

        button{
            width: 160px;
            height: 59px;
            margin-top:40px;
        }

        .btn{
            font-size: 24px !important;
        }

        .kefu{
            margin-top:50px;
            color:white;
        }

        .qq{
            color:white;
        }
    }

    @media screen and (min-width:1080px) and (max-width:3080px){
        .title{
            width: 300px;
        }

        input
        {
            height:50px !important;
            width: 400px;
            margin-top:10px !important;
            margin-bottom: 10px;
        }

        button{
            width: 160px;
            height: 59px;
            margin-top:10px !important;
            font-size:24px;
            margin-bottom: 10px;
        }

        .btn{
            font-size: 24px !important;
        }

        .kefu{
            margin-top:150px;
            color:white;
        }

        .qq{
            color:white;
        }
    }
    body{
        background-color: #006d8a;
    }

</style>
<body>

<div class=\"container-fluid\">
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class=\"row\" style=\"margin-top:30px;\">
        <div class=\"col-xs-4 col-sm-4 col-md-4 \"> </div>
        <div class=\"col-xs-4 col-sm-4 col-md-4 \" style=\"text-align: center;color:rgb(156,232,236)\">
            <h2>请填写您的收款信息</h2>
        </div>
        <div class=\"col-xs-4 col-sm-4 col-md-4\"> </div>
    </div>
    <div class=\"row\" style=\"margin-top:30px;\">
        <div class=\"col-xs-12 col-sm-12 col-md-12\">
            <form class=\"form-horizontal\" action=\"/ex/excodeValidate\" method=\"post\" id=\"_form\">
                <input type=\"hidden\" value=\"";
        // line 141
        echo twig_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : null), "html", null, true);
        echo "\" name=\"type\" />
                <input type=\"hidden\" value=\"";
        // line 142
        echo twig_escape_filter($this->env, (isset($context["pp"]) ? $context["pp"] : null), "html", null, true);
        echo "\" name=\"pp\" />
                <input type=\"hidden\" value=\"";
        // line 143
        echo twig_escape_filter($this->env, (isset($context["excode"]) ? $context["excode"] : null), "html", null, true);
        echo "\" name=\"excode\" />
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"bank_no\"  id=\"bank_no\" class=\"form-control\" placeholder=\"请输入您的银行卡号\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"bank_no_again\" id=\"bank_no_again\" class=\"form-control\" placeholder=\"请再次输入您的银行卡号\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"bank_name\"  id=\"bank_name\" class=\"form-control\" placeholder=\"开户银行\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"name\" id=\"name\" class=\"form-control\" placeholder=\"收款人姓名\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"mobile\" id=\"mobile\" class=\"form-control\" placeholder=\"手机号\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center\">
                        <input type=\"text\" name=\"qq\" id=\"qq\" class=\"form-control\" placeholder=\"QQ号\" />
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-4   col-md-offset-4\" style=\"text-align: center;color:white\">

                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"col-md-2   col-md-offset-5\" style=\"text-align: center\">
                        <button type=\"button\" class=\"btn btn-default btn-block\" onclick=\"doSubmit()\">提交</button>
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\"kefu\" style=\"text-align: center\">
                        客服电话:17092775719
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class=\" qq\" style=\"text-align: center\">
                        QQ:3148250047
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    function doSubmit(){
        var bank_no = document.getElementById('bank_no').value.replace(/\\s+/g,'');
        if(bank_no == '' || !luhmCheck(bank_no))
        {
            alert('请输入正确的银行卡号');
            return;
        }
        var bank_no_again = document.getElementById('bank_no_again').value.replace(/\\s+/g,'');
        if(bank_no_again == '')
        {
            alert('请再次输入银行卡号');
            return;
        }

        if(bank_no != bank_no_again){
            alert('两次输入的银行卡号不一致');
            return;
        }

        var bank_name = document.getElementById('bank_name').value.replace(/\\s+/g,'');
        if(bank_name == '')
        {
            alert('请输入开户银行');
            return;
        }

        var name = document.getElementById('name').value.replace(/\\s+/g,'');
        if(name == '')
        {
            alert('请输入收款人姓名');
            return;
        }
        var mobile = document.getElementById('mobile').value.replace(/\\s+/g,'');
        if(mobile == '' || !\$.is_mobile(mobile))
        {
            alert('请输入手机号');
            return;
        }
        var qq = document.getElementById('qq').value.replace(/\\s+/g,'');
        if(qq == '')
        {
            alert('请输入qq号');
            return;
        }

        document.getElementById('_form').submit();
    }

    function luhmCheck(bankno){
        if (bankno.length < 16 || bankno.length > 19) {
            //\$(\"#banknoInfo\").html(\"银行卡号长度必须在16到19之间\");
            return false;
        }
        var num = /^\\d*\$/;  //全数字
        if (!num.exec(bankno)) {
            //\$(\"#banknoInfo\").html(\"银行卡号必须全为数字\");
            return false;
        }
        //开头6位
        var strBin=\"10,18,30,35,37,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,58,60,62,65,68,69,84,87,88,94,95,98,99\";
        if (strBin.indexOf(bankno.substring(0, 2))== -1) {
            //\$(\"#banknoInfo\").html(\"银行卡号开头6位不符合规范\");
            return false;
        }
        var lastNum=bankno.substr(bankno.length-1,1);//取出最后一位（与luhm进行比较）

        var first15Num=bankno.substr(0,bankno.length-1);//前15或18位
        var newArr=new Array();
        for(var i=first15Num.length-1;i>-1;i--){    //前15或18位倒序存进数组
            newArr.push(first15Num.substr(i,1));
        }
        var arrJiShu=new Array();  //奇数位*2的积 <9
        var arrJiShu2=new Array(); //奇数位*2的积 >9

        var arrOuShu=new Array();  //偶数位数组
        for(var j=0;j<newArr.length;j++){
            if((j+1)%2==1){//奇数位
                if(parseInt(newArr[j])*2<9)
                    arrJiShu.push(parseInt(newArr[j])*2);
                else
                    arrJiShu2.push(parseInt(newArr[j])*2);
            }
            else //偶数位
                arrOuShu.push(newArr[j]);
        }

        var jishu_child1=new Array();//奇数位*2 >9 的分割之后的数组个位数
        var jishu_child2=new Array();//奇数位*2 >9 的分割之后的数组十位数
        for(var h=0;h<arrJiShu2.length;h++){
            jishu_child1.push(parseInt(arrJiShu2[h])%10);
            jishu_child2.push(parseInt(arrJiShu2[h])/10);
        }

        var sumJiShu=0; //奇数位*2 < 9 的数组之和
        var sumOuShu=0; //偶数位数组之和
        var sumJiShuChild1=0; //奇数位*2 >9 的分割之后的数组个位数之和
        var sumJiShuChild2=0; //奇数位*2 >9 的分割之后的数组十位数之和
        var sumTotal=0;
        for(var m=0;m<arrJiShu.length;m++){
            sumJiShu=sumJiShu+parseInt(arrJiShu[m]);
        }

        for(var n=0;n<arrOuShu.length;n++){
            sumOuShu=sumOuShu+parseInt(arrOuShu[n]);
        }

        for(var p=0;p<jishu_child1.length;p++){
            sumJiShuChild1=sumJiShuChild1+parseInt(jishu_child1[p]);
            sumJiShuChild2=sumJiShuChild2+parseInt(jishu_child2[p]);
        }
        //计算总和
        sumTotal=parseInt(sumJiShu)+parseInt(sumOuShu)+parseInt(sumJiShuChild1)+parseInt(sumJiShuChild2);

        //计算Luhm值
        var k= parseInt(sumTotal)%10==0?10:parseInt(sumTotal)%10;
        var luhm= 10-k;

        if(lastNum==luhm){
            \$(\"#banknoInfo\").html(\"Luhm验证通过\");
            return true;
        }
        else{
            \$(\"#banknoInfo\").html(\"银行卡号必须符合Luhm校验\");
            return false;
        }
    }
</script>
</html>";
    }

    public function getTemplateName()
    {
        return "excode_bank.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 143,  174 => 142,  170 => 141,  36 => 10,  32 => 9,  28 => 8,  19 => 1,);
    }
}
