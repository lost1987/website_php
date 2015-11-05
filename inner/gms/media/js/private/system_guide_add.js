/**
 * Created by shameless on 15/6/10.
 */
$(function () {
    $(".form_datetime").datepicker({
        format: "yyyy-mm-dd",
        pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
        language: 'zh-CN',
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
    });
});

function addImage() {
    var imageStr = '<div class="row-fluid"><div class="span12">' +
        '<div class="control-group">' +
        '<label class="control-label"><b class="midnight">图片</b><span class="required"></span></label> ' +
        '&nbsp;&nbsp;&nbsp; &nbsp; ' +
        '<b class="midnight">(190px * 130px)并且文件大小小于512KB</b> ' +
        '<div class="controls">' +
        '<input type="file" name="image[]" /><a href="javascript:;" class="btn mini white" onclick="removeImage(this)"><i class="icon-remove"></i></a>' +
        '<br/><input type="text" name="url[]" value="" placeHolder="url地址" />'
        '</div>' +
        '</div> ' +
        '</div> ' +
        '</div>';

    $(imageStr).insertBefore($(".form-actions"));
}

function removeImage(node) {
    $(node).parent().parent().parent().remove();
}

function doSubmit() {
	
    var name = $("#name").val();
    if (name == '') {
        alert('请填写公告名称');
        return;
    }

    var expired_time = $("#expired_time").val();
    if (expired_time == ''){
        alert('请选择过期时间');
        return;
    }
    

    var imageOk = true;
    $("input:file").each(function () {
        if ($(this).val() == undefined || $(this).val() == '') {
            alert('请选择图片');
            imageOk = false;
            return false;
        }
    })
    


    if (imageOk)
        $("#form_sample_2").submit();
}