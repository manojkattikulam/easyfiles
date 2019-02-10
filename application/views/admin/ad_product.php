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

        <div class="col-6">
        <a class='btn bg-light' href="<?php echo base_url('Admin_Product/view_add_product'); ?>"><i class="fas fa-plus fa-lg text-danger mr-3"></i>Ajouter une produit</a>
        </div>

        <h3 class="text-danger text-center mb-3">Les Produits</h3>

        <?php if($allProducts) : ?>
          <!--TABLE STARTS HERE -->
          <table id="product_tbl" class="table table-bordered bg-light text-center">

            <thead class="bg-dark text-white"> 
                <tr class="text-muted">                    
                <th>Fichier</th>
                <th>Nom du Produit</th>
                <th>Description</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
           

                <?php foreach($allProducts as $allproduct): ?>
                <tr>
                <td><?php echo $allproduct->pro_file; ?></td>
                <td><?php echo $allproduct->pro_name; ?></td>
                <td><?php echo $allproduct->pro_desc; ?></td>

                <td>
                <a href="<?php echo base_url('Admin_Product/edit_product/'.$allproduct->pro_id); ?>" class="btn"><i class="fas fa-edit fa-lg text-success mr-2"></i></a>

                <a href="<?php echo base_url('Admin_Product/delete_product/'.$allproduct->pro_id); ?>" class="btn delete_cat"><i class="fas fa-trash-alt fa-lg text-danger mr-2"></i></a>
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
   