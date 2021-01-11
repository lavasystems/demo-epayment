<?php
require ('stringer.php');
define('ROOT_DIR', dirname(__DIR__, 1));

class Payment
{
    private $config;

    public function __construct()
    {
        // read config.json
        $config_filename = 'config.json';

        if (!file_exists($config_filename)) {
            throw new Exception("Can't find ".$config_filename);
        }
        $this->config = json_decode(file_get_contents($config_filename), true);
    }

    # process online payment
    public function process($data)
    {
        if(isset($data)){

            $transaction_id = $payment_type.date('Ymdhis');

            $payment_data = array(
                'transaction_id' => $transaction_id,
                'amount' => $data['amount'],
                'payment_date' => date('Y-m-d'),
                'payment_time' => date('H:i:s'),
                'payment_type' => $data['payment_type'],
                'payment_mode' => $data['payment_mode'],
                'remarks' => '',
                'status' => 'processing'
            );

            //$this->model->addPayment($payment_data);

            $fpx_data = array(
                'transaction_id' => $transaction_id,
                'amount' => $data['amount'],
                'payee_name' => $data['name'],
                'payee_email' => $data['email'],
                'payment_type' => $data['payment_type'],
                'payment_mode' => $data['payment_mode'],
                'bank_code' => $data['BANK_CODE'],
                'be_message' => $data['BE_MESSAGE']
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

    public function paymentResponse(Request $request)
    {
        if (empty($request)) {
            return $this->sendError('No return response received from payment gateway');
        }

        $status = $request->get('STATUS');
        $order_id = $request->get('TRANS_ID');

        $order = $this->orderRepository->findWithoutFail($order_id);

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        # update order (and payment not failed)
        $this->updateOrder($order_id, $status);

        # update bill to db
        $fpx_data = [
            'status' => $request->get('STATUS'),
            'status_code' => $request->get('STATUS_CODE'),
            'status_message' => $request->get('STATUS_MESSAGE'),
            'order_id' => $request->get('TRANS_ID'),
            'transaction_id' => $request->get('TRANS_ID'),
            'payment_datetime' => $request->get('PAYMENT_DATETIME'),
            'payment_mode' => $request->get('PAYMENT_MODE'),
            'amount' => $request->get('AMOUNT'),
            'merchant_code' => $request->get('MERCHANT_CODE'),
            'payment_trans_id' => $request->get('PAYMENT_TRANS_ID')
        ];
        
        $this->PaynetRepository->where('order_id', $order_id)->update($fpx_data);

        switch ($status) {
            case '1': # payment success
                Notification::send($order->foodOrders[0]->food->restaurant->users, new NewOrder($order));
                $msg = 'success';
                break;

            case '0': # pending
                Notification::send($order->foodOrders[0]->food->restaurant->users, new NewOrder($order));
                $msg = 'pending';
                break;

            case '2': # failed
                $msg = 'failed';
                break;
            
            default: # unknown response
                return $this->sendError('Unknown return response status received');
                $msg = 'unknown';
                break;
        }

        return $this->sendResponse($fpx_data,$msg);
    }

    public static function render($fieldValues, $paymentUrl)
    {
        echo "<form id='autosubmit' action='".$paymentUrl."' method='post'>";
        if (is_array($fieldValues) || is_object($fieldValues))
        {
            foreach ($fieldValues as $key => $val) {
                echo "<input type='hidden' name='".ucfirst($key)."' value='".htmlspecialchars($val)."'>";
            }
        }
        echo "</form>";
        echo "
        <script type='text/javascript'>
            function submitForm() {
                //document.getElementById('autosubmit').submit();
            }
            window.onload = submitForm;
        </script>";
    }
}