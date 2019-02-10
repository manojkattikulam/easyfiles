<!--TABLE SECTION-->
<section>
<div class="container-fluid">
  <div class="row mb-5">
    <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">     
      <div class="row align-items-center">

        <!--CONTENT DIV -->
        <div class="col-12 mb-4 mb-xl-0">

        

        <h3 class="text-muted text-center mb-3">Modifier Les Catégories</h3>

            <div class="col-sm-9 ml-auto mb-5">

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


            <?php echo validation_errors('<div class="alert alert-admin mb-2"><a href="#" class="close ml-3" data-dismiss="alert" aria-label="close">x</a>', '</div>'); ?>

            <?php echo form_open_multipart('Admin_Category/update_category');?>
            
            <input type="hidden" name="category_id" value="<?php echo $categoriesEdit[0]['cat_id']; ?>">
            <input type="hidden" name="category_oldImg" value="<?php echo $categoriesEdit[0]['cat_image']; ?>">

            <div class="form-group">
            <label>Nom de la catégorie</label>
            <input type="text" class="form-control" name="category_name" value="<?php echo $categoriesEdit[0]['cat_name']; ?>">
            </div>

            <div class="form-group">
            <label>Description</label>
            <textarea id="editor1" class="form-control" name="category_desc"><?php echo $categoriesEdit[0]['cat_desc']; ?></textarea>
            </div>


            <div class="form-group">
            <label>Ajouter une image</label><br>
            <input type="file" name="userfile" size="20">
            </div>
            <div col-md-3 class="my-3"><img class="catedit_img_resize" src="<?php echo base_url('assets/images/category/'). $categoriesEdit[0]['cat_image'];?>" alt="category_photo" ></div>

            <button type="submit" name="btn_updateCategory" class="btn btn-primary">Modifier</button>

            </form>

            </div>
          
          
        </div><!--end of content div -->
      </div><!-- end of row -->
    </div><!--end of div col-xl-10 -->
  </div><!--end of row-->
</div><!--end of container fluid-->
</section>
   
