<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Login extends CI_Controller {


  // LOGIN
  public function login(){

    if(isset($_SESSION['login']) == TRUE ){

      redirect('client_dashbd');

    } else {

      //validate form inputs

      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');

      if($this->form_validation->run() == FALSE) {

          $this->load->view('templates/home_header');
          $this->load->view('client/login_client/cl_login');
          $this->load->view('templates/home_footer');

      } else {

          $email              =   $this->input->post('email',TRUE);
          $raw_password       =   $this->input->post('password',TRUE);
          $password           =   hash('md5', $raw_password);
        
          $resultEmail        =   $this->Clients_login_model->verifyLoginEmail($email);
         
            if(!$resultEmail) {

              setFlashData('alert-danger','L\'email n\'exist pas','client_login/login');
              
            } 

          $resultPassword     =   $this->Clients_login_model->verifyLoginPassword($password);
            
            if($resultPassword == FALSE) {

              setFlashData('alert-danger','Mot de passe ne correspond pas','client_login/login');
            
            }

          $resultStatus       =   $this->Clients_login_model->verifyLoginStatus($email, $password);

            if($resultStatus == FALSE) {

              setFlashData('alert-danger',"Votre compte est inaccessible. Vérifiez si vous avez activé votre compte par courrier électronique. Si c'est le cas, votre compte est bloqué par notre administrateur. Contactez notre équipe de support pour réactiver votre compte",'client_login/login');
              
          
            } 
             
            if (($resultEmail == TRUE) AND ($resultPassword == TRUE) AND ($resultStatus == TRUE))
            {
            // User logged in already
            $result = $this->Clients_login_model->getUserData($email);

            $data = array(

              'fullname' =>  $result->fullname,
              'email'    =>  $result->email,
              'user_id'  =>  $result->id,
              'login'    =>  TRUE

            );

             $this->session->set_userdata($data);

             redirect('client_dashbd');

           } else {

             redirect('client_login/login');
           }
      }
    }
} // END LOGIN


// LOGOUT
public function logout() {

  unset($_SESSION['login']);
  unset($_SESSION['fullname']);
  unset($_SESSION['image']);
  unset($_SESSION['email']);
  unset($_SESSION['user_id']);
  unset($_SESSION['gtotals']);
  unset($_SESSION['quantity']);

  session_destroy(); 

  redirect('home');

  }
 // END LOGOUT



}//END