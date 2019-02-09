<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_login_model extends CI_Model {

  //Process User Login

  public function verifyLoginEmail($email){

    $this->db->where('email', $email);
    $query = $this->db->get('customers');
    if($query->num_rows() > 0){
    return true;
    } else {
    return false;
    }

  }
  public function verifyLoginPassword($password){
   
    $this->db->where('password', $password);
    $query = $this->db->get('customers');
    if($query->num_rows() > 0){
    return true;
    } else {
    return false;
    }

  }
  public function verifyLoginStatus($email, $password){
    
    $this->db->where('email', $email);
    $this->db->where('password', $password);
    $this->db->where('status', TRUE);
    $query = $this->db->get('customers');
    if($query->num_rows() > 0){
    return true;
    } else {
    return false;
    }

  }

    //Get user info after login
    public function getUserData($email)
    {
    $this->db->where('email', $email);

    $query = $this->db->get('customers');

    return $query->row();

    }

    //Insert Password Reset Data
    public function insertPassResetData($data)
    {

    $this->db->insert('passreset', $data);

    $insert_id = $this->db->insert_id();

    return $insert_id;

    }


    //Check to see if token and status are valid
    public function verifyToken($tokenid, $status)
    {

    $this->db->where('token', $tokenid);
    $this->db->where('status', $status);

    $query  = $this->db->get('passreset');

    $result = $query->row();

    if(isset($result)){

    return $result->email;

    } else {

    return FALSE;

    }


    }

    //Check to see if code is valid
    public function verifyCode($code)
    {

    $this->db->where('code', $code);
    
    $query  = $this->db->get('passreset');

    $result = $query->row();

    if(isset($result)){

    return $result->email;

    } else {

      return FALSE;

    }


    }

    // Update new password
    public function updateNewPassword($email, $password)
    {
    $this->db->where('email', $email);

    $data = array (

    'password' => $password

    );

    $this->db->update('customers', $data);

    $result = $this->db->affected_rows();

    return $result;

    }

    // Change Status of password reset status to false
    public function updatePasswordResetStatus($email, $status)
    {
      $this->db->where('email', $email);

      $data = array (

        'status' => $status

      );

      $this->db->update('passreset', $data);

      $result = $this->db->affected_rows();

      return $result;

    }



}//END