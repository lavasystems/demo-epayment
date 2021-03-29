<?php
require ('stringer.php');

class Payment
{
    private $config;

    public function __construct()
    {
        $config_filename = ROOT_DIR.'/config.json';

        if (!file_exists($config_filename)) {
            throw new Exception("Can't find ".$config_filename);
        }
        $this->config = json_decode(file_get_contents($config_filename), true);
    }

    # process online payment
    public function process($data)
    {
        require ('conn.php');

        if(isset($data)){

            if($this->config['fpx']['environment'] == 'Staging'){
                $merchant_code = '001000STG';
            } else {
                $merchant_code = $data['agency'];
            }

            $transaction_data = array(
                'service_id' => $data['service'],
                'amount' => $data['amount'],
                'payment_method' => 'FPX',
                'payment_mode' => 'fpx',
                'status' => '2',
                'payment_id' => '0'
            );

            $transaction_extra = array(
                'nama' => $data['nama'],
                'nric' => $data['nric'],
                'telefon' => $data['telefon'],
                'email' => $data['email'],
                'nama_agensi' => $data['nama_agensi'],
                'jenis_pembayaran' => $data['jenis_pembayaran'],
                'alamat' => $data['alamat'],
                'cukai' => $data['cukai'],
                'catatan' => $data['catatan'],
                'agency_email' => $data['agency_email']
            );

            $transaction_query = $pdo->prepare("INSERT INTO transactions (service_id, amount, payment_method, payment_mode, status, payment_id) VALUES (:service_id, :amount, :payment_method, :payment_mode, :status, :payment_id)");
            $transaction_query->bindValue(":service_id", $transaction_data['service_id'], PDO::PARAM_STR);
            $transaction_query->bindValue(":amount", $transaction_data['amount'], PDO::PARAM_STR);
            $transaction_query->bindValue(":payment_method", $transaction_data['payment_method'], PDO::PARAM_STR);
            $transaction_query->bindValue(":payment_mode", $transaction_data['payment_mode'], PDO::PARAM_STR);
            $transaction_query->bindValue(":status", $transaction_data['status'], PDO::PARAM_STR);
            $transaction_query->bindValue(":payment_id", $transaction_data['payment_id'], PDO::PARAM_STR);
            $transaction_query->execute();

            $transaction_id = $pdo->lastInsertId();
            
            foreach ($transaction_extra as $key => $value) {
                $test = $pdo->prepare("INSERT INTO transaction_details (`transaction_id`, `key`, `value`) VALUES (:transaction_id, :key, :value)");
                $test->bindValue(":transaction_id", $transaction_id);
                $test->bindParam(":key", $key);
                $test->bindParam(":value", $value);
                $test->execute();
            }

            $encrypt = new StringerController();

            $checksum_data = [
                'TRANS_ID' => $data['TRANS_ID'].'-'.$transaction_id,
                'PAYMENT_MODE' => $transaction_data['payment_mode'],
                'AMOUNT' => $transaction_data['amount'],
                'MERCHANT_CODE' => $merchant_code
            ];

            $checksum = $encrypt->getChecksum($checksum_data);

            $fpx_data = array(
                'TRANS_ID' => $data['TRANS_ID'].'-'.$transaction_id,
                'AMOUNT' => $transaction_data['amount'],
                'PAYEE_NAME' => $transaction_extra['nama'],
                'PAYEE_EMAIL' => $transaction_extra['email'],
                'EMAIL' => $transaction_extra['email'],
                'PAYMENT_MODE' => $transaction_data['payment_mode'],
                'BANK_CODE' => $data['bank_code'],
                'BE_MESSAGE' => $data['be_message'],
                'MERCHANT_CODE' => $merchant_code,
                'CHECKSUM' => $checksum,
                'nama' => $data['nama'],
                'nric' => $data['nric'],
                'telefon' => $data['telefon'],
                'kod_agensi' => $data['agency'],
                'nama_agensi' => $data['nama_agensi'],
                'jenis_pembayaran' => $data['jenis_pembayaran'],
                'alamat' => $data['alamat'],
                'cukai' => $data['cukai'],
                'catatan' => $data['catatan'],
                'agency_email' => $data['agency_email']
            );

            # pass to FPX controller
            echo "<form id=\"myForm\" action=\"".$this->config['fpx']['url']."\" method=\"post\">";
            foreach ($fpx_data as $a => $b) {
                echo '<input type="hidden" name="'.htmlentities($a).'" value="'.filter_var($b, FILTER_SANITIZE_STRING).'">';
            }
            echo "</form>";
            echo "<script type=\"text/javascript\">
                document.getElementById('myForm').submit();
            </script>";

        } else {

            // error
        }
    }

