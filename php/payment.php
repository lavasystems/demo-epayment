<?php
require ('stringer.php');

class Payment
{
    private $config;

    public function __construct()
    {
        // read config.json
        $config_filename = ROOT_DIR.'/config.json';

        if (!file_exists($config_filename)) {
            throw new Exception("Can't find ".$config_filename);
        }
        $this->config = json_decode(file_get_contents($config_filename), true);
    }

    # process online payment
    public function process($data)
    {
        if(isset($data)){

            $transaction_id = date('Ymdhis');

            $payment_data = array(
                'transaction_id' => $transaction_id,
                'amount' => $data['amount'],
                'payment_date' => date('Y-m-d'),
                'payment_time' => date('H:i:s'),
                'payment_type' => $data['payment_type'],
                'payment_mode' => $data['payment_mode'],
                'kod' => $data['kod'],
                'remarks' => '',
                'status' => 'processing'
            );

            //$this->model->addPayment($payment_data);
            $encrypt = new StringerController();

            $checksum_data = [
                'TRANS_ID' => $transaction_id,
                'PAYMENT_MODE' => $data['payment_mode'],
                'AMOUNT' => $data['amount'],
                'MERCHANT_CODE' => $this->config['fpx']['merchant-code']
            ];

            $checksum = $encrypt->getChecksum($checksum_data);

            $fpx_data = array(
                'TRANS_ID' => $transaction_id,
                'AMOUNT' => $data['amount'],
                'PAYEE_NAME' => $data['payee_name'],
                'PAYEE_EMAIL' => $data['payee_email'],
                'EMAIL' => $data['payee_email'],
                'payment_type' => $data['payment_type'],
                'PAYMENT_MODE' => $data['payment_mode'],
                'KOD' => $data['kod'],
                'BANK_CODE' => $data['bank_code'],
                'BE_MESSAGE' => $data['be_message'],
                'MERCHANT_CODE' => $this->config['fpx']['merchant-code'],
                'CHECKSUM' => $checksum
            );

            # pass to FPX controller
            echo "<form id=\"myForm\" action=\"".$this->config['fpx']['url']."\" method=\"post\">";
            foreach ($fpx_data as $a => $b) {
                echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
            }
            echo "</form>";
            echo "<script type=\"text/javascript\">
                document.getElementById('myForm').submit();
            </script>";

        } else {

            // error
        }
    }
}