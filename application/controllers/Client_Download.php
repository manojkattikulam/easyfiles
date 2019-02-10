<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Download extends CI_Controller {

  //function to download files
public function telecharger()
{

	if(isset($_SESSION['login']) == TRUE )
	{

		$uId  =  $this->session->userdata('user_id');

		$results['tel'] = $this->Clients_achat_model->getOrderTelecharger($uId);

			if($results > 0){

					$this->load->view('templates/client_header.php');
					$this->load->view('client/dashbd_client/cl_download',$results);
					$this->load->view('templates/client_footer.php');
			} else {

        setFlashData("alert-danger","Il n'y a pas des fichiers pour télécharger","Client_Dashbd");
				

			}

	} else {

		redirect('home');
	}
	
}

public function force_download()
{

	if(isset($_POST['file_name'])){
    $file = $_POST['file_name'];
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'.$file.'"');
    readfile('mystery_folder/'.$file);
    exit();
	}

}

public function pdfdetails($txId)
 {

		$html_content = '<a href="'.base_url().'Client_Achat/getClientOrders">Retour</a>';	
		$html_content .= '<h1 align="center">Facture - EasyFile Management</h1>';
		$html_content .= '<h3 align="right">'.$this->session->userdata('fullname').'</h3>';
		$html_content .= $this->Clients_achat_model->fetch_invoice_details($txId);
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$txId.".pdf", array("Attachment"=>1));
		
 }



}//END