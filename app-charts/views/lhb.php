<div id="content" class="span10" style="min-height: 150px;">


            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="index.html">Home</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li><a href="#">Tables</a></li>
            </ul>

            <div class="row-fluid sortable ui-sortable">
                <div class="box span12">
                    <div class="box-header" data-original-title="">
                        <h2><i class="halflings-icon user"></i><span class="break"></span>活跃</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                            <div class="row-fluid">
                                <div class="span12">
                            <div id="DataTables_Table_0_length" class="dataTables_length">
                                <?php foreach ($openday_list as $value) {
                                        $ccx = $value['dateline'] == $params['d'] ? 'btn-success' : 'btn-info';
                                        echo '<a href="/lhb?d='.$value['dateline'].'" target="_blank" class="btn '.$ccx.'">'.$value['dateline'].'</a>';
                                    }?>
                                 </div>

                             </div>

                            </div>

                            <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                          <thead>
                              <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="" style="width: 150px;">营业部</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 80px;">买入(万)</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 80px;">卖出(万)</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 80px;">净额(万)</th>
                                 <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 200px;">活跃度</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 311px;">题材</th>
                            </tr>
                          </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php if(!empty($datalist)):?>
                        <?php foreach($datalist as $k=>$val):?>
                        <?php if($val['yyb_id']==8888 || $k>40){continue;}?>
                        <?php $name = str_replace(array('证券营业部'), array(''), $lhb_yyb[$val['yyb_id']]['name']);?>
                            <tr class="odd">
                                    <td class="center "><span class="label label-warning "><?=$val['yyb_id']?></span><a href="http://data.eastmoney.com/stock/lhb/yyb/<?php echo $val['yyb_id'];?>.html" target="_blank"><?=$name?></a></td>
                                    <td class="center "><?=$val['B']/10000?></td>
                                    <td class="center "><?=$val['S']/10000?></td>
                                    <td class="center "><?=($val['B']-$val['S'])/10000?></td>
                                    <td class="center"><span class="sparkLineStats-<?=$val['yyb_id']?>"></span></td>
                                    <td class="center "><?php foreach ($val['stocks'] as $value) {
                                        echo '<span class="label">'.$stock_list[$value]['name'].'</span>';
                                    }?></td>
                                <!--td class="center ">

                                    <a class="btn btn-success" href="#">
                                        <i class="halflings-icon white zoom-in"></i>
                                    </a>
                                    <a class="btn btn-info" href="#">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a class="btn btn-danger" href="#">
                                        <i class="halflings-icon white trash"></i>
                                    </a>
                                </td-->

                            </tr>
                        <?php endforeach;?>
                        <?php endif;?>

                        </tbody></table>

                            <!--div class="row-fluid">
                                <div class="span12">
                                    <div class="dataTables_info" id="DataTables_Table_0_info">Showing 1 to 10 of 32 entries</div>
                                </div>
                                <div class="span12 center">
                                    <div class="dataTables_paginate paging_bootstrap pagination">
                                        <ul>
                                            <li class="prev disabled"><a href="#">← Previous</a></li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li class="next"><a href="#">Next → </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div-->
                        </div>
                    </div>
                </div><!--/span-->

            </div><!--/row-->

            <div class="row-fluid sortable ui-sortable">
                <div class="box span6">
                    <div class="box-header">
                        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>净买入</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <table class="table">
                              <thead>
                                  <tr>
                                      <th>题材</th>
                                      <th>关联</th>
                                      <th>量（万）</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php if(!empty($datalist_J_B)):?>
                                <?php foreach ($datalist_J_B as $k=>$value) :?>
                                <?php if($k>20){ break;}?>
                                    <tr>
                                    <td><?=$k+1?></td>
                                    <td class="center">
                                        <span class="label label-waring"><?=$lhb_yyb[$value['yyb_id']]['name']?></span>
                                    </td>
                                    <td><?=$value['JBS']/10000?></td>
                                </tr>
                                <?php endforeach;?>
                             <?php endif;?>
                              </tbody>
                         </table>
                         <!--div class="pagination pagination-centered">
                          <ul>
                            <li><a href="#">Prev</a></li>
                            <li class="active">
                              <a href="#">1</a>
                            </li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">Next</a></li>
                          </ul>
                        </div-->
                    </div>
                </div><!--/span-->

                <div class="box span6">
                    <div class="box-header">
                        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>净卖出</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th>题材</th>
                                      <th>关联</th>
                                      <th>量（万）</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php if(!empty($datalist_J_S)):?>
                                <?php foreach ($datalist_J_S as $k=>$value) :?>
                                <?php if($k>20){ break;}?>
                                    <tr>
                                    <td><?=$k+1?></td>
                                    <td class="center">
                                        <span class="label label-waring"><?=$lhb_yyb[$value['yyb_id']]['name']?></span>
                                    </td>
                                    <td><?=$value['JBS']/10000?></td>
                                </tr>
                                <?php endforeach;?>
                             <?php endif;?>
                              </tbody>
                         </table>

                    </div>
                </div><!--/span-->
            </div><!--/row-->

            <div class="row-fluid sortable ui-sortable">
                <div class="box span6">
                    <div class="box-header">
                        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Bordered Table</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>Username</th>
                                      <th>Date registered</th>
                                      <th>Role</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/01/01</td>
                                    <td class="center">Member</td>
                                    <td class="center">
                                        <span class="label label-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/02/01</td>
                                    <td class="center">Staff</td>
                                    <td class="center">
                                        <span class="label label-important">Banned</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/02/01</td>
                                    <td class="center">Admin</td>
                                    <td class="center">
                                        <span class="label">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/03/01</td>
                                    <td class="center">Member</td>
                                    <td class="center">
                                        <span class="label label-warning">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/01/21</td>
                                    <td class="center">Staff</td>
                                    <td class="center">
                                        <span class="label label-success">Active</span>
                                    </td>
                                </tr>
                              </tbody>
                         </table>
                         <div class="pagination pagination-centered">
                          <ul>
                            <li><a href="#">Prev</a></li>
                            <li class="active">
                              <a href="#">1</a>
                            </li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">Next</a></li>
                          </ul>
                        </div>
                    </div>
                </div><!--/span-->

                <div class="box span6">
                    <div class="box-header">
                        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Condensed Table</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <table class="table table-condensed">
                              <thead>
                                  <tr>
                                      <th>Username</th>
                                      <th>Date registered</th>
                                      <th>Role</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/01/01</td>
                                    <td class="center">Member</td>
                                    <td class="center">
                                        <span class="label label-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/02/01</td>
                                    <td class="center">Staff</td>
                                    <td class="center">
                                        <span class="label label-important">Banned</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/02/01</td>
                                    <td class="center">Admin</td>
                                    <td class="center">
                                        <span class="label">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/03/01</td>
                                    <td class="center">Member</td>
                                    <td class="center">
                                        <span class="label label-warning">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/01/21</td>
                                    <td class="center">Staff</td>
                                    <td class="center">
                                        <span class="label label-success">Active</span>
                                    </td>
                                </tr>
                              </tbody>
                         </table>
                         <div class="pagination pagination-centered">
                          <ul>
                            <li><a href="#">Prev</a></li>
                            <li class="active">
                              <a href="#">1</a>
                            </li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">Next</a></li>
                          </ul>
                        </div>
                    </div>
                </div><!--/span-->

            </div><!--/row-->

            <div class="row-fluid sortable ui-sortable">
                <div class="box span12">
                    <div class="box-header">
                        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Combined All Table</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <table class="table table-bordered table-striped table-condensed">
                              <thead>
                                  <tr>
                                      <th>Username</th>
                                      <th>Date registered</th>
                                      <th>Role</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/01/01</td>
                                    <td class="center">Member</td>
                                    <td class="center">
                                        <span class="label label-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/02/01</td>
                                    <td class="center">Staff</td>
                                    <td class="center">
                                        <span class="label label-important">Banned</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/02/01</td>
                                    <td class="center">Admin</td>
                                    <td class="center">
                                        <span class="label">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/03/01</td>
                                    <td class="center">Member</td>
                                    <td class="center">
                                        <span class="label label-warning">Pending</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dennis Ji</td>
                                    <td class="center">2012/01/21</td>
                                    <td class="center">Staff</td>
                                    <td class="center">
                                        <span class="label label-success">Active</span>
                                    </td>
                                </tr>
                              </tbody>
                         </table>
                         <div class="pagination pagination-centered">
                          <ul>
                            <li><a href="#">Prev</a></li>
                            <li class="active">
                              <a href="#">1</a>
                            </li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">Next</a></li>
                          </ul>
                        </div>
                    </div>
                </div><!--/span-->
            </div><!--/row-->
    </div>
