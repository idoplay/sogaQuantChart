<?php
class Debugger{

    public function set_debug(){
        $CI = & get_instance();
        #$CI->config->load('common');
        $client_ip = $CI->input->ip_address();
        $allow_patterns = $CI->config->item("debug_allow_patterns");
        $is_allow_debug = false;
        if (is_array($allow_patterns) && !empty($allow_patterns)) {
            foreach ($allow_patterns as $pattern) {
                if (preg_match($pattern, $client_ip)) {
                    $is_allow_debug = TRUE;
                    break;
                }
            }
        }

        if($is_allow_debug){
            $debug_cookie = $CI->input->cookie("_debug");
            $debug_param = $CI->input->get('debug',1);
            if (isset($debug_param) && $debug_param == 0) {
                if (isset($debug_cookie)) {
                    $CI->input->set_cookie("_debug",0,-1);
                    define('IS_ALLOW_DEBUG', 0);//#为了给api debug使用
                }
                return true;
            }
            if (isset($debug_param) && $debug_param > 0) {
                $CI->input->set_cookie("_debug",1,43200);
                $CI->output->enable_profiler(true);
                define('IS_ALLOW_DEBUG', 1);
                return true;
            }
            if (isset($debug_cookie) && $debug_cookie > 0) {
                $CI->output->enable_profiler(true);
                define('IS_ALLOW_DEBUG', 1);
                return true;
            }
        }
    }
}