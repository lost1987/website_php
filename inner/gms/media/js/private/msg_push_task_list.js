/**
 * Created by shameless on 15/6/30.
 */
var current_del_id ;
function confirm_del(task_id) {
    $('#myModal').modal({
        keyboard: true
    });
    current_del_id = task_id;
}

function del(){
    $("#myModal").modal('hide');
    window.location.href = '/msgPush/taskDel/74/'+current_del_id;
}

function cancel_del(){
    $("#myModal").modal('hide');
    current_del_id = undefined;
}