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
                        <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
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
                                        echo '<a href="/limit_up?d='.$value['dateline'].'" target="_blank" class="btn '.$ccx.'">'.$value['dateline'].'</a>';
                                    }?>
                                 </div>

                             </div>

                            </div>

                            <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                          <thead>
                              <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="" style="width: 100px;">Code</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 100px;">High</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 148px;">前/后</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 157px;">封单/流通</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 311px;">封额/成交</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 80px;">主导</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 80px;">做T</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 80px;">力度</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 80px;">LHB</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="" style="width: 311px;">题材</th>
                            </tr>
                          </thead>

                      <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php if(!empty($datalist)):?>
                        <?php foreach($datalist as $val):?>
                        <?php if(preg_match('/N/',$val['name'])){continue;}?>
                            <tr class="odd">
                                <td class=" sorting_1"><font color="<?php if(!empty($val['no_lhb'])){echo "red";}?>"><?=$val['s_code']?><br><?=$val['name']?></font></td>
                                <td class="center "><font color="<?php if($val['chg']<0){echo "#090";}else{echo "red";}?>"><?=$val['close']?><br><?=$val['chg']?></font></td>
                                <td class="center "><?php if(!empty($prev_list[$val['s_code']])){echo $prev_list[$val['s_code']]['chg'];}?><br><?php if(!empty($next_list[$val['s_code']])){echo $next_list[$val['s_code']]['chg'];}?></td>

                                <?php if(!empty($val['is_ztb'])):?>
                                <td class="center "><a title="FD:<?=$val['cj']['B_1_volume'];?>&#13;LT:<?=$val['run_capital']?>"><?=number_format($val['cj']['B_1_volume']/$val['run_capital'],3)?><br>封单:<?=$val['cj']['B_1_volume'];?><br>流盘:<?=$val['run_capital']?></td>
                                <td class="center ">
                                    <?php
                                        $_F = number_format(($val['cj']['B_1_volume']*$val['close'])/10000,2,'.','');
                                        $_C = number_format($val['amount']/10000,2,'.','');
                                    ?>
                                    封单:<?=$_F?><br>
                                    成交:<?=$_C?>
                                    </td>
                                <?php else:?>
                                    <td class="center "></td>
                                    <td class="center "></td>
                                <?php endif;?>

                                <td class="center "><?php if(!empty($val['jg'])){echo '机构';}?><?php if(!empty($val['yz'])){echo '游资';}?></td>
                                <td class="center "><?php $_zt_str = ''; if(!empty($val['zT'])){
        foreach($val['zT'] as $value){$_zt_str .=$yyb[$value]['name']."&#13;";}
    }?>
    <a title="<?=$_zt_str?>" ><?php if(!empty($val['zT'])){echo count($val['zT']);}else{echo 0;}?></a></td>
                                <td class="center "><a title="B:<?=$val['B_cnt']?>&#13;S:<?=$val['S_cnt']?>"><?php if(!empty($val['rate'])){echo $val['rate'];}?></a></td>
                                <td class="center">
                                    <?php $_lh_detail = array(); if(!empty($val['S_yyb'])){
                                        $has_ids = array();
                                        if(!empty($val['B_yyb'])){
                                            $y = 1;
                                            foreach($val['B_yyb'] as $_byyd =>$value){
                                                $_lh_detail[] = "B".$y.":".($value/10000).$yyb[$_byyd]['name'];
                                                $y+=1;
                                                $has_ids[] = $_byyd;
                                            }
                                        }
                                        $z=1;
                                        foreach($val['S_yyb'] as $_syyd =>$value){
                                            $_stx = "S".$z.":".($value/10000);
                                            if(in_array($_syyd,$has_ids)){
                                                $_stx .= "<font color='red'>".$yyb[$_syyd]['name']."</font>";
                                            }else{
                                                $_stx .= $yyb[$_syyd]['name'];
                                            }
                                            $_lh_detail[] = $_stx;
                                            $z+=1;
                                        }
                                    } ?>
    <a title="<?=implode('&#13;',$_lh_detail)?>" >11111</a></td>
                                <td class="center "><a title="<?php echo implode('&#13;',array_unique($val['cate']))?>">
                                    <?php $cc =array_unique($val['cate']);foreach ($cc as $_tk=>$value) {
                                        if($_tk>5){break;}
                                        echo '<span class="label">'.$value.'</span>';
                                    }
                                    ?></a>
                                </td>
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
                        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>题材归类</h2>
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
                                  </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($tag_list as $key => $value) :?>
                                    <tr>
                                    <td><?=$key?></td>
                                    <td class="center">
                                        <span class="label label-success"><?=$value?></span>
                                    </td>
                                </tr>
                                <?php endforeach;?>
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
                        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Striped Table</h2>
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