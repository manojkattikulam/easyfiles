<!DOCTYPE html>
<html lang="<?php echo WEBSITE_LANGUAGE; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="<?php echo WEBSITE_DESCRIPTION; ?>">
  <meta name="keywords" content="<?php echo WEBSITE_KEYWORDS; ?>">
  <meta name="author" content="<?php echo WEBSITE_AUTHOR; ?>">
  <meta property="og:title" content="<?php echo WEBSITE_FACEBOOK_NAME; ?>"/>
  <meta property="og:image" content="<?php echo base_url("assets/images/logo.png") ; ?>"/>
  <meta property="og:site_name" content="<?php echo WEBSITE_FACEBOOK_URL; ?>"/>
  <meta property="og:description" content="<?php echo WEBSITE_FACEBOOK_DESCRIPTION; ?>"/>
  <link rel="icon" href="<?php echo base_url('assets/images/favicon.ico');?>">


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

  <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url("assets/css/backend.css"); ?>">

  <title>EasyFiles - achats fichiers clients</title>

</head>
<body>


<!-- navbar -->
<nav class="navbar navbar-expand-md navbar-light">
    <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#esyNav"><span class="navbar-toggler-icon"></span></button>

    <div class="collapse navbar-collapse" id="esyNav">
        <div class="container-fluid">
            <div class="row">
                <!-- sidebar -->
                <div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
                <a href="<?php echo base_url('Admin_Dashbd');?>" class="navbar-brand text-white d-block mx-auto py-3 mb-4 bottom-border text-center"><img class="logo" src="<?php echo base_url('assets/images/logo.png');?>" alt="logo" width="50"></i><span class="text-light">EASY</span><span class="text-orange mr-3">Files</span></a>

                    <div class="bottom-border pb-3">
                        <div><p class="text-muted">ESPACE CLIENT</p></div>
                        <a href="<?php echo base_url('Client_Dashbd'); ?>" class="text-white"><?php echo $this->session->userdata['fullname']; ?></a>
                    </div>
                    <ul class="navbar-nav flex-column mt-4">
                        <li class="nav-item"><a href="<?php echo base_url('Client_Dashbd'); ?>" class="nav-link text-white p-3 mb-2 sidebar-link "><i class="fas fa-home text-light fa-lg mr-3 "></i>Dashboard</a></li>
                        <li class="nav-item"><a href="<?php echo site_url('Client_Profile/customerUpdateProfile/'.$this->session->userdata('user_id')) ?>" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-address-card text-light fa-lg mr-3"></i>Mon Profile</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('Client_Download/telecharger'); ?>" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-envelope text-light fa-lg mr-3"></i>Téléchargement</a></li>
                        <li class="nav-item"><a href="<?php echo site_url('Client_Panier'); ?>" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-shopping-cart text-light fa-lg mr-3"></i> Panier</a></li>
                        <li class="nav-item"><a href="<?php echo site_url('Client_Achat/getClientOrders'); ?>" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-money-bill-alt text-light fa-lg mr-3"></i>Achats</a></li>

                    </ul>
                </div>
                <!-- end of sidebar -->

                <!-- top-nav -->
                <div class="col-xl-10 col-lg-9 col-md-8 ml-auto bg-dark fixed-top py-2 top-navbar">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h4 class="text-light text-uppercase">Dashboard</h4>
                        </div>
                        
                        <div class="col-md-8 float-right">
                            <ul class="navbar-nav">
                                <li class="nav-item ml-md-auto"><a href="#" class="nav-link text-white btn-logout" data-toggle="modal" data-target="#sign-out"><i class="fas fa-sign-out-alt text-danger fa-lg mr-2"></i>Deconnexion</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end of top-nav -->
            </div>
        </div>
    </div>
</nav>
<!-- end of navbar -->


<div class="modal fade" id="sign-out" role="dialog" >
  <div class="modal-dialog" role="document">

  <?php $attributes = array('role' => 'form' ); ?>   
  <?php echo form_open_multipart('Client_Dashbd/logout', $attributes);?>

    <div class="modal-content bg-dark">
      <div class="modal-header text-warning p-5">
        <h5 class="modal-title">Voulez-vous quitter le site ?</h5>
        <button type="button" class="close text-warning" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-white p-5">

        Appuyez sur le bouton de déconnexion pour quitter

       </div>
      <div class="modal-footer bg-dark text-warning p-5">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Rester</button>
        <button type="submit" class="btn btn-success text-warning">Déconnexion</button>
        
        
      </div>
    </div>
    </form>
  </div>
</div>



<!-- cards -->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="row pt-md-5 mt-md-3 ">
                <div class="col-xl-3 col-sm-6 p-2 ">
                    <a class="c_panier" href="<?php echo base_url('Client_Panier'); ?>">
                        <div class="card card-common bg-info">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-shopping-cart fa-2x text-white"></i>
                                    <div class="text-right text-white font-weight-bold text-uppercase">
                                        <h5>Paniers<span class="badge badge-dark text-warning ml-3"><?php echo $this->session->userdata('qtyCart')?></span></h5>
                                    </div>
                                </div>
                            </div>
                             <div class="card-footer text-white">
                                <i class="fas fa-sync mr-3"></i>
                                <span></span>
                            </div> 
                        </div> 
                    </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 p-2">
                    <a class="c_panier" href="<?php echo base_url('Client_Achat/getClientOrders'); ?>">
                        <div class="card card-common bg-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-money-bill-alt fa-2x text-white"></i>
                                    <div class="text-right text-white font-weight-bold text-uppercase">
                                    <h5>Achats<span class="badge badge-dark text-warning ml-3"><?php echo $this->session->userdata('qtyOrders')?></span></h5>                                </div>
                                </div>
                            </div>
                            <div class="card-footer text-white">
                                <i class="fas fa-sync mr-3"></i>
                                <span></span>
                            </div> 
                        </div>
                       </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 p-2">
                    <a class="c_panier" href="<?php echo base_url('Client_Download/telecharger'); ?>">
                        <div class="card card-common bg-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-users fa-2x text-white"></i>
                                    <div class="text-right text-dark font-weight-bold text-uppercase">
                                    <h5>Télécharger<span class="badge badge-dark text-warning ml-3"><?php echo $this->session->userdata('qtyOrders')?></span></h5>
                                    </div>
                                </div>
                            </div>
                             <div class="card-footer text-dark">
                                <i class="fas fa-sync mr-3"></i>
                                <span></span>
                            </div> 
                        </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 p-2">
                    <a class="c_panier" href="#"  data-toggle="modal" data-target="#clientMsg">
                        <div class="card card-common bg-danger">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-envelope fa-2x text-white"></i>
                                    <div class="text-right text-white font-weight-bold text-uppercase">
                                    <h5> Support Client</h5>                                
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-white">
                                <i class="fas fa-sync mr-3"></i>
                                <span></span>
                            </div> 
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of cards -->