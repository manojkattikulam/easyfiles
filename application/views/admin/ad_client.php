<!--TABLE SECTION-->
<section>
<div class="container-fluid">
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

       

        <h3 class="text-danger text-center mb-3">Les Clients</h3>

        <?php if($allClients) : ?>
          <!--TABLE STARTS HERE -->
          <table id="product_tbl" class="table table-bordered bg-light text-center">

            <thead class="bg-dark text-white"> 
                <tr class="text-muted">                    
                <th>Nom</th>
                <th>Profession</th>
                <th>Email</th>
                <th>Fichiers</th>
                <th>Achats</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
           

                <?php foreach($allClients as $allclient): ?>
                <tr>
                <td class="text-uppercase font-weight-bold"><?php echo $allclient->fullname; ?></td>
               
                <td><?php echo $allclient->profession; ?></td>
                <td><?php echo $allclient->email; ?></td>
                <td><?php echo $allclient->totalOrders; ?></td>
                <td class="text-success"><?php echo $allclient->total_value; ?></td>

                <td>
               
                <a href="<?php echo base_url('Admin_Client/adminDetailClient/'.$allclient->id); ?>" class="btn btn-warning text-black mr-2"  data-toggle="tooltip" data-placement="top" title="VOIR"><i class="fas fa-eye text-black"></i></a>
                <a href="<?php echo base_url('Admin_Client/blockClient/'.$allclient->id); ?>" class="btn btn-danger text-white mr-2"  data-toggle="tooltip" data-placement="top" title="BLOQUER"><i class="fas fa-ban text-white"></i></a>
                <a href="<?php echo base_url('Admin_Client/permitClient/'.$allclient->id); ?>" class="btn btn-success text-white mr-2" data-toggle="tooltip" data-placement="top" title="ACTIVER"><i class="fas fa-check text-white"></i></a>

                <a href="<?php echo base_url('Admin_Client/deleteClient/'.$allclient->id); ?>" class="btn btn-dark text-danger" data-toggle="tooltip" data-placement="top" title="SUPPRIMER"><i class="fas fas fa-trash-alt text-danger"></i></a>
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
   

