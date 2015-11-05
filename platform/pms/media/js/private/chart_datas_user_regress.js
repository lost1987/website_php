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
    var loginNum = eval('('+$("#loginNum").val()+')');
    var vigorous = eval('('+$("#vigorous").val()+')');

    var regressNumSeriesData = [];
    var regressRatioSeriesData = [];

    var regressNum,vigorousNum,regressRatio;
    $.each(loginNum,function(i,item){
         regressNum = parseInt(item) == 0 ? 0 : parseInt(item.regressNum);
         vigorousNum  =  parseInt(vigorous[i]) == 0 ? 0 : parseInt(vigorous[i].vigorousNum);
        regressNumSeriesData.push(regressNum);
        if(vigorousNum == 0)
            regressRatio =  0;
        else
            regressRatio = (regressNum/vigorousNum).toFixed(2);
        regressRatioSeriesData.push(regressRatio);
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
                        params[1].data = params[1].data * 100 + '%';

                        output += params[0].name+'<br/>';
                        output += params[0].seriesName+':'+params[0].data+'<br/>';
                        output += params[1].seriesName+':'+params[1].data+'<br/>';
                        return output;
                    }
                },
                legend: {
                    data:['回归用户数','用户回归率']
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
                        name:'回归用户数',
                        type:'line',
                        data: regressNumSeriesData,
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                                {type : 'min', name: '最小值'}
                            ]
                        }
                    },
                    {
                        name: '用户回归率',
                        type: 'line',
                        data: regressRatioSeriesData,
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
