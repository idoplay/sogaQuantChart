<div id="main2" class="main" style='height:350px;margin-bottom:1px;padding-bottom:0;border-bottom-width:0'></div>
<?php $Layout->script_block_begin();?>
<script type="text/javascript">
option2 = {
    tooltip : {
        trigger: 'axis',
        showDelay: 0             // 显示延迟，添加显示延迟可以避免频繁切换，单位ms
    },
    calculable : true,
    legend: {
        //y : -30,
        data:['触碰涨停','最终封板','上涨数']
    },
    toolbox: {
        y : -30,
        show : false,
        feature : {
            mark : {show: true},
            dataZoom : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    dataZoom : {
        show : true,
        //realtime: true,
        //start : 0,
        //end : 1000
    },
    grid: {
        x: 80,
        y: 5,
        x2:20,
        y2:40
    },
    xAxis : [
        {
            type : 'category',
            boundaryGap : true,
            axisTick: {onGap:false},
            splitLine: {show:false},
            //axisLine: {onZero: false},
            data : axisData
        }
    ],
    yAxis : [
        {
            type : 'value',
            scale:true,
            splitNumber: 5,
            boundaryGap: [0.05, 0.05],
            axisLabel: {
                formatter: function (v) {
                    return v + ' 家'
                }
            },
            splitArea : {show : true}
        }
    ],
    series : [
        {
            name:'触碰涨停',
            type:'bar',
            symbol: 'none',
            data:[<?=implode(',',$ztb_top)?>],
            markLine : {
                symbol : 'none',
                itemStyle : {
                    normal : {
                        color:'#1e90ff',
                        label : {
                            show:false
                        }
                    }
                },
                data : [
                    {type : 'average', name: '平均值'}
                ]
            }
        },
        {
            name:'最终封板',
            type:'line',
            symbol: 'none',
            data:[<?=implode(',',$ztb_last)?>],
            markLine : {
                symbol : 'none',
                itemStyle : {
                    normal : {
                        color:'#1e90ff',
                        label : {
                            show:false
                        }
                    }
                },
                data : [
                  //  {type : 'average', name: '平均值'}
                ]
            }
        },
        {
            name:'上涨数',
            type:'line',
            symbol: 'none',
            data:[<?=implode(',',$max_ud['sz_up'])?>],
            markLine : {
                symbol : 'none',
                itemStyle : {
                    normal : {
                        color:'#1e90ff',
                        label : {
                            show:false
                        }
                    }
                },
                data : [
                  //  {type : 'average', name: '平均值'}
                ]
            }
        }
    ]
};
</script>
<?php $Layout->script_block_end();?>