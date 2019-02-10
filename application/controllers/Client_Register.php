<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Register extends CI_Controller {


  // REGISTER CUSTOMER  
  public function register(){

    if(isset($_SESSION['login']) == TRUE ){

      redirect('clients_dashbd');

    } else {

      $this->form_validation->set_rules('username', 'Nom d\'utilisateur', 'required|min_length[3]');
      $this->form_validation->set_rules('profession', 'Profession');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('sexe', 'Sexe', 'required');
      $this->form_validation->set_rules('password', 'Mot de passe', 'required|min_length[5]');
      $this->form_validation->set_rules('confirm_password', 'Mot de passe confirmer', 'required|matches[password]');

        if($this->form_validation->run() === false) {

          $this->load->view('templates/home_header');
          $this->load->view('home');
          $this->load->view('templates/home_footer');

        } else {

          $data['fullname']   = $this->input->post('username', TRUE);
          $data['profession'] = $this->input->post('profession', TRUE);
          $data['email']      = $this->input->post('email', TRUE);
          $data['sex']        = $this->input->post('sexe', TRUE);
          $data['password']   = $this->input->post('password', TRUE);
          $data['password']   = hash('md5', $data['password']);
          $data['elink']      = random_string('alnum', 15);

          $results = $this->Clients_register_model->checkCustomer($data['email']);

          if($results == TRUE){

          setFlashData('alert-danger','Email existe déjà ! Connectez-vous à votre espace client','home'); 

          } else {

          $results = $this->Clients_register_model->addCustomer($data);

          if($results) {
              
              if($this->sendEmailToCustomer($data)){

                setFlashData('alert-success','Vous êtes enregistré Veuillez vérifier votre email et activer le lien d\'inscription pour vous connecter à votre espace client.','client_login/login');


              } else {

                setFlashData('alert-danger','L\'accompte à été crée mais l\'envois mail d\'activation de compte à échoué. Veuillez vérifié votre adresse mail','client_login/login');

                
              }


          } else {

                setFlashData('alert-danger','Échec de l\'inscription. Veuillez réessayer','home');

          }

        }

      }

    }

  } 


  // SEND EMAIL TO CUSTOMER ON REGISTER
  private function sendEmailToCustomer($data) {

    $message = '<strong> Bonjour '.$data['fullname'].'</stong><br>'.anchor(base_url('client_register/confirm/'.$data['elink']), 'Activer votre compte en cliquant sur ce lien');
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

  }



  // CONFIRM LINK TO ACTIVATE ACCOUNT
  public function confirm($link = NULL) {

    if(isset($link) && !empty($link)) {

      $results = $this->Clients_register_model->checkLink($link);

      if($results->num_rows() === 1) {

        $data['status']  = 1;
        $data['elink']   = $link.'ok';

        $results = $this->Clients_register_model->activateAccount($data, $link);

            if($results) {

              setFlashData('alert-success','Votre compte est activé, veuillez vous connecter à votre espace client','client_login/login');

            } else {

              setFlashData('alert-danger','Désolé, nous ne pouvons pas activer votre compte maintenant.','client_register/register');

            }

        } else {

          setFlashData('alert-danger','Le lien d\'activation du compte a expiré','client_register/register');

        }

    } else {

      setFlashData('alert-danger','Veuillez vérifier votre adresse mail et réessayer','client_register/register');

    }

  }





} // END 


