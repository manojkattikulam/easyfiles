<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Panier extends CI_Controller {

  public function index()
  {
    if(isset($_SESSION['login']) == TRUE ){

      $uId = $this->session->userdata['user_id'];

      $qtyCart = $this->Clients_panier_model->getCountFromCart($uId);
      $this->session->set_userdata('qtyCart', $qtyCart);

      $qtyOrder = $this->Clients_panier_model->getCountFromOrders($uId);
      $this->session->set_userdata('qtyOrders', $qtyOrder);

      $data['viewcarts'] = $this->Clients_panier_model->viewCart($uId);

      if($data['viewcarts'] > 0){

      $this->load->view('templates/client_header');
      $this->load->view('client/dashbd_client/cl_panier', $data);
      $this->load->view('templates/client_footer');

    } else {

      setFlashData('Alert-danger', 'le panier est vide, veuillez ajouté des produits', 'Client_Panier');

    }

  } else {

  redirect('home');

  }
}



public function addToCart()
{
  if(isset($_SESSION['login']) == TRUE ){

    if(isset($_POST['addCart'])){

     
      $pId      = $this->input->post('proId',TRUE); 
      $sId      = $this->input->post('sId',TRUE);
      $userId   = $this->input->post('userId',TRUE);
      $products = $this->Clients_panier_model->getAllProductsForCart($pId);

     

      $data = array (
      'session_id'    => $sId,
      'user_id'       => $userId,
      'product_id'    => $products->pro_id,
      'product_name'  => $products->pro_name,
      'product_price' => $products->pro_price,
      'product_file'  => $products->pro_file
      );

      
      $chkProductBought = $this->Clients_panier_model->checkProductBought($pId, $userId);

      if($chkProductBought > 0) {

        setFlashData('alert-danger', 'Produit déjà acheté', 'Client_Dashbd');

      } else {
        
        $chkProductExist = $this->Clients_panier_model->checkProductAdded($pId, $userId);

        if($chkProductExist > 0) {

          setFlashData('alert-danger', 'Produit déjà ajouté', 'Client_Dashbd');

        } else {
          
          $this->Clients_panier_model->insertToCart($data);
         
          
          setFlashData('alert-success', 'Produit ajouté', 'Client_Panier');
          
        }
        
      }

      

    } else {

        redirect('Client_Dashbd');
    }

  } else {

  redirect('home');

  }
}

public function cartDelete($cartId){

  if(isset($_SESSION['login']) == TRUE ){

  $result = $this->Clients_panier_model->deleteProductFromCart($cartId);

    if($result = TRUE) {
      setFlashData('alert-danger', 'Produit supprimer', 'Client_Panier');
      
      
    
    } else {
      setFlashData('alert-danger', 'Erreur de suppression de produit', 'Client_Panier');
    }

    } else {

      redirect('pages');

    }
}





}//END