    public function response()
    {
        require ('conn.php');
        
        $input = $_POST;

        $fpx_data = [
            'status' => $_POST['STATUS'],
            'status_code' => $_POST['STATUS_CODE'],
            'status_message' => $_POST['STATUS_MESSAGE'],
            'payment_datetime' => $_POST['PAYMENT_DATETIME'],
            'payment_mode' => $_POST['PAYMENT_MODE'],
            'amount' => $_POST['AMOUNT'],
            'payment_transaction_id' => $_POST['PAYMENT_TRANS_ID'],
            'buyer_bank' => $_POST['BUYER_BANK'],
            'merchant_order_no' => $_POST['MERCHANT_ORDER_NO'],
            'payment_transaction_id' => $_POST['APPROVAL_CODE'],
            'trans_id' => $_POST['TRANS_ID'],
            'approval_code' => $_POST['APPROVAL_CODE'],
            'buyer_bank' => $_POST['BUYER_BANK'],
            'buyer_name' => $_POST['BUYER_NAME']
        ];

        $payment = $pdo->prepare("INSERT INTO payments (amount, status_code, status_message, payment_transaction_id, payment_datetime, buyer_name, buyer_bank, merchant_order_no) VALUES (:amount, :status_code, :status_message, :payment_transaction_id, :payment_datetime, :buyer_name, :buyer_bank, :merchant_order_no)");
        $payment->bindValue(":amount", $fpx_data['amount']);
        $payment->bindValue(":status_code", $fpx_data['status_code']);
        $payment->bindValue(":status_message", $fpx_data['status_message']);
        $payment->bindValue(":payment_transaction_id", $fpx_data['payment_transaction_id']);
        $payment->bindValue(":payment_datetime", $fpx_data['payment_datetime']);
        $payment->bindValue(":buyer_name", $fpx_data['buyer_name']);
        $payment->bindValue(":buyer_bank", $fpx_data['buyer_bank']);
        $payment->bindValue(":merchant_order_no", $fpx_data['merchant_order_no']);
        $payment->execute();
        $payment_id = $payment->lastInsertId();

        // update transaction table
        $transaction = $pdo->prepare("UPDATE transactions SET status = :status, receipt_no = :receipt_no, payment_id = :payment_id");
        $transaction->bindValue(":status", $_POST['STATUS']);
        $transaction->bindParam(":receipt_no", isset($_POST['RECEIPT_NO']) ? $_POST['RECEIPT_NO'] : '');
        $transaction->bindParam(":payment_id", isset($payment_id) ? $payment_id : '');
        $transaction->execute();

        // redirect to receipt page
        echo "<form id=\"receipt\" action=\"receipt.php\" method=\"post\">";
        foreach ($input as $a => $b) {
            echo '<input type="hidden" name="'.htmlentities($a).'" value="'.filter_var($b, FILTER_SANITIZE_STRING).'">';
        }
        echo '<input type="hidden" name="payload" value="'.base64_encode('eb4yAr').'">';
        echo "</form>";
        echo "<script type=\"text/javascript\">
            document.getElementById('receipt').submit();
        </script>";
    }
}