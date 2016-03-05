<?php

class Bll_OpeningDay extends MY_Bll{

    public function past_next_day($date){
        $m = $this->get_dao('S_opening_day');
        $_xd =$m->find_row(array("dateline>".$date ." and 1="=>1),'dateline asc');
        $_xd2 = $m->find_row(array("dateline< ".$date ." and 1="=>1),'dateline DESC');
        $res = array();
        $res['next'] = empty($_xd) ? 0 : $_xd['dateline'];
        $res['past'] = empty($_xd2) ? 0 : $_xd2['dateline'];
        return $res;
    }

    #取最近的交易日
    public function get_last_opening_day($num,$date=0){
        if(!$date){
            $date = date('Ymd');
        }
        $m = $this->get_dao('S_opening_day');
        return $m->find(array('dateline <='.$date.' and 1='=>1),'dateline DESC',$num);
    }

    public function get_date($start=0,$end=0,$limit=62){
        $end = $end>0 ? $end :date('Ymd',time());

        $_where = array();
        if($start){
            $_where[] = " dateline>=".$start;
        }
        $_where[] = " dateline<=".$end;
        $sql = "select * from s_opening_day where ".implode(' AND ', $_where) ;
        if(!$start){
            $sql .= " order by dateline DESC  limit ".$limit;
        }
        $m = $this->get_dao('S_opening_day');
        $list = $m->find_by_sql($sql);
        $res = array();
        foreach($list as $val){
            $res[] = $val['dateline'];
        }
        $res = array_reverse($res);
        return $res;
    }
}