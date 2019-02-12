<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Order extends CI_Controller {

  public function index(){

    if(isset($_SESSION['ad_login']) == TRUE ){
  
      // Pagination for admin client page
      $config['base_url']    = site_url().'Admin_Order/index/';
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


  public function force_download()
{

	if(isset($_POST['file_name'])){
    $file = $_POST['file_name'];
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'.$file.'"');
    readfile('mystery_folder/'.$file);
    exit();
	}

}

public function pdfdetails($txId)
 {
  $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
  }
		$html_content = '<a href="'.$previous.'">Retour</a>';	
		$html_content .= '<h1 align="center">Facture - EasyFile Management</h1>';
		$html_content .= '<h3 align="right">'.$this->session->userdata('clientname').'</h3>';
		$html_content .= $this->Admins_order_model->fetch_invoice_adminClient_details($txId);
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$txId.".pdf", array("Attachment"=>0));
		
 }

  

  


}//END