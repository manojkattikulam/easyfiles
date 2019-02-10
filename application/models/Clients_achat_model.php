<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_achat_model extends CI_Model {


  
    //Function to get total saved order price
      public function getSavedOrder($email)
      {
       $query = $this->db->query("SELECT * FROM cart WHERE email='$email'ORDER BY date DESC");
    
       foreach($query->result() as $row)
       {
         $itemPrice  =  $row->item_price;
    
         return $itemPrice;
       }
    
      }
    
    
    
      //Function to fetch for all product
      public function getAllPackages()
      {
        $query = $this->db->get('products');
    
        return $query->result_array();
      }
    
       //Function to fetch for product details
       public function getPackagesDetails($productId)
       {
         $this->db->where('id', $productId);
         $query = $this->db->get('products');
     
         return $query->row();
       }
     
    
    //Insert Saved Order Data
       public function insertSavedOrder($data)
      {
    
        $this->db->insert('cart', $data);
    
        $insert_id = $this->db->insert_id();
    
        return $insert_id;
    
      }
    
      // Function to fetch for saved orders to checkout page
      public function getSavedOrderDetails($email)
      {
        
        $query = $this->db->query("SELECT * FROM cart WHERE email = '$email' ORDER BY date DESC");
    
        $result = $query->row();
    
        return $result;
      }
    
     // Insert Orders Data
    public function insertOrder($data)
    {
      $this->db->insert('orders', $data);
    
    }
    
    
    
    // Delete saved orders after purchase
    public function deleteSavedOrder($uId)
    {
      $this->db->where('user_id', $uId);
    
      $this->db->delete('cart');
    }
    
    // Update users table with transaction id
    
    public function updateUserMembership($email, $membership, $txId, $package_name)
    {
    
        $data = array (
    
          'membership'        => $membership,
          'transaction_id'    => $txId,
          'package_name'      => $package_name,
    
        );
    
        $this->db->where('email', $email);
    
        $this->db->update('users', $data);
    
     
    
    }
    
    // Function to fetch completed orders
    public function getOrderDetails($uId)
    {
      // $query  = $this->db->query("SELECT * FROM orders WHERE customer_id = '$uId' ORDER BY date DESC");
      // return $query->result();
    
      $this->db->select('orders.product_name, orders.tx_id, SUM(orders.product_price) as totalOrders, COUNT(orders.tx_id) as total_value , orders.date');
      $this->db->where('customer_id', $uId);
      $this->db->group_by('tx_id'); 
      $this->db->from('orders');
      
    
      $this->db->order_by('orders.date', 'desc');
    
      $query = $this->db->get();
      return $query->result();
     
    }
    
    public function getInvoiceDetails($txId)
    {
      $this->db->where('tx_id', $txId);
      return $this->db->get('orders')->result();
      
    
    }
    
    function fetch_invoice_details($txId)
    {
     $this->db->where('tx_id', $txId);
     $data = $this->db->get('orders');
     $sum =0;
    
     foreach($data->result() as $row)
     {
      $output = '<h4 align="right"> N°Facture: '.$row->tx_id.'</h4>';
     }
     
     $output .= '
     <style>
     table {
      width:100%; padding:50px;font-size:18px;
      border-collapse: collapse;
    }
    
    table, th {
      border-bottom: 1px solid grey; padding:5px;
    }
    
    tr:last-child {
      
      font-size:22px;
      color: #cc0000;
      padding:5px;}
   
     </style>
     
     <table>';
     $output .= '
     <thead>
     <tr>
      <th>Date</th>
      <th>Transaction</th>
      <th>Fichier</th>
      <th>Prix</th>
    
     </tr>
     </thead>
    
    ';
     foreach($data->result() as $row)
     {
     
      $date = $row->date;
      
      $output .= '
      <tr>
        <td>'.date('d-m-Y', strtotime($date)).'</td>
        <td>'.$row->tx_id.'</td>
        <td>'.$row->product_name.'</td>
        <td>'.$row->product_price.' €</td>
      </tr>'
       .$sum += $row->product_price;
     };
    
     $sum = number_format((float)$sum, 2, '.', '');
     $tva = ($sum * 0.2) + $sum;
     $tva = number_format((float)$tva, 2, '.', '');
     $output .= '
      <tr >
        <th></th>
        <th></th>
        <th>Prix HT</th>
        <th>'.$sum.' €</th>
      </tr>
    
      <tr>
        <th></th>
        <th></th>
        <th>TVA</th>
        <th>20%</th>
      </tr>
    
      <tr>
        <th></th>
        <th></th>
        <th>Prix TTC</th>
        <th>'.$tva.' €</th>
      </tr>'.
    
      $tva = number_format((float)$tva, 2, '.', '');
     
     $output .= '</table>';
    
     
     return $output;
    }
    
    
    public function getOrderTelecharger($uId)
    {
      $query  = $this->db->query("SELECT * FROM orders WHERE customer_id = '$uId' ORDER BY date DESC");
      return $query->result();
    
    }
    
    

}