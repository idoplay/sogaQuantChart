<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#涨停分析
class Top extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $params = $this->input->get_parameters();
        $Bll_OpeningDay = $this->load->bll('Bll_OpeningDay');
        //取最近10个交易日
        $this->data['openday_list'] = $Bll_OpeningDay->get_last_opening_day(10);

        $date = empty($params['d']) ? $this->data['openday_list'][0]['dateline'] : $params['d'];
        $params['d'] = $date;


        $Bll_ZtbAc = $this->load->bll('Bll_ZtbAc');
        $datalist = $Bll_ZtbAc->get_ztb_data_detail($date);

        //按标签归类
        $tag_list = array();
        foreach ($datalist as $value) {
            if(!empty($value['cate'])){
                foreach ($value['cate'] as $v) {
                    if($this->_filter_tag($v)){
                        continue;
                    }
                    if(isset($tag_list[$v])){
                        $tag_list[$v] +=1;
                    }else{
                         $tag_list[$v] =1;
                    }
                }
            }
        }
        arsort($tag_list);
        $s_codes = array_keys($datalist);
        $s_codes_str = "'".implode("','",$s_codes)."'";

        #取前后两交易日
        $pn_days = $Bll_OpeningDay->past_next_day($date);

        $Bll_StockTrade = $this->load->bll('Bll_StockTrade');
        if(!empty($pn_days['next'])){
            $_next_list = $Bll_StockTrade->find(array("dateline=".$pn_days['next']." and s_code in(".$s_codes_str.") and 1="=>1),'',0);
            if(!empty($_next_list)){
                foreach ($_next_list as $value) {
                    $next_list[$value['s_code']] = $value;
                }
            }
        }
        if(!empty($pn_days['past'])){
            $_prev_list = $Bll_StockTrade->find(array("dateline=".$pn_days['past']." and s_code in(".$s_codes_str.") and 1="=>1),'',0);
            if(!empty($_prev_list)){
                foreach ($_prev_list as $value) {
                    $prev_list[$value['s_code']] = $value;
                }
            }
        }

        //营业部
        $Bll_lhb = $this->load->bll('Bll_lhb');
        $_yyb = $Bll_lhb->find_all();
        $yyb = array();
        foreach ($_yyb as $value) {
            $yyb[$value['codex']] = $value;
        }
        $this->data['params'] = $params;
        $this->data['tag_list'] = $tag_list;
        $this->data['datalist'] = $datalist;
        $this->data['yyb'] = $yyb;
        $this->data['prev_list'] = $prev_list;
        $this->data['next_list'] = $next_list;

        $this->layout->set_title(1);
        $this->layout->set_keywords(2);
        $this->layout->set_description(3);
        $this->layout->view('top',$this->data);
    }
    private function _first_filter($code_data){
        $_is_match = false;
        if($code_data['run_money'] > 10000000){
            $_is_match = true;
        }elseif(preg_match('/油|ST|航空|水泥|煤|农|钢|路|纸|木|中国|车|Ａ|证券|黄金|海洋|港|N|食/',$code_data['name'])){
            $_is_match = true;
        }elseif( $code_data['current_price'] < 10 || $code_data['current_price'] >=70 ){
            $_is_match = true;
        }
        return $_is_match;
    }

    private function _filter_tag($tag){
        $blank_list = array(
            '融资融券',
            '创业板',
            '深成500',
            'AB股',
            '中证500',
            'HS300_'
            );
        if(in_array($tag,$blank_list)){
            return true;
        }
        if(preg_match('/板块/',$tag)){
            return true;
        }

        return false;
    }
}