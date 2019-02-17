<!-- tables -->

<section>
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-start">
            
            <!--table client-->
              <div class="col-xl-8 col-12 mb-4 mb-xl-0">
                <h3 class="text-muted text-center mb-3"> Clients - un apérçu d'achats</h3>

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

                <table class="table table-striped bg-light">
                  <thead>
                  <?php $i = 0; ?>
                    <tr class="bg-dark text-muted">
                      
                      <th>Nom</th>
                      <th>Fichiers</th>
                      <th>Achats</th>
                      <th>Contact</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($clients as $client): ?>
                    <tr>                      
                      
                      <td class="text-uppercase font-weight-bold"><?php echo $client->fullname ?></td>
                      <td><?php echo $client->totalOrders ?></td>
                      <td class="text-danger"><?php echo $client->total_value.' €' ?></td>
 
                      <td><button class="btn btn-warning" onclick="send_mail(<?php echo $client->id;?>)"><i class="fas fa-envelope "></i></button>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <div class="pagination">
                  <?php echo $clientlinks; ?>
                </div>
              </div>
               <!--end table client-->

               <!--table file-->
              <div class="col-xl-4 col-12">
                <h3 class="text-muted text-center mb-3">Fichiers les plus vendus</h3>
                <table class="table table-dark table-hover ">
                <thead class="text-muted">
                 
                    <tr>
                     
                      <th>Fichiers</th>
                      <th>Acheter</th>
                      
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($files as $file):  ?>
                    <tr>                      
                     
                      <td class="text-uppercase font-weight-bold"><?php echo $file->product_name ?></td>
                      <td class="text-danger"><?php echo $file->total.' fois';?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
               
              <!--end table file-->

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end of tables -->

<div class="row">
  <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
    <div class="row m-2">
      <div class="col-md-4  mb-4 mb-xl-0">
      <div class="card">
        <div class="card-header bg-dark text-white">
        <h5>Créer des tâches</h5>
        </div>
          <div class="card-body">
          <div class="container">
          <form id="task-form">
            <div class="form-group"><input id="title" class="form-control form-control-lg tache" type="text" placeholder="Nom de tâches"></div>
            <div class="form-group">
            <textarea id="taches" class="form-control" rows="3"></textarea>
            </div>
            <input type="submit" class="btn btn-dark text-warning mb-2" value="Ajouter">
            </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8  mb-4 mb-xl-0">
        <div class="card">
          <div class="card-header bg-dark text-white">        
            <div class="col-md-6"><h5>Liste de tâches</h5></div>
          </div>
          <div class="card-body">
          <h5 class="card-title"></h5>
          <table class="table task-tbl">
          <thead>
          <th class="text-danger text-uppercase">Nom de la tâche</th>
          <th class="text-danger text-uppercase">Tâche à finir</th>
          </thead>
          <tbody id="task-list"></tbody>
          
          </table>

          </div>
        </div>
      </div>
    </div>   
  </div>    
</div>


    <!--//////////////  ENVOIS MESSAGE CLIENT  //////////////////--->

<div class="modal fade" id="clientAdminMsg" role="dialog" >
  <div class="modal-dialog" role="document">

  <?php $attributes = array('role' => 'form' ); ?>   
  <?php echo form_open_multipart('Admin_Dashbd/sendMessageToClient', $attributes);?>

    <div class="modal-content bg-dark ">
      <div class="modal-header text-warning p-4">
        <h5 class="modal-title">Envoyer un message</h5>
        <button type="button" class="close text-warning" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-white p-4">
          <div class="form-group">
              <label class="font-weight-bold text-uppercase ">Email Client</label>            
                <input type="num" name="email" class="form-control" >              
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


<!--//////////////  FIN ENVOIS MESSAGE CLIENT  //////////////////--->
   
  