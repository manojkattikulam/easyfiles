<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_panier_model extends CI_Model {

  public function getAllProductsForCart($pId)
  {

    $query = $this->db->get_where('products', array('pro_id' => $pId));
    return $query->row();

  }

  public function insertToCart($data){
    $this->db->insert('cart', $data);
  }

  public function viewCart($uId){
    $query = $this->db->get_where('cart', array('user_id' => $uId));
    return $query->result();
  }

  public function checkProductAdded($pId, $userId)
  {
   $query = $this->db->get_where('cart', array('product_id' => $pId, 'user_id' => $userId));
   return $query->num_rows();
  }

  public function checkProductBought($pId, $userId)
  {
   $query = $this->db->get_where('orders', array('product_id' => $pId, 'customer_id' => $userId));
   return $query->num_rows();
  }

  public function deleteProductFromCart($cartId){

    $this->db->where('cart_id', $cartId);
    return $this->db->delete('cart');
   

  }

  public function getCountFromCart($userId)
  {
    $this->db->where('user_id', $userId);
    $this->db->from('cart');
    return $this->db->count_all_results();

  }

  public function getCountFromOrders($uId)
  {
    $this->db->where('customer_id', $uId);
    $this->db->from('orders');
    return $this->db->count_all_results();

  }




}