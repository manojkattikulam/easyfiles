<?php

function setFlashData($class, $message, $url) {
  $CI = get_instance();
  $CI->load->library('session');
  $CI->session->set_flashdata('class', $class);
  $CI->session->set_flashdata('message', $message);
  redirect($url);

}

function adminLoggedIn() {
  $CI = get_instance();
  $CI->load->library('session');
  if($CI->session->userdata('ad_login')){
    return TRUE;
  } else {
    return FALSE;
  }
  
}

function chkDump($data){

  echo '<pre>';
  var_dump($data);
  echo '</pre>';
  die();

}


