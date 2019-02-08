<?php

  //SEO
  define("WEBSITE_DESCRIPTION", "Achat de Fichiers de Prospection Qualifiés en ligne");
  define("WEBSITE_KEYWORDS", "Achat, Location de fichier client particuliers, professionnels, paris, londre, beijing");
  define("WEBSITE_LANGUAGE", "fr");
  define("WEBSITE_AUTHOR", "EasyFiles management");
  define("WEBSITE_AUTHOR_MAIL", "contact@easyfiles.com");

  // Facebook Open Graph tags
  define("WEBSITE_FACEBOOK_NAME", "Easyfiles management");
  define("WEBSITE_FACEBOOK_DESCRIPTION", "Achetez en ligne un fichier de prospection actualisé et qualifié. Plus de 1500 contacts en téléchargement immédiat");
  define("WEBSITE_FACEBOOK_URL", "http://facebook.com/easyfiles");
  define("WEBSITE_FACEBOOK_IMAGE", "");

  

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




