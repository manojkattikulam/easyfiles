<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Login extends CI_Controller {


  // LOGIN
  public function login(){

    if(isset($_SESSION['login']) == TRUE ){

      redirect('client_dashbd');

    } else {

      //validate form inputs

      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if($this->form_validation->run() == FALSE) {

          $this->load->view('templates/home_header');
          $this->load->view('client/login_client/cl_login');
          $this->load->view('templates/home_footer');

      } else {

          $email              =   $this->input->post('email',TRUE);
          $raw_password       =   $this->input->post('password',TRUE);
          $password           =   hash('md5', $raw_password);
        
          $resultEmail        =   $this->clients_login_model->verifyLoginEmail($email);
         
            if(!$resultEmail) {

              $this->session->set_flashdata('message', "
              L'email n'exist pas.");
              redirect('client_login/login');
              exit();
            } 

          $resultPassword     =   $this->clients_login_model->verifyLoginPassword($password);
            
            if($resultPassword == FALSE) {

              $this->session->set_flashdata('message', "
              Mot de passe ne correspond pas.");
              redirect('client_login/login');
              exit();
            }

          $resultStatus       =   $this->clients_login_model->verifyLoginStatus($email, $password);

            if($resultStatus == FALSE) {
              
              $this->session->set_flashdata('message', "
              Votre compte n'est pas encore activé. Veuillez cliquez sur le lien envoyer à votre email pour activer votre compte ");
              redirect('client_login/login');
              exit();
            } 
             
            if (($resultEmail == TRUE) AND ($resultPassword == TRUE) AND ($resultStatus == TRUE))
            {
            // User logged in already
            $result = $this->clients_login_model->getUserData($email);

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