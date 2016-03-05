<div id="main" class="main" style='height:300px;margin-bottom:1px;padding-bottom:0;border-bottom-width:0'></div>
<?php $Layout->script_block_begin();?>
<script type="text/javascript">
option = {
    title : {
        text: '上证指数'
    },
    tooltip : {
        trigger: 'axis',
        formatter: function (params) {
            var res = params[0].seriesName + ' ' + params[0].name;
            res += '<br/>  开盘 : ' + params[0].value[0] + '  最高 : ' + params[0].value[3];
            res += '<br/>  收盘 : ' + params[0].value[1] + '  最低 : ' + params[0].value[2];
            return res;
        }
    },
    legend: {
        data:['上证指数']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataZoom : {show: true},
            dataView : {show: true, readOnly: false},
            magicType: {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    dataZoom : {
        y:250,
        show : false,
        realtime: true,
        start : 0,
        end : 1000
    },
    grid:{
        x:80,
        y:40,
        x2:20,
        y2:25
    },
    xAxis : [
        {
            type : 'category',
            boundaryGap : true,
            axisTick: {onGap:false},
            splitLine: {show:false},
            data : axisData
        }
    ],
    yAxis : [
        {
            type : 'value',
            scale:true,
            boundaryGap: [0.01, 0.01],
            splitArea:{show:true}
        }
    ],
    series : [
        {
            name:'上证指数',
            type:'k',
            //data:get_index_data()
            data:[ // 开盘，收盘，最低，最高
                <?php $_tmp_index = array(); foreach($index_data as $val){ $_tmp_index[]="[".$val['open'].",".$val['close'].",".$val['low'].",".$val['high']."]";}?>
                <?php echo implode(',',$_tmp_index);?>
            ]
        }
    ]
};
</script>
<?php $Layout->script_block_end();?>