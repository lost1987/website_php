/**
 * Created by shameless on 15/3/24.
 */

function agree(id,uid,login_name,node){
    $.confirm('注意','是否批准账号为[ '+login_name+' ]的奖励申请?',function(){
        $.iAjax('/comissionerApply/agreeChild','id='+id+"&uid="+uid,function(response){
            $(node).parent().parent().parent().parent().find('td[rel="ajax_state"]').html('已生效');
            var curRatioNode = $(node).parent().parent().parent().parent().find('td[rel="ajax_curRatio"]');
            curRatioNode.html(curRatioNode.next().html());
            $(node).parent().parent().parent().parent().find('td[rel="ajax_handle_time"]').html(response.handle_time);
            var btns = $(node).parent().find("button");
            btns.eq(0).attr('disabled',true);
            btns.eq(1).attr('disabled',true);
            $("#ComissionerApplyModal").modal('close');
        },'POST');
    })
}


function disagree(id,login_name,node){
    $("#SettlementUser").html(login_name)
    $("#ComissionerApplyModal").modal({closeViaDimmer:false});
    $("#ComissionerApplyModal-btn-yes").off('click').click(function(){
            var comment = $("#comment").val();
            if(comment.replace(/\s+/g,'') == ''){
                $.alert('请填写驳回原因');
                return;
            }

            $.iAjax('/comissionerApply/disagree','id='+id+"&comment="+comment,function(response){
                    $(node).parent().parent().parent().parent().find('td[rel="ajax_state"]').html('已驳回');
                    $(node).parent().parent().parent().parent().find('td[rel="ajax_handle_time"]').html(response.handle_time);
                    $(node).next().next().val(response.comment);
                    var btns = $(node).parent().find("button");
                    btns.eq(0).attr('disabled',true);
                    btns.eq(1).attr('disabled',true);
                    btns.eq(2).attr('disabled',false);
                    $("#ComissionerApplyModal").modal('close');
            },'POST');
    });
}

function commentDetail(node){
    var comment = $(node).next().val();
    if(comment != '')
        $.alert(comment);
}