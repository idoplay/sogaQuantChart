<?php

class Bll_StockTrade extends MY_Bll{

    public function find($where,$order='',$limit=500){
        $_m = $this->get_dao('S_stock_trade');
        return $_m->find($where,$order,$limit);
    }
    public function get_stock_list($where,$field=''){
        $_m =$this->get_dao('S_stock_list');
        $_res = $_m->find($where,'',0);
        $data = array();
        if(!empty($field) && !empty($_res)){
            foreach ($_res as $value) {
                $data[$value[$field]] = $value;
            }
        }
        return $data;
    }
    #指数
    public function get_sz_index_data($date){
        $sql="select * from s_index where dateline in(".implode(',',$date).") and zs_code='000001'";
        $_m = $this->get_dao('S_index');
        $data = $_m->find_by_sql($sql);
        $res = array();
        foreach ($data as $value) {
            $res[$value['dateline']] = $value;
        }
        $_kk=array();
        $_end = end($res);
        foreach ($date as $value) {
            if(empty($res[$value])){
                $_kk[$value]=array(
                        'open'=>$_end['close'],
                        'close'=>$_end['close'],
                        'high'=>$_end['close'],
                        'low'=>$_end['close'],
                        );
            }else{
                $_kk[$value]=$res[$value];
            }
        }
        return $_kk;
    }

    private $report_data = array();
    private function get_report_data($date){
        $sql="select * from s_daily_report where dateline in(".implode(',',$date).")";
        $_m = $this->get_dao('S_daily_report');
        $data = $_m->find_by_sql($sql);
        $res = array();
        foreach ($data as $value) {
            $res[$value['dateline']] = $value;
        }
        $this->report_data = $res;
        return $res;
    }
    public function get_daily_data($date){
        if(!empty($this->report_data)){
            $res = $this->report_data;
        }else{
            $res = $this->get_report_data($date);
        }
        $rs = array(
            'sz_max'=>array(),
            'sz_up'=>array(),
            'sz_down'=>array(),

            'on_ma5'=>array(),
            'on_ma10'=>array(),
            'on_ma20'=>array(),
            'on_ma30'=>array(),
            'on_ma60'=>array(),
            );

        foreach ($date as $value) {
            $rs['sz_max'][] = $res[$value]['sz_max'];
            $rs['sz_up'][] = $res[$value]['sz_up']>550 ? 550 : $res[$value]['sz_up'];
            $rs['sz_down'][] = $res[$value]['sz_down'];

            $rs['on_ma5'][] = $res[$value]['on_ma5']==0 ? 1 : $res[$value]['on_ma5'];
            $rs['on_ma10'][] = $res[$value]['on_ma10']==0 ? 1 : $res[$value]['on_ma10'];
            $rs['on_ma20'][] = $res[$value]['on_ma20']==0 ? 1 : $res[$value]['on_ma20'];
            $rs['on_ma30'][] = $res[$value]['on_ma30']==0 ? 1 : $res[$value]['on_ma30'];
            $rs['on_ma60'][] = $res[$value]['on_ma60']==0 ? 1 : $res[$value]['on_ma60'];

        }
        return $rs;
    }

    public function get_ztb_data($date){
        if(!empty($this->report_data)){
            $res = $this->report_data;
        }else{
            $res = $this->get_report_data($date);
        }
        $ztb_top = $ztb_last = array();
        foreach ($date as $value) {
            if(isset($res[$value]['zt_top'])){
                $ztb_top[] = $res[$value]['zt_top'] >500 ? 300 : $res[$value]['zt_top'];
            }else{
                $ztb_top[]=10;
            }
            if(isset($res[$value]['zt_last'])){
                $ztb_last[] = $res[$value]['zt_last'] >500 ? 300 : $res[$value]['zt_last'];
            }else{
                $ztb_last[]=10;
            }
        }
        return array(
            'ztb_top'=>$ztb_top,
            'ztb_last'=> $ztb_last
            );
    }
}