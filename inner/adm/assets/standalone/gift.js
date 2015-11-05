/**
 * Created by shameless on 15/2/6.
 */
$(function(){
    $("#Form1").validate({
        rules:{
            c:{
                required:true,
                digits:true
            },
            d:{
                required:true,
                digits:true
            },
            t:{
                required:true,
                digits:true
            },
            cp:{
                required:true,
                digits:true
            },
            f:{
                required:true,
                digits:true
            },
            e:{
                required:true,
                digits:true
            },
            h:{
                required:true,
                digits:true
            },
            r:{
                required:true,
                digits:true
            },
            cwd:{
                required:true,
                digits:true
            },
            clh:{
                required:true,
                digits:true
            },
            ced:{
                required:true,
                digits:true
            }
        },
        debug:true,
        submitHandler:function(form){
            var c = $(form).find("input[name='c']").val();
            var d = $(form).find("input[name='d']").val();
            var t = $(form).find("input[name='t']").val();
            var cp = $(form).find("input[name='cp']").val();
            var f = $(form).find("input[name='f']").val();
            var e = $(form).find("input[name='e']").val();
            var h = $(form).find("input[name='h']").val();
            var r = $(form).find("input[name='r']").val();
            var cwd = $(form).find("input[name='cwd']").val();
            var clh= $(form).find("input[name='clh']").val();
            var ced = $(form).find("input[name='ced']").val();
            var id = $("#giftID1").val();
            $.iAjax('/giftBag/update','c='+c+'&d='+d+'&t='+t+'&cp='+cp+'&f='+f+'&e='+e+'&h='+h+'&r='+r+'&cwd='+cwd+'&clh='+clh+'&ced='+ced+'&id='+id,function(response){
                $.alert('提示','设置成功');
            },'POST');
        }
    });


    $("#Form2").validate({
        rules:{
            c:{
                required:true,
                digits:true
            },
            d:{
                required:true,
                digits:true
            },
            t:{
                required:true,
                digits:true
            },
            cp:{
                required:true,
                digits:true
            },
            f:{
                required:true,
                digits:true
            },
            e:{
                required:true,
                digits:true
            },
            h:{
                required:true,
                digits:true
            },
            r:{
                required:true,
                digits:true
            },
            cwd:{
                required:true,
                digits:true
            },
            clh:{
                required:true,
                digits:true
            },
            ced:{
                required:true,
                digits:true
            }
        },
        debug:true,
        submitHandler:function(form){
            var c = $(form).find("input[name='c']").val();
            var d = $(form).find("input[name='d']").val();
            var t = $(form).find("input[name='t']").val();
            var cp = $(form).find("input[name='cp']").val();
            var f = $(form).find("input[name='f']").val();
            var e = $(form).find("input[name='e']").val();
            var h = $(form).find("input[name='h']").val();
            var r = $(form).find("input[name='r']").val();
            var cwd = $(form).find("input[name='cwd']").val();
            var clh= $(form).find("input[name='clh']").val();
            var ced = $(form).find("input[name='ced']").val();
            var id = $("#giftID2").val();
            $.iAjax('/giftBag/update','c='+c+'&d='+d+'&t='+t+'&cp='+cp+'&f='+f+'&e='+e+'&h='+h+'&r='+r+'&cwd='+cwd+'&clh='+clh+'&ced='+ced+'&id='+id,function(response){
                $.alert('提示','设置成功');
            },'POST');
        }
    });


    $("#Form3").validate({
        rules:{
            c:{
                required:true,
                digits:true
            },
            d:{
                required:true,
                digits:true
            },
            t:{
                required:true,
                digits:true
            },
            cp:{
                required:true,
                digits:true
            },
            f:{
                required:true,
                digits:true
            },
            e:{
                required:true,
                digits:true
            },
            h:{
                required:true,
                digits:true
            },
            r:{
                required:true,
                digits:true
            },
            cwd:{
                required:true,
                digits:true
            },
            clh:{
                required:true,
                digits:true
            },
            ced:{
                required:true,
                digits:true
            }
        },
        debug:true,
        submitHandler:function(form){
            var c = $(form).find("input[name='c']").val();
            var d = $(form).find("input[name='d']").val();
            var t = $(form).find("input[name='t']").val();
            var cp = $(form).find("input[name='cp']").val();
            var f = $(form).find("input[name='f']").val();
            var e = $(form).find("input[name='e']").val();
            var h = $(form).find("input[name='h']").val();
            var r = $(form).find("input[name='r']").val();
            var cwd = $(form).find("input[name='cwd']").val();
            var clh= $(form).find("input[name='clh']").val();
            var ced = $(form).find("input[name='ced']").val();
            var id = $("#giftID3").val();
            $.iAjax('/giftBag/update','c='+c+'&d='+d+'&t='+t+'&cp='+cp+'&f='+f+'&e='+e+'&h='+h+'&r='+r+'&cwd='+cwd+'&clh='+clh+'&ced='+ced+'&id='+id,function(response){
                $.alert('提示','设置成功');
            },'POST');
        }
    });
});
