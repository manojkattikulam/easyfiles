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

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

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
                    <p class="text-muted">Administrator</p>
                    <ul class="navbar-nav flex-column mt-4">
                        <li class="nav-item"><a href="<?php echo base_url('Admin_Dashbd');?>" class="nav-link text-white p-3 mb-2 sidebar-link "><i class="fas fa-home text-light fa-lg mr-3 "></i>Dashboard</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('Admin_Category'); ?>" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-address-card text-light fa-lg mr-3"></i>Catégories</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('Admin_Product'); ?>" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-heart text-light fa-lg mr-3"></i>Produits</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('Admin_Client'); ?>" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-users text-light fa-lg mr-3"></i>Clients</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('Admin_Order'); ?>" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-shopping-cart text-light fa-lg mr-3"></i>Commandes</a></li>

                    </ul>
                </div>
                <!-- end of sidebar -->

                <!-- top-nav -->
                <div class="col-xl-10 col-lg-9 col-md-8 ml-auto bg-dark fixed-top py-2 top-navbar">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h4 class="text-light text-uppercase">Dashboard</h4>
                        </div>
                     
                        <div class="col-md-8">
                            <ul class="navbar-nav float-right">
                            <li class="nav-item ml-md-auto"><a href="<?php echo base_url('Admin_Dashbd/admin_logout') ?>" class="nav-link text-white btn-logout"><i class="fas fa-sign-out-alt text-danger fa-lg mr-2"></i>Deconnexion</a>
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

    <!-- cards -->
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row pt-md-5 mt-md-3 mb-5">
              <div class="col-xl-3 col-sm-6 p-2">
                <div class="card card-common bg-dark text-warning">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <i class="fas fa-shopping-cart fa-3x text-warning"></i>
                      <div class="text-right text-secondary">
                        <h5>Chiffre d'affaire</h5>
                        <h3 class="text-danger font-weight-bold"><?php echo $this->session->userdata('totalSales').' €'; ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-secondary">
                    <i class="fas fa-sync mr-3"></i>
                    <span></span>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 p-2">
                <div class="card card-common bg-dark text-info">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <i class="fas fa-money-bill-alt fa-3x text-info"></i>
                      <div class="text-right text-secondary">
                        <h5>Fichiers Vendu</h5>
                        <h3 class="text-danger font-weight-bold"><?php echo $this->session->userdata('totalFilesSold'); ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-secondary">
                    <i class="fas fa-sync mr-3"></i>
                    <span></span>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 p-2">
                <div class="card card-common bg-dark text-success">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <i class="fas fa-users fa-3x text-success"></i>
                      <div class="text-right text-secondary">
                        <h5>Clients</h5>
                        <h3 class="text-danger font-weight-bold"><?php echo $this->session->userdata('numUsers'); ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-secondary">
                    <i class="fas fa-sync mr-3"></i>
                    <span></span>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 p-2">
                <div class="card card-common bg-dark text-white">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <i class="fas fa-chart-line fa-3x text-white"></i>
                      <div class="text-right text-secondary">
                        <h5>Moyenne</h5>
                        <h3 class="text-danger font-weight-bold">
                        <?php 


                        $avgSales = number_format($this->session->userdata('salesAvg'), 2, '.','');
                        echo $avgSales.' €'; 
                        
                        ?>
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-secondary">
                    <i class="fas fa-sync mr-3"></i>
                    <span></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end of cards -->
