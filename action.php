<?php
$id = $_REQUEST['id'];

switch ($id) {
	case 'process-payment':
	
		require_once('php/payment.php');
		$payment = new Payment();

		$data = [
            'amount' => $_POST['amount'],
            'payee_name' => $_POST['nama'],
            'payee_email' => $_POST['email'],
            'payment_type' => $_POST['payment_type'],
            'kod' => $_POST['kod'],
            'payment_mode' => $_POST['payment_mode'],
            'bank_code' => $_POST['bank_code'],
            'be_message' => $_POST['be_message']
		];

		return $payment->process($data);
		
	break;

	case 'response':
	
		$data = $_POST;

		echo "<form id='autosubmit' action='receipt.php' method='post'>";
        if (is_array($data) || is_object($data))
        {
            foreach ($data as $key => $val) {
                echo "<input type='hidden' name='".$key."' value='".htmlspecialchars($val)."'>";
            }
        }
        echo "</form>";
        echo "
        <script type='text/javascript'>
            function submitForm() {
                document.getElementById('autosubmit').submit();
            }
            window.onload = submitForm;
        </script>";
		
	break;

	case 'fpx-request':



	break;
	
	default:
		# code...
		break;
}