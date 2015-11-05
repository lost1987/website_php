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
                    account: {
                        minlength: 5,
                        required: true,
                        remote: {
                            url: '/login/check_account_toggle',
                            type: 'post',
                            dataType: 'html',
                            data: {
                                username: function () {
                                    return $("#account").val();
                                }
                            }
                        }
                    },
                    nickname:{
                        required:true
                    },
                    password: {
                        minlength:5,
                        required: true
                    },
                    re_password: {
                        required: true,
                        equalTo:"#password"
                    },
                    superman: {
                        required: true
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    account:{
                        required:"这是必填项"
                    },
                    nickname:{
                        required:"这是必填项"
                    },
                    password: {
                        minlength:"密码长度最少5位",
                        required:"这是必填项"
                    },
                    re_password: {
                        required:"这是必填项",
                        equalTo:"两次输入的密码不匹配"
                    },
                    superman: {
                        required: "这是必填项"
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

                    $("#password").val( md5($("#password").val()) );
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