var current_del_id ;
function confirm_del(module_id) {
    $('#myModal').modal({
        keyboard: true
    });
    current_del_id = module_id;
}

function del(){
    $("#myModal").modal('hide');
    window.location.href = '/module/del/7/'+current_del_id;
}

function cancel_del(){
    $("#myModal").modal('hide');
    current_del_id = undefined;
}
