<!-- tables -->
<section>
    <div class="container-fluid">
     
    <div class="row mb-5">
        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
                <div class="col-xl-12 col-12 mb-4 mb-xl-0">

                    <!-- MESSAGES -->
                        <?php 
                            if($this->session->flashdata('message')){
                            echo '<div class="alert alert-message my-3 p-3 text-center bg-danger text-white"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'. $this->session->flashdata('message'). '</div>';} 
                        ?>
                    <!-- END OF MESSAGES -->

                    <h3 class="text-orange text-center mb-3 display-3">Acheter Vos Fichiers</h3>
                    <table class="table table-striped bg-light text-center">
                        <thead class="text-white bg-dark">
                            <tr >
                                <th>Ville</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th></th>
                                <th></th>                             
                            </tr>
                        </thead>
                        <tbody>                          
                            <tr>
                                <td><?php echo $product[0]['item_name']; ?></td>
                                <td><?php echo $product[0]['item_desc']; ?></td>
                                <td><?php echo $product[0]['item_price']; ?></td>
                                <td><a class="btn btn-warning text-white" href="">Commander</a></td>
                                <td><a class="btn btn-success text-white" href="">Panier</a></td>
                            </tr>
                            <form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

                            <!-- Identify your business so that you can collect the payments. -->
                            <input type="hidden" name="business" value="shop@easyfiles.com">

                            <!-- Specify a PayPal Shopping Cart Add to Cart button. -->
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="add" value="1">

                            <!-- Specify details about the item that buyers will purchase. -->
                            <input type="hidden" name="item_name" value="<?php echo $this->session->userdata('itemName');  ?>">
                            <input type="hidden" name="item_desc" value="<?php echo $this->session->userdata('itemDesc');  ?>">
                            <input type="hidden" name="amount" value="<?php echo $this->session->userdata('itemPrice'); ?>">
                            <input type="hidden" name="currency_code" value="FR">

                            <!-- Specify return success and cancel pages. -->
                            <input type="hidden" name="return" value="<?php echo base_url('Client_Achat/payment/') ?>">
                            <input type="hidden" name="cancel_return" value="<?php echo base_url('Client_Panier') ?>">



                            <!-- Display the payment button. -->
                            <input type="image" name="submit"
                            src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif"
                            alt="PayPal - The safer, easier way to pay online">
                            <img alt="" width="1" height="1"
                            src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
                            </form>
                                                        
                            </tbody>
                        </table>                    
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of tables -->

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
