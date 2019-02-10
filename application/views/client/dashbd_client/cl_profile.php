<!-- tables -->
<section>
    <div class="container-fluid">
           
        
            <div class="col-md-5 mt-5 mx-auto">

             <!-- MESSAGES -->
             <?php 
                if($this->session->flashdata('message')){
                echo '<div class="alert alert-message my-3 p-3 text-center bg-danger text-white"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'. $this->session->flashdata('message'). '</div>';} 
            ?>
            <!-- END OF MESSAGES -->

              <!-- update profile form begin here -->

                 <?php $attr_register = array('id'=>'form_register','role'=>'form');?>

                <?php echo form_open('Client_Profile/updateCustomer', $attr_register) ?>

                <?php echo validation_errors('<div class="alert alert-register"><a href="#" class="close ml-3" data-dismiss="alert" aria-label="close">x</a>', '</div>'); ?>

                <input type="hidden" name ="userId" class="form-control" value="<?php echo $customer[0]['id'];?>" > 

                <div class="form-group">
                <input type="text" name ="fullname" class="form-control" value="<?php echo $customer[0]['fullname'];?>" > 
                </div>
                <div class="form-group">
                <input type="text" name ="profession" class="form-control" value="<?php echo $customer[0]['profession'];?>"> 
                </div>
                <div class="form-group">
                <input type="email" name="email" class="form-control"  value="<?php echo $customer[0]['email'];?>"> 
                </div>
               
                <button type="submit" name="btn_register" class="btn btn-info btn-block">Modifier</button>
                </form>

               

            </div>

        
    </div>
</section>
<!-- end of tables -->

<!--//////////////  ENVOIS MESSAGE SUPPORT CLIENT  //////////////////--->

<div class="modal fade" id="clientMsg" role="dialog" >
  <div class="modal-dialog" role="document">

  <?php $attributes = array('role' => 'form' ); ?>   
  <?php echo form_open_multipart('clients/sendmessage', $attributes);?>

    <div class="modal-content bg-dark ">
      <div class="modal-header text-warning p-4">
        <h5 class="modal-title">Envoyer un message</h5>
        <button type="button" class="close text-warning" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-white p-4">

          <div class="form-group my-5">
            <label for="receiver_email" class="font-weight-bold text-uppercase ">Choisissez votre support de service<span class="required text-danger">&nbsp;*</span></label>
            <select type="select" name="support_email" class="form-control">
                <option value="mkworkshop49@gmail.com">Support Achats</option>
                <option value="mkbilling49@gmail.com">Support SAV</option>
                <option value="mkadmin49@gmail.com">Support Téchnique</option>  
            </select>
          </div>
          <div class="form-group my-5">
                <label for="message" class="font-weight-bold text-uppercase ">Message</label>
                <textarea aria-required="true" rows="8" cols="45" name="message" id="message" class="form-control" placeholder="Votre message ici " required></textarea>
          </div>
        
       </div>
      <div class="modal-footer bg-dark text-warning p-4">
        <button type="submit" class="btn btn-success text-warning">Envoyé</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
    </form>
  </div>
</div>


<!--//////////////  FIN ENVOIS MESSAGE SUPPORT CLIENT  //////////////////--->