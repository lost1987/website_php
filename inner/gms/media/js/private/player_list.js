/**
 * Created by shameless on 14/11/6.
 */
var TableAdvanced = function () {

    var initTable1 = function() {
        /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr ,uid)
        {
            var sOut ;
            $.ajax({
                url: '/player/detail/' + uid,
                method:'post',
                async : false,
                success: function (data) {
                    var response = eval('(' + data + ')');
                    if (response.error == 0) {
                        response = response.data;
                        response.last_refresh_time = response.last_refresh_time==undefined ? '/' : response.last_refresh_time;
                        response.wins = response.wins==undefined ? '/' : response.wins;
                        response.fengs = response.fengs==undefined ? '/' : response.fengs;
                        response.total = response.total==undefined ? '/' : response.total;
                        response.littlewin = response.littlewin==undefined ? '/' : response.littlewin;
                        response.allwind = response.allwind==undefined ? '/' : response.allwind;
                        response.all258 = response.all258==undefined ? '/' : response.all258;
                        response.allonesuite = response.allonesuite==undefined ? '/' : response.allonesuite;
                        response.alltriples = response.alltriples==undefined ? '/' : response.alltriples;
                        response.allothers = response.allothers==undefined ? '/' : response.allothers;
                        response.allothers = response.allothers==undefined ? '/' : response.allothers;
                        response.quadruplerobbery = response.quadruplerobbery==undefined ? '/' : response.quadruplerobbery;
                        response.winquadruplecard = response.winquadruplecard==undefined ? '/' : response.winquadruplecard;
                        response.topgold = response.topgold==undefined ? '/' : response.topgold;
                        response.topdiamond = response.topdiamond==undefined ? '/' : response.topdiamond;
                        response.fangchong = response.fangchong==undefined ? '/' : response.fangchong;
                        response.zimo = response.zimo==undefined ? '/' : response.zimo;
                        response.baohu = response.baohu==undefined ? '/' : response.baohu;
                        response.mobile = response.mobile==undefined ? '/':response.mobile;
                        response.email = response.email==undefined ? '/' : response.email;

                        sOut = '<table style="width:100%">';
                        sOut += '<tr><th>真实姓名:</th><td>' + response.real_name + '</td><th>区域:</th><td>' + response.area + '</td></tr>';
                        sOut += '<tr><th>身份证:</th><td>' + response.id_card + '</td><th>手机号:</th><td>' + response.mobile + '</td><th>邮箱:</th><td>' + response.email + '</td></tr>';
                        sOut += '<tr><th>性别:</th><td>' + response.gender + '</td><th>更新时间:</th><td>' + response.last_refresh_time + '</td></tr>';
                        sOut += '<tr><th>赢局数:</th><td>' + response.wins + '</td><th>封顶局数:</th><td>' + response.fengs + '</td></tr>';
                        sOut += '<tr><th>总局数:</th><td>' + response.total + '</td><th>小胡:</th><td>' + response.littlewin + '</td><th>风一色:</th><td>' + response.allwind + '</td></tr>';
                        sOut += '<tr><th>将一色:</th><td>' + response.all258 + '</td><th>清一色:</th><td>' + response.allonesuite + '</td><th>碰碰胡:</th><td>' + response.alltriples + '</td></tr>';
                        sOut += '<tr><th>全求人:</th><td>' + response.allothers + '</td><th>海底捞:</th><td>' + response.allothers + '</td><th>杠上开花:</th><td>' + response.winquadruplecard + '</td></tr>';
                        sOut += '<tr><th>抢杠:</th><td>' + response.quadruplerobbery + '</td><th>金顶:</th><td>' + response.topgold + '</td><th>钻石顶:</th><td>' + response.topdiamond + '</td></tr>';
                        sOut += '<tr><th>放冲:</th><td>' + response.fangchong + '</td><th>自摸:</th><td>' + response.zimo + '</td><th>包胡:</th><td>' + response.baohu + '</td></tr>';
                        sOut += '</table>';
                    } else
                         sOut = 'error_code:' + response.error;
                }
            });
            return sOut;
        }

        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';

        $('#sample_1 thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );

        $('#sample_1 tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );

        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#sample_1').dataTable( {
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
            "aLengthMenu": false,
            "bLengthChange":false,
            // set the initial value
            "iDisplayLength": 10,
            "bPaginate":false,
            'bInfo':false,
            'bFilter':false,
            'bSort':false,
            "oLanguage": {
                "sEmptyTable": "未找到任何数据"
            }
        });

        jQuery('#sample_1_wrapper .dataTables_filter input').addClass("m-wrap small"); // modify table search input
        jQuery('#sample_1_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
        jQuery('#sample_1_wrapper .dataTables_length select').select2(); // initialzie select2 dropdown

        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#sample_1').on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            var uid = $(this).parent().parent().attr('rel');
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */
                $(this).addClass("row-details-open").removeClass("row-details-close");
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr,uid), 'details' );
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            initTable1();
            $("div.span6").each(function(){
                var __this =  $(this);
                if(__this.html() == '')
                    __this.remove();
            })
        }
    };
}();


