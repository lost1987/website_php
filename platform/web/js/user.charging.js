var login_name,amount_type,token;$(function(){$("input:radio").eq(0).trigger("click")});function doSubmit(){login_name=$("#pay_login_name").val().replace(/\s+/g,"");var a=$("#pay_re_login_name").val().replace(/\s+/g,"");amount_type=$("input:checked").val();token=$("#token").val();if(login_name==""||a==""){$.alert("请输入要充值的账号");return}if(login_name!=a){$.alert("请确认要充值的账号");return}if(amount_type==undefined){$.alert("请选择要充值的金额");return}$("#confirm_login_name").html(login_name);$("#confirm_amount").html(parseInt(amount_type).toFixed(2));$("#toPay").modal()}function pay(){var b=$("#pay_type").val();var a="/payment/go/?login_name="+login_name+"&amount_type="+amount_type+"&pay_type="+b+"&csrf_token="+token;window.location.href=a};