<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Product extends CI_Controller {


 
// VIEW ALL PRODUCTS  
public function index() {

  if(adminLoggedIn()){

    // Pagination for products page
    $config['base_url']    = site_url().'Admin_Product/index/';
    $config['total_rows']  = $this->db->count_all('products');
    $config['per_page']    = 8;
    $config['uri_segment'] = 3;

    $this->pagination->initialize($config);
    
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
  
    $data['allProducts'] = $this->Admins_product_model->fetchAllProducts($config['per_page'], $page);
    $data['links'] = $this->pagination->create_links();

    $this->load->view('templates/admin_header');
    $this->load->view('admin/ad_product', $data);
    $this->load->view('templates/admin_footer');  

  } else {
    
    setFlashData('alert-danger','Vous devez vous connecter pour accéder à l\'administrateur','Admin_Login');

  }
}

// VIEW ADD PRODUCTS PAGE
public function view_add_product(){

  $data['categories'] = $this->Admins_product_model->getAllCategoriesPro();

  $this->load->view('templates/admin_header');
  $this->load->view('admin/ad_product_add', $data);
  $this->load->view('templates/admin_footer');  

}

// ADD PRODUCTS  
public function add_product() {

  if(adminLoggedIn()){
   
  $cat['categories'] = $this->Admins_product_model->getAllCategoriesPro();

  $this->form_validation->set_rules('product_name', 'Nom', 'required');
  $this->form_validation->set_rules('product_desc', 'Description', 'required');
  $this->form_validation->set_rules('product_price', 'Prix', 'required');
  $this->form_validation->set_rules('category_id', 'Category', 'required');
  
  if (empty($_FILES['userfile']['name']))
  {
    $this->form_validation->set_rules('userfile', 'Fichier', 'required');
  }

    if($this->form_validation->run() == FALSE) {

    $this->load->view('templates/admin_header');
    $this->load->view('admin/ad_product_add', $cat);
    $this->load->view('templates/admin_footer');  

    } else {

    $data['pro_name']   =   $this->input->post('product_name',TRUE);
    $data['pro_desc']   =   $this->input->post('product_desc',TRUE);
    $data['pro_price']  =   $this->input->post('product_price',TRUE);
    $data['cat_id']     =   $this->input->post('category_id',TRUE);

   
   
    //upload files
    $config['upload_path']       = 'application/views/client/mystery_folder';
    $config['allowed_types']     = 'pdf|xlsx|docx';
    $config['max_size']          = '2048';
    $config['file_ext_tolower']  = TRUE;
    $config['overwrite']         = TRUE;
    $config['remove_spaces']     = TRUE;
    $config['detect_mime']       = TRUE;

   
    $this->upload->initialize($config);
    
  
    if(!$this->upload->do_upload()) { 
      $errors     = $this->upload->display_errors();
      setFlashData('alert-danger', $errors, 'Admin_Product');
      $data['pro_file'] = 'nofile.pdf';

      } else {
      
      $fileName         = $this->upload->data();
      $data['pro_file'] = $fileName['file_name'];
      
      }
      // checking whether product already exist

       $addProData = $this->Admins_product_model->checkProductExist($data);

       

      if($addProData->num_rows() > 0){

        setFlashData('alert-danger', 'Un produit existe déjà avec ce nom. Essayez avec un nouveau nom s\'il vous plaît', 'Admin_Product');

      } else {

        // adding product into database
        $addProData = $this->Admins_product_model->addProducts($data);

        if($addProData) {

          setFlashData('alert-success', 'Vous avez ajouté le produit avec succès', 'Admin_Product');

        } else {

          setFlashData('alert-danger', 'Une erreur s\'est produit lors de la création de la nouvelle product...ressayer s\'il vous plaît', 'Admin_Product');
        }

      }       

    }

  } else {

    setFlashData('alert-danger','Il faut s\'connecter pour accéder à l\'espace administrator','Admin_Login');

  }//end adminLogged 
}//end add product 




// EDIT PRODUCTS  
public function edit_product($pId) {

  if(adminLoggedIn()) {

    if (!empty($pId) && isset($pId)) {

      $data['products'] = $this->Admins_product_model->checkProductIdExist($pId);
      $data['categories'] = $this->Admins_product_model->getAllCategoriesPro();
    

      if($data['products']) {

        $this->load->view('templates/admin_header');
        $this->load->view('admin/ad_product_edit', $data);
        $this->load->view('templates/admin_footer');  
        
      } else {
        setFlashData('alert-danger','Le produit demandée n\'existe pas','Admin_Product');
      }
    } else {
        setFlashData('alert-danger','
        Une erreur s\'est produit lors du chargement de la page demandée. Veuillez réessayer','Admin_Product');
    }  
  } else {    
    setFlashData('alert-danger','Il faut s\'connecter pour accéder à l\'espace administrator','Admin_Login');
  }
}



// UPDATE product
public function update_product() {

  if(adminLoggedIn()){

    $data['pro_name']   = $this->input->post('product_name', true);
    $data['pro_desc']   = $this->input->post('product_desc', true);
    $data['pro_price']  = $this->input->post('product_price', true);
    $data['cat_id']     = $this->input->post('category_id', true);
    $pId                = $this->input->post('product_id', true);
    $proOldImage        = $this->input->post('product_oldImg', true);
    

    //checking if the required name field 
    if(!empty($data['pro_name']) && isset($data['pro_name'])) {

      //image checking here
      if(isset($_FILES['userfile']) && is_uploaded_file($_FILES['userfile']['tmp_name'])) {

        //upload Image
        $config['upload_path']       = 'application/views/client/mystery_folder';
        $config['allowed_types']     = 'pdf|xlsx|docx';
        $config['max_size']          = '2048';
        $config['file_ext_tolower']  = TRUE;
        $config['overwrite']         = TRUE;
        $config['remove_spaces']     = TRUE;
        $config['detect_mime']       = TRUE;

        $path                        = $config['upload_path'];
    
    
        $this->upload->initialize($config);
      
        if(!$this->upload->do_upload()) { 
          $errors     = $this->upload->display_errors();
          setFlashData('alert-danger', $errors, 'Admin_Product');
          $data['pro_file'] = 'noimage.pdf';
    
          } else {
          
          $fileName = $this->upload->data();
          $data['pro_file'] = $fileName['file_name'];
          
          }
    
        }

      $results = $this->Admins_product_model->updateproduct($data, $pId);
      if($results){
        //check image path to delete old image
        if(!empty($data['pro_file']) && isset($data['pro_file'])){
          if(file_exists($path.'/'.$proOldImage)){
            unlink($path.'/'.$proOldImage);
          }
        }
        setFlashData('alert-success','Vous avez modifié le produit avec succès','Admin_Product');
      } else {
        setFlashData('alert-danger','Il y avait une erreur, la modification du produit a échoué','Admin_Product');
      }

    } else {
      setFlashData('alert-danger','Le nom du produit est obligatoire','Admin_Product');
    }


  } else {
    
    setFlashData('alert-danger','Il faut s\'connecter pour accéder à l\'espace administrator','Admin_Login');

  }


}

// DELETE PRODUCTS 
public function delete_product($pId) {

  

  if(adminLoggedIn()){
    
      $oldImage = $this->Admins_product_model->getProductImage($pId);
      if(!empty($oldImage) && count($oldImage) == 1){
        $realImage = $oldImage[0]['pro_file'];
      }
     

    $checkDelete = $this->Admins_product_model->deleteproduct($pId);

    if($checkDelete){

      //check image path to delete old image
      $config['upload_path']       = 'application/views/client/mystery_folder';
      $path                        = $config['upload_path'];
      if(!empty($realImage) && isset($realImage)){
        if(file_exists($path.'/'.$realImage)){
          unlink($path.'/'.$realImage);
        }
      }

      setFlashData('alert-success','Vous avez supprimé le produit avec succès','Admin_Product');
      
    } else {

      setFlashData('alert-danger','Il y avait une erreur, la suppression du produit a échoué','Admin_Product');
    }

  } else {
    
    setFlashData('alert-danger','Il faut s\'connecter pour accéder à l\'espace administrator','Admin_Login');

  }
}




}//END