<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testajax_controller extends CI_Controller {

  public function __construct() {
    parent::__construct();
}

public function index(){
  
   

    $this->load->view('templates/home_header');
    $this->load->view('testajax_view');
    $this->load->view('templates/home_footer');
   
}


}//END