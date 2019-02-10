<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins_product_model extends CI_Model {

  

  // ADD PRODUCTS TO DATABASE
  public function addProducts($data)
  {
    return $this->db->insert('products', $data);
  }

  // CHECK IF PRODUCT EXIST IN DATABASE
  public function checkProductExist($data)
  {
    return $this->db->get_where('products', array('pro_name' => $data['pro_name']));
  }

  // GET ALL PRODUCTS FROM DATABASE
  public function getAllProducts()
  {

    $query = $this->db->get_where('products', array('pro_status' => 1));
    return $query->result();
  }

  // GET PRODUCT IMAGE
  public function getProductImage($pId){

  return $this->db->select('pro_file')
             ->from('products')
             ->where('pro_id', $pId)
             ->get()
             ->result_array();


  }

  // GET NUMBER OF ROWS
  public function getProNumRows()
  {
    return $this->db->count_all('products');
  }

  // FETCH ALL PRODUCTS FOR PAGINATION
  public function fetchAllProducts($limit, $start)
  {
    $this->db->limit($limit, $start);
    $this->db->order_by("pro_id", "desc");
    $query = $this->db->get_where('products', array('pro_status' => 1));

    if($query->num_rows() > 0) {

      foreach($query->result() as $row)
      {
          $data[] = $row;
      }
      return $data;     
    } 
      return false;
  }

   // CHECK IF PRODUCTS ID EXIST IN DATABASE FOR EDIT
   public function checkProductIdExist($pId)
   {
     return $this->db->get_where('products', array('pro_id' => $pId))->row();
   }

   // UPDATE PRODUCTS
   public function updateProduct($data, $pId)
   {
    $this->db->where('pro_id', $pId);
    return $this->db->update('products', $data);

   }

   // DELETE PRODUCTS
   public function deleteProduct($pId)
   {
    $this->db->where('pro_id', $pId);
    return $this->db->delete('products');

   }

  // GET ALL CATEGORIES FOR PRODUCTS FROM DATABASE
  public function getAllCategoriesPro()
  {
    // $this->db->from('category');
    // $query=$this->db->get();
    // return $query->result();
    return $this->db->get('category')->result();
  }


   




}