<?php
$id = $_REQUEST['id'];

switch ($id) {
	case 'process-payment':

		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		require_once('php/payment.php');
		$payment = new Payment();

		$data = [
            'amount' => $_POST['amount'],
            'payee_name' => $_POST['name'],
            'payee_email' => $_POST['email'],
            'payment_type' => $_POST['payment_method'],
            'payment_mode' => $_POST['payment_mode'],
            'bank_code' => $_POST['bank_code'],
            'be_message' => $_POST['be_message']
		];

		return $payment->process($data);
		
	break;

	case 'fpx-request':

		

	break;
	
	default:
		# code...
		break;
}