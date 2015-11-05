/**
 * Created by shameless on 15/3/26.
 */
var action='/comissioner/index',data='',args=new Object();
function doSearch(){
    var search_nickname = $("#search_nickname").val();
    data = 'nickname='+search_nickname;
    args.url = action;
    args.data = data;
    return args;
}

function selfRatioApply(uid){
    $.iAjax('/comissioner/ratioApply','uid='+uid+"&type=1",function(response){
        $("#comment").html('待审核');
        $("#comment").unbind();
        $("#selfApplyBtn").attr('disabled',true);
        $.alert('您的申请已提交,请等待工作人员处理!');
    },'POST');
}

function childRatioApply(uid,node){
    $.iAjax('/comissioner/ratioApply','uid='+uid+"&type=2",function(response){
        $(node).attr('disabled',true);
        $.alert('您的下线福利申请已提交,请等待工作人员处理!');
    },'POST');
}

function showChildrenVigrous(){
    $.iAjax('/comissioner/vigrousChildren',"",function(response){
        $(".admin-content").html(response);
    },'POST');
}