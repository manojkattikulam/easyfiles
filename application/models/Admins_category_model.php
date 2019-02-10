<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins_category_model extends CI_Model {

  
  // ADD CATEGORIES TO DATABASE
  public function addCategories($data)
  {
    return $this->db->insert('category', $data);
  }

  // CHECK IF CATEGORY EXIST IN DATABASE
  public function checkCategoryExist($data)
  {
    return $this->db->get_where('category', array('cat_name' => $data['cat_name']));
  }

  // GET ALL CATEGORIES FROM DATABASE
  public function getAllCategories()
  {
   
    // $this->db->from('category');
    // $query=$this->db->get();
    // return $query->result();
    $query = $this->db->get_where('category', array('cat_status' => 1));
    return $query->result();
  }

  // GET CATEGORY IMAGE
  public function getCategoryImage($cId){

  return $this->db->select('cat_image')
             ->from('category')
             ->where('cat_id', $cId)
             ->get()
             ->result_array();


  }

  // GET NUMBER OF ROWS
  public function getCatNumRows()
  {
    return $this->db->count_all('category');
  }

  

   // CHECK IF CATEGORY ID EXIST IN DATABASE FOR EDIT
   public function checkCategoryIdExist($cId)
   {
     return $this->db->get_where('category', array('cat_id' => $cId))->result_array();
   }

   // UPDATE CATEGORY
   public function updateCategory($data, $cId)
   {
    $this->db->where('cat_id', $cId);
    return $this->db->update('category', $data);

   }

   // DELETE CATEGORY
   public function deleteCategory($cId)
   {
    $this->db->where('cat_id', $cId);
    return $this->db->delete('category');

   }


   



}


