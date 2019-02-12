<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Achat extends CI_Controller {

  


	public function payment()
	{
			if(isset($_SESSION['login']) == TRUE ){

				// Parsing PayPal transaction url information
			$url =  parse_url($_SERVER['REQUEST_URI']);
			parse_str($url['query'], $params);

			$txId    =  $params['tx'];
			$status  =  $params['st'];
			$raw_amt =  $params['amt'];

			//clean the amount
			$amt     =  preg_replace('~\.0+$~','', $raw_amt);

			// Keeping transaction details in sessions
			$this->session->set_userdata('tx_id', $txId);
			$this->session->set_userdata('tx_amt', $amt);
			$this->session->set_userdata('tx_st', $status);

			//Create paypal token id
			$payPal  = "1Fgd9rRC3FrIBHeogws9qmnpOaePyGf_OZUHOoZy16qd2HGdlGyDQNjMvAO";
				
			$data['paymentData']   = array(

				'tx'     =>  $txId,
				'st'     =>  $status,
				'amt'    =>  $amt,
				'token'  =>  $payPal

			);

			$this->load->view('templates/client_header.php');
			$this->load->view('Client/dashbd_client/cl_payment', $data);
			$this->load->view('templates/client_footer.php');

		} else {

			redirect('home');

		}
	}

	public function paymentsuccess()
	{

		if(isset($_SESSION['login']) == TRUE ){

			$txId         =  $this->session->userdata('tx_id');
			$status       =  $this->session->userdata('tx_st');
			$raw_amt      =  $this->session->userdata('tx_amt');
			$amt          =  $raw_amt;
			$email        =  $this->session->userdata('email');
			$uId          =  $this->session->userdata('user_id');
			
			//get all products from cart

			$dataCart = $this->Clients_panier_model->viewCart($uId);
			foreach($dataCart as $cart){

				$data = array (

					'customer_id'    => $uId,
					'product_id'     => $cart->product_id,
					'product_name'   => $cart->product_name,
					'product_file'   => $cart->product_file,
					'product_price'  => $cart->product_price,
					'customer_email' => $email,
					'tx_id'          => $txId,
					'amt'            => $amt,
					'status'         => 'TERMINER'
	
				);

				$this->Clients_achat_model->insertOrder($data);

			}

		
				// Delete saved orders from cart table
				$this->Clients_achat_model->deleteSavedOrder($uId);


				//Email users the transaction id and ask them to keep for reference

			$subject   =  "Payment réçu | EasyFiles";

			$userName  = $this->session->userdata('fullname');

			$message   =  "Cher ". $userName. ",\r\nNous vous remercions pour votre achat.\r\n Les fichiers vous attend dans votre espace client pour être télécharger.\n\nVoici le numéro de votre transaction: ". $txId . "\r\nMerci\r\nCordialement,\r\nEasyFiles Support Team \r\ninfo@easyfiles.com";

			// Load library and pass in the config
			$this->load->library('email');
			$this->email->set_newline("\r\n");

			$supportEmail  =  "payment@easyfiles.com";
			$supportName   =  "Le support achats EasyFiles";
			$email         =  $this->session->userdata('email');
			
			$this->email->from($supportEmail, $supportName);
			$this->email->to($email);

			$this->email->subject($subject);
			$this->email->message($message);
		
			$this->email->send();

			unset($_SESSION['tx_id']);
			unset($_SESSION['tx_amt']);
			unset($_SESSION['tx_st']);

				$this->load->view('templates/client_header.php');
				$this->load->view('client/dashbd_client/cl_paymentsuccess');
				$this->load->view('templates/client_footer.php');
	
			
	} else {

		redirect('home');

	}

}



public function getClientOrders()
{
		$uId  =  $this->session->userdata('user_id');

		$results['billing'] = $this->Clients_achat_model->getOrderDetails($uId);

			if($results > 0){

				$this->load->view('templates/client_header.php');
				$this->load->view('client/dashbd_client/cl_achat',$results);
				$this->load->view('templates/client_footer.php');

			} else {

				$error = "Pas de commandes pour l\'instant";
				$this->session->set_flashdata('error', $error);
				redirect('Client_Achat');

		}
	
}
public function clientInvoiceHtml($txId) 
{

	$data['invoices'] = $this->Clients_achat_model->getInvoiceDetails($txId);

	$this->load->view('templates/client_header.php');
	$this->load->view('client/dashbd_client/cl_achat_details',$data);
	$this->load->view('templates/client_footer.php');
}

public function pdfdetails($txId)
 {

		$previous = "javascript:history.go(-1)";
			if(isset($_SERVER['HTTP_REFERER'])) {
			$previous = $_SERVER['HTTP_REFERER'];
			}
		$html_content = '<a href="'.$previous.'">Retour</a>';		
		$html_content .= '<h1 align="center">Facture - EasyFile Management</h1>';
		$html_content .= '<h3 align="right">'.$this->session->userdata('fullname').'</h3>';
		$html_content .= $this->Clients_achat_model->fetch_invoice_details($txId);
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$txId.".pdf", array("Attachment"=>0));
		
 }

}//END