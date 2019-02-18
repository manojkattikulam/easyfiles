
<!--TABLE SECTION-->
<section>
<div class="container dashbd-client">
  <div class="row mb-5">
    <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">     

       
 
<div class="col-12 text-center ">
    <h2 class="display-5 m-5 text-success">Merci pour votre commande</h2>

    <p>Achat réussi! Cher <?php echo $this->session->userdata('fullname'); ?>&nbsp;merci pour votre achat. </p>

    <p>Votre détails d'achat est envoyé à votre email:&nbsp;<?php echo $this->session->userdata('email'); ?>.</p>
   <p> Veuillez garder le numéro de transactions pour le réference.</p>

    <p><a href="<?php echo base_url('Client_Download/telecharger');?>">Télécharger votre fichiers</a></p>              
</div>

  


    </div><!--end of div col-xl-10 -->
  </div><!--end of row-->
</div><!--end of container fluid-->
</section>

<!--//////////////  ENVOIS MESSAGE SUPPORT CLIENT  //////////////////--->

<div class="modal fade" id="clientMsg" role="dialog" >
  <div class="modal-dialog" role="document">

  <?php $attributes = array('role' => 'form' ); ?>   
  <?php echo form_open_multipart('Client_Dashbd/sendmessage', $attributes);?>

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