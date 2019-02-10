<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_dashbd_model extends CI_Model {


  // FETCH ALL CATEGORIES FOR PAGINATION
  public function fetchAllCategories($limit, $start)
  {
    $this->db->limit($limit, $start);
    $query = $this->db->get_where('category', array('cat_status' => 1));

    if($query->num_rows() > 0) {

      foreach($query->result() as $row)
      {
          $data[] = $row;
      }
      return $data;     
    } 
      return false;
  }


  // FETCH ALL PRODUCTS FOR PAGINATION
  public function fetchAllProductsClient($limit, $start)
  {
    $this->db->limit($limit, $start);
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



    // FETCH ALL PRODUCTS FOR PAGINATION EUROPE
    public function fetchAllProductsEurope($limit, $start)
    {
      $this->db->limit($limit, $start);
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

    // FETCH ALL PRODUCTS FOR PAGINATION AMERIQUE
    public function fetchAllProductsAmerique($limit, $start)
    {
      $this->db->limit($limit, $start);
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

    // FETCH ALL PRODUCTS FOR PAGINATION AMERIQUE
    public function fetchAllProductsByCatId($limit, $start, $catId)
    {
      $this->db->limit($limit, $start);
      $query = $this->db->get_where('products', array('cat_id' => $catId));
      
      if($query->num_rows() > 0) {
  
        foreach($query->result() as $row)
        {
            $data[] = $row;
        }
        return $data;     
      } 
        return false;
      
 
    }


    public function getProByCategoryClients($cat_id)
    {

      $query = $this->db->get_where('products', array('cat_id' => $cat_id));
      return $query->result();

    }
    public function getRowCountById ($catId){
      return $this->db->where(['cat_id'=>$catId])->from("products")->count_all_results();

    }

    public function checkCustomerId($id) {
     
      return $this->db->get_where('customers', array('id'=> $id))->result_array();
 
     }
 
     public function updateCustomerProfile($data, $userId) {
 
       $this->db->where('id', $userId);
 
       return $this->db->update('customers', $data);
 
     }
 



}