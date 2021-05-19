<?php
$config_filename = 'config.json';

if (!file_exists($config_filename)) {
    throw new Exception("Can't find ".$config_filename);
}

$config = json_decode(file_get_contents($config_filename), true);

$id = filter_var($_REQUEST['id'], FILTER_SANITIZE_STRING);

switch ($id) {

    case 'confirm-payment':
 
        if (isset($_POST['email']) && $_POST['email']) {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        } else {
            header('location: index.php');
            exit;
        }

        $data = $_POST;

        echo "<form id='autosubmit' action='confirm.php' method='post'>";
        if (is_array($data) || is_object($data))
        {
            foreach ($data as $key => $val) {
                echo "<input type='hidden' name='".$key."' value='".filter_var($val, FILTER_SANITIZE_STRING)."'>";
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

        require_once('php/payment.php');
        $payment = new Payment();

        $data = $_POST;

        return $payment->response($data);
		
	break;
}
