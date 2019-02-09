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

          
            <h3 class="text-center"><i class="fas fa-lock orange mr-2"></i>Espace Client</h3>
            <p class="text-center text-muted">Connectez-vous à votre espace client</p>

            

          <!-- Login form begin here -->

          <?php $attr_register = array('id'=>'form_register','role'=>'form');?>

          <?php echo form_open('client_login/login', $attr_register) ?>

          <?php echo validation_errors('<div class="alert alert-register"><a href="#" class="close ml-3" data-dismiss="alert" aria-label="close">x</a>', '</div>'); ?>

            
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Votre Email" value="<?php echo set_value('email'); ?>"> 
            </div>
           
            <div class="form-group">
              <input type="password" name ="password" class="form-control" placeholder="Mot de passe" value="<?php echo set_value('password'); ?>"> 
            </div>
            
            <button type="submit" name="btn_login" class="btn btn-outline-danger btn-block">Valider</button>
            </form>
            <div class="text-white text-center"><a class="nav-link mt-3 p-3 text-info" href="<?php echo base_url('home');?>">Pas inscrit ? Inscrivez-vous</a></div>
            <div class="text-white text-center"><a class="nav-link text-warning" data-toggle="modal" data-target="#resetpassword" href="">Mot de passe oublié ?</a></div>
          </div>
        </div>
      </div>


  </div><!--end of row-->
</div><!--end of home-inner-->

    <!-- end of banner -->
  </header>
  <!-- end of header -->

 

  <!-- modal -->
  <div class="modal fade" id="resetpassword">
    <div class="modal-dialog ">
        <div class="modal-content resetpass">
            <div class="modal-header">
                <h4 class="modal-title">
                    Entrer votre email
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php $attr_register = array('id'=>'form_resetpassword','role'=>'form');?>

              <?php echo form_open('client_forgotpassword/resetpassword', $attr_register) ?>

              <?php echo validation_errors('<div class="alert alert-register"><a href="#" class="close ml-3" data-dismiss="alert" aria-label="close">x</a>', '</div>'); ?>


              <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Votre Email" value="<?php echo set_value('email'); ?>"> 
              </div>

              <button type="submit" name="btn_resetpassword" class="btn btn-outline-danger btn-block">Envoyé</button>
              </form>

            </div><!--end of modal body-->
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
  <!-- end of modal -->