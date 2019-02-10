
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
        <a class='btn bg-light' href="<?php echo base_url('Admin_Category/add_category'); ?>"><i class="fas fa-plus fa-lg text-danger mr-3"></i>Ajouter une categorie</a>
        </div>

        <h3 class="text-danger text-center mb-3">Les Catégories</h3>

        <?php if($allCategories) : ?>
          <!--TABLE STARTS HERE -->
          <table class="table table-bordered bg-light text-center">

            <thead class="bg-dark text-white"> 
                <tr class="text-muted">                    
                <th>Image</th>
                <th>Nom de la catégorie</th>
                <th>Description</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
           

                <?php foreach($allCategories as $allCategory): ?>
                <tr>
                <td><img class="cat_img_resize" src="<?php echo base_url('assets/images/category/');?><?php echo $allCategory->cat_image; ?>"></td>
                <td><?php echo $allCategory->cat_name; ?></td>
                <td><?php echo $allCategory->cat_desc; ?></td>

                <td>
                <a href="<?php echo base_url('Admin_Category/edit_category/'.$allCategory->cat_id); ?>" class="btn"><i class="fas fa-edit fa-lg text-success mr-2"></i></a>

                <a href="<?php echo base_url('Admin_Category/delete_category/'.$allCategory->cat_id); ?>" class="btn delete_cat"><i class="fas fa-trash-alt fa-lg text-danger mr-2"></i></a>
                </td>

                </tr>
                <?php endforeach; ?>
                

            </tbody>
          </table> <!-- end of tables -->
          <div class="pagination">
          <?php echo $links; ?>
        </div>
          <?php else: ?>
                <p class="bg-danger text-white text-center p-3">Il n'y a pas de catégories dans la base de données pour le moment</p>
          <?php endif; ?>

        </div><!--end of content div -->
      </div><!-- end of row -->
    </div><!--end of div col-xl-10 -->
  </div><!--end of row-->
</div><!--end of container fluid-->
</section>
   
