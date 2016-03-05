<div id="main4" class="main" style='height:300px;margin-bottom:1px;padding-bottom:0;border-bottom-width:0'></div>
<?php $Layout->script_block_begin();?>
<script type="text/javascript">
option4 = {
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
        data:['5日线','10日线','20日线','30日线','60日线']
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
            name : '5日线',
            splitNumber: 5,
            axisLabel : {
                formatter: '{value}'
            }
        },
        {
            type : 'value',
            name : '10日线',
            axisLabel : {
                formatter: '{value}'
            }
        },
        {
            type : 'value',
            name : '20日线',
            axisLabel : {
                formatter: '{value}'
            }
        },
        {
            type : 'value',
            name : '30日线',
            axisLabel : {
                formatter: '{value}'
            }
        },
        {
            type : 'value',
            name : '60日线',
            axisLabel : {
                formatter: '{value}'
            }
        }
    ],
    series : [
        {
            name:'5日线',
            type:'line',
            data:[<?=implode(',',$max_ud['on_ma5'])?>]
        },
        {
            name:'10日线',
            type:'line',
            data:[<?=implode(',',$max_ud['on_ma10'])?>]
        },
        {
            name:'20日线',
            type:'line',
            data:[<?=implode(',',$max_ud['on_ma20'])?>]
        },
        {
            name:'30日线',
            type:'line',
            data:[<?=implode(',',$max_ud['on_ma30'])?>]
        },
        {
            name:'60日线',
            type:'line',
            data:[<?=implode(',',$max_ud['on_ma60'])?>]
        }
    ]
};
</script>
<?php $Layout->script_block_end();?>