<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_ForgotPassword extends CI_Controller {


public function index(){

  if(isset($_SESSION['login']) == TRUE ){

    redirect('client_dashbd');

  } else {

    $this->load->view('templates/home_header');
    $this->load->view('client/forgot_password/cl_forgotPassword');
    $this->load->view('templates/home_footer');

  }

}

  
// CUSTOMER PASSWORD RESET 
public function resetpassword(){

  if(isset($_SESSION['login']) == TRUE ){

    redirect('client_dashbd');

  } else {

  // Getting User email for password reset

  $this->form_validation->set_rules('email', 'Email', 'trim|required');

  if($this->form_validation->run() == FALSE) {

    $this->load->view('templates/home_header');
    $this->load->view('client/forgot_password/cl_forgotPassword');
    $this->load->view('templates/home_footer');

  } else { 

      // Get email input from the form
      $email = $this->input->post('email',TRUE);

      //Check if email exist
      $result = $this->Clients_register_model->checkCustomer($email);
      $this->session->set_userdata('email', $email);


          if($result == TRUE){

            // Create token, random Code, Status, Subject, message for email
            $token     =  md5(uniqid(rand(), true));
            $randcode  =  md5($email);
            $code      =  substr($randcode, 2, 8);
            $status    =  "TRUE";

            $subject   =  "Password Reset Link | EasyFiles";
            $message   =  "Cher Client,\r\nVous avez demandez un nouveau mot de passe.\r\nVeuillez cliquer sur ce lien ou copier le lien et coller dans votre navigateur pour crée un nouveau mot de passe.\n\nVoici le lien: ". base_url('client_forgotpassword/verifytoken')."/?tokenID=". $token ."&status=". $status ."\n\n Voici le code pour ce nouveau mot de passe: ". $code . "\r\nMerci\r\nCordialement,\r\nEasyFiles Support Team \r\ninfo@easyfiles.com";

            // Load library and pass in the config
            $this->load->library('email');
            $this->email->set_newline("\r\n");

            $supportEmail  =  "reset@easyfiles.com";
            $supportName   =  "EasyFiles Support Team";
            $email         =  $this->session->userdata('email');
            
            $this->email->from($supportEmail, $supportName);
            $this->email->to($email);

            $this->email->subject($subject);
            $this->email->message($message);
          
                if($this->email->send()) {
          
                  $data = array(

                    'email'    => $email,
                    'token'    => $token,
                    'code'     => $code,
                    'status'   => "TRUE"

                  );

                  // Call the model function to insert data in the reset password table
                  $result = $this->Clients_login_model->insertPassResetData($data);

                      if($result > 0){

                        setFlashData('alert-success', 'Nous venons de vous envoyé le code à votre adresse mail','home');
                      }
          
                } else {

                  setFlashData('alert-danger', 'Envois mail échoué. Email n\'est pas valide. Ressayer avec une autre adresse mail','client_login/login');
          
                }



        } else {

          // Redirect user to login page
          setFlashData('alert-danger','Email n\'est pas valide. Ressayer avec une autre adresse mail','client_login/login');
          
        }

  }

  }
} 
  

// VERIFY PASSWORD RESET TOKEN
public function verifytoken(){

  $url     =  parse_url($_SERVER['REQUEST_URI']);
              parse_str($url['query'], $params);
  $tokenid =  $params['tokenID'];

  $status  =  $params['status'];

  //Check if the code and token and status are valid
    
  $result = $this->Clients_login_model->verifyToken($tokenid, $status);

    if($result == false){

      setFlashData('alert-danger','Desolé code expiré. Ressayer','client_login/login');
  

    } else {

      $userEmail = $result;

      $this->session->set_userdata('userEmail', $userEmail);

      $success = "Votre code est vérifié pour ". $userEmail . " Veuillez entrez votre CODE";

      $this->session->set_flashdata('message', $success);
      redirect('client_forgotpassword/verifyPasswordCode');

    }

} // END OF VERIFY PASSWORD RESET TOKEN


// VERIFY PASSWORD RESET CODE
public function verifyPasswordCode(){

  if(isset($_SESSION['login']) == TRUE ){

    redirect('cl_dashbd');

  } else {


    $this->form_validation->set_rules('resetcode', 'Reset Code', 'trim|required|min_length[7]');

    if($this->form_validation->run() == FALSE){

      $this->load->view('templates/home_header');
      $this->load->view('client/forgot_password/cl_verifyresetcode');
      $this->load->view('templates/home_footer');

    } else {

      $code   = $this->input->post('resetcode', TRUE);

      $result = $this->Clients_login_model->verifyCode($code);

      if($result){

        redirect('client_ForgotPassword/newpassword');	

      } else {

        setFlashData("alert-danger","Désolé, Votre code n'est pas valide. Reessayer s'il vous plâit !","client_login/login");


      }

    }
  }
} // END OF VERIFY PASSWORD RESET CODE




// SET NEW PASSWORD
public function newpassword(){

  if(isset($_SESSION['login']) == TRUE ){

    redirect('client_dashbd');

  } else {

  $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
  $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|min_length[5]|matches[password]');


  if($this->form_validation->run() == FALSE) {

    $this->load->view('templates/home_header');
    $this->load->view('client/forgot_password/cl_newpassword');
    $this->load->view('templates/home_footer');

  } else {

    $rawpass   =  $this->input->post('confirm_password');
    $password  =  md5($rawpass);
    $email     =  $this->session->userdata('userEmail');

    $result = $this->Clients_login_model->updateNewPassword($email, $password);

    if($result > 0) {

      //Change the status in the password reset table to FALSE
      $status = "FALSE";
      $email  = $this->session->userdata('userEmail');
      $result = $this->Clients_login_model->updatePasswordResetStatus($email, $status);

          if($result > 0){

            setFlashData('alert-success','Votre nouveau mot de passe est prise en compte. Veuillez s\'identifier s\'il vous plait ','client_login/login');

        } 
      }
    }

  }
} // END OF SET NEW PASSWORD


}//END