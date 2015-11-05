/**
 * Created by shameless on 15/3/3.
 */
$(function(){

    var data = $("#data").val();
    data = eval('('+data+')');
    var dateLine = [];
    var coins = [];
    var nums = [];
    var online = [];
    var tablelv1 = [];
    var tablelv2 = [];
    var cheatlv1 = [];
    var cheatlv2 = [];
    var cheat = $("#cheat").val();
    $.each(data,function(i,item){
        dateLine.push(item.create_time);
        coins.push(parseInt(item.coins));
        nums.push(parseInt(item.nums));
        online.push(parseInt(item.online));
        tablelv1.push(parseInt(item.tablelv1));
        tablelv2.push(parseInt(item.tablelv2));
        cheatlv1.push(parseInt(item.cheat_rate_lv1));
        cheatlv2.push(parseInt(item.cheat_rate_lv2));
    });

    if(coins.length == 0)
        return;

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
                    text: '作弊状态:'+cheat,
                    subtext: ''
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['机器人数量','在线人数','初级场桌数','中级场桌数','初级场作弊几率','中级场作弊几率']
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
                        name: '机器人数量',
                        type: 'line',
                        data: nums,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name:'在线人数',
                        type:'line',
                        data: online,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name:'初级场桌数',
                        type:'line',
                        data: tablelv1,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name:'中级场桌数',
                        type:'line',
                        data: tablelv2,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name:'初级场作弊几率',
                        type:'line',
                        data: cheatlv1,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name:'中级场作弊几率',
                        type:'line',
                        data: cheatlv2,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                ]
            }
            myChart.setOption(option);

            var myChart1 = ec.init(document.getElementById('coins'),theme);
            var option1 = {
                title : {
                    text: '金币统计',
                    subtext: ''
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['金币']
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
                        name:'金币',
                        type:'line',
                        data: coins,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    }
                ]
            };
            myChart1.setOption(option1);
        }
    );
});