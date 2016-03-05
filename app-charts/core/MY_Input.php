<?php

class MY_Input extends CI_Input {

    public function __construct() {
        parent::__construct();
    }

    private $user_id;
    public function set_user_id ($user_id) {
        $this->user_id = $user_id;
    }
    public function get_user_id () {
        return $this->user_id;
    }
    private $user_name;
    public function set_user_name ($name) {
        $this->user_name = $name;
    }
    public function get_user_name () {
        return $this->user_name;
    }

    private $user_type;
    public function set_user_type ($user_type) {
        $this->user_type = $user_type;
    }
    public function get_user_type () {
        return $this->user_type;
    }

    /**
     * 取得http请求的参数，缺省情况包括queryString($_GET), form($_POST)和seo的参数，
     * 但不包括cookie。
     *
     * @return array ref
     */
    public function get_parameters() {
        if (!isset($this->parameters)) {
            $this->parameters = $this->load_parameters();
        }
        return $this->parameters;
    }

    public function get_parameter($name) {
        if (!isset($this->parameters)) {
            $this->parameters = $this->load_parameters();
        }
        if(isset($this->parameters[$name])){
            return $this->parameters[$name];
        }else{
            return NULL;
        }
    }

    protected $parameters;

    /**
     * 设置参数解析对象
     *
     * @param $loader
     */
    public function set_parameters_loader($loader) {
        $this->parameters_loader = $loader;
    }

    public function load_parameters() {
         $parms = array_merge(
            $_GET,
            $_POST);
         return $this->security->xss_clean($parms);
    }

    protected $parameters_loader;

    public function get_client_ips() {
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