<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Login extends CI_Controller {

  
  // LOGIN
  public function login(){

    if(isset($_SESSION['login']) == TRUE ){

      redirect('clients');

    } else {

      //validate form inputs

      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if($this->form_validation->run() == FALSE) {

          $this->load->view('templates/home_header');
          $this->load->view('users/login');
          $this->load->view('templates/home_footer');

      } else {

          $email         =   $this->input->post('email',TRUE);
          $raw_password  =   $this->input->post('password',TRUE);
          $password      =   hash('md5', $raw_password);

          $result        =   $this->User_model->verifyLoginData($email, $password);

            if($result == FALSE) {

              $this->session->set_flashdata('message', "
              L'email ou mot de passe incorrect. Vérifier également que vous avez activé votre compte");
              redirect('users/login');


            } else {

            // User logged in already
            $result = $this->User_model->getUserData($email);

            $data = array(

              'fullname' =>  $result->fullname,
              'image'    =>  $result->image,
              'email'    =>  $result->email,
              'user_id'  =>  $result->id,
              'login'    =>  TRUE

            );

            $this->session->set_userdata($data);

            redirect('clients');
          }
      }
    }
} // END LOGIN


// LOGOUT
public function logout() {

  $this->load->view('templates/home_header');
  $this->load->view('users/logout');
  $this->load->view('templates/home_footer');

} // END LOGOUT



}//END