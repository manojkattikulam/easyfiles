<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Order extends CI_Controller {

  public function index(){

    if(isset($_SESSION['ad_login']) == TRUE ){
  
      // Pagination for admin client page
      $config['base_url']    = site_url().'ad_orders/index/';
      $config['total_rows']  = $this->db->count_all('orders');
      $config['per_page']    = 10;
      $config['uri_segment'] = 3;
  
      $this->pagination->initialize($config);
  
      $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
  
      $data['allOrders']=$this->Admins_order_model->getOrderDetails($config['per_page'], $page);
      $data['links'] = $this->pagination->create_links();
  
      $this->load->view('templates/admin_header');
      $this->load->view('admin/ad_order',$data);
      $this->load->view('templates/admin_footer');
  
    } else {
  
      redirect('admins');
  
    }
  
  }
  
  
  
  


}//END