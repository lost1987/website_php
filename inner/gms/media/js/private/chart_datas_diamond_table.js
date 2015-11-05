/**
 * Created by shameless on 15/3/3.
 */
$(function(){
    //--------------------------------------------------------时段分析图表
    var dateLine = $("#dateLine").val();
    dateLine = eval('('+dateLine+')');
    var data = $("#data").val();
    data = eval('('+data+')');

    var tableNumSeriesData = [];
    var chiChangeSeriesData  = [];

    $.each(data,function(i){
        var tableNum = undefined == data[i].table_num ? 0 : parseInt(data[i].table_num);
        var chiChange = undefined == data[i].chi_change ? 0 : parseInt(data[i].chi_change);
        tableNumSeriesData.push(tableNum);
        chiChangeSeriesData.push(chiChange);
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
            var tChart = ec.init(document.getElementById('chart1'),theme);
            var tOption = {
                title : {
                    text: '',
                    subtext: ''
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['钻石场场数']
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
                        name:'钻石场场数',
                        type:'line',
                        data: tableNumSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    }
                ]
            }
            tChart.setOption(tOption);


            var wChart = ec.init(document.getElementById('chart2'),theme);
            var wOption = {
                title : {
                    text: '当前奖池奖券数量:'+coupon,
                    subtext: ''
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['奖券变化数']
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
                        name:'奖券变化数',
                        type:'line',
                        data: chiChangeSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    }
                ]
            }
            wChart.setOption(wOption);
        }
    );
});