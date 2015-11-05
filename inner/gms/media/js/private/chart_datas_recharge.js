/**
 * Created by shameless on 15/3/3.
 */
$(function(){

    $(".form_datetime").datepicker({
        format: "yyyy-mm-dd",
        pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
        language:'zh-CN',
        autoclose: true,
        todayBtn: true,
        todayHighlight:true
    });

    var dateLine = eval('('+$("#dateLine").val()+')');
    var recharge = eval('('+$("#recharge").val()+')');
    var see_type = $("#see_type").val();

    var rechargeSeriesData = [];
    var newRechargeSeriesData = [];
    var oldRechargeSeriesData = [];
    if(see_type == 'money'){
        var rechargeSeriesDataName = '充值金额';
        var newRechargeSeriesDataName = '新增充值金额';
        var oldRechargeSeriesDataName = '老用户充值金额';
        $.each(recharge,function(i,item){
            rechargeSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.rechargeMoney));
            newRechargeSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.newRechargeMoney));
            oldRechargeSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.oldRechargeMoney));
        });
    }
    else if(see_type == 'num'){
        var rechargeSeriesDataName = '充值人数';
        var newRechargeSeriesDataName = '新增充值人数';
        var oldRechargeSeriesDataName = '老用户充值人数';
        $.each(recharge,function(i,item){
            rechargeSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.rechargeNum));
            newRechargeSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.newRechargeNum));
            oldRechargeSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.oldRechargeNum));
        });
    }
    else{
        var rechargeSeriesDataName = '充值次数';
        var newRechargeSeriesDataName = '新增充值次数';
        var oldRechargeSeriesDataName = '老用户充值次数';
        $.each(recharge,function(i,item){
            rechargeSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.rechargeCount));
            newRechargeSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.newRechargeCount));
            oldRechargeSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.oldRechargeCount));
        });
    }
    var legendData = [rechargeSeriesDataName,newRechargeSeriesDataName,oldRechargeSeriesDataName];


    // 路径配置
    require.config({
        paths: {
            echarts: '/media/js/echarts'
        }
    });

    require(
        [
            'echarts',
            'echarts/theme/macarons',//导入主题 必须先于图表JS导入 不然不起作用
            'echarts/chart/line',   // 按需加载所需图表，如需动态类型切换功能，别忘了同时加载相应图表
            'echarts/chart/bar'
        ],
        function (ec,theme) {
            var myChart = ec.init(document.getElementById('main'),theme);
            var option = {
                title : {
                    text: '',
                    subtext: ''
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:legendData
                },
                toolbox: {
                    show : true,
                    feature : {
                        mark : {
                            show: true,
                            lineStyle : {
                                width : 2,
                                color : 'red',
                                type : 'dotted'
                            }
                        },
                        dataView : {show: true, readOnly: false},
                        magicType : {show: true, type: ['line', 'bar']},
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                dataZoom:{
                    show:true,
                    start:0
                },
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        data : dateLine
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        axisLabel : {
                            formatter: '{value}'
                        }
                    }
                ],
                series : [
                    {
                        name:rechargeSeriesDataName,
                        type:'line',
                        data: rechargeSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name : '平均值'}
                            ]
                        }
                    },
                    {
                        name: newRechargeSeriesDataName,
                        type: 'line',
                        data: newRechargeSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name : '平均值'}
                            ]
                        }
                    },
                    {
                        name: oldRechargeSeriesDataName,
                        type: 'line',
                        data: oldRechargeSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name : '平均值'}
                            ]
                        }
                    }
                ]
            }
            myChart.setOption(option);
        }
    );
});