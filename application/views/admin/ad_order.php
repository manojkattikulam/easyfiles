
 <!--TABLE SECTION-->
 <section>
<div class="container-fluid ">
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

       

        <h3 class="text-center mb-3 text-danger">Les Commandes</h3>

        <?php if($allOrders) : ?>
          <!--TABLE STARTS HERE -->
          <table id="product_tbl" class="table table-bordered bg-light text-center">

            <thead class="bg-dark text-white"> 
                <tr class="text-muted">  
                <th>Date</th> 
                <th>Fichier</th>                 
                <th>Nom</th>              
                <th>Prix</th>
                <th>N° transaction</th>               
                <th>Statut</th>
                </tr>
            </thead>
            <tbody>
            
           

                <?php foreach($allOrders as $allorder): ?>
                <tr>
                <td><?php $date = $allorder->date; echo date('d-m-Y', strtotime($date)); ?></td>
                <td class="text-uppercase font-weight-bold"><?php echo $allorder->product_name; ?></td>
                <td><?php echo $allorder->fullname; ?></td>
                <td><?php echo $allorder->product_price; ?></td>
                <td><?php echo $allorder->tx_id; ?></td>    
                <td class="text-success"><?php echo $allorder->status; ?></td>

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
   

