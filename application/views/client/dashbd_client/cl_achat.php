
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

        <h3 class="text-success mb-3">Vos Commandes & Factures</h3>
        <div class="row">


        <?php if($billing) :  $sum = 0; ?>
          <!--TABLE STARTS HERE -->
          <table id="product_tbl" class="table table-bordered bg-muted">

            <thead class="bg-dark text-white"> 
                <tr class="text-muted"> 
                
                <th>Date d'achat</th>  
                <th>N° Transaction</th>            
                <th>Quantité</th>   
                <th>Achats</th>                  
                
                <th>Facture</th>
                <th>Télécharger</th>             
               
               
                </tr>
            </thead>
            <tbody>
                
           

                <?php foreach($billing as $bill): ?>
               
                <tr>
                
                <td ><?php $date = $bill->date; echo date('d-m-Y', strtotime($date)); ?></td>
                <td class="font-weight-bold text-uppercase"><?php echo $bill->tx_id; ?></td>
                <td class="text-center"><?php echo $bill->total_value; ?></td>
                <td class="text-center"><?php echo $bill->totalOrders.'€'; ?></td>
                
                <td class="text-center"><a href="<?php echo base_url('Client_Achat/clientInvoiceHtml/'.$bill->tx_id);?>"><i class="fa fa-eye text-success fa-2x"></i></a></td>
                <td class="text-center"><a href="<?php echo base_url('Client_Achat/pdfdetails/'.$bill->tx_id);?>"><i class="fa fa-file-pdf text-orange fa-2x" ></i></a></td>                  
            
                </tr>
                <?php $sum += $bill->totalOrders; ?>
                <?php endforeach; ?>
                

            </tbody>
          </table> <!-- end of tables -->
          
          <div class=" bg-dark text-warning p-3 mt-5 text-center mx-auto">
          <?php $tva = $sum *0.2; $gtotal = $sum + $tva; ?>
         <h5 class="text-weight-bold mr-3"> Votre achats juqu'ici est de:</h5> <h2 class=" text-uppercase text-danger"><?php echo $gtotal.'€ TTC'; ?></h2>
          </div>
          

          <?php else: ?>
                <p class="bg-danger text-white text-center p-3">Il n'y a pas les fichiers à télécharger</p>
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