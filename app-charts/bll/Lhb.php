<?php

class Bll_Lhb extends MY_Bll{


    public function find_all(){
        $_m_lhb = $this->get_dao('S_lhb');
        return $_m_lhb->find(array(),'',0);
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