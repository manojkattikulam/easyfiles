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


   function fetch_invoice_adminClient_details($txId)
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
    
 

}