 <!--TABLE SECTION-->
 <section>
<div class="container-fluid">
  <div class="row mb-5">
    <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">     
      <div class="row align-items-center">

        <!--CONTENT DIV -->
        <div class="col-12 mb-4 mb-xl-0">

        

        <h3 class="text-muted text-center mb-3">Ajouter Les Catégories</h3>

            <div class="col-md-6 mx-auto mb-5">

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

            <?php echo form_open_multipart('Admin_Category/add_category');?>

            <div class="form-group">
            <label>Nom de la catégorie</label>
            <input type="text" class="form-control" name="category_name" placeholder="Ajouter le titre">
            </div>

            <div class="form-group">
            <label>Description</label>
            <textarea id="editor1" class="form-control" name="category_desc" placeholder="Ajouter le texte"></textarea>
            </div>


            <div class="form-group">
            <label>Ajouter une image</label><br>
            <input type="file" name="userfile" size="20">
            </div>

            <button type="submit" name="btn_addCategory" class="btn btn-primary">Ajouter</button>

            </form>

            </div>
          
          
        </div><!--end of content div -->
      </div><!-- end of row -->
    </div><!--end of div col-xl-10 -->
  </div><!--end of row-->
</div><!--end of container fluid-->
</section>
   
