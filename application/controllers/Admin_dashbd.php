<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Dashbd extends CI_Controller {


    public function index()
    {
    
      if(isset($_SESSION['ad_login']) == TRUE ){
    
        $dataSales      = $this->Admins_dashbd_model->getDataSales();
        $totalSales     = ($dataSales->product_price * 0.2) + $dataSales->product_price;
        $dataFilesSold  = $this->db->count_all('orders');
        $numUsers       = $this->db->count_all('customers');
        $dataSalesAvg   = $totalSales/$dataFilesSold;
    
        $data = array(
         
          'totalSales'      =>  $totalSales,
          'totalFilesSold'  =>  $dataFilesSold,
          'numUsers'        =>  $numUsers,
          'salesAvg'        =>  $dataSalesAvg
          );
    
        $this->session->set_userdata($data);
        
        // Pagination for clients table
        $num = $this->Admins_dashbd_model->getClientDetailsCountForAdmin();
        $config['base_url']    = site_url().'Admin_Dashbd/index/';
        $config['total_rows']  = $num;
        $config['per_page']    = 4;
        $config['uri_segment'] = 3;
    
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
      
        $data['clients'] = $this->Admins_dashbd_model->getClientDetailsForAdmin($config['per_page'], $page);
        $data['clientlinks'] = $this->pagination->create_links();
    
         // Show most sold files
         
       $data['files']   = $this->Admins_dashbd_model->getFilesSoldDetailsForAdmin(); 
    
       
     
      $this->load->view('templates/admin_header');
      $this->load->view('admin/ad_dashbd',$data);
      $this->load->view('templates/admin_footer');
    
      } else {
    
      redirect('Admin_Login');
    
      }
    
    }
    
    
    // LOGIN
    public function admin_login(){
    
      if(isset($_SESSION['ad_login']) == TRUE ){
    
       redirect('Admin_Dashbd');
    
      } else {
    
      //validate form inputs
    
        $this->form_validation->set_rules('name', 'Nom d\'admin', 'required');
        $this->form_validation->set_rules('password', 'Mot de passe admin', 'required');
    
        if($this->form_validation->run() == FALSE) {
    
          $this->load->view('templates/home_header.php');
          $this->load->view('admin/ad_login');
          $this->load->view('templates/home_footer.php');
    
        } else {
    
          $name        =   $this->input->post('name',TRUE);
          $password    =   Md5($this->input->post('password',TRUE));
          $result        = $this->Admins_dashbd_model->verifyAdminData($name, $password);
    
          if($result == FALSE) {
    
          setFlashData('alert-danger', 'Le nom ou mot de passe incorrect', 'Admin_Login');
    
          } else {
    
            // User logged in already
            $result         = $this->Admins_dashbd_model->getAdminData($name);
            $dataSales      = $this->Admins_dashbd_model->getDataSales();
            $totalSales     = ($dataSales->product_price * 0.2) + $dataSales->product_price;
            $dataFilesSold  = $this->db->count_all('orders');
            $numUsers       = $this->db->count_all('customers');
            $dataSalesAvg   = $totalSales/$dataFilesSold;
         
    
            $data = array(
            'admin_name'      =>  $result->admin_name,
            'admin_id'        =>  $result->id,
            'ad_login'        =>  TRUE,
            'totalSales'      =>  $totalSales,
            'totalFilesSold'  =>  $dataFilesSold,
            'numUsers'        =>  $numUsers,
            'salesAvg'        =>  $dataSalesAvg
            );
    
            $this->session->set_userdata($data);
    
            redirect('Admin_Dashbd');
          }
        }
      }
    } // END LOGIN
    
    
    // LOGOUT
    public function admin_logout() {
    
    unset($_SESSION['ad_login']);
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_name']);
    unset($_SESSION['totalSales']);
    unset($_SESSION['totalFilesSold']);
    unset($_SESSION['numUsers']);
    unset($_SESSION['salesAvg']);
    
    session_destroy(); 
    
    redirect('Admin_Login');
    
    } // END LOGOUT
    
   
    
    public function getClientForEmail($id)
    {
    
      $data=$this->Admins_dashbd_model->getClientForEmail($id);
      echo json_encode($data);
     
    }
    
    public function sendMessageToClient()
    {
    
      $this->form_validation->set_rules('message', 'Message Body', 'trim|required|min_length[5]');
    
        if($this->form_validation->run() == FALSE) {
    
          setFlashData('alert-danger', 'Le message doit comporter plus de 5 caractères', 'ad_dashbd');
    
        } else {
    
          $msgBody      = $this->input->post('message');
          $emailClient  = $this->input->post('email');
    
    
          // Load library and pass in the config
          $this->load->library('email');
          $this->email->set_newline('\r\n');
    
          $userEmail   = 'easyfiles@support.com';
          $userName    = 'Easy Files';
          $email       = $emailClient;
          $subject     = substr($msgBody, 0, 20);
    
          $this->email->from($userEmail, $userName);
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($msgBody);
    
          if($this->email->send()) {
    
            setFlashData('alert-success', 'Le message est envoyé', 'Admin_Dashbd');
    
          } else {
    
            setFlashData('alert-danger', "Erreur lors d'envoi du message", 'Admin_Dashbd');
          }
        
        }
    
    }
    
    
    
    
    
 
  

}//END