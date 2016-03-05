<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }


    private function _json_encode($res){
         echo json_encode($res);
    }

}