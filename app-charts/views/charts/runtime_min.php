<div id="main" class="main" style='height:500px;margin-bottom:1px;padding-bottom:0;border-bottom-width:0'></div>
<?php $Layout->script_block_begin();?>
<script type="text/javascript">
option = {
    title: {
        text: '堆叠区域图'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['7+','3-7%','1-3%','-3%','-3-5%','-5%+']
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis : [
        {
            type : 'category',
            boundaryGap : false,
            data : [<?php echo "'".implode("','",array_keys($res))."'";?>]
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],

    series : [
        {
            name:'-5%+',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[<?php $_a1 = array();foreach ($res as $value) {$_a1[]=$value['t_1'];} echo implode(',',$_a1);?>]
        },
        {
            name:'-3-5%',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[<?php $_a1 = array();foreach ($res as $value) {$_a1[]=$value['t_2'];} echo implode(',',$_a1);?>]
        },
        {
            name:'-3%',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[<?php $_a1 = array();foreach ($res as $value) {$_a1[]=$value['t_3'];} echo implode(',',$_a1);?>]
        },
        {
            name:'1-3%',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[<?php $_a1 = array();foreach ($res as $value) {$_a1[]=$value['t_4'];} echo implode(',',$_a1);?>]
        },
        {
            name:'3-7%',
            type:'line',
            stack: '总量',
            areaStyle: {normal: {}},
            data:[<?php $_a1 = array();foreach ($res as $value) {$_a1[]=$value['t_5'];} echo implode(',',$_a1);?>]
        },
        {
            name:'7+',
            type:'line',
            stack: '总量',
            label: {
                normal: {
                    show: true,
                    position: 'top'
                }
            },
            areaStyle: {normal: {}},
            data:[<?php $_a1 = array();foreach ($res as $value) {$_a1[]=$value['t_6'];} echo implode(',',$_a1);?>]
        }
    ]
};

var myChart = echarts.init(document.getElementById('main'));
myChart.setOption(option);
</script>

<?php $Layout->script_block_end();?>