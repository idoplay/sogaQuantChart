<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lhb extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $params = $this->input->get_parameters();
        $date = empty($params['d']) ? 0: $params['d'];


        $Bll_OpeningDay = $this->load->bll('Bll_OpeningDay');
        //取最近10个交易日
        $openday_list = $Bll_OpeningDay->get_last_opening_day(10);
        $this->data['openday_list'] = $openday_list;
        if(empty($date)){
            $date = array_keys($openday_list)[0];
        }

        $params['d'] = $date;
        $bll_lhb = $this->load->bll('Bll_Lhb');
        $_datalist = $bll_lhb->find_lhb_daily($date);

        $yyb_ids = array();
        $jg = array();#机构
        $datalist = array();
        foreach ($_datalist as $value) {
            if($value['yyb_id']==8888){
                $jg = $value;
                continue;
            }
            $yyb_ids[] = $value['yyb_id'];
            $datalist[] = $value;
        }
        $lhb_yyb = $bll_lhb->find_all(array('codex'=>$yyb_ids),'codex');

        $datalist = $bll_lhb->sysSortArray($datalist,'B','SORT_DESC');

        //净买入
        $datalist_J_B = $bll_lhb->sysSortArray($datalist,'JBS','SORT_DESC');

        //净卖出
        $datalist_J_S = $bll_lhb->sysSortArray($datalist,'JBS','SORT_ASC');

        //取营业部最近10天交易量
        $b = array_keys($openday_list);
        $b = array_reverse($b);

        $lhb_link = $bll_lhb->get_yyb_days_detail($b);
        $this->data['lhb_link'] = $lhb_link;
        $this->data['params'] = $params;
        $this->data['datalist'] = $datalist;
        $this->data['datalist_J_B'] = $datalist_J_B;
        $this->data['datalist_J_S'] = $datalist_J_S;
        $this->data['lhb_yyb'] = $lhb_yyb;
        $this->data['lhb_jg'] = $jg;
        //stock_list
        $Bll_StockTrade = $this->load->bll('Bll_StockTrade');
        $this->data['stock_list'] = $Bll_StockTrade->get_stock_list(array(),'s_code');

        $this->layout->set_title(1);
        $this->layout->set_keywords(2);
        $this->layout->set_description(3);
        $this->layout->view('lhb',$this->data);
    }
}