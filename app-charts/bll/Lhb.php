<?php

class Bll_Lhb extends MY_Bll{


    public function find_all($where = array(),$field=''){
        $_m_lhb = $this->get_dao('S_lhb');
        #return $_m_lhb->find($where,'',0);
        $_res = $_m_lhb->find($where,'',0);
        $data = array();
        if(!empty($field) && !empty($_res)){
            foreach ($_res as $value) {
                $data[$value[$field]] = $value;
            }
        }
        return $data;
    }
    //处理一天的数据
    public function find_lhb_daily($day=0){
        $_m_lhb = $this->get_dao('S_lhb_days_detail');
        $_data = $_m_lhb->find(array('dateline'=>$day),'',0);
        $res = array();
        if(!empty($_data)){
            $_record = array();
            foreach ($_data as $value) {
                $_tmp = implode('|',array($value['s_code'],$value['yyb_id'],$value['B_volume'],$value['S_volume']));
                #买前5，也会出现卖5
                if(!in_array($_tmp,$_record)){
                    $_record[] = $_tmp;
                    if(!isset($res[$value['yyb_id']])){
                        $res[$value['yyb_id']] = array(
                            'yyb_id'=>$value['yyb_id'],
                            'B'=>0,
                            'S'=>0,
                            'JBS'=>0,
                            'stocks'=>array()
                            );
                    }
                    $res[$value['yyb_id']]['B'] += $value['B_volume'];
                    $res[$value['yyb_id']]['S'] += $value['S_volume'];
                    $_j =$value['B_volume']-$value['S_volume'];
                    $res[$value['yyb_id']]['JBS'] += $_j;
                    $res[$value['yyb_id']]['stocks'][] = $value['s_code'];
                }
            }
        }
        return $res;
    }
    #交易日每天的量,没有上榜至为0
    public function get_yyb_days_detail($days=array()){
        $_m_lhb = $this->get_dao('S_lhb_daily');
        $_data = $_m_lhb->find(array('dateline'=>$days),'',0);
        #print_r($days);exit;
        $res = array();
        if(!empty($_data)){
            $data = array();
            foreach ($_data as $key => $value) {
                $data[$value['yyb_id']][$value['dateline']] = $value;
            }
            foreach ($data as $yyb_id =>$value) {
                foreach ($days as $d) {
                    if (isset($data[$yyb_id][$d])) {
                        $res[$yyb_id][$d] = $value[$d];
                    }else{
                        $res[$yyb_id][$d] = array('B'=>0,'S'=>0);
                    }
                }
            }
        }
        return $res;
    }

    public function get_lhb_data($date){
        $sql="select * from s_lhb_days where dateline in(".implode(',',$date).")";
        $_m_lhb = $this->get_dao('S_lhb');
        $_m_lhb_detail = $this->get_dao('S_lhb_days_detail');

        $data = $_m_lhb->find_by_sql($sql);
        $_res = $res = array();
        foreach ($data as $value) {
            if(!isset($_res[$value['dateline']])){
                $_res[$value['dateline']] =0;
            }
            $_res[$value['dateline']] += $value['volume'];
        }
        foreach ($date as $value) {
            $_tmp = array();
            $sql2 = "select * from s_lhb_days_detail where dateline=".$value;
            $_data = $_m_lhb_detail->find_by_sql($sql2);
            $_tmp_yyb = array();
            foreach ($_data as $val) {//一个票中营业部买入又卖出
                if(!empty($_tmp[$val['s_code']]) && in_array($val['yyb_id'],$_tmp[$val['s_code']])){
                    continue;//$val['B_volume'] - $val['S_volume'];
                }
                $_tmp_yyb[$value][$val['yyb_id']][] = $val['B_volume'] - $val['S_volume'];
                $_tmp[$val['s_code']][] = $val['yyb_id'];
            }

            if(!empty($_tmp_yyb[$value])){
                foreach ($_tmp_yyb[$value] as $yyb_id => $_v) {
                    if($yyb_id!=80052395){
                        //continue;
                    }
                    if(!isset($res[$value]['yyb']['cnt'])){
                        $res[$value]['yyb']['cnt'] = 0;
                    }

                    if(!isset($res[$value]['yyb']['in'])){
                        $res[$value]['yyb']['in'] = 0;
                    }
                    if(!isset($res[$value]['yyb']['out'])){
                        $res[$value]['yyb']['out'] = 0;
                    }
                    $x = array_sum($_v);
                    $res[$value]['yyb']['cnt'] +=1;
                    if($x>0){
                        $res[$value]['yyb']['in'] +=1;
                    }else{
                        $res[$value]['yyb']['out'] +=1;
                    }
                }
            }
            if(!isset($res[$value]['yyb']['cnt'])){
                $res[$value]['yyb']['cnt'] = 0;
            }
            if(!isset($res[$value]['yyb']['in'])){
                $res[$value]['yyb']['in'] = 0;
            }
            if(!isset($res[$value]['yyb']['out'])){
                $res[$value]['yyb']['out'] =0;
            }
           // $res[$value][$val['yyb_id']] = array_sum($res[$value]);

            //$res[$value]['yyb'] = mt_rand(1,10);
            if(!isset($_res[$value])){
                $res[$value]['volumes'] = 0;

            }else{
                $_t = $_res[$value]/10000;
                $res[$value]['volumes'] = $_t;
            }
        }
        return $res;
    }
}