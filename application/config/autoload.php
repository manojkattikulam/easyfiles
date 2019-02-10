<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$autoload['packages']  = array();

$autoload['libraries'] = array(
  
  'database', 
  'form_validation',
  'upload', 
  'session', 
  'pagination', 
  'encryption', 
  'email', 
  'pdf'
);

$autoload['drivers']   = array();

$autoload['helper']    = array('form', 'url', 'path', 'security', 'file', 'string','custom_helper');

$autoload['config']    = array();

$autoload['language']  = array();

$autoload['model']     = array(

'Clients_register_model', 
'Clients_login_model',
'Clients_achat_model',
'Clients_dashbd_model',
'Clients_download_model',
'Clients_login_model',
'Clients_panier_model',
'Clients_register_model',
'Admins_category_model',
'Admins_client_model',
'Admins_login_model',
'Admins_order_model',
'Admins_product_model',
'Testajax_model'

);
