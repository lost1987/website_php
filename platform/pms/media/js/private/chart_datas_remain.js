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
    var remain = eval('('+$("#remain").val()+')');

    var secondDaySeriesData = [];
    var weekDaySeriesData = [];
    var monthDaySeriesData = [];
    $.each(remain,function(i,item){
        secondDaySeriesData.push(parseInt(item) == 0 ? '0.00' : item.secondDayRatio);
        weekDaySeriesData.push(parseInt(item) == 0 ? '0.00' : item.weekDayRatio);
        monthDaySeriesData.push(parseInt(item) == 0 ? '0.00' : item.monthDayRatio);
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
                    trigger: 'axis',
                    formatter:function(params,ticket,callback){
                        var output = '';
                        params[0].data = parseFloat(params[0].data)*100+'%';
                        params[1].data = parseFloat(params[1].data)*100+'%';
                        params[2].data = parseFloat(params[2].data)*100+'%';

                        output += params[0].name+'<br/>';
                        output += '次日留存:'+params[0].data+'<br/>';
                        output += '周留存:'+params[1].data+'<br/>';
                        output += '月留存:'+params[2].data;
                        return output;
                    }
                },
                legend: {
                    data:['次日留存','周留存','月留存']
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
                        name:'次日留存',
                        type:'line',
                        data: secondDaySeriesData,
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
                        name: '周留存',
                        type: 'line',
                        data: weekDaySeriesData,
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
                        name: '月留存',
                        type: 'line',
                        data: monthDaySeriesData,
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