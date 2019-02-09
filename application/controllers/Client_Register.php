<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Register extends CI_Controller {


  // REGISTER CUSTOMER  
  public function register(){

    if(isset($_SESSION['login']) == TRUE ){

      redirect('cl_dashbd');

    } else {

      $this->form_validation->set_rules('username', 'Nom d\'utilisateur', 'required|min_length[3]');
      $this->form_validation->set_rules('profession', 'Profession');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('sexe', 'Sexe', 'required');
      $this->form_validation->set_rules('password', 'Mot de passe', 'required|min_length[5]');
      $this->form_validation->set_rules('confirm_password', 'Mot de passe confirmer', 'required|matches[password]');

        if($this->form_validation->run() === false) {

          $this->load->view('templates/home_header');
          $this->load->view('pages/home');
          $this->load->view('templates/home_footer');

        } else {

          $data['fullname']   = $this->input->post('username', TRUE);
          $data['profession'] = $this->input->post('profession', TRUE);
          $data['email']      = $this->input->post('email', TRUE);
          $data['sex']        = $this->input->post('sexe', TRUE);
          $data['password']   = $this->input->post('password', TRUE);
          $data['password']   = hash('md5', $data['password']);
          $data['elink']      = random_string('alnum', 15);

          $results = $this->User_model->checkCustomer($data['email']);

          if($results->num_rows() > 0){

          $this->session->set_flashdata('message', 'Email existe déjà ! Connectez-vous à votre espace client');
          redirect('pages');

          } else {

          $results = $this->User_model->addCustomer($data);

          if($results) {
              
              if($this->sendEmailToCustomer($data)){

                $this->session->set_flashdata('message', 'Vous êtes enregistré Veuillez vérifier votre email et activer le lien d\'inscription pour vous connecter à votre espace client.');
                redirect('users/login');

              } else {

                $this->session->set_flashdata('message', 'L\'accompte à été crée mais l\'envois mail d\'activation de compte à échoué. Veuillez vérifié votre adresse mail');
                redirect('users/login');
              }


          } else {

                $this->session->set_flashdata('message', 'Échec de l\'enregistrement. Veuillez réessayer');
                redirect('pages');

          }

        }

      }

    }

  } //END REGISTER CUSTOMER


  // SEND EMAIL TO CUSTOMER ON REGISTER
  private function sendEmailToCustomer($data) {

    $message = '<strong> Bonjour '.$data['fullname'].'</stong><br>'.anchor(base_url('users/confirm/'.$data['elink']), 'Activer votre compte en cliquant sur ce lien');
    $this->load->library('email');
    $this->email->set_newline('\r\n');
    $this->email->from('support@easyfiles.com');
    $this->email->to($data['email']);
    $this->email->subject('Activer votre compte');
    $this->email->message($message);
    $this->email->set_mailtype('html');

    if($this->email->send()){

      return TRUE;

    } else {

      return FALSE;
    }

  }//END SEND MAIL TO CUSTOMER ON REGISTER



  // CONFIRM LINK TO ACTIVATE ACCOUNT
  public function confirm($link = NULL) {

    if(isset($link) && !empty($link)) {

      $results = $this->User_model->checkLink($link);

      if($results->num_rows() === 1) {

        $data['status']  = 1;
        $data['elink']   = $link.'ok';

        $results = $this->User_model->activateAccount($data, $link);

            if($results) {

              $this->session->set_flashdata('message', 'Votre compte est activé, veuillez vous connecter à votre espace client');
              redirect('users/login');

            } else {

              $this->session->set_flashdata('message', 'Désolé, nous ne pouvons pas activer votre compte maintenant.');
              redirect('users/register');

            }

        } else {

        $this->session->set_flashdata('message', 'Le lien d\'activation du compte a expiré');
        redirect('users/register');

        }

    } else {

      $this->session->set_flashdata('message', 'Veuillez vérifier votre adresse mail et réessayer.');
      redirect('users/register');

    }
  }// END CONFIRM LINK TO ACTIVATE ACCOUNT




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



  // CUSTOMER PASSWORD RESET 
  public function resetpassword(){

    if(isset($_SESSION['login']) == TRUE ){

      redirect('cl_dashbd');

    } else {

    // Getting User email for password reset
  
    $this->form_validation->set_rules('email', 'Email', 'trim|required');
  
    if($this->form_validation->run() == FALSE) {
  
      $this->load->view('templates/home_header');
      $this->load->view('users/login');
      $this->load->view('templates/home_footer');
  
    } else { 
  
        // Get email input from the form
        $email = $this->input->post('email');

        //Check if email exist
        $result = $this->User_model->checkCustomer($email);
        $this->session->set_userdata('email', $email);


            if($result == TRUE){

              // Create token, random Code, Status, Subject, message for email
              $token     =  md5(uniqid(rand(), true));
              $randcode  =  md5($email);
              $code      =  substr($randcode, 2, 8);
              $status    =  "TRUE";

              $subject   =  "Password Reset Link | EasyFiles";
              $message   =  "Cher Client,\r\nVous avez demandez un nouveau mot de passe.\r\nVeuillez cliquer sur ce lien ou copier le lien et coller dans votre navigateur pour crée un nouveau mot de passe.\n\nVoici le lien: ". base_url('users/verifytoken')."/?tokenID=". $token ."&status=". $status ."\n\n Voici le code pour ce nouveau mot de passe: ". $code . "\r\nMerci\r\nCordialement,\r\nEasyFiles Support Team \r\ninfo@easyfiles.com";

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
                    $result = $this->User_model->insertPassResetData($data);

                        if($result > 0){
                          $success = "Nous venons de vous envoyé le code à votre adresse mail";
                          $this->session->set_flashdata('message', $success);
                          redirect('users/login');
                        }
            
                  } else {
            
                    $error = "Envois mail échoué. Email n'est pas valide. Ressayer avec une autre adresse mail";
                    $this->session->set_flashdata('message', $error);
                    redirect('users/login');
                  }



          } else {

            // Redirect user to login page
            $error = "Email n'est pas valide. Ressayer avec une autre adresse mail";
            $this->session->set_flashdata('message', $error);
            redirect('users/register');

          }

    }

    }
  } // END CUSTOMER PASSWORD RESET 
    
  
  // VERIFY PASSWORD RESET TOKEN
  public function verifytoken(){

    $url     =  parse_url($_SERVER['REQUEST_URI']);
                parse_str($url['query'], $params);
    $tokenid =  $params['tokenID'];

    $status  =  $params['status'];

    //Check if the code and token and status are valid
      
    $result = $this->User_model->verifyToken($tokenid, $status);

      if($result == false){
        
        $error = "Desolé code invalide. Ressayer";

        $this->session->set_flashdata('message', $error);
        redirect('users/login');

      } else {

        $userEmail = $result;

        $this->session->set_userdata('userEmail', $userEmail);

        $success = "Votre code est vérifié pour ". $userEmail . " Veuillez entrez votre CODE";

        $this->session->set_flashdata('message', $success);
        redirect('users/verifyPasswordCode');

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
        $this->load->view('verifypasswordresetcode');
        $this->load->view('templates/home_footer');

      } else {

        $code   = $this->input->post('resetcode');

        $result = $this->User_model->verifyCode($code);

        if($result){

          redirect('users/newpassword');	

        } else {

          $error = "Désolé, Votre mot de passe n'est pas valide. Reessayer s'il vous plâit !";

          $this->session->set_flashdata('message', $error);
          redirect('users/login');

        }

      }
    }
  } // END OF VERIFY PASSWORD RESET CODE
  
  
  
  
  // SET NEW PASSWORD
  public function newpassword(){

    if(isset($_SESSION['login']) == TRUE ){

      redirect('cl_dashbd');

    } else {

    $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|min_length[5]');

    if($this->form_validation->run() == FALSE) {

      $this->load->view('templates/home_header');
      $this->load->view('users/newpassword');
      $this->load->view('templates/home_footer');

    } else {

      $rawpass   =  $this->input->post('confirm_password');
      $password  =  md5($rawpass);
      $email     =  $this->session->userdata('userEmail');

      $result = $this->User_model->updateNewPassword($email, $password);

      if($result > 0) {

        //Change the status in the password reset table to FALSE
        $status = "FALSE";
        $email  = $this->session->userdata('userEmail');
        $result = $this->User_model->updatePasswordResetStatus($email, $status);

            if($result > 0){

              $success = "Votre nouveau mot de passe est prise en compte. Veuillez s'identifier s'il vous plait ";
              $this->session->set_flashdata('message', $success);
              redirect('users/login');

          } 
        }
      }

    }
  } // END OF SET NEW PASSWORD


} // END 


