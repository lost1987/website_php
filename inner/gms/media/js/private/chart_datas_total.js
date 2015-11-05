/**
 * Created by shameless on 15/3/3.
 */
$(function(){
    //--------------------------------------------------------时段分析图表
    var t = $("#t").val();
    data_t = eval('('+t+')');
    var dateLine_t = data_t.timeLine;
    var newUsers_t = data_t.newUsers;
    var loginCount_t = data_t.loginCount;
    var recharge_t = data_t.recharge;
    var vigorous_t = data_t.vigorous;

    var newUsers_tSeriesData = [];
    $.each(newUsers_t,function(i){
        var obj = newUsers_t[i];
        if (undefined == obj.registerNum)
            newUsers_tSeriesData.push(0);
        else
            newUsers_tSeriesData.push(parseInt(obj.registerNum));
    });

    var vigorous_tSeriesData = [];
    $.each(vigorous_t,function(i){
        var obj = vigorous_t[i];
        if (undefined == obj.vigorousNum)
            vigorous_tSeriesData.push(0);
        else
            vigorous_tSeriesData.push(parseInt(obj.vigorousNum));
    });

    var recharge_tNumSeriesData = [];
    var recharge_tMoneySeriesData = [];
    var recharge_tNewNumSeriesData = [];
    $.each(recharge_t,function(i){
        var obj = recharge_t[i];
        if (undefined == obj.rechargeNum)
            recharge_tNumSeriesData.push(0);
        else
            recharge_tNumSeriesData.push(parseInt(obj.rechargeNum));

        if (undefined == obj.rechargeMoney)
            recharge_tMoneySeriesData.push(0);
        else
            recharge_tMoneySeriesData.push(parseFloat(obj.rechargeMoney));

        if (undefined == obj.newrechargeNum)
            recharge_tNewNumSeriesData.push(0);
        else
            recharge_tNewNumSeriesData.push(parseInt(obj.newRechargeNum));
    });

    var loginCount_tSeriesData = [];
    $.each(loginCount_t,function(i){
        var obj = loginCount_t[i];
        if (undefined == obj.loginCount)
            loginCount_tSeriesData.push(0);
        else
            loginCount_tSeriesData.push(parseInt(obj.loginCount));
    });


    //--------------------------------------------------------整体趋势
    var data_w = $("#w").val();
    data_w = eval('('+data_w+')');
    var dateLine_w = data_w.timeLine;
    var newUsers_w = data_w.newUsers;
    var vigorous_w = data_w.vigorous;
    var loginCount_w = data_w.loginCount;

    var newUsers_wSeriesData = [];
    $.each(newUsers_w,function(i){
        var obj = newUsers_w[i];
        if (undefined == obj.registerNum)
            newUsers_wSeriesData.push(0);
        else
            newUsers_wSeriesData.push(parseInt(obj.registerNum));
    });

    var vigorous_wSeriesData = [];
    var vigorousStruct_wSeriesData = [];
    $.each(vigorous_w,function(i){
        var obj = vigorous_w[i];
        if (undefined == obj.vigorousNum)
            vigorous_wSeriesData.push(0);
        else
            vigorous_wSeriesData.push(parseInt(obj.vigorousNum));

        if (undefined == obj.struct)
            vigorousStruct_wSeriesData.push(0);
        else
            vigorousStruct_wSeriesData.push(obj.struct);
    });

    var loginCount_wSeriesData = [];
    $.each(loginCount_w,function(i){
        var obj = loginCount_w[i];
        if (undefined == obj.loginCount)
            loginCount_wSeriesData.push(0);
        else
            loginCount_wSeriesData.push(parseInt(obj.loginCount));
    });

    //--------------------------------------------------付费分析
    var data_p = $("#p").val();
    data_p = eval('('+data_p+')');
    var dateLine_p = data_p.timeLine;
    var rechargeList_p  = data_p.recharge;

    var rechargeNum_pSeriesData = [];
    var rechargeNewNum_pSeriesData = [];
    var rechargeMoney_pSeriesData = [];
    var rechargeRatio_pSeriesData = [];
    $.each(rechargeList_p,function(i){
        var obj = rechargeList_p[i];
        if (undefined == obj.rechargeNum)
            rechargeNum_pSeriesData.push(0);
        else
            rechargeNum_pSeriesData.push(parseInt(obj.rechargeNum));

        if(undefined == obj.newRechargeNum)
            rechargeNewNum_pSeriesData.push(0);
        else
            rechargeNewNum_pSeriesData.push(parseInt(obj.newRechargeNum));

        if(undefined == obj.rechargeMoney)
            rechargeMoney_pSeriesData.push(0);
        else
            rechargeMoney_pSeriesData.push(parseFloat(obj.rechargeMoney));

        if(undefined == obj.ratio)
            rechargeRatio_pSeriesData.push(0);
        else
            rechargeRatio_pSeriesData.push(obj.ratio);
    });

    //--------------------------------------留存分析
    var data_r = $("#r").val();
    data_r = eval('('+data_r+')');
    var dateLine_r = data_r.timeLine;
    var remainlist_r = data_r.remain;

    var secondDaySeriesData = [];
    var weekDaySeriesData = [];
    var monthDaySeriesData = [];
    $.each(remainlist_r,function(i,item){
        secondDaySeriesData.push(parseInt(item) == 0 ? '0.00' : item.secondDayRatio);
        weekDaySeriesData.push(parseInt(item) == 0 ? '0.00' : item.weekDayRatio);
        monthDaySeriesData.push(parseInt(item) == 0 ? '0.00' : item.monthDayRatio);
    });


    //-----------------------------------渠道分析
    var data_pt = $("#pt").val();
    data_pt = eval('('+data_pt+')');
    var platforms_pt = data_pt.platforms;
    var register_pt = data_pt.register;
    var vigorous_pt = data_pt.vigorous;
    var registerTotal_pt = data_pt.registerTotal;

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
            var tChart = ec.init(document.getElementById('chart_t'),theme);
            var tOption = {
                title : {
                    text: '',
                    subtext: '单位范围小时 显示今日与昨日的数据'
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['新增用户','活跃用户','付费用户','付费金额','新增付费人数','启动次数']
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
                        data : dateLine_t
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
                        name:'新增用户',
                        type:'line',
                        data: newUsers_tSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '活跃用户',
                        type: 'line',
                        data: vigorous_tSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '付费用户',
                        type: 'line',
                        data: recharge_tNumSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '付费金额',
                        type: 'line',
                        data: recharge_tMoneySeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '新增付费人数',
                        type: 'line',
                        data: recharge_tNewNumSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '启动次数',
                        type: 'line',
                        data: loginCount_tSeriesData,
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


            var wChart = ec.init(document.getElementById('chart_w'),theme);
            var wOption = {
                title : {
                    text: '',
                    subtext: '显示过去30天的数据'
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['新增用户','活跃用户','活跃用户构成','启动次数']
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
                        data : dateLine_w
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
                        name:'新增用户',
                        type:'line',
                        data: newUsers_wSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '活跃用户',
                        type: 'line',
                        data: vigorous_wSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '活跃用户构成',
                        type: 'line',
                        data: vigorousStruct_wSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '启动次数',
                        type: 'line',
                        data: loginCount_wSeriesData,
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


            var pChart = ec.init(document.getElementById('chart_p'),theme);
            var pOption = {
                title : {
                    text: '',
                    subtext: '显示过去30天的数据'
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['付费人数','新增付费人数','付费金额','付费率']
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
                        data : dateLine_p
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
                        name:'付费人数',
                        type:'line',
                        data: rechargeNum_pSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '新增付费人数',
                        type: 'line',
                        data: rechargeNewNum_pSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '付费金额',
                        type: 'line',
                        data: rechargeMoney_pSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '付费率',
                        type: 'line',
                        data: rechargeRatio_pSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    }
                ]
            }
            pChart.setOption(pOption);


            var rChart = ec.init(document.getElementById('chart_r'),theme);
            var rOption = {
                title : {
                    text: '',
                    subtext: ''
                },
                tooltip : {
                    trigger: 'axis'
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
                        data : dateLine_r
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
                        }
                    }
                ]
            }
            rChart.setOption(rOption);

            var ptChart = ec.init(document.getElementById('chart_pt'),theme);
            ptOption = {
                title : {
                    text: '',
                    subtext: '显示今日及昨日的数据'
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['新增用户', '活跃用户','累计用户']
                },
                toolbox: {
                    show : true,
                    feature : {
                        mark : {show: true},
                        dataView : {show: true, readOnly: false},
                        magicType: {show: true, type: ['line', 'bar']},
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                calculable : true,
                xAxis : [
                    {
                        type : 'value',
                        boundaryGap : [0, 0.01]
                    }
                ],
                yAxis : [
                    {
                        type : 'category',
                        data : platforms_pt
                    }
                ],
                series : [
                    {
                        name:'新增用户',
                        type:'bar',
                        data:register_pt
                    },
                    {
                        name:'活跃用户',
                        type:'bar',
                        data:vigorous_pt
                    },
                    {
                        name:'累计用户',
                        type:'bar',
                        data:registerTotal_pt
                    }
                ]
            };
            ptChart.setOption(ptOption);
        }
    );
});