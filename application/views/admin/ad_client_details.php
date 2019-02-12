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

       

        <h3 class="text-danger text-center mb-3">Détails Clients</h3>

        <?php if($fullClientDetails) : ?>

        <?php $this->session->set_userdata('clientname', $fullClientDetails[0]->fullname); ?>
        <?php $this->session->set_userdata('clientid', $fullClientDetails[0]->id); ?>

        <div class="row align-items-center">            
              <div class="col-md-6 col-lg-10">             
                <div class="row align-items-start justify-content-end">
                    <div class="col-md-6 col-lg-10 align-self-start text-left">
                    <a class="btn btn-info" href="<?php echo base_url('Admin_Client');?>">Retour</a>
                    
                             
                    </div>
                    <div class="col-md-6 col-lg-10 align-self-start text-right">
                        Nom: <span class="text-success"><?php echo $fullClientDetails[0]->fullname;?></span><br>
                        Profession: <span class="text-success"><?php echo $fullClientDetails[0]->profession;?></span> <br>
                        Email: <span class="text-primary"><?php echo $fullClientDetails[0]->email;?></span> <br>     
                    </div>
                </div>
                              
              </div>           
            </div>
          <!--TABLE STARTS HERE -->
          <table id="product_tbl" class="table table-bordered bg-light text-center  mt-5">

            <thead class="bg-dark text-white"> 
                <tr class="text-muted">                    
                <th>Date d'achat</th>
                <th>N° Transation</th>
                <th>Quantité</th>
                <th>Achats</th>
                <th>Voir</th>
                <th>Télécharger</th>
                </tr>
            </thead>
            <tbody>
            
           

                <?php foreach($fullClientDetails as $fullClientDetail): ?>
                <tr>
                <td><?php $date = $fullClientDetail->date; echo date('d-m-Y', strtotime($date)); ?></td>
                <td><?php echo $fullClientDetail->tx_id; ?></td>
                <td><?php echo $fullClientDetail->txNum; ?></td>
                <td><?php echo $fullClientDetail->totalprice; ?></td>

                <td width="5%">
               
                <a class="btn" href="<?php echo base_url('Admin_Client/adminClientInvoiceHtml/'.$fullClientDetail->tx_id); ?>"  data-toggle="tooltip" data-placement="top" title="VOIR"><i class="fas fa-eye text-success fa-2x mr-2"></i></a>
                </td>
                <td width="5%">
                <a class="btn" href="<?php echo base_url('Admin_Order/pdfdetails/'.$fullClientDetail->tx_id);?>"  data-toggle="tooltip" data-placement="top" title="TELECHARGER"><i class="fa fa-file-pdf text-orange fa-2x" ></i></a>  
               </td>
               

                </tr>
                <?php endforeach; ?>
                

            </tbody>
          </table> <!-- end of tables -->
          
          <?php else: ?>
                <p class="bg-danger text-white text-center p-3">Désolé ! Le client demandé n'exist pas</p>
          <?php endif; ?>

        </div><!--end of content div -->
      </div><!-- end of row -->
    </div><!--end of div col-xl-10 -->
  </div><!--end of row-->
</div><!--end of container fluid-->
</section>
