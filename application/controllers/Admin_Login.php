<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Login extends CI_Controller {

  public function index()
	{  

    $this->load->view('templates/home_header');
    $this->load->view('admin/ad_login');
    $this->load->view('templates/home_footer');

  }


}//END