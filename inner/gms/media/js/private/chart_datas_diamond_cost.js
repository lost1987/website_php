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
    var cost = eval('('+$("#cost").val()+')');
    var get = eval('('+$("#get").val()+')');

    var costUserNumSeriesData = [];
    var costUserCountSeriesData = [];
    var costTotalSeriesData = [];
    var getUserNumSeriesData = [];
    var getUserCountSeriesData = [];
    var getTotalSeriesData = [];

    $.each(cost,function(i,item){
        if(item.costTotal)
            item.costTotal = item.costTotal/1000;
        else if(item.costTotal == undefined)
            item.costTotal = 0;

        costUserNumSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.costUserNum));
        costUserCountSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.costUserCount));
        costTotalSeriesData.push(parseInt(item) == 0 ? 0 : item.costTotal);
    });

    $.each(get,function(i,item){
        if(item.getTotal)
            item.getTotal = item.getTotal/1000;
        else if(item.getTotal == undefined)
            item.getTotal = 0;
        getUserNumSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.getUserNum));
        getUserCountSeriesData.push(parseInt(item) == 0 ? 0 : parseInt(item.getUserCount));
        getTotalSeriesData.push(parseInt(item) == 0 ? 0 : item.getTotal);
    })

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
                        params[2].data = params[2].data+'K';
                        params[5].data = params[5].data+'K';

                        output += params[0].name+'<br/>';
                        output += params[0].seriesName+':'+params[0].data+'<br/>';
                        output += params[1].seriesName+':'+params[1].data+'<br/>';
                        output += params[2].seriesName+':'+params[2].data+'<br/>';
                        output += params[3].seriesName+':'+params[3].data+'<br/>';
                        output += params[4].seriesName+':'+params[4].data+'<br/>';
                        output += params[5].seriesName+':'+params[5].data+'<br/>';
                        return output;
                    }
                },
                legend: {
                    data:['消费人数','消费次数','消费虚拟币','消耗人数','消耗次数','消耗虚拟币']
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
                        name:'消费人数',
                        type:'line',
                        data: costUserNumSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '消费次数',
                        type: 'line',
                        data: costUserCountSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '消费虚拟币',
                        type: 'line',
                        data: costTotalSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },

                    {
                        name:'消耗人数',
                        type:'line',
                        data: getUserNumSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '消耗次数',
                        type: 'line',
                        data: getUserCountSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '消耗虚拟币',
                        type: 'line',
                        data: getTotalSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    }
                ]
            }
            myChart.setOption(option);
        }
    );
});
