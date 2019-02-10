<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins_dashbd_model extends CI_Model {


  public function verifyAdminData($name, $password){

    $this->db->where('admin_name', $name);
    $this->db->where('admin_pass', $password);
    $query = $this->db->get('admin');
  
    if($query->num_rows() > 0){
  
    return true;
  
    } else {
  
    return false;
    }
  
  }
  
  //Get user info after login
  public function getAdminData($name)
  {
    $this->db->where('admin_name', $name);
  
    $query = $this->db->get('admin');
  
    return $query->row();
  
  }
  

  
  public function getDataSales()
  {
  
    $this->db->select_sum('product_price');
    $query = $this->db->get('orders');
    return $query->row();
  
  }
  
  public function getDatafilesSold()
  {
    return $this->db->count_all('orders');
   
  }
  
  public function getDataSalesAvg()
  {
    $this->db->select_avg('product_price');
    $query = $this->db->get('orders');
    return $query->row();
  }
  
  public function getClientDetailsCountForAdmin()
  {
    $this->db->select(' customers.id, customers.fullname, COUNT(orders.customer_id)totalOrders, SUM(orders.product_price) total_value');
    $this->db->from('customers');
    $this->db->join('orders', 'customers.id = orders.customer_id ');
    $this->db->group_by('customers.id', 'customers.fullname');
    $query = $this->db->get();
    return $query->num_rows();
  }
  
  public function getClientDetailsForAdmin($limit,$offset)
  {
  
    $this->db->select(' customers.id, customers.email, customers.fullname, COUNT(orders.customer_id)totalOrders, SUM(orders.product_price) total_value');
    $this->db->from('customers');
    $this->db->join('orders', 'customers.id = orders.customer_id ');
    $this->db->group_by('customers.id', 'customers.fullname');
    $this->db->limit($limit, $offset);
    $query = $this->db->get();
    return $query->result();
   
   }
   
  
  
  public function getFilesDetailsCountForAdmin()
  {
    $this->db->select('product_id, product_name, COUNT(product_id) as total');
    $this->db->from('orders');
    $this->db->group_by('product_name');
    $this->db->order_by('total', 'desc'); 
    $query = $this->db->get();
    return $query->num_rows();
  
  }
  
  public function getFilesSoldDetailsForAdmin()
  {
   
   $this->db->select('product_id, product_name, COUNT(product_id) as total');
   $this->db->from('orders');
   $this->db->group_by('product_name');
   $this->db->order_by('total', 'desc');
   $this->db->limit(6);
   $query = $this->db->get();
   return $query->result();
  
  }
  
  public function getClientForEmail($id)
  {
    $this->db->from('customers');
    $this->db->where('id',$id);
    $query = $this->db->get();
    return $query->row();
   
   }
  

  
  
   
  

  


}//END





