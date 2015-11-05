/**
 * Created by shameless on 15/8/31.
 */
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
                    RTC_tutorialBonus: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_coinsGivenPerTime:{
                        required:true,
                        digits:true,
                        min:0
                    },
                    RTC_MinRoomDur: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_MaxRoomDur: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_pointMatchRanksTotal: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_PointTOP: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_MaxRoomUsers: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_MaxMinutesLeft: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_MinutesAlert: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_MinAddMinutes: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_BasicLivingCoins: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_BasicLivingCount: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_Junior_Rate: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_Medium_Rate: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_Junior_Prize_Type: {
                        required: true
                    },
                    RTC_Junior_Prize_Num: {
                        required: true,
                        digits:true
                    },
                    RTC_DiaTable_Big_Rate: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_DiaTable_Big_Max_Value: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_DiaTable_Small_Value: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_DiaTable_Cast: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_DiaTable_Big_Min_Value: {
                        required: true,
                        digits:true,
                        min:100
                    },
                    RTC_MinCoinsJunior: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    RTC_MinCoinsMedium: {
                        required: true,
                        digits:true,
                        min:0
                    },
                    cheat_value_begin_dia: {
                        required: true,
                        digits:true
                    },
                    cheat_value_end_dia: {
                        required: true,
                        digits:true
                    },
                },

                messages: { // custom messages for radio buttons and checkboxes
                    RTC_tutorialBonus: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_coinsGivenPerTime:{
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_MinRoomDur: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_MaxRoomDur: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_pointMatchRanksTotal: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_PointTOP: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_MaxRoomUsers: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_MaxMinutesLeft: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_MinutesAlert: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_MinAddMinutes: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_BasicLivingCoins: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_BasicLivingCount: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_MinCoinsJunior: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    RTC_MinCoinsMedium: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                        min:"必须大于0"
                    },
                    cheat_value_begin_dia: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                    },
                    cheat_value_end_dia: {
                        required: "这是必填项",
                        digits:"必须输入整数",
                    },
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



            //form-game
            var formGame= $('#form_sample_game');
            var errorGame = $('.alert-error', formGame);
            var successGame = $('.alert-success', formGame);

            formGame.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    RTC_Junior_Prize_Begin_Min: {
                        required: true,
                        digits:true
                    },
                    RTC_Junior_Prize_Begin_MAX: {
                        required: true,
                        digits:true
                    },
                    RTC_Medium_Prize_Type: {
                        required: true
                    },
                    RTC_Medium_Prize_Num: {
                        required: true,
                        digits:true
                    },
                    RTC_Medium_Prize_Begin_Min: {
                        required: true,
                        digits:true
                    },
                    RTC_Medium_Prize_Begin_MAX: {
                        required: true,
                        digits:true
                    },
                    RTC_DiaTable_TaxRate: {
                        required: true,
                        digits:true
                    },
                    RTC_DidTable_Enter_Diamonds:{
                        required: true,
                        digits:true
                    },
                    RTC_DiaTable_CanWin_Double:{
                        required: true,
                        digits:true,
                        range:[0,10]
                    },
                    RTC_DiaTable_Rate:{
                        required: true,
                        digits:true,
                        range:[1,88]
                    },
                    RTC_DiaTable_BasePoint:{
                        required: true,
                        digits:true,
                        range:[1,100]
                    },
                    RTC_DiaTable_WinTop:{
                        required: true,
                        digits:true,
                    },
                    RTC_Junior_Prize_Begin_INC:{
                        required:true,
                        digits:true
                    },
                    RTC_Medium_Prize_Begin_INC:{
                        required:true,
                        digits:true
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    RTC_Junior_Prize_Begin_Min: {
                        required: "这是必填项",
                        digits:"必须输入整数"
                    },
                    RTC_Junior_Prize_Begin_MAX: {
                        required: "这是必填项",
                        digits:"必须输入整数"
                    },
                    RTC_Medium_Prize_Type: {
                        required: "这是必填项",
                    },
                    RTC_Medium_Prize_Num: {
                        required: "这是必填项",
                        digits:"必须输入整数"
                    },
                    RTC_Medium_Prize_Begin_Min: {
                        required: "这是必填项",
                        digits:"必须输入整数"
                    },
                    RTC_Medium_Prize_Begin_MAX: {
                        required: "这是必填项",
                        digits:"必须输入整数"
                    },
                    RTC_DiaTable_TaxRate: {
                        required: "这是必填项",
                        digits:"必须输入整数"
                    },
                    RTC_DidTable_Enter_Diamonds:{
                        required: "这是必填项",
                        digits:"必须输入整数"
                    },
                    RTC_DiaTable_CanWin_Double:{
                        required: "这是必填项",
                        digits:"必须输入整数",
                        range:"输入0-10"
                    },
                    RTC_DiaTable_Rate:{
                        required: "这是必填项",
                        digits:"必须输入整数",
                        range:"输入1-88"
                    },
                    RTC_DiaTable_BasePoint:{
                        required: "这是必填项",
                        digits:"必须输入整数",
                        range:"输入1-100"
                    },
                    RTC_DiaTable_WinTop:{
                        required: "这是必填项",
                        digits:"必须输入整数"
                    },
                    RTC_Junior_Prize_Begin_INC:{
                        required: "这是必填项",
                        digits:"必须输入整数"
                    },
                    RTC_Medium_Prize_Begin_INC:{
                        required: "这是必填项",
                        digits:"必须输入整数"
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
                    successGame.hide();
                    errorGame.show();
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
                    successGame.show();
                    errorGame.hide();
                    form.submit();
                }

            });

            //apply validation on chosen dropdown value change, this only needed for chosen dropdown integration.
            $('.chosen, .chosen-with-diselect', formGame).change(function () {
                formGame.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });

            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('.select2', formGame).change(function () {
                formGame.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
        }
    };
}();
