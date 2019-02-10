<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Profile extends CI_Controller {


  public function customerUpdateProfile($id = null) {

    if(isset($_SESSION['login']) == TRUE ){

      $data['customer'] = $this->Clients_dashbd_model->checkCustomerId($id);

      if (count($data['customer']) == 1) {

        $this->load->view('templates/client_header');
        $this->load->view('client/dashbd_client/cl_profile', $data);
        $this->load->view('templates/client_footer');
  

      } else {

        setFlashData("alert-danger","Cet utilisateur n'existe pas", "client/dashbd_client/cl_dashbd");
       
        
      }   

    } else {

      redirect('home');

    }   

  }


  
public function updateCustomer()
{
  if(isset($_SESSION['login'])){

  $userId             = $this->input->post('userId', TRUE);
  $data['fullname']   = $this->input->post('fullname', TRUE);
  $data['profession'] = $this->input->post('profession', TRUE);
  $data['email']      = $this->input->post('email', TRUE);

     if (empty($data['fullname']) || empty($data['profession']) || empty($data['email']) || empty($userId) ) {

      setFlashData("alert-danger","Les champs ne peut pas être vide", "Client_Dashbd");

      } else {

        $results = $this->Clients_dashbd_model->updateCustomerProfile($data, $userId);
    
            if ($results) {

              $this->session->set_userdata('fullname', $data['fullname'] );
              setFlashData("alert-success","Profile Client modifier", "Client_Dashbd");
             
            } else {

              setFlashData("alert-danger","Erreur...reessayer s'il vous plait", "Client_Dashbd");
          
            }
        
      }

  } else {

    redirect('home');
  }
}



}//END