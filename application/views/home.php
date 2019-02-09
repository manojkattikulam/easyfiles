
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

      <div class="col-lg-8 d-none d-lg-block text-white banner-heading ">
        <h1 class="display-4 text-shadow banner-heading">Votre site <span class="orange font-weight-bold">d’achat</span> de <span class="orange font-weight-bold">fichiers</span> de prospection en ligne</h1>
        <div class="d-flex">
          <div class="p-4 align-self-start">
            <i class="fas fa-check fa-2x "></i>
          </div>
          <div class="p-4 align-self-end">
            Inscrivez vous en remplissant la formulaire et connectez à votre espace client.
          </div>
        </div>
        <div class="d-flex">
          <div class="p-4 align-self-start ">
            <i class="fas fa-check fa-2x"></i>
          </div>
          <div class="p-4 align-self-end ">
          Chossisez votre le fichier clients et réglez votre commande en ligne .
          </div>
        </div>
        <div class="d-flex">
          <div class="p-4 align-self-start">
            <i class="fas fa-check fa-2x"></i>
          </div>
          <div class="p-4 align-self-end ">
           Téléchargez votre fichier de prospection.
          </div>
        </div>
      </div><!--end of col-lg-8-->

      <div class="col-lg-4">
        <div class="card bg-dark-transparent text-light cardform banner-par">

          <div class="card-body">
            <h3 class="text-center"><i class="fas fa-user orange mr-2"></i>Inscription</h3>
            <p class="text-center text-muted">Crée un compte client </p>
          <!-- Registration form begin here -->

            <?php $attr_register = array('id'=>'form_register','role'=>'form');?>

            <?php echo form_open('client_register/register', $attr_register) ?>

            <?php echo validation_errors('<div class="alert alert-register"><a href="#" class="close ml-3" data-dismiss="alert" aria-label="close">x</a>', '</div>'); ?>
           
            <div class="form-group">
              <input type="text" name ="username" class="form-control" value="<?php echo set_value('username'); ?>" placeholder="Votre Nom"> 
            </div>
            <div class="form-group">
              <input type="text" name ="profession" class="form-control" value="<?php echo set_value('profession'); ?>" placeholder="Profession"> 
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Votre Email" value="<?php echo set_value('email'); ?>"> 
            </div>
            <div class="form-group">
                <select name="sexe" class="form-control" id="gender">
                    <option value="sexe" <?php echo  set_select('sexe', 'Sexe', TRUE); ?>>Civilité</option>
                    <option value="M" <?php echo  set_select('sexe', 'Madame'); ?>>Madame</option>
                    <option value="Mr" <?php echo  set_select('sexe', 'Monsieur'); ?>>Monsieur</option>
                </select>
            </div>
            <div class="form-group">
              <input type="password" name ="password" class="form-control" placeholder="Mot de passe" value="<?php echo set_value('password'); ?>"> 
            </div>
            <div class="form-group">
              <input type="password" name ="confirm_password" class="form-control" placeholder="Confirmer Mot de passe" value="<?php echo set_value('confirm_password'); ?>"> 
            </div>
            <button type="submit" name="btn_register" class="btn btn-outline-danger btn-block">C'est parti !</button>
            

            
            <div class="text-white text-center"><a class="nav-link p-3 text-info" href="<?php echo base_url('client_login/login');?>">Déjà inscrit ? Connectez-vous</a></div>
            
            </form>
          </div>


        </div>
      </div>


</div><!--end of row-->
</div><!--end of home-inner-->

<!-- end of banner -->
</header>
<!-- end of header -->

 



