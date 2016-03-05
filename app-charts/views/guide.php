<div id="content" class="span10" style="min-height: 150px;">


            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="index.html">Home</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li><a href="#">Charts</a></li>
            </ul>
            <div class="row-fluid">
                <?php $Layout->script_block_begin();?>
                <script type="text/javascript">
                 var axisData = [<?=implode(',',$date_list)?>];
                 </script>
                <?php $Layout->script_block_end();?>
                <div class="box">
                    <div class="box-header">
                        <h2><i class="halflings-icon list-alt"></i><span class="break"></span>指数</h2>
                        <!--div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div-->
                    </div>
                    <div class="box-content">
                        <?php echo $Layout->component('charts/index_zs',array('res'=>$runtime_min));?>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <h2><i class="halflings-icon list-alt"></i><span class="break"></span>封板率</h2>
                    </div>
                    <div class="box-content">
                        <?php echo $Layout->component('charts/index_ztb',array('ztb_top'=>$ztb_top,'ztb_last'=>$ztb_last,'max_ud'=>$max_ud));?>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <h2><i class="halflings-icon list-alt"></i><span class="break"></span>均线</h2>
                    </div>
                    <div class="box-content">
                        <?php echo $Layout->component('charts/index_average',array('max_ud'=>$max_ud));?>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <h2><i class="halflings-icon list-alt"></i><span class="break"></span>营业部</h2>
                    </div>
                    <div class="box-content">
                        <?php echo $Layout->component('charts/index_yyb',array('lhb_list'=>$lhb_list));?>
                    </div>
                </div>
                <?php $Layout->script_block_begin();?>
                <script type="text/javascript">
            /*function get_index_data(){
                var arr=[];
                $.ajax({type : "get",async : false,data : {},dataType : "json",
                    url : "http://s.155027.com/ajax.php?func=get_index_data",
                    success : function(result) {
                        if (result) {
                            $.each(result, function(idx, obj) {
                                arr.push([obj.open,obj.close,obj.low,obj.high]);
                            });
                        }
                    },
                    error : function(errorMsg) { alert("图表请求数据失败啦!");}
                })
                return arr;
            }*/
                myChart = echarts.init(document.getElementById('main'));
                myChart.setOption(option);

                myChart2 = echarts.init(document.getElementById('main2'));
                myChart2.setOption(option2);

                myChart4 = echarts.init(document.getElementById('main4'));
                myChart4.setOption(option4);

                myChart3 = echarts.init(document.getElementById('main3'));
                myChart3.setOption(option3);


                echarts.connect([myChart2,myChart3,myChart4]);
                echarts.connect([myChart,myChart3,myChart4]);
                echarts.connect([myChart,myChart2,myChart4]);
                echarts.connect([myChart,myChart2,myChart4]);
                </script>
                <?php $Layout->script_block_end();?>
                <div class="box">
                    <div class="box-header">
                        <h2><i class="halflings-icon list-alt"></i><span class="break"></span>Flot</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div id="flotchart" class="center" style="height: 300px; padding: 0px; position: relative;"><canvas class="base" width="1152" height="300"></canvas><canvas class="overlay" width="1152" height="300" style="position: absolute; left: 0px; top: 0px;"></canvas><div class="tickLabels" style="font-size:smaller"><div class="xAxis x1Axis" style="color:#545454"><div class="tickLabel" style="position:absolute;text-align:center;left:-89px;top:280px;width:230px">0.0</div><div class="tickLabel" style="position:absolute;text-align:center;left:193px;top:280px;width:230px">π/2</div><div class="tickLabel" style="position:absolute;text-align:center;left:475px;top:280px;width:230px">π</div><div class="tickLabel" style="position:absolute;text-align:center;left:757px;top:280px;width:230px">3π/2</div></div><div class="yAxis y1Axis" style="color:#545454"><div class="tickLabel" style="position:absolute;text-align:right;top:265px;right:1131px;width:21px">-2.0</div><div class="tickLabel" style="position:absolute;text-align:right;top:231px;right:1131px;width:21px">-1.5</div><div class="tickLabel" style="position:absolute;text-align:right;top:197px;right:1131px;width:21px">-1.0</div><div class="tickLabel" style="position:absolute;text-align:right;top:163px;right:1131px;width:21px">-0.5</div><div class="tickLabel" style="position:absolute;text-align:right;top:130px;right:1131px;width:21px">0.0</div><div class="tickLabel" style="position:absolute;text-align:right;top:96px;right:1131px;width:21px">0.5</div><div class="tickLabel" style="position:absolute;text-align:right;top:62px;right:1131px;width:21px">1.0</div><div class="tickLabel" style="position:absolute;text-align:right;top:28px;right:1131px;width:21px">1.5</div><div class="tickLabel" style="position:absolute;text-align:right;top:-6px;right:1131px;width:21px">2.0</div></div></div><div class="legend"><div style="position: absolute; width: 55px; height: 66px; top: 9px; right: 9px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div><table style="position:absolute;top:9px;right:9px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(250,88,51);overflow:hidden"></div></div></td><td class="legendLabel">sin(x)</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(47,171,233);overflow:hidden"></div></div></td><td class="legendLabel">cos(x)</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(250,187,61);overflow:hidden"></div></div></td><td class="legendLabel">tan(x)</td></tr></tbody></table></div></div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <h2><i class="halflings-icon list-alt"></i><span class="break"></span>Stack Example</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                         <div id="stackchart" class="center" style="height: 300px; padding: 0px; position: relative;"><canvas class="base" width="1152" height="300"></canvas><canvas class="overlay" width="1152" height="300" style="position: absolute; left: 0px; top: 0px;"></canvas><div class="tickLabels" style="font-size:smaller"><div class="xAxis x1Axis" style="color:#545454"><div class="tickLabel" style="position:absolute;text-align:center;left:-27px;top:280px;width:96px">0</div><div class="tickLabel" style="position:absolute;text-align:center;left:79px;top:280px;width:96px">1</div><div class="tickLabel" style="position:absolute;text-align:center;left:186px;top:280px;width:96px">2</div><div class="tickLabel" style="position:absolute;text-align:center;left:292px;top:280px;width:96px">3</div><div class="tickLabel" style="position:absolute;text-align:center;left:398px;top:280px;width:96px">4</div><div class="tickLabel" style="position:absolute;text-align:center;left:505px;top:280px;width:96px">5</div><div class="tickLabel" style="position:absolute;text-align:center;left:611px;top:280px;width:96px">6</div><div class="tickLabel" style="position:absolute;text-align:center;left:717px;top:280px;width:96px">7</div><div class="tickLabel" style="position:absolute;text-align:center;left:824px;top:280px;width:96px">8</div><div class="tickLabel" style="position:absolute;text-align:center;left:930px;top:280px;width:96px">9</div><div class="tickLabel" style="position:absolute;text-align:center;left:1036px;top:280px;width:96px">10</div></div><div class="yAxis y1Axis" style="color:#545454"><div class="tickLabel" style="position:absolute;text-align:right;top:263px;right:1138px;width:14px">0</div><div class="tickLabel" style="position:absolute;text-align:right;top:225px;right:1138px;width:14px">10</div><div class="tickLabel" style="position:absolute;text-align:right;top:186px;right:1138px;width:14px">20</div><div class="tickLabel" style="position:absolute;text-align:right;top:148px;right:1138px;width:14px">30</div><div class="tickLabel" style="position:absolute;text-align:right;top:109px;right:1138px;width:14px">40</div><div class="tickLabel" style="position:absolute;text-align:right;top:71px;right:1138px;width:14px">50</div><div class="tickLabel" style="position:absolute;text-align:right;top:32px;right:1138px;width:14px">60</div><div class="tickLabel" style="position:absolute;text-align:right;top:-6px;right:1138px;width:14px">70</div></div></div></div>

                        <p class="stackControls center">
                            <input class="btn" type="button" value="With stacking">
                            <input class="btn" type="button" value="Without stacking">
                        </p>

                        <p class="graphControls center">
                            <input class="btn-primary" type="button" value="Bars">
                            <input class="btn-primary" type="button" value="Lines">
                            <input class="btn-primary" type="button" value="Lines with steps">
                        </p>
                    </div>
                </div>

            </div><!--/row-->

            <div class="row-fluid sortable ui-sortable">
                <div class="box span6">
                    <div class="box-header">
                        <h2><i class="halflings-icon list-alt"></i><span class="break"></span>Pie</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                            <div id="piechart" style="height: 300px; padding: 0px; position: relative;"><canvas class="base" width="549" height="300"></canvas><canvas class="overlay" width="549" height="300" style="position: absolute; left: 0px; top: 0px;"></canvas><span class="pieLabel" id="pieLabel0" style="position: absolute; top: 0px; left: 237px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(250,88,51);">Internet Explorer<br>3%</div></span><span class="pieLabel" id="pieLabel1" style="position: absolute; top: 10px; left: 304.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(47,171,233);">Mobile<br>7%</div></span><span class="pieLabel" id="pieLabel2" style="position: absolute; top: 95px; left: 381px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(250,187,61);">Safari<br>22%</div></span><span class="pieLabel" id="pieLabel3" style="position: absolute; top: 232px; left: 331px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(120,205,81);">Opera<br>16%</div></span><span class="pieLabel" id="pieLabel4" style="position: absolute; top: 233px; left: 179.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(148,64,237);">Firefox<br>23%</div></span><span class="pieLabel" id="pieLabel5" style="position: absolute; top: 48px; left: 149.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(200,70,40);">Chrome<br>29%</div></span></div>
                    </div>
                </div>

                <div class="box span6">
                    <div class="box-header" data-original-title="">
                        <h2><i class="halflings-icon list-alt"></i><span class="break"></span>Donut</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                         <div id="donutchart" style="height: 300px; padding: 0px; position: relative;"><canvas class="base" width="549" height="300"></canvas><canvas class="overlay" width="549" height="300" style="position: absolute; left: 0px; top: 0px;"></canvas><span class="pieLabel" id="pieLabel0" style="position: absolute; top: 0px; left: 237px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(250,88,51);">Internet Explorer<br>3%</div></span><span class="pieLabel" id="pieLabel1" style="position: absolute; top: 10px; left: 304.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(47,171,233);">Mobile<br>7%</div></span><span class="pieLabel" id="pieLabel2" style="position: absolute; top: 95px; left: 381px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(250,187,61);">Safari<br>22%</div></span><span class="pieLabel" id="pieLabel3" style="position: absolute; top: 232px; left: 331px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(120,205,81);">Opera<br>16%</div></span><span class="pieLabel" id="pieLabel4" style="position: absolute; top: 233px; left: 179.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(148,64,237);">Firefox<br>23%</div></span><span class="pieLabel" id="pieLabel5" style="position: absolute; top: 48px; left: 149.5px;"><div style="font-size:x-small;text-align:center;padding:2px;color:rgb(200,70,40);">Chrome<br>29%</div></span></div>
                    </div>
                </div>

            </div><!--/row-->

            <hr>

            <div class="row-fluid sortable ui-sortable">
                <div class="box span12">
                    <div class="box-header">
                        <h2><i class="halflings-icon list-alt"></i><span class="break"></span>Realtime</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                         <div id="realtimechart" style="height: 190px; padding: 0px; position: relative;"><canvas class="base" width="1152" height="190"></canvas><canvas class="overlay" width="1152" height="190" style="position: absolute; left: 0px; top: 0px;"></canvas><div class="tickLabels" style="font-size:smaller"><div class="yAxis y1Axis" style="color:#545454"><div class="tickLabel" style="position:absolute;text-align:right;top:176px;right:1131px;width:21px">0</div><div class="tickLabel" style="position:absolute;text-align:right;top:131px;right:1131px;width:21px">25</div><div class="tickLabel" style="position:absolute;text-align:right;top:85px;right:1131px;width:21px">50</div><div class="tickLabel" style="position:absolute;text-align:right;top:40px;right:1131px;width:21px">75</div><div class="tickLabel" style="position:absolute;text-align:right;top:-6px;right:1131px;width:21px">100</div></div></div></div>
                         <p>You can update a chart periodically to get a real-time effect by using a timer to insert the new data in the plot and redraw it.</p>
                         <p>Time between updates: <input id="updateInterval" type="text" value="" style="text-align: right; width:5em"> milliseconds</p>
                    </div>
                </div>
            </div><!--/row-->

            <div class="row-fluid">

                <div class="widget span6" ontablet="span6" ondesktop="span6">
                    <h2><span class="glyphicons facebook"><i></i></span>Facebook Fans</h2>
                    <hr>
                    <div class="content">
                        <div id="facebookChart" style="height: 300px; padding: 0px; position: relative;"><canvas class="base" width="553" height="300"></canvas><canvas class="overlay" width="553" height="300" style="position: absolute; left: 0px; top: 0px;"></canvas><div class="tickLabels" style="font-size:smaller"><div class="xAxis x1Axis" style="color:#545454"><div class="tickLabel" style="position:absolute;text-align:center;left:59px;top:280px;width:79px">5</div><div class="tickLabel" style="position:absolute;text-align:center;left:149px;top:280px;width:79px">10</div><div class="tickLabel" style="position:absolute;text-align:center;left:239px;top:280px;width:79px">15</div><div class="tickLabel" style="position:absolute;text-align:center;left:329px;top:280px;width:79px">20</div><div class="tickLabel" style="position:absolute;text-align:center;left:419px;top:280px;width:79px">25</div><div class="tickLabel" style="position:absolute;text-align:center;left:510px;top:280px;width:79px">30</div></div><div class="yAxis y1Axis" style="color:#545454"><div class="tickLabel" style="position:absolute;text-align:right;top:265px;right:532px;width:21px">0</div><div class="tickLabel" style="position:absolute;text-align:right;top:175px;right:532px;width:21px">50</div><div class="tickLabel" style="position:absolute;text-align:right;top:84px;right:532px;width:21px">100</div><div class="tickLabel" style="position:absolute;text-align:right;top:-6px;right:532px;width:21px">150</div></div></div><div class="legend"><div style="position: absolute; width: 48px; height: 22px; top: 9px; right: 9px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div><table style="position:absolute;top:9px;right:9px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(59,89,152);overflow:hidden"></div></div></td><td class="legendLabel">Fans</td></tr></tbody></table></div></div>
                    </div>
                </div><!--/span-->

                <div class="widget span6" ontablet="span6" ondesktop="span6">
                    <h2><span class="glyphicons twitter"><i></i></span>Twitter Followers</h2>
                    <hr>
                    <div class="content">
                        <div id="twitterChart" style="height: 300px; padding: 0px; position: relative;"><canvas class="base" width="553" height="300"></canvas><canvas class="overlay" width="553" height="300" style="position: absolute; left: 0px; top: 0px;"></canvas><div class="tickLabels" style="font-size:smaller"><div class="xAxis x1Axis" style="color:#545454"><div class="tickLabel" style="position:absolute;text-align:center;left:59px;top:280px;width:79px">5</div><div class="tickLabel" style="position:absolute;text-align:center;left:149px;top:280px;width:79px">10</div><div class="tickLabel" style="position:absolute;text-align:center;left:239px;top:280px;width:79px">15</div><div class="tickLabel" style="position:absolute;text-align:center;left:329px;top:280px;width:79px">20</div><div class="tickLabel" style="position:absolute;text-align:center;left:419px;top:280px;width:79px">25</div><div class="tickLabel" style="position:absolute;text-align:center;left:510px;top:280px;width:79px">30</div></div><div class="yAxis y1Axis" style="color:#545454"><div class="tickLabel" style="position:absolute;text-align:right;top:265px;right:532px;width:21px">0</div><div class="tickLabel" style="position:absolute;text-align:right;top:175px;right:532px;width:21px">50</div><div class="tickLabel" style="position:absolute;text-align:right;top:84px;right:532px;width:21px">100</div><div class="tickLabel" style="position:absolute;text-align:right;top:-6px;right:532px;width:21px">150</div></div></div><div class="legend"><div style="position: absolute; width: 76px; height: 22px; top: 9px; right: 9px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div><table style="position:absolute;top:9px;right:9px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(27,178,233);overflow:hidden"></div></div></td><td class="legendLabel">Followers</td></tr></tbody></table></div></div>
                    </div>
                </div><!--/span-->

            </div>



    </div>