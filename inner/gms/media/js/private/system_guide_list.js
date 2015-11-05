/**
 * Created by shameless on 14/11/21.
 */
var current_del_id ;
function confirm_del(id) {
    $('#myModal').modal({
        keyboard: true
    });
    current_del_id = id;
}

function del(){
    $("#myModal").modal('hide');
    window.location.href = '/system/guideDel/17/'+current_del_id;
}

function cancel_del(){
    $("#myModal").modal('hide');
    current_del_id = undefined;
}