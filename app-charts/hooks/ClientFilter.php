<?php
#屏蔽用户
class ClientFilter{

    public function init(){
        $ips = $this->_get_client_ips();
        $ipdeny = config_item('ipdeny');

        if(!empty($ipdeny)){
            foreach($ips as $ip) {
                if(in_array($ip, $ipdeny)) {
                    show_404();
                }
            }
        }
    }

    private function _get_client_ips() {
        $ips = array();
        if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if (is_array($ips) && ! empty($_SERVER["HTTP_CLIENT_IP"])) {
                $ips[] = $_SERVER["HTTP_CLIENT_IP"];
            }
            foreach($ips as $key => $ip) {
                if (eregi('^(10|172\.16|192\.168)\.', $ip)) {
                    unset($ips[$key]);
                }
            }
        }
        if (empty($ips)) {
            $ips = array(
                    $_SERVER['REMOTE_ADDR']
            );
        }
        return $ips;
    }
}