
<?php
class Ajaxsearch_model extends CI_Model
{
 function fetch_data($query)
 {
  $this->db->select("*");
  $this->db->from("products");
  if($query != '')
  {
   $this->db->like('pro_name', $query);
   $this->db->or_like('pro_price', $query);
  
  }
  $this->db->order_by('pro_id', 'DESC');
  return $this->db->get();
 }
}
?>