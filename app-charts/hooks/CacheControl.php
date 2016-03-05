<?php
//浏览器缓存控制
class CacheControl{

    public function init(){
        $CI = & get_instance();
        $cache_control = $CI->input->get_request_header('cache-control',true);
        if($cache_control == "no-cache") {
            $CI->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            $CI->output->set_header("Expires:".gmdate("D, d M Y H:i:s", 0) . " GMT");
            $CI->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
            $CI->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
            $CI->output->set_header("Pragma: no-cache");
        }else{
            $CI->config->load('cache');
            $cache_config = $this->get_cache_control($CI->config->item('cache_control'));
            $smaxage = isset($cache_config['smaxage']) ? $cache_config['smaxage'] : 0;
            $maxage = isset($cache_config['maxage']) ? $cache_config['maxage'] : 0;
            $expires = $maxage>0 ? (time()+$maxage) : 0;

            $CI->output->set_header("Cache-Control:public, s-maxage=$smaxage, max-age=$maxage, must-revalidate");
            #$CI->output->set_header("Last-Modified:". gmdate("D, d M Y H:i:s", time()) . " GMT");
            $CI->output->set_header("Expires:".gmdate("D, d M Y H:i:s", $expires) . " GMT");
        }
    }
    private function get_cache_control($conf) {
        if(empty($conf) || ! is_array($conf)) {
            return array();
        }
        ///echo BASE_URI;
        if(BASE_URI != '' && strpos($_SERVER['REQUEST_URI'], BASE_URI) === 0) {
            $uri = substr($_SERVER['REQUEST_URI'], strlen(BASE_URI));
        } else {
            $uri = $_SERVER['REQUEST_URI'];
        }
        #echo $uri;
        $pos = strpos($uri, '?');
        if($pos) {
            $uri = substr($uri, 0, $pos);
        }
        if(empty($uri)) {
            $uri = '/';
        }
        #print_r($conf);
        $matches = array();
        foreach($conf as $item) {
            if(ereg($item['url'], $uri, $matches)) {
                return $item;
            }
        }
        return array();
    }
}