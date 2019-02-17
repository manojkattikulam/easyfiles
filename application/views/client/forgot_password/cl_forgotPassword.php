<div class="home-inner container">



  <div class="row">


      <div class="col-md-6 mx-auto">

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



        <div class="card bg-dark-transparent text-light cardform banner-heading">
          <div class="card-body">

          
            <h3 class="text-center"><i class="fas fa-key fa-lg mr-2 orange"></i></i>Mot de passe oublié ?</h3>
            <p class="text-center text-muted">Nouvelle demande de mot de passe</p>

            

          <!-- Login form begin here -->

          <?php $attr_register = array('id'=>'form_register','role'=>'form');?>

          <?php echo form_open('Client_ForgotPassword/resetpassword', $attr_register) ?>

          <?php echo validation_errors('<div class="alert alert-register"><a href="#" class="close ml-3" data-dismiss="alert" aria-label="close">x</a>', '</div>'); ?>

            
          <div class="form-group">
              <input type="text" name ="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Votre email"> 
            </div>
                     
            
            <button id="resetpass" type="submit" name="btn_resetpassword" class="btn btn-outline-danger btn-block">Envoyé</button>
            </form>
          
          </div>
        </div>
      </div>


  </div><!--end of row-->
</div><!--end of home-inner-->

    <!-- end of banner -->
  </header>
  <!-- end of header -->

 

  