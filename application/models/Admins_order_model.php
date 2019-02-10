<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins_order_model extends CI_Model {

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
 

}