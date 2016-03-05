<?php

class MY_Loader extends CI_Loader {

    /**
     * List of loaded sercices
     *
     * @var array
     * @access protected
     */
    protected $_ci_services = array();

    /**
     * List of paths to load sercices from
     *
     * @var array
     * @access protected
     */
    protected $_ci_service_paths = array();

    /**
     * Constructor
     *
     * Set the path to the Service files
     */
    public function __construct() {

        parent::__construct();
        //$this->add_package_path(APPPATH);
        load_class('Bll', 'core');
        $this->_ci_service_paths = array(APPPATH.'../app-core/',APPPATH);
    }

    public function bll($bll_name){
        $_bll_path = explode('_',$bll_name);
        #if(count($bll_path)>1){
        $file_path = array();
        foreach ($_bll_path as $key => $value) {
            if($key < (count($bll_path)-1)){
                $file_path[] = strtolower($value);
            }else{
                $file_path[] = $value;
                #$object_name = $value;
            }
        }
        #}
        //var_dump($bll_name);
        foreach ($this->_ci_service_paths as $path) {
            #$bll_path = str_replace('_','/',$bll_name);

            $filepath = $path . implode('/',$file_path). '.php';
            //echo $filepath."<br>";
            if (!file_exists($filepath)) {
                continue;
            }
            #continue;
            include_once($filepath);
            #$object_name = str_replace('/','_',$bll_name);


            #$service = explode('/',$bll_name);
            #$service = $service[count($service)-1];
            #$CI = &get_instance();

            #$CI->$bll_name = new $bll_name();
#var_dump($CI->$bll_name);
            $this->_ci_services[$bll_name] = new $bll_name();

            return $this->_ci_services[$bll_name];
        }
    }
}