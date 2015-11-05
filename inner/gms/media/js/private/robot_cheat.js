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
                    cheat_lv1_rate: {
                        required: true,
                        range:[0,100]
                    },
                    cheat_lv2_rate:{
                        required:true,
                        range:[0,100]
                    },
                    cheat_lv3_rate: {
                        required: true,
                        range:[0,100]
                    },
                    cheat_step_begin: {
                        required: true
                    },
                    cheat_step_end: {
                        required: true
                    },
                    cheat_value_begin: {
                        required: true
                    },
                    cheat_value_end: {
                        required: true
                    },
                    cheat_increase_rate: {
                        required: true,
                        range:[0,100]
                    },
                    cheat_user_laizis_rate:{
                        required:true,
                        range:[0,100]
                    },
                    cheat_free_lv1_rate: {
                        required: true,
                        range:[0,100]
                    },
                    cheat_free_lv2_rate: {
                        required: true,
                        range:[0,100]
                    },
                    cheat_free_lv3_rate:{
                        required:true,
                        range:[0,100]
                    },
                    RTC_BlackList_Begin_Value:{
                        required:true,
                        digits:true
                    },
                    RTC_BlackList_End_Value:{
                        required:true,
                    },
                    RTC_BlackList_Work_Interval:{
                        required:true,
                        digits:true
                    },
                    RTC_BlackList_Laizi_Rate:{
                        required:true,
                        range:[0,100]
                    },
                    RTC_BlackList_Win_Rate:{
                        required:true,
                        range:[0,100]
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    cheat_lv1_rate: {
                        required: "这是必填项"
                    },
                    cheat_lv2_rate:{
                        required:"这是必填项"
                    },
                    cheat_lv3_rate: {
                        required: "这是必填项"
                    },
                    cheat_step_begin: {
                        required: "这是必填项"
                    },
                    cheat_step_end: {
                        required: "这是必填项"
                    },
                    cheat_value_begin: {
                        required: "这是必填项"
                    },
                    cheat_value_end: {
                        required: "这是必填项"
                    },
                    cheat_increase_rate: {
                        required: "这是必填项"
                    },
                    cheat_user_laizis_rate:{
                        required:"这是必填项"
                    },
                    cheat_free_lv1_rate: {
                        required:"这是必填项"
                    },
                    cheat_free_lv2_rate: {
                        required:"这是必填项"
                    },
                    cheat_free_lv3_rate:{
                        required:"这是必填项"
                    },
                    RTC_BlackList_Begin_Value:{
                        required:'这是必填项',
                        digits:'只能输入数字'
                    },
                    RTC_BlackList_End_Value:{
                        required:'这是必填项'
                    },
                    RTC_BlackList_Work_Interval:{
                        required:'这是必填项',
                        digits:'只能输入数字'
                    },
                    RTC_BlackList_Laizi_Rate:{
                        required:'这是必填项',
                        range:'只能输入0-100的数字'
                    },
                    RTC_BlackList_Win_Rate:{
                        required:'这是必填项',
                        range:'只能输入0-100的数字'
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
