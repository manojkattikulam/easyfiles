<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins_client_model extends CI_Model {

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





}