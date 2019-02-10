<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Category extends CI_Controller {


// VIEW ALL CATEGORIES  
public function index() {

  if(adminLoggedIn()){

    // Pagination for category page
    $config['base_url']    = site_url().'Admin_Category/index/';
    $config['total_rows']  = $this->db->count_all('category');
    $config['per_page']    = 5;
    $config['uri_segment'] = 3;

    $this->pagination->initialize($config);
    
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3):0;
  
    $data['allCategories'] = $this->Admins_category_model->fetchAllCategories($config['per_page'], $page);
    $data['links'] = $this->pagination->create_links();

    $this->load->view('templates/admin_header');
    $this->load->view('admin/ad_category', $data);
    $this->load->view('templates/admin_footer');  

  } else {
    
    setFlashData('alert-danger','Vous devez vous connecter pour accéder à l\'administrateur','Admin_Login');

  }
}



// ADD CATEGORIES  
public function add_category() {

  if(adminLoggedIn()){
    

  $this->form_validation->set_rules('category_name', 'Nom', 'required');
  $this->form_validation->set_rules('category_desc', 'Description', 'required');
  if (empty($_FILES['userfile']['name']))
  {
    $this->form_validation->set_rules('userfile', 'Image', 'required');
  }

    if($this->form_validation->run() == FALSE) {

    $this->load->view('templates/admin_header');
    $this->load->view('admin/ad_category_add');
    $this->load->view('templates/admin_footer');  

    } else {

    $data['cat_name']   =   $this->input->post('category_name',TRUE);
    $data['cat_desc']   =   $this->input->post('category_desc',TRUE);

    //upload Image
    $config['upload_path']       = './assets/images/category';
    $config['allowed_types']     = 'gif|jpg|jpeg|png';
    $config['max_size']          = '2048';
    $config['file_ext_tolower']  = TRUE;
    $config['overwrite']         = TRUE;
    $config['remove_spaces']     = TRUE;
    $config['detect_mime']       = TRUE;


    $this->upload->initialize($config);
  
    if(!$this->upload->do_upload()) { 
      $errors     = $this->upload->display_errors();
      setFlashData('alert-danger', $errors, 'Admin_Category');
      $data['cat_image'] = 'noimage.png';

      } else {
      
      $fileName = $this->upload->data();
      $data['cat_image'] = $fileName['file_name'];
      
      }
      // checking whether category already exist

       $addData = $this->Admins_category_model->checkCategoryExist($data);

      if($addData->num_rows() > 0){

        setFlashData('alert-danger', 'Une catégorie existe déjà avec ce nom. Essayez avec un nouveau nom s\'il vous plaît', 'Admin_Category');

      } else {

        // adding category into database
        $addData = $this->Admins_category_model->addCategories($data);

        if($addData) {

          setFlashData('alert-success', 'Vous avez ajouté la catégorie avec succès', 'Admin_Category');

        } else {

          setFlashData('alert-danger', 'Une erreur s\'est produite lors de la création de la nouvelle catégorie...ressayer s\'il vous plaît', 'Admin_Category');
        }

      }       

    }

  } else {

    setFlashData('alert-danger','Il faut s\'connecter pour accéder à l\'espace administrator','Admin_Login');

  }//end adminLogged 
}//end add category 




// EDIT CATEGORIES  
public function edit_category($cId) {

  if(adminLoggedIn()) {

    if (!empty($cId) && isset($cId)) {

      $data['categoriesEdit'] = $this->Admins_category_model->checkCategoryIdExist($cId);

      if(count($data['categoriesEdit']) == 1) {

        $this->load->view('templates/admin_header');
        $this->load->view('admin/ad_category_edit', $data);
        $this->load->view('templates/admin_footer');  
        
      } else {
        setFlashData('alert-danger','La catégorie demandée n\'existe pas','Admin_Category');
      }
    } else {
        setFlashData('alert-danger','
        Une erreur s\'est produite lors du chargement de la page demandée. Veuillez réessayer','Admin_Category');
    }  
  } else {    
    setFlashData('alert-danger','Il faut s\'connecter pour accéder à l\'espace administrator','Admin_Login');
  }
}


// UPDATE CATEGORIES
public function update_category() {

  if(adminLoggedIn()){

    $data['cat_name'] = $this->input->post('category_name', true);
    $cId              = $this->input->post('category_id', true);
    $catOldImage      = $this->input->post('category_oldImg', true);

    //checking if the required name field 
    if(!empty($data['cat_name']) && isset($data['cat_name'])) {

      //image checking here
      if(isset($_FILES['userfile']) && is_uploaded_file($_FILES['userfile']['tmp_name'])) {

        //upload Image
        $config['upload_path']       = './assets/images/category';
        $config['allowed_types']     = 'gif|jpg|jpeg|png';
        $config['max_size']          = '2048';
        $config['file_ext_tolower']  = TRUE;
        $config['overwrite']         = TRUE;
        $config['remove_spaces']     = TRUE;
        $config['detect_mime']       = TRUE;

        $path                        = $config['upload_path'];
    
    
        $this->upload->initialize($config);
      
        if(!$this->upload->do_upload()) { 
          $errors     = $this->upload->display_errors();
          setFlashData('alert-danger', $errors, 'Admin_Category');
          $data['cat_image'] = 'noimage.png';
    
          } else {
          
          $fileName = $this->upload->data();
          $data['cat_image'] = $fileName['file_name'];
          
          }
    
        }

      $results = $this->Admins_category_model->updateCategory($data, $cId);
      if($results){
        //check image path to delete old image
        if(!empty($data['cat_image']) && isset($data['cat_image'])){
          if(file_exists($path.'/'.$catOldImage)){
            unlink($path.'/'.$catOldImage);
          }
        }
        setFlashData('alert-success','Vous avez modifié la catégorie avec succès','Admin_Category');
      } else {
        setFlashData('alert-danger','Il y avait une erreur, la modification de la catégorie a échoué','Admin_Category');
      }

    } else {
      setFlashData('alert-danger','Le nom de la catégorie est obligatoire','Admin_Category');
    }


  } else {
    
    setFlashData('alert-danger','Il faut s\'connecter pour accéder à l\'espace administrator','Admin_Login');

  }


}

// DELETE CATEGORIES  
public function delete_category($cId) {

  

  if(adminLoggedIn()){
    
      $oldImage = $this->Admins_category_model->getCategoryImage($cId);
      if(!empty($oldImage) && count($oldImage) == 1){
        $realImage = $oldImage[0]['cat_image'];
      }
     

    $checkDelete = $this->Admins_category_model->deleteCategory($cId);

    if($checkDelete){

      //check image path to delete old image
      $config['upload_path']       = './assets/images/category';
      $path                        = $config['upload_path'];
      if(!empty($realImage) && isset($realImage)){
        if(file_exists($path.'/'.$realImage)){
          unlink($path.'/'.$realImage);
        }
      }

      setFlashData('alert-success','Vous avez supprimé la catégorie avec succès','Admin_Category');
      
    } else {

      setFlashData('alert-danger','Il y avait une erreur, la suppression de la catégorie a échoué','Admin_Category');
    }

  } else {
    
    setFlashData('alert-danger','Il faut s\'connecter pour accéder à l\'espace administrator','Admin_Login');

  }
}














}//END