<?php
//Api调用接口
class Performance {

    public static function &get_instance() {
        if (!self::$instance) {
            self::$instance = new Performance();
        }
        return self::$instance;
    }
    private static $instance;

    private $logs=array();

    public function log($str){
        $this->logs[] = $str;
    }

    public function run_run(){
        $output = '<div id="codeigniter_profiler2" style="clear:both;background-color:#fff;padding:10px;">';
        $output .= '<fieldset id="ci_profiler_csession" style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee;"><legend style="color:#900;">&nbsp;&nbsp;Java_API&nbsp;&nbsp;</legend>';
        $output .= print_r($this->logs, true);
        $output .= '</fieldset></div>';
        echo $output ;
    }
}