function forbidden(user_id,login_name){
        if(confirm("确定要封停账号 "+login_name+' ?')){
            $.post('/player/forbidden/'+user_id+'/'+login_name,'',function(data){
                        var response = eval( '('  +data+ ')');
                        if(response.error == 0){
                            alert('操作成功');
                            window.location.reload();
                            return;
                        }
                        alert(response.error);
            });
        }
}

function unforbidden(user_id,login_name){
    if(confirm("确定要解封账号 "+login_name+' ?')){
        $.post('/player/unforbidden/'+user_id+'/'+login_name,'',function(data){
            var response = eval( '('  +data+ ')');
            if(response.error == 0){
                alert('操作成功');
                window.location.reload();
                return;
            }
            alert(response.error);
        });
    }
}

function reset_password(user_id,user_number,login_name){
    if(confirm("确定要重置账号 "+login_name+' 的登陆密码?')){
        $.post('/player/reset_password/'+user_id+'/'+user_number+'/'+login_name,'',function(data){
            var response = eval( '('  +data+ ')');
            if(response.error == 0){
                alert('操作成功,重置后的登陆密码为: '+response.data);
                return;
            }
            alert(response.error);
        });
    }
}

function reset_purchase_password(user_id,user_number,login_name){
    if(confirm("确定要重置账号 "+login_name+' 的消费密码?')){
        $.post('/player/reset_purchase_password/'+user_id+'/'+user_number+'/'+login_name,'',function(data){
            var response = eval( '('  +data+ ')');
            if(response.error == 0){
                alert('操作成功,重置后的消费密码为: '+response.data);
                return;
            }
            alert(response.error);
        });
    }
}

function addSupporter(){
        $("#supporterModal").modal();
    $("#supporter_num").trigger('change');
}

function confirm_support(){
        var supporter_num = $("#supporter_num").val();
        var nicknames_nodes = $("input[name='nicknames[]']");
        var diamond = $("#add_diamond").val().replace(/\s+/g,'');
        var coins = $("#add_coins").val().replace(/\s+/g,'');

        if(diamond == ''){
            alert('请输入初始钻石');
            return;
        }

        if(coins == ''){
            alert('请输入初始金币');
            return;
        }

        var nicknames = [];
        $(nicknames_nodes).each(function(){
                var nickname = $(this).val().replace(/\s+/g,'');
                if(nickname.length >2 && nickname.length < 7){
                    nicknames.push($(this).val());
                }
        });

        if(nicknames.length != supporter_num){
            alert('请填写昵称!');
            return;
        }
      $("#waitTipModalContent").html("系统正在生成帐号,请不要刷新浏览器....");
      $("#waitTipModal").modal({backdrop:'static',keyboard:false});

    nicknames = nicknames.join(',');
    $.post("/player/addSupporter/19","supporter_num="+supporter_num+'&nicknames='+nicknames+'&diamond='+diamond+'&coins='+coins,function(data){
        $("#waitTipModal").modal('hide');
        $("#waitTipModalContent").html("");
        var response = eval('('+data+')');
        if(response.error != 0){
            alert('error code:'+response.error);
        }
        else
        {
            alert("操作成功");
            window.location.href = '/player/lists/19?user_flag=2';
        }
    })
}

function cancel_supporter(){
    $("#supporterModal").modal('hide');
}


function createNickNameInputs(node){
    var num =parseInt( node.value);
    var inputs = '';
    $(node).parent().find('div').html('');
    for(var i = 0 ; i < num ; i++){
        inputs+='<input type="text" name="nicknames[]" /> ';
    }
    $(node).parent().find('div').html(inputs);
}