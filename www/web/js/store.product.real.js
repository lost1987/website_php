var name,address,mobile;$(function(){jQuery.validator.addMethod("mobile",function(b,a,c){if(c){if($.is_mobile(b)){return true}return false}},"请输入正确的手机号码");$("#exchangeForm").validate({rules:{realName:{required:true,rangelength:[2,5]},mobile:{required:true,mobile:true},reMobile:{required:true,mobile:true,equalTo:"#mobile"},password:{required:true,rangelength:[6,16]},address:{required:true}},messages:{realName:{required:"请输入真实姓名",rangelength:"格式错误"},mobile:{required:"请输入手机号",rangelength:"格式错误"},reMobile:{required:"请输入手机号",rangelength:"格式错误",equalTo:"两次输入的密码不一致"},password:{required:"请输入消费密码",rangelength:"消费密码不合规则"},address:{required:"请输入收货地址"}},errorPlacement:function(a,b){$(a).appendTo($(b).parent().parent())},success:function(a){$(a).html('<img src="../../../../images/icons/icon_accept.png" />')},submitHandler:function(a){name=$("#realName").val();mobile=$("#mobile").val();address=$("#address").val();$("#confirm-name").html(name);$("#confirm-mobile").html(mobile);$("#confirm-address").html(address);$("#confirmModal").modal()}})});function exchange(){$("#exBtn").attr("disabled",true);var a=md5($("#password").val());var c=$("#token").val();var b=$("#product_id").val();var d="name="+name+"&mobile="+mobile+"&address="+address+"&password="+a+"&csrf_token="+c;$.post("/store/purchase/"+b,d,function(f){f=$.parseJson(f);if(f!="error"){var e=$("#category_id").val();window.location.href="/store/done/"+b+"/"+e}else{$("#exBtn").attr("disabled",false);$("#confirmModal").modal("hide")}})};