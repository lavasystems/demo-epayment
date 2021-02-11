<?php
$id = $_REQUEST['id'];

switch ($id) {

    case 'confirm-payment':

        $data = $_POST;

        echo "<form id='autosubmit' action='confirm.php' method='post'>";
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

	case 'process-payment':
	
		require_once('php/payment.php');
		$payment = new Payment();

		$data = $_POST;

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

}