/**
 * Created by shameless on 15/3/3.
 */
$(function(){

    var dateLine = eval('('+$("#dateLine").val()+')');
    var data = eval('('+$("#data").val()+')');

    var cpuUserUsageSeriesData = [];
    var cpuSysUsageSeriesData = [];
    var MemUsageSeriesData = [];
    var MemFreeSeriesData = [];
    var load5SeriesData = [];
    var load10SeriesData = [];
    var load15SeriesData = [];
    $.each(data,function(i,item){
        cpuUserUsageSeriesData.push(parseFloat(item.cpuUserUsage) == undefined ? 0 : parseFloat(item.cpuUserUsage));
        cpuSysUsageSeriesData.push(parseFloat(item.cpuSysUsage) == undefined ? 0 : parseFloat(item.cpuSysUsage));
        MemUsageSeriesData.push(parseFloat(item.memUsage) == undefined ? 0 : parseFloat(item.memUsage));
        MemFreeSeriesData.push(parseFloat(item.memFree) == undefined ? 0 : parseFloat(item.memFree));
        load5SeriesData.push(parseFloat(item.load5) == undefined ? 0 : parseFloat(item.load5));
        load10SeriesData.push(parseFloat(item.load10) == undefined ? 0 : parseFloat(item.load10));
        load15SeriesData.push(parseFloat(item.load15) == undefined ?  0 : parseFloat(item.load15));
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
                    data:['用户CPU','系统CPU','使用内存','剩余内存','1分钟平均系统负载','5分钟平均系统负载','15分钟平均系统负载']
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
                        name:'用户CPU',
                        type:'line',
                        data: cpuUserUsageSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '系统CPU',
                        type: 'line',
                        data: cpuSysUsageSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '使用内存',
                        type: 'line',
                        data: MemUsageSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '剩余内存',
                        type: 'line',
                        data: MemFreeSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '1分钟平均系统负载',
                        type: 'line',
                        data: load5SeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '5分钟平均系统负载',
                        type: 'line',
                        data: load10SeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '15分钟平均系统负载',
                        type: 'line',
                        data: load15SeriesData,
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