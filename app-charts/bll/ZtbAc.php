<?php

class Bll_ZtbAc extends MY_Bll{

    public function get_ztb_data_detail($date){

        $_m_lhb_detail = $this->get_dao('S_lhb_days_detail');
        $_m_close_bid = $this->get_dao('S_closing_bid');
        $_m_stock_trade = $this->get_dao('S_stock_trade');
        $_m_stock_cate = $this->get_dao('S_stock_cate_list');

        $_where = array('dateline'=>$date);
        $_data = $_m_lhb_detail->find($_where,'',0);
        $res = array();
        if(!empty($_data)){
            foreach($_data as $val){
                if(empty($res[$val['s_code']]['B_cnt'])){
                    $res[$val['s_code']]['B_cnt']=0;
                }
                if(empty($res[$val['s_code']]['S_cnt'])){
                    $res[$val['s_code']]['S_cnt']=0;
                }
                $res[$val['s_code']]['B_cnt'] += $val['B_volume'];
                $res[$val['s_code']]['S_cnt'] += $val['S_volume'];

                if($val['s_sort']==1){
                    $_k =$val['type'];
                    $res[$val['s_code']][$_k.'_one'] = $val[$_k.'_volume'];
                    if($_k=='B'){
                        $res[$val['s_code']]['yyb_id'] = $val['yyb_id'];
                    }
                }
                $res[$val['s_code']][$val['type'].'_yyb'][$val['yyb_id']] = $val[$val['type'].'_volume'];
            }
            //拉出尾盘数据,整理
            $_all_stock = $_m_close_bid->find($_where,'',0);
            $_stock_list = array();
            $_codes = array_keys($res);
            foreach ($_all_stock as $value) {
                if(in_array($value['s_code'],$_codes)){
                    $_stock_list[$value['s_code']]=$value;
                }
            }
            foreach ($res as $code=>$value) {
                if($value['B_cnt'] < $value['S_cnt']){
                    #unset($res[$code]);
                    #continue;
                }
                if(empty($res[$code]['jg'])){$res[$code]['jg']=0;}
                if(empty($res[$code]['yz'])){$res[$code]['yz']=0;}

                if($value['yyb_id']==8888){//机构主导还是游资主导
                    $res[$code]['jg'] += 1;
                }else{
                    $res[$code]['yz'] += 1;
                }
                //买一对比卖一的实力
                $res[$code]['rate'] = number_format($value['B_cnt']/$value['S_cnt'],2);
                //营业部做T
                $res[$code]['zT'] = array_intersect(array_keys($value['B_yyb']),array_keys($value['S_yyb']));
                //成交,s1为0就是打板

            }
            //有涨停但没有上榜
            $data = $_m_stock_trade->find($_where,'',0);
            foreach ($data as $value) {
                $is_build = 0;
                $_tmp = $this->_check_limit_up($value);
                if (!isset($res[$value['s_code']])) {
                    if($_tmp['l'] == 1){
                        $res[$value['s_code']] = array('no_lhb'=>1);
                        $is_build = 1;
                    }
                }else{
                    $is_build = 1;
                }
                if($is_build){
                    $res[$value['s_code']]['name'] = $value['name'];
                    $res[$value['s_code']]['s_code'] = $value['s_code'];
                    $res[$value['s_code']]['close'] = $value['close'];
                    $res[$value['s_code']]['chg'] = $value['chg'];
                    $res[$value['s_code']]['is_ztb'] = $_tmp['l'];
                    $res[$value['s_code']]['now_zf'] = $value['now_zf'];
                    $res[$value['s_code']]['turnover'] = $value['turnover'];
                    $res[$value['s_code']]['run_capital'] = $value['run_capital'];
                    $res[$value['s_code']]['amount'] = $value['amount'];
                    $res[$value['s_code']]['cj']['all_volume'] = $_stock_list[$value['s_code']]['all_volume'];
                    $res[$value['s_code']]['cj']['all_money'] = $_stock_list[$value['s_code']]['all_money'];
                    $res[$value['s_code']]['cj']['B_1_volume'] = $_stock_list[$value['s_code']]['B_1_volume'];
                    $res[$value['s_code']]['cj']['S_1_volume'] = $_stock_list[$value['s_code']]['S_1_volume'];
                }

            }
            //题材
            $s_codes = array_keys($res);
            $s_codes_str = "'".implode("','",$s_codes)."'";
            $_tmp_cate = $_m_stock_cate->find(array("s_code in(".$s_codes_str.") and 1="=>1),'',0);
            foreach ($_tmp_cate as $value) {
                $res[$value['s_code']]['cate'][] = $value['category_name'];
            }
        }
        $res = $this->sysSortArray($res,'rate','SORT_DESC');
        return $res;
    }
    private function _check_limit_up($_data=array()){
        $up_price = number_format($_data['last_close']*1.1,2);
        $res = array(
            'm'=>0,//触到涨停
            'l'=>0,//最终涨停
            'k'=>0 //开板
            );
        if($_data['last_close'] && $_data['high'] && $_data['close']){
            if($_data['high']==$up_price){
                $res['m'] = 1;
                if($_data['high']==$_data['close']){//最高价==当前价
                    $res['l']=1;
                }else{
                    $res['k']=1;
                }
            }
        }
        return $res;
    }
}