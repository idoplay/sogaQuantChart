<div id="main3" class="main" style='height:300px;margin-bottom:1px;padding-bottom:0;border-bottom-width:0'></div>
<?php $Layout->script_block_begin();?>
<script type="text/javascript">
option3 = {
    tooltip : {
        trigger: 'axis'
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
        realtime: true,
        start : 0,
        end : 1000
    },
    grid: {
        x: 80,
        y: 5,
        x2:20,
        y2:40
    },
    calculable : true,
    legend: {
        data:['日成交量','参与YYB','净买入YYB']
    },
    xAxis : [
        {
            type : 'category',
            data : axisData
        }
    ],
    yAxis : [
        {
            type : 'value',
            name : '日成交量',
            splitNumber: 5,
            axisLabel : {
                formatter: '{value}'
            }
        },
        {
            type : 'value',
            name : '参与YYB',
            axisLabel : {
                formatter: '{value}'
            }
        },
        {
            type : 'value',
            name : '净买入YYB',
            axisLabel : {
                formatter: '{value}'
            }
        }
    ],
    series : [
        {
            name:'日成交量',
            type:'bar',
            data:[<?php $_lhb_vo =array(); foreach($lhb_list as $val){ $_lhb_vo[]=$val['volumes'];} echo implode(',',$_lhb_vo);?>],
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
            name:'参与YYB',
            type:'line',
            yAxisIndex: 1,
            data:[<?php $_lhb_yyb =array(); foreach($lhb_list as $val){ $_lhb_yyb[]=$val['yyb']['cnt'];} echo implode(',',$_lhb_yyb);?>]
        },
        {
            name:'净买入YYB',
            type:'line',
            yAxisIndex: 1,
            data:[<?php $_lhb_yyb =array(); foreach($lhb_list as $val){ $_lhb_yyb[]=$val['yyb']['in'];} echo implode(',',$_lhb_yyb);?>]
        }
    ]
};
</script>
<?php $Layout->script_block_end();?>