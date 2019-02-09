
<div class="home-inner container">

<!-- ALERT MESSAGE -->       
<?php if($this->session->flashdata('class')): ?>
  <div class="alert <?php echo $this->session->flashdata('class');?> alert-dismissible fade show text-center" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button> 
    <?php echo $this->session->flashdata('message');?>
  </div>
<?php endif; ?>
<!--END ALERT MESSAGE -->   


  <div class="row">

    <div class="col-md-8 mx-auto page-404">
    
    <h1 class="display-1 text-danger text-center zeroheading"> Desolé ! </h1>
    <p class="lead text-warning text-center zero">Nous n'avons pas trouvé la page que vous recherchez.<br>Si vous êtes inscrit chez nous, connectez-vous à notre<br> <a class="text-info" href="<?php echo base_url('client_login/login');?>">espace client</a> ou <a  class="text-info" href="<?php echo base_url('home');?>">inscrivez-vous</a></p>
    
    </div>

</div><!--end of row-->
</div><!--end of home-inner-->

<!-- end of banner -->
</header>
<!-- end of header -->







