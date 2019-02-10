  <!-- tables -->
  <section>
      <div class="container-fluid dashbd-client-invoice">
        <div class="row mb-5">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
           
            <div class="row align-items-center">            
              <div class="col-md-6 col-lg-10">             
                <div class="row align-items-start justify-content-end mb-5">
                    <div class="col-md-6 col-lg-10 align-self-start text-left">
                    <a class="btn btn-info mb-5" href="<?php echo base_url('Client_Achat/getClientOrders');?>">Retour</a>
                        <h3>Easy<span class="text-danger">Files</span> Management</h3>
                       
                           
                    </div>
                    <div class="col-md-6 col-lg-10 align-self-start text-right">
                        Nom: <span class="text-success"><?php echo $this->session->userdata('fullname');?></span><br>
                        N°Facture: <span class="text-success"><?php echo $invoices[0]->tx_id; ?></span> <br>   
                    </div>
                </div>
                              
              </div>           
            </div>
            
            <div class="row align-items-center">            
              <div class="col-md-6 col-lg-10">             
                <div class="row align-items-start justify-content-end mb-5">
                    <div class="col-lg-10 p-3">
                    <h5 class="text-success">
                        Achats de
                        <?php $date = $invoices[0]->date; echo date('d/m/Y', strtotime($date)); ?>
                    </h5>
                    <?php if($invoices) { $sum = 0; ?>
                    <table id="billing" class="table table-striped text-center">
                      <thead class="bg-dark text-muted">
                        <tr>
                          <th>Date</th>
                          <th>Transaction</th>
                          <th>Fichier</th>
                          <th>Prix</th>

                        </tr>
                      </thead>
                      <tbody>

                      <?php foreach($invoices as $invoice): ?>
                        <tr>
                          <td><?php $date = $invoice->date; echo date('d-m-Y', strtotime($date)); ?></td>
                          <td><?php echo $invoice->tx_id; ?></td>
                          <td class="text-uppercase font-weight-bold"><?php echo $invoice->product_name; ?></td>
                          <td class="text-danger"><?php echo $invoice->product_price.' €'; ?></td>
                        </tr>
                         <?php $sum += $invoice->product_price; ?>  
                      <?php endforeach;?>
                        <tr>
                          <td></td>
                          <td></td>
                          <td class="bg-dark text-warning">Prix HT</td>
                          <td class="bg-dark text-warning"><?php echo number_format((float)$sum, 2, '.', '').' €'; ?></td>

                        </tr>
                          <tr>
                          <td></td>
                          <td></td>
                          <td class="bg-dark text-warning">TVA </td>
                          <td class="bg-dark text-warning">20%</td>
                          <?php $tva = ($sum * 0.2) + $sum; ?>
                        </tr>
                          <tr>
                          <td></td>
                          <td></td>
                          <td class="bg-dark text-warning">Prix TOTAL</td>
                          <td class="bg-dark text-warning"><?php echo number_format((float)$tva, 2, '.', '').' €'; ?></td>
                
                        </tr>
                      </tbody>
                    </table>
                    <?php } else { ?>
                        
                        <div class="col-md-10">
                            <h3 class="text-white bg-danger p-3">La facture demandé n'est pas disponible</h3>
                        </div>

                    <?php } ?>
                    </div>
                </div>
                              
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