<?php $Layout->script_block_begin();?>
<script type="text/javascript">
function sparkline_charts(){
    randNum = function(){
        //return Math.floor(Math.random()*101);
        return (Math.floor( Math.random()* (1+40-20) ) ) + 20;
    }
     <?php if(!empty($datalist)):?>
    <?php foreach($datalist as $k=>$val):?>
    <?php if($val['yyb_id']==8888 || $k>40 ){continue;}?>
    //var data_<?php echo $val["yyb_id"];?> = [[1, 3+randNum()], [2, 5+randNum()], [3, 8+randNum()], [4, 11+randNum()],[5, 14+randNum()],[6, 17+randNum()],[7, 20+randNum()], [8, 15+randNum()], [9, 18+randNum()], [10, 22+randNum()]];
    <?php
        if(empty($lhb_link[$val['yyb_id']] )){
            $_tk = array([1,0],[2,0]);
        }else{
            $_tk = array(); $i=1;
            foreach($lhb_link[$val['yyb_id']] as $_v){
                $_tk[] = '['.$i.','.intval(($_v['B']-$_v['S'])/10000).']';
                $i+=1;
            }

        }
     ?>
    var data_<?php echo $val["yyb_id"];?> =[<?php echo implode(',', $_tk)?>];


    var placeholder = '.sparkLineStats-<?php echo $val["yyb_id"];?>';
    if($.browser.msie  && parseInt($.browser.version, 10) === 8) {

                $(placeholder).sparkline(data_<?php echo $val["yyb_id"];?>, {
                    width: 200,
                    height: 50,
                    lineColor: '#ffffff',
                    fillColor: '#ffffff',
                    spotColor: '#ffffff',
                    maxSpotColor: '#ffffff',
                    minSpotColor: '#ffffff',
                    spotRadius: 2,
                    lineWidth: 1
                });

            } else {

                $(placeholder).sparkline(data_<?php echo $val["yyb_id"];?>, {
                    width: 200,
                    height: 50,
                    lineColor: '#cccccc',
                    fillColor: 'rgba(255,255,255,0.2)',
                    spotColor: '#cccccc',
                    maxSpotColor: '#dddddd',
                    minSpotColor: '#cccccc',
                    spotRadius: 2,
                    lineWidth: 1
                });

            }
    <?php endforeach;?>
    <?php endif;?>
}
$(document).ready(function(){
    sparkline_charts();
});
</script>

<?php $Layout->script_block_end();?>