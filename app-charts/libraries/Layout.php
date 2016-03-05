<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Layout{

    private $_ci;
    public $name = 'default';
    public $title = '一';
    public $description = '一';
    public $keywords = '一';
    public $styles = array();
    public $javascript = array();
    public $lib_styles = array();
    public $layout_header = 'component/header';
    public $layout_footer = 'component/footer';

    public function __construct() {
         $this->_ci = &get_instance();
         $this->baseUrl = $this->_ci->config->slash_item('base_url');
    }
    public static function &get_instance() {
        if (!self::$instance) {
            self::$instance = new Layout();
        }
        return self::$instance;
    }

    private static $instance;

    public function component($component_path,$i_data = array()){
        #$component_path = 'component/' . $name;
        return $this->_ci->load->view($component_path, $i_data, true);
    }

    public function view($view = 'site/index', $view_data = array()){
        $this->data['Layout'] = &$this;
        $this->data = array_merge($this->data, $view_data);
        $this->data['contents_for_layout'] = $this->_ci->load->view($view, $this->data, true);

        $this->data['title_for_layout'] = $this->_get_title();
        $this->data['keywords_for_layout'] = $this->_get_keywords();
        $this->data['description_for_layout'] = $this->_get_description();
        $this->data['script_for_layout'] = $this->_get_scripts();
        $this->data['style_for_layout'] = $this->_get_styles();
        $this->data['lib_style_for_layout'] = $this->_get_lib_styles();

        $this->_ci->load->view($this->name, $this->data);

    }

    public function set_layout($name){
        $this->name = $name;
    }
    public function get_head_sections() {
        return array_merge(
            array('<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />'),
            array('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />')
        );
    }

    public function set_header($header=''){
        $this->layout_header = $header;
    }
    public function set_footer($footer=''){
        $this->layout_footer = $footer;
    }
    public function get_header(){
        return $this->layout_header;
    }
    public function get_footer(){
        return $this->layout_footer;
    }

    private function _get_title(){
        $title = 'g ';
        if ($this->title_for_layout) {
            $title = $this->title_for_layout;
        }
        return $title;
    }
    public function set_title($title){
        $this->title_for_layout = $title;
    }
    private function _get_keywords(){
        return $this->keywords;
    }
    public function set_keywords($keywords=''){
        $this->keywords = $keywords;
    }
    private function _get_description(){
        return $this->description;
    }
    public function set_description($description=''){
        $this->description = $description;
    }
    public function use_css($css_file){
        if(is_array($css_file)){
            $this->styles = array_merge($this->styles,$css_file);
        }else{
            $this->styles[] = $css_file;
        }
    }
    public function use_lib_css($css=''){
        $this->lib_styles[] = 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext';
    }
    public function _get_lib_styles(){
        //TODO
        $this->use_lib_css();
        return $this->lib_styles;
    }

    private function _get_styles(){
        $def_css = array(
            "css/bootstrap.min.css",
            "css/bootstrap-responsive.min.css",
            "css/style.css",
            "css/style-responsive.css"
            );
        return array_merge($this->styles,$def_css);
    }

    public function get_style_url($uri) {
        $img_host = $this->_ci->config->item('img_host');
        return $img_host.'/pages/' . $uri;
    }

    public function use_javascript($js_file){
        if(is_array($js_file)){
            $this->javascript = array_merge($this->javascript,$js_file);
        }else{
            $this->javascript[] = $js_file;
        }
    }

    private function _get_scripts(){
        $def_js = array(
            //'echarts/echarts.js',
            'js/jquery-1.10.2.min.js',
            "js/jquery-migrate-1.0.0.min.js",
            "js/jquery-ui-1.10.0.custom.min.js",
            "js/jquery.ui.touch-punch.js",
           // "js/modernizr.js",
            "js/bootstrap.min.js",
            "js/jquery.cookie.js",
            "js/fullcalendar.min.js",
            "js/jquery.dataTables.min.js",
            //"js/excanvas.js",
            "js/jquery.flot.js",
            "js/jquery.flot.pie.js",
            "js/jquery.flot.stack.js",
            "js/jquery.flot.resize.min.js",
            "js/jquery.chosen.min.js",
            "js/jquery.uniform.min.js",
            "js/jquery.cleditor.min.js",
            "js/jquery.noty.js",
            "js/jquery.elfinder.min.js",
            "js/jquery.raty.min.js",
            "js/jquery.iphone.toggle.js",
           // "js/jquery.uploadify-3.1.min.js",
            "js/jquery.gritter.min.js",
            "js/jquery.imagesloaded.js",
            "js/jquery.masonry.min.js",
            "js/jquery.knob.modified.js",
            "js/jquery.sparkline.min.js",
            "js/counter.js",
            "js/retina.js",
           // "js/custom.js",
            );
        return array_merge($def_js,$this->javascript);
    }

    public function get_javascript_url($uri) {
        $img_host = $this->_ci->config->item('img_host');
        return $img_host.'/pages/' . $uri;
    }
    //TODO 一component 加载多次未实现
    public function script_block_begin(){
        ob_start();
    }
    public function script_block_end(){
        $content = ob_get_contents();
        $this->register_script_block($content);
        ob_end_clean();

    }
    private $resource_index=0;
    public function register_script_block($content) {
        $this->script_blocks[$this->resource_index] = $content;
        $this->resource_index++;
    }

    public function get_script_blocks() {
        if (!$this->script_blocks_processed) {
            $values = $this->script_blocks;
            $this->script_blocks = array();
            foreach ($values as $value) {
                $this->script_blocks[] = $value;
            }
            $this->script_blocks_processed = true;
        }
        return $this->script_blocks;
    }

    private $script_blocks = array();
    private $script_blocks_processed = false;
}