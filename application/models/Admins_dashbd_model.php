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
  
  //*********************************************************//
  // CATAGORIES SECTION //
  //*********************************************************//
  
  public  function get_all_categories()
  {
    $this->db->from('category');
    $query=$this->db->get();
    return $query->result();
  }
  
  
  
  public function cat_get_by_id($cid)
  {
    $this->db->from('category');
    $this->db->where('cat_id',$cid);
    $query=$this->db->get();
    return $query->row();
  }
  
  public function update_category($post_image){
  
    $data = array (
  
    'cat_name'   => $this->input->post('category_name'),
    'cat_desc'   => $this->input->post('category_desc'),
    'cat_image' => $post_image
  
    );
    $this->db->where('cat_id', $this->input->post('category_id'));
    return $this->db->update('category', $data);
  
  }
  
  public function add_category($post_image)
  {
    $data = array (
  
    'cat_name'  => $this->input->post('category_name'),
    'cat_desc'  => $this->input->post('category_desc'),
    'cat_image' => $post_image
  
    );
    return $this->db->insert('category', $data);
  }
  
  public function cat_delete_by_id($id)
  {
    $this->db->where('cat_id',$id);
    $this->db->delete('category');
  }
  
  //*********************************************************//
  // END CATAGORIES SECTION //
  //*********************************************************//
  
  
  //*********************************************************//
  // PRODUCTS SECTION //
  //*********************************************************//
  
  public function get_all_products()
  {
  
  $this->db->select('*');
  $this->db->from('products');
  $this->db->join('category','category.cat_id = products.cat_id');
  $query = $this->db->get();
  return $query->result();
  
  }
  
  public function pro_get_by_id($id)
  {
  
  $this->db->from('products');
  $this->db->where('pro_id',$id);
  $query = $this->db->get();
  return $query->row();
  
  }
  
  
  
  public function update_products($post_image)
  {
  
    $data = array (
  
    'item_name'  => $this->input->post('products_name',TRUE),
    'item_desc'  => $this->input->post('products_desc',TRUE),
    'item_price' => $this->input->post('products_price',TRUE),
    'cat_id'     => $this->input->post('category_id', TRUE),
    'item_file'  => $post_image
  
    );
    $this->db->where('pro_id', $this->input->post('products_id',TRUE));
    return $this->db->update('products', $data);
  
    $this->db->where('cat_id', $this->input->post('cat_id',TRUE));
    return $this->db->update('category', $data);
  }
  
  
  public function add_products($post_image)
  {
  
    $data = array (
    'cat_id'  => $this->input->post('category_id'),
    'item_name'  => $this->input->post('products_name'),
    'item_desc'  => $this->input->post('products_desc'),
    'item_price'  => $this->input->post('products_price'),
    'item_file' => $post_image
  
    );
  
    return $this->db->insert('products', $data);
  }
  
  
  public function pro_delete_by_id($id)
  {
  $this->db->where('pro_id',$id);
  $this->db->delete('products');
  }
  
  
  
  //*********************************************************//
  // END PRODUCTS SECTION //
  //*********************************************************//
  
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
  
   public function getClientDetails($limit,$offset)
  {
  
    $this->db->select(' customers.id, customers.fullname, customers.profession, customers.email, COUNT(orders.customer_id)totalOrders, SUM(orders.product_price) total_value');
    $this->db->from('customers');
    $this->db->join('orders', 'customers.id = orders.customer_id ');
    $this->db->group_by('customers.id', 'customers.fullname');
    $this->db->limit($limit, $offset);
    $query = $this->db->get();
    return $query->result();
   
   }
  
   public function getOrderDetails($limit,$offset)
   {
   
     $this->db->select(' customers.id, customers.fullname, orders.product_name, orders.product_price, orders.tx_id, orders.date, orders.status');
     $this->db->from('customers');
     $this->db->join('orders', 'customers.id = orders.customer_id ');
     $this->db->order_by('orders.date', 'desc');
     $this->db->limit($limit, $offset);
     $query = $this->db->get();
     return $query->result();
    
    }
  
   public function blockClientFromAdmin($id, $data)
   {
  
     $this->db->where('id', $id);
     return $this->db->update('customers', $data);
  
   }
  
   public function permitClientFromAdmin($id, $data)
   {
  
     $this->db->where('id', $id);
     return $this->db->update('customers', $data);
  
   }
  
   public function deleteClientFromAdmin($id)
   {
     $this->db->where('id', $id);
     return $this->db->delete('customers');
  
   }
  
   public function getClientFullDetails($client_id)
   {
    $this->db->select(' customers.id, customers.fullname, customers.email, customers.profession, orders.product_name, orders.tx_id, SUM(orders.product_price) totalprice, COUNT(orders.tx_id) txNum, orders.date, orders.status');
     $this->db->from('customers');
     $this->db->where('customers.id', $client_id);
     $this->db->join('orders', 'customers.id = orders.customer_id ');
     $this->db->group_by('tx_id');
     $this->db->order_by('orders.date', 'desc');
     $query = $this->db->get();
     return $query->result();
  
   }
  


}//END





