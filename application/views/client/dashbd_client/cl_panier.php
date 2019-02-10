<!--TABLE SECTION-->
<section>
<div class="container dashbd-client">
  <div class="row mb-5">
    <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">     
      <div class="row align-items-center">

        <!--CONTENT DIV -->
        <div class="col-12 mb-4 mb-xl-0">



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

        <h3 class="text-success mb-3">Votre Panier</h3>
        <div class="row">
           
            
        </div>

        <?php if($viewcarts) : 

            $i = 0; 
            $sum = 0;  
         
        ?>
          <!--TABLE STARTS HERE -->
          <table id="cart_tbl" class="table table-bordered bg-muted">

            <thead class="bg-dark text-white"> 
                <tr class="text-muted"> 
                <th>#</th>                   
                <th>Fichier</th>
                <th>Nom du Produit</th>
                <th>Prix</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
            <?php foreach($viewcarts as $cart): ?>
                <?php $i++; ?>
                
                <tr>
                <td ><?php echo $i; ?></td>
                <td class="font-italic"><?php echo $cart->product_file; ?></td>
                <td class="font-weight-bold text-uppercase"><?php echo $cart->product_name;?></td>
                <td class="text-danger font-weight-bold"><?php echo $cart->product_price."€";?></td>
                     
                <td class="text-center"><a href="<?php echo base_url("Client_Panier/cartDelete/$cart->cart_id"); ?>"><i class="fas fa-trash-alt fa-lg text-danger"></i></a></td>
               
                </tr>
                <?php $sum += $cart->product_price; ?>
                   
               
                <?php endforeach; ?>
                
               <tr>
               
                   <td></td>
                   <td></td>
                   <td></td>
                   <td class="bg-dark text-white text-center">Prix HT</td>
                   <td class="bg-dark text-white text-center"><?php echo $sum ."€"; ?></td>
                   
               </tr>
               <tr>
                   <td></td>
                   <td></td>
                   <td><?php $tva = $sum *0.2; $gtotal = $sum + $tva;?>
                   </td>

                   <?php 
                if(!empty($gtotal)){

                    $this->session->set_userdata('quantity', $i);
                    $this->session->set_userdata('gtotal', $gtotal); 
                    
                } else {

                    unset($_SESSION['quantity']);
                    unset($_SESSION['gtotal']);

                }
                
                
                ?>
                  
                   <td class="bg-dark text-white text-center">TVA</td>
                   <td class="bg-dark text-white text-center">20%</td>
                   
               </tr>
               <tr >
                   <td></td>
                   <td><a class="btn btn-dark text-warning" href="Client_Dashbd">Continuer vos achats</a></td>

                   <!--PAY PAL CHECKOUT FORM WITH BUTTON-->
                   <td>
                   <form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

                    <input type="hidden" name="cmd" value="_cart">
                    <input type="hidden" name="business" value="business@easyfiles.com">

                    <!-- Specify details about the item that buyers will purchase. -->
                    <?php $x = 0 ?>
                    <?php foreach($viewcarts as $pcart): 
                        $x++; 
                    ?>
                    
                    <input type="hidden" name="item_name_<?php echo $x; ?>" value="<?php echo $pcart->product_name; ?>">
                    <input type="hidden" name="item_desc_<?php echo $x; ?>" value="<?php echo $pcart->product_file; ?>">
                    <input type="hidden" name="amount_<?php echo $x; ?>" value="<?php echo $pcart->product_price; ?>">
                    
                   <?php endforeach; ?>
                    <input type="hidden" name="currency_code" value="FR">

                    <!-- Specify return success and cancel pages. -->
                    <input type="hidden" name="return" value="<?php echo base_url('Client_Achat/payment') ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo base_url('Client_Panier') ?>">



                    <!-- Display the payment button. -->
                    <input type="image" name="upload"
                    src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif"
                    alt="PayPal - The safer, easier way to pay online">
                    <img alt="" width="1" height="1"
                    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
                    </form>
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   </td><!--end paypal form -->
                   <td class="bg-dark text-white text-center">Prix TTC</td>
                   <td class="bg-dark text-white text-center"><?php echo $gtotal ."€"; ?>                  
                   </td>

            
                   
               </tr>
              
            </tbody>
          </table> <!-- end of tables -->
        
          
          <?php else: ?>
                <p class="bg-danger text-white text-center p-3">Il n'y a pas les produits dans le panier</p>
              
          <?php endif; ?>
         

        </div><!--end of content div -->
      </div><!-- end of row -->
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