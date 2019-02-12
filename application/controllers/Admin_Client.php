<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Client extends CI_Controller {

  public function index(){

    if(isset($_SESSION['ad_login']) == TRUE ){
  
      // Pagination for admin client page
      $config['base_url']    = site_url().'Admin_Client/index/';
      $config['total_rows']  = $this->db->count_all('customers');
      $config['per_page']    = 5;
      $config['uri_segment'] = 3;
  
      $this->pagination->initialize($config);
  
      $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
  
      $data['allClients']=$this->Admins_client_model->getClientDetails($config['per_page'], $page);
      $data['links'] = $this->pagination->create_links();
  
      $this->load->view('templates/admin_header');
      $this->load->view('admin/ad_client',$data);
      $this->load->view('templates/admin_footer');
  
    } else {
  
      redirect('Admin_Login');
  
    }
  
  }
  
  
  public function blockClient($id)
    {
  
      if(isset($_SESSION['ad_login']) == TRUE ){
  
        $data = array(
          'status' => 0
        );
  
        $result = $this->Admins_client_model->blockClientFromAdmin($id, $data);
  
        if($result == TRUE){
  
          $subject   =  "Accès bloquer | EasyFiles";
          $message   =  "Cher Client,\r\n Votre accès est bloqué temporairement.\r\nVeuillez contacter le support technique de EASY FILES pour reactiver votre compte.\r\nMerci\r\nCordialement,\r\nEasyFiles Support Team \r\ninfo@easyfiles.com";
  
          // Load library and pass in the config
          $this->load->library('email');
          $this->email->set_newline("\r\n");
  
          $supportEmail  =  "reset@easyfiles.com";
          $supportName   =  "EasyFiles Support Team";
          $email         =  "manojkattikulam@gmail.com";
          
          $this->email->from($supportEmail, $supportName);
          $this->email->to($email);
  
          $this->email->subject($subject);
          $this->email->message($message);
        
              if($this->email->send()) {
  
                setFlashData('alert-success', 'Le compte du utilisateur est bloqué et un mail est envoyé pour avertir le client', 'Admin_Client');
  
              } else {
  
                setFlashData('alert-success', 'Erreur...envois mail échoué', 'Admin_Client');
  
              }     
  
        } else {
  
          setFlashData('alert-danger', 'Erreur...pas réussi de bloqué l\'utilisateur', 'Admin_Client');
        }
  
      } else {
  
        redirect('Admin_Login');
    
      }
  
    }
  
    public function permitClient($id)
    {
  
      if(isset($_SESSION['ad_login']) == TRUE ){
  
        $data = array(
          'status' => 1
        );
  
        $result = $this->Admins_client_model->permitClientFromAdmin($id, $data);
        if($result == TRUE){
  
          $subject   =  "Accès Débloquer | EasyFiles";
          $message   =  "Cher Client,\r\n Votre compte est reactiver.\r\nVeuillez connecter à votre espace client pour continuer vos achats.\r\nMerci\r\nCordialement,\r\nEasyFiles Support Team \r\ninfo@easyfiles.com";
  
          // Load library and pass in the config
          $this->load->library('email');
          $this->email->set_newline("\r\n");
  
          $supportEmail  =  "reset@easyfiles.com";
          $supportName   =  "EasyFiles Support Team";
          $email         =  "manojkattikulam@gmail.com";
          
          $this->email->from($supportEmail, $supportName);
          $this->email->to($email);
  
          $this->email->subject($subject);
          $this->email->message($message);
        
              if($this->email->send()) {
  
                setFlashData('alert-success', 'Le compte du utilisateur est débloqué et un mail est envoyé pour informer le client', 'Admin_Client');
  
              } else {
  
                setFlashData('alert-success', 'Erreur...envois mail échoué', 'Admin_Client');
  
              }     
  
        } else {
  
          setFlashData('alert-danger', 'Erreur...pas réussi de bloqué l\'utilisateur', 'Admin_Client');
        }
  
      } else {
  
        redirect('Admin_Login');
    
      }
  
    }
  
    public function deleteClient($id)
    {
  
      if(isset($_SESSION['ad_login']) == TRUE ){
  
        
        $result = $this->Admins_client_model->deleteClientFromAdmin($id);
        if($result == TRUE){
  
          $subject   =  "Compte Supprimer | EasyFiles";
          $message   =  "Cher Client,\r\n Votre compte est supprimer.\r\nVeuillez connecter nos support téchnique pour plus de renseignement.\r\nMerci\r\nCordialement,\r\nEasyFiles Support Team \r\ninfo@easyfiles.com";
  
          // Load library and pass in the config
          $this->load->library('email');
          $this->email->set_newline("\r\n");
  
          $supportEmail  =  "reset@easyfiles.com";
          $supportName   =  "EasyFiles Support Team";
          $email         =  "manojkattikulam@gmail.com";
          
          $this->email->from($supportEmail, $supportName);
          $this->email->to($email);
  
          $this->email->subject($subject);
          $this->email->message($message);
        
              if($this->email->send()) {
  
                setFlashData('alert-success', 'Votre compte est malheuresement supprimer. Veuillez contactez notre support client', 'Admin_Client');
  
              } else {
  
                setFlashData('alert-success', 'Erreur...envois mail échoué', 'Admin_Client');
  
              }     
  
        } else {
  
          setFlashData('alert-danger', 'Erreur...pas réussi de bloqué l\'utilisateur', 'Admin_Client');
        }
  
      } else {
  
        redirect('Admin_Login');
    
      }
  
  
    }
  
  
   public function adminDetailClient($client_id){
  
    $data['fullClientDetails'] = $this->Admins_client_model->getClientFullDetails($client_id);
    $this->load->view('templates/admin_header.php');
    $this->load->view('admin/ad_client_details',$data);
    $this->load->view('templates/admin_footer.php');
  
   }
  
   public function adminClientInvoiceHtml($txId) 
  {
  
    $data['invoices'] = $this->Admins_client_model->getInvoiceDetails($txId);
  
    $this->load->view('templates/admin_header.php');
    $this->load->view('admin/ad_clientinvoice_details',$data);
    $this->load->view('templates/admin_footer.php');
  }
  
  



}//END