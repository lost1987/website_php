/**
 * Created by shameless on 15/1/14.
 */
var action='/user/lists',data='',args=new Object(),comissionerUid,comissionerLoginName,comissionerNode;
function doSearch(){
    var search_user = $("#search_user").val();
    var search_comissioner = $("#search_comissioner").val();
    data = 'search_user='+search_user+'&search_comissioner='+search_comissioner;
    args.url = action;
    args.data = data;
    return args;
}

$(function(){
    setTimeout('$(".select2").select2()',400);

    //触发下啦按钮 并且解决挡住按钮的bug
    var dropdowns = $('.common-btn-drop').dropdown({justify: '.common-btn-drop'});
    dropdowns.each(function(){
        var windowHeight = $(window).height();
        $(this).on('open.dropdown.amui', function (e) {
            if(windowHeight - $(this).offset().top < windowHeight/2.5){
                $(this).addClass('am-dropdown-up');
            }else{
                $(this).removeClass('am-dropdown-up');
            }
        });
    });

    initComissionerRatioForm();
    initComissionerProfileForm();
});

function setReward(uid){
    $.iAjax('/user/readReward','uid='+uid,function(data){
            $('.admin-content').html(data);
    });
}

function depositApply(uid){
    $.iAjax('/user/depositList','search_uid='+uid,function(data){
        $('.admin-content').html(data);
    });
}

function findChildren(uid){
    $.iAjax('/user/children','uid='+uid,function(data){
        $('.admin-content').html(data);
    });
}

function forbidden(uid,node){
    $.confirm("提示","确定要这么做吗?",function(){
        $.iAjax('/user/forbidden','uid='+uid,function(response){
            $(node).parent().parent().parent().parent().parent().find('td[rel="ajax_state"]').html('禁止提现');
        },'POST');
    });
}

function unForbidden(uid,node){
    $.confirm("提示","确定要这么做吗?",function(){
        $.iAjax('/user/unForbidden','uid='+uid,function(response){
            $(node).parent().parent().parent().parent().parent().find('td[rel="ajax_state"]').html('正常');
        },'POST');
    });
}

function detail(uid){
    $.iAjax('/user/newCoinsDetail','uid='+uid,function(data){
        $('.admin-content').html(data);
    });
}

function initComissionerRatioForm(){
    $("#ComissionerRatioModal").find('form').eq(0).validate({
        rules:{
            ratio_stage0:{
                required:true,
                number:true,
                range:[0,1]
            },
            ratio_stage10:{
                required:true,
                number:true,
                range:[0,1]
            },
            ratio_stage30:{
                required:true,
                number:true,
                range:[0,1]
            },
            ratio_stage60:{
                required:true,
                number:true,
                range:[0,1]
            },
            ratio_stage100:{
                required:true,
                number:true,
                range:[0,1]
            }
        },
        messages:{
            ratio_stage0:{
                required:"输入0-1之间的小数",
                number:"输入0-1之间的小数",
                range:"输入0-1之间的小数"
            },
            ratio_stage10:{
                required:"输入0-1之间的小数",
                number:"输入0-1之间的小数",
                range:"输入0-1之间的小数"
            },
            ratio_stage30:{
                required:"输入0-1之间的小数",
                number:"输入0-1之间的小数",
                range:"输入0-1之间的小数"
            },
            ratio_stage60:{
                required:"输入0-1之间的小数",
                number:"输入0-1之间的小数",
                range:"输入0-1之间的小数"
            },
            ratio_stage100:{
                required:"输入0-1之间的小数",
                number:"输入0-1之间的小数",
                range:"输入0-1之间的小数"
            }
        },
        errorPlacement: function(error, element) {
            error.css('vertical-align','middle').css('margin-bottom','15px').css('color','red');
            error.appendTo(element.parent());
        },
        debug:true,
        submitHandler:function(form){
            var ratio0 = $("#ratio_stage0").val();
            var ratio10 = $("#ratio_stage10").val();
            var ratio30 = $("#ratio_stage30").val();
            var ratio60 = $("#ratio_stage60").val();
            var ratio100 = $("#ratio_stage100").val();

            var data = "ratio_stage0="+ratio0+"&ratio_stage10="+ratio10+"&ratio_stage30="+ratio30+"&ratio_stage60="+ratio60+"&ratio_stage100="+ratio100+"&uid="+comissionerUid;
            $.iAjax('/user/updateComissionerRatio',data,function(response){
                comissionerUid = undefined;
                $("#ComissionerRatioModal").modal('close');
                $.alert('操作成功');
            },'POST');
        }
    });
}

