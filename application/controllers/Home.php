<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{  

    if(isset($_SESSION['login']) == TRUE ){

      redirect('client_dashbd');

    } else {
        $this->load->view('templates/home_header');
        $this->load->view('home');
        $this->load->view('templates/home_footer');
    }

  }
  
  



}
