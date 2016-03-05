<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guide extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $Bll_OpeningDay = $this->load->bll('Bll_OpeningDay');
        $date_list = $Bll_OpeningDay->get_date();

        $Bll_StockTrade = $this->load->bll('Bll_StockTrade');
        //上证指数
        $index_data = $Bll_StockTrade->get_sz_index_data($date_list);
        //涨停榜
        $ztb_list = $Bll_StockTrade->get_ztb_data($date_list);
        $ztb_top = $ztb_list['ztb_top'];
        $ztb_last = $ztb_list['ztb_last'];

        //龙虎榜
        $Bll_Lhb = $this->load->bll('Bll_Lhb');
        $lhb_list = $Bll_Lhb->get_lhb_data($date_list);

        //开盘、上涨、下跌
        $max_ud = $Bll_StockTrade->get_daily_data($date_list);

        $this->data['date_list'] = $date_list;
        $this->data['index_data'] = $index_data;
        $this->data['ztb_top'] = $ztb_top;
        $this->data['ztb_last'] = $ztb_last;
        $this->data['lhb_list'] = $lhb_list;
        $this->data['max_ud'] = $max_ud;

        $this->layout->set_title(1);
        $this->layout->set_keywords(2);
        $this->layout->set_description(3);
        $this->layout->view('guide',$this->data);
    }
}