function setComissionerRatio(uid,login_name){
        $.iAjax('/user/comissionerRatio','uid='+uid,function(response){
            if(response){
                comissionerUid = uid;
                $("#ratio_stage0").val(response.ratio_stage0);
                $("#ratio_stage10").val(response.ratio_stage10);
                $("#ratio_stage30").val(response.ratio_stage30);
                $("#ratio_stage60").val(response.ratio_stage60);
                $("#ratio_stage100").val(response.ratio_stage100);
                $("#SettlementUser").html(login_name);
                $("#ComissionerRatioModal").modal({closeViaDimmer:false});
                $("#ComissionerRatioModal-btn-yes").off('click').click(function(){
                    $("#comissionerRatioSubmitBtn").trigger('click');
                });
            }
        },'POST');
}


function setComissioner(uid,login_name,node){
    $("#SettlementProfile").html(login_name);
    $("#ComissionerProfileModal").modal({closeViaDimmer:false});
    $("#ComissionerProfileModal-btn-yes").off('click').click(function(){
        $("#comissionerProfileSubmitBtn").trigger('click');
    });
    comissionerUid = uid;
    comissionerLoginName = login_name;
    comissionerNode = node;
}


function initComissionerProfileForm(){
    $("#ComissionerProfileModal").find('form').validate({
        rules:{
            profile_mobile:{
                required:true,
                number:true
            },
            profile_qq:{
                required:true,
                number:true
            }
        },
        messages:{
            profile_mobile:{
                required:"输入手机号码",
                number:"输入手机号码"
            },
            profile_qq:{
                required:"输入qq号",
                number:"输入qq号"
            }
        },
        errorPlacement: function(error, element) {
            error.css('vertical-align','middle').css('margin-bottom','15px').css('color','red');
            error.appendTo(element.parent());
        },
        debug:true,
        submitHandler:function(form){
            if(uploadurl == undefined){
                $.alert('请上传身份证图片');return;
            }

            var mobile = $("#profile_mobile").val();
            var qq = $("#profile_qq").val();

            $.confirm("注意","是否要将用户账号为["+comissionerLoginName+"]设为专员?",function(){
                $.iAjax('/user/setComissioner','uid='+comissionerUid+'&mobile='+mobile+"&qq="+qq+'&id_card='+uploadurl,function(data){
                    $("#ComissionerProfileModal").modal('close');
                    $(comissionerNode).parent().parent().parent().parent().parent().find('td[rel="ajax_comissioner"]').find('a')
                    .removeClass('am-badge-primary').addClass('am-badge-danger').html('推广专员');
                    createNewItemForComissioner(comissionerNode,comissionerUid,comissionerLoginName);

                    comissionerUid = undefined;
                    comissionerLoginName = undefined;
                    comissionerNode = undefined;
                    $.alert('操作成功!');
                },'POST');
            });
        }
    });
}

var uploadurl = undefined;
function uploadIDCard(){
        var file = $("#profile_idcard").val();
        if('' == file){
            $.alert('请选择身份证图片');return;
        }

    $("#upIdCardForm").ajaxSubmit({
            dataType:  'json', //数据格式为json
            beforeSend: function() { //开始上传
                $("#upIdCardBtn").find('i').removeClass('am-icon-cloud-upload').addClass('am-icon-spinner am-icon-spin');
                $("#upIdCardBtn").attr('disabled',true);
            },
            success: function(response) { //成功
                //获得后台返回的json数据，显示文件名，大小，以及删除按钮
                $("#upIdCardBtn").find('i').removeClass('am-icon-spinner am-icon-spin').addClass('am-icon-cloud-upload');
                $("#upIdCardBtn").attr('disabled',false);
                uploadurl = response.data.url;
                $.alert('上传成功');
            },
            error:function(xhr){ //上传失败
                $.alert('上传文件失败');
            }
        });
}


function createNewItemForComissioner(comissionerNode,uid,login_name){
    $(comissionerNode).parent().after('<li><a href="javascript:;" onclick="setComissionerRatio('+uid+',\''+login_name+'\')"><i class="am-icon-cogs">&nbsp;</i>设置月结算</a></li> <li><a href="javascript:;" onclick="setComissionerRatio('+uid+',\''+login_name+'\')"><i class="am-icon-list-alt">&nbsp;</i>推广员详情</a></li>');
    $(comissionerNode).remove();
}


function comissionerDetail(uid,login_name){
    $("#SettlementDetailProfile").html(login_name);
    $.iAjax('/user/comissionerDetail','uid='+uid,function(response){
        $("#profile-mobile").html(response.mobile);
        $("#profile-qq").html(response.qq);
        $("#profile-idCard").html('<img src="'+response.id_card+'" />');
        $("#profile-childNum").html(response.childNum);
        $("#ComissionerDetailModal").modal({closeViaDimmer:false});
    },'POST');
}