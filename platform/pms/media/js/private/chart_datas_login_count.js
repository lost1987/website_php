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
    var loginCount = eval('('+$("#loginCount").val()+')');

    var loginCountSeriesData = [];
    var newLoginCountSeriesData = [];
    var oldLoginCountSeriesData = [];
    $.each(loginCount,function(i,item){
        loginCountSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.loginCount));
        newLoginCountSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.newLoginCount));
        oldLoginCountSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.oldLoginCount));
    });

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
                    data:['启动次数','新用户启动次数','老用户启动次数']
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
                        name:'启动次数',
                        type:'line',
                        data: loginCountSeriesData,
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
                        name: '新用户启动次数',
                        type: 'line',
                        data: newLoginCountSeriesData,
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
                        name: '老用户启动次数',
                        type: 'line',
                        data: oldLoginCountSeriesData,
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