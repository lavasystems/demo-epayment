<?php
$id = $_REQUEST['id'];

switch ($id) {

    case 'confirm-payment':

        define("RECAPTCHA_V3_SECRET_KEY", '');
 
        if (isset($_POST['email']) && $_POST['email']) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        } else {
            header('location: bayar.php');
            exit;
        }
         
        $token = $_POST['token'];
        $action = $_POST['action'];
         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($response, true);
         
        if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {

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
        } else {
            // spam submission
            die('Go away you nasty bot!');
        }

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
