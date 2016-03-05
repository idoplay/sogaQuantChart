<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Runtime extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $this->data['runtime_min'] = $this->get_runtime_min();
        $this->layout->set_title(1);
        $this->layout->set_keywords(2);
        $this->layout->set_description(3);
        $this->layout->view('home',$this->data);
    }
    public function pr($data){
        echo "<pre>";
        print_r($data);
    }
    public function get_runtime_min($date=array()){
        //return $this->get_runtime_data();
        $this->load->model('S_status');
        $data = $this->S_status->find(array(),'s_t asc' ,500);
        $res = array();
        foreach ($data as $value) {
            $res[date('H:i',$value['s_t'])] = $value;
        }
        return $res;
    }
    /*
    public function get_runtime_data($date=array()){
        $sql="select * from s_stock_trade where dateline in(20160304,20160303,20160302,20160301,20160229)";
        #echo $sql;exit;
        $data = $this->db->fetch_all($sql);
        #print_r($data);
        $res = array();
        foreach ($data as $value) {
            $type = $this->_check_pos($value['chg']);
            $res[$value['dateline']]['t_'.$type] += 1;
        }
        //print_r($res);
        return $res;

    }*/
    private function _check_pos($chg){

        if($chg <= -5){
            $type =1;
        }elseif ($chg >-5 && $chg<=-3) {
            $type =2;
        }elseif($chg >-3 && $chg <=0){
            $type =3;
        }elseif($chg >0 && $chg <=3){
            $type =4;
        }elseif($chg >3 && $chg <=7){
            $type =5;
        }else{
            $type =6;
        }
        return $type;
    }
}
