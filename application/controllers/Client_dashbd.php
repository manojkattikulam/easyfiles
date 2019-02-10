<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Dashbd extends CI_Controller {

  public function index()
	{
    if(isset($_SESSION['login']) == TRUE ){

      $uId = $this->session->userdata['user_id'];
      $qtyCart = $this->Clients_panier_model->getCountFromCart($uId);
      $this->session->set_userdata('qtyCart', $qtyCart);

      $qtyOrder = $this->Clients_panier_model->getCountFromOrders($uId);
      $this->session->set_userdata('qtyOrders', $qtyOrder);
            
      // Pagination for products page
      $config['base_url']    = site_url().'Client_Dashbd/index/';
      $config['total_rows']  = $this->db->count_all('products');
      $config['per_page']    = 8;
      $config['uri_segment'] = 3;

      $this->pagination->initialize($config);

      $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;

      $data['getCatClients'] = $this->Admins_category_model->getAllCategories();
      $data['allProductsClients'] = $this->Clients_dashbd_model->fetchAllProductsClient($config['per_page'], $page);


      $data['links'] = $this->pagination->create_links();

      $this->load->view('templates/client_header');
      $this->load->view('client/dashbd_client/cl_dashbd', $data);
      $this->load->view('templates/client_footer');  

    } else {

      redirect('home');

    }
    
  }

  public function logout(){
 
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

  public function getProClientsById($catId)
  {
    if(isset($_SESSION['login']) == TRUE ){

      // Pagination to show products in client page

      $config['base_url']    = site_url().'Client_Dashbd/getProClientsById/'.$catId.'/';
      $config['total_rows']  = $this->Clients_dashbd_model->getRowCountById($catId);

      $config['per_page']    = 8;
      $config['uri_segment'] = 4;

      $this->pagination->initialize($config);

      $page = ($this->uri->segment(4)) ? $this->uri->segment(4):0;

      $data['getCatClients'] = $this->Admins_category_model->getAllCategories();
      $data['allProductsClients'] = $this->Clients_dashbd_model->fetchAllProductsByCatId($config['per_page'], $page, $catId);

      $data['links'] = $this->pagination->create_links();

      $this->load->view('templates/client_header');
      $this->load->view('client/dashbd_client/cl_dashbd', $data);
      $this->load->view('templates/client_footer');  

      } else {

        redirect('pages');

      }
      
    }

    public function sendmessage()
    {
  
      $this->form_validation->set_rules('message', 'Message Body', 'trim|required|min_length[5]');
  
        if($this->form_validation->run() == FALSE) {
  
          setFlashData('alert-danger', 'Le message doit comporter plus de 5 caractères', 'clients');
  
        } else {
  
          $msgBody      = $this->input->post('message');
          $supportEmail = $this->input->post('support_email');
  
          //Create session for user
          $this->session->set_userdata('msgBody', $msgBody);
          $this->session->set_userdata('adminEmail', $supportEmail);
  
          // Load library and pass in the config
          $this->load->library('email');
          $this->email->set_newline('\r\n');
  
          $userEmail   = $this->session->userdata('email');
          $userName    = $this->session->userdata('fullname');
          $email       = $supportEmail;
          $subject     = substr($msgBody, 0, 20);
  
          $this->email->from($userEmail, $userName);
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($msgBody);
  
          if($this->email->send()) {
  
            setFlashData('alert-danger', 'Le message est envoyé', 'Client_Dashbd');
  
          } else {
  
           
            setFlashData('alert-danger', 'Le message n\'a pas pu être envoyé', 'Client_Dashbd');
          }
        
        }
  
    }
  





}//END