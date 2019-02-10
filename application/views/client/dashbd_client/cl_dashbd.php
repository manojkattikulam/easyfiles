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

        <h3 class="text-success mb-3">Acheter vos fichiers</h3>
        <div class="row">
           <div class="col-12">
        Trier par zone géographique : 

            <ul class="clientCat float-right">
            <li><a href="<?php echo base_url('Client_Dashbd')?>">Tout</a></li>
            <?php foreach($getCatClients as $catClients): ?>
            <li><a  href="<?php echo base_url('Client_Dashbd/getProClientsById/'). $catClients->cat_id ?>"><?php echo $catClients->cat_name ?></a></li>
            <?php endforeach; ?>
            </ul>
            </div> 
        </div>

        <?php if($allProductsClients) :  ?>
          <!--TABLE STARTS HERE -->
          <table id="product_tbl" class="table table-bordered bg-muted">

            <thead class="bg-dark text-white"> 
                <tr class="text-muted"> 
                <th>Fichier</th>                   
                <th>Nom du Produit</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
           

                <?php foreach($allProductsClients as $allproduct): ?>
                <tr>
                <td class="font-italic"><?php echo $allproduct->pro_file; ?></td>  
                <td class="font-weight-bold text-uppercase"><?php echo $allproduct->pro_name; ?></td>
                <td><?php echo $allproduct->pro_desc; ?></td>
                <td class="text-danger font-weight-bold"><?php echo $allproduct->pro_price.'€'; ?></td> 
                         
                <td class="text-center">
                <?php echo form_open('cart/addToCart/'); ?>
                    <input type="hidden" name="proId" value="<?php echo $allproduct->pro_id; ?>">
                    <input type="hidden" name="sId" value="<?php echo session_id(); ?>">
                    <input type="hidden" name="userId" value="<?php echo $this->session->userdata['user_id']; ?>">
                    <button type="submit" name="addCart" class="btn btn-outline-success"><i class="fas fa fa-shopping-cart"></i></button>
                </form>
                
                </td>
                

                </tr>
                <?php endforeach; ?>
                

            </tbody>
          </table> <!-- end of tables -->
          <div class="pagination">
          <?php echo $links; ?>
        </div>
          <?php else: ?>
                <p class="bg-danger text-white text-center p-3">Il n'y a pas les produits dans la base de données pour le moment</p>
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