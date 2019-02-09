
<div class="home-inner container">

<!-- MESSAGES -->
<?php if($this->session->flashdata('message')){
      echo '<div class="alert alert-message my-3 p-3 text-center bg-light"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'. $this->session->flashdata('message'). '</div>';
    } ?>
<!-- END OF MESSAGES -->

<div class="row">


    <div class="col-md-6 mx-auto">
      <div class="card bg-dark-transparent text-light cardform banner-heading">
        <div class="card-body">

        
          <h3 class="text-center"><i class="fas fa-lock orange mr-2"></i>Entrer votre code</h3>
          <p class="text-center text-muted">Derniere etape avant crée votre nouveau mot de passe</p>

          

        <!-- Insert Code form begin here -->

        <?php $attr_register = array('id'=>'form_register','role'=>'form');?>

        <?php echo form_open('client_forgotpassword/newpassword', $attr_register) ?>

        <?php echo validation_errors('<div class="alert alert-register"><a href="#" class="close ml-3" data-dismiss="alert" aria-label="close">x</a>', '</div>'); ?>

          
          <div class="form-group">
            <input type="text" name="resetcode" class="form-control" placeholder="Entrer votre code ici..." > 
          </div>
         
         
          
          <button type="submit" name="btn_login" class="btn btn-outline-danger btn-block">Valider</button>
          </form>
         
        </div>
      </div>
    </div>


</div><!--end of row-->
</div><!--end of home-inner-->

  <!-- end of banner -->
</header>
<!-- end of header -->