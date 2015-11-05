/**
 * Created by shameless on 14/10/31.
 */
var FormValidation = function () {


    return {
        //main function to initiate the module
        init: function () {

            var form2 = $('#form_sample_2');
            var error2 = $('.alert-error', form2);
            var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    product_type:{
                        required:true
                    },
                    category_id: {
                        required: true
                    },
                    item_additional_num:
                    {
                        required:true,
                        number:true
                    },
                    price: {
                        required: true,
                        number:true
                    },
                    price_type: {
                        required: true
                    },
                    tool: {
                        required: true,
                        number:true
                    },
                    tool_type: {
                        required: true
                    },
                    image:{
                        required:true
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    name: {
                        minlength:"至少输入2个字",
                        required: "这是必填项"
                    },
                    product_type:{
                        required: "这是必填项"
                    },
                    category_id: {
                        required: "这是必填项"
                    },
                    item_additional_num:
                    {
                        required: "这是必填项",
                        number:'只能输入数字'
                    },
                    price: {
                        required: "这是必填项",
                        number:'只能输入数字'
                    },
                    price_type: {
                        required: "这是必填项"
                    },
                    tool: {
                        required: "这是必填项",
                        number:"只能输入数字"
                    },
                    tool_type: {
                        required: "这是必填项"
                    },
                    image:{
                        required:"请上传图片"
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "education") { // for chosen elements, need to insert the error after the chosen container
                        error.insertAfter("#form_2_education_chzn");
                    } else if (element.attr("name") == "membership") { // for uniform radio buttons, insert the after the given container
                        error.addClass("no-left-padding").insertAfter("#form_2_membership_error");
                    } else if (element.attr("name") == "service") { // for uniform checkboxes, insert the after the given container
                        error.addClass("no-left-padding").insertAfter("#form_2_service_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavoir
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success2.hide();
                    error2.show();
                    App.scrollTo(error2, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.help-inline').removeClass('ok'); // display OK icon
                    $(element)
                        .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change dony by hightlight
                    $(element)
                        .closest('.control-group').removeClass('error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "service" || label.attr("for") == "membership") { // for checkboxes and radip buttons, no need to show OK icon
                        label
                            .closest('.control-group').removeClass('error').addClass('success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                            .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success2.show();
                    error2.hide();
                    var image = $("#image").val();
                    if(action_name == '添加'){
                        if(image == ''){
                            success2.hide();
                            error2.show();
                            return;
                        }
                    }
                    form.submit();
                }

            });

            //apply validation on chosen dropdown value change, this only needed for chosen dropdown integration.
            $('.chosen, .chosen-with-diselect', form2).change(function () {
                form2.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });

            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('.select2', form2).change(function () {
                form2.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });

        }

    };

}();

var handleDatetimePicker = function () {

    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
        language:'zh-CN',
        autoclose: true,
        todayBtn: true,
        todayHighlight:true
    });

    $(".form_advance_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        autoclose: true,
        todayBtn: true,
        startDate: "2013-02-14 10:00",
        pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
        minuteStep: 10
    });

    $(".form_meridian_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        showMeridian: true,
        autoclose: true,
        pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
        todayBtn: true
    });
}