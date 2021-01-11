<?php
define('ROOT_DIR', dirname(__DIR__, 1));

class StringerController
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

	public function getChecksum($data)
	{
		$data = [
	        'TRANS_ID' => $data['TRANS_ID'],
	        'MERCHANT_CODE' => $data['MERCHANT_CODE'],
	        'PAYMENT_MODE' => $data['PAYMENT_MODE'],
	        'AMOUNT' => $data['AMOUNT']
	    ];

	    $header = null;

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config['stringer']['url']);
        if (!is_null($header)) {
	        curl_setopt($ch, CURLOPT_HEADER, true);
	    }
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        $body = null;
	    // error
	    if (!$response) {
	        $body = curl_error($ch);
	        // HostNotFound, No route to Host, etc  Network related error
	        $http_status = -1;
	        Log::error("CURL Error: = " . $body);
	    } else {
	       //parsing http status code
	        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	        if (!is_null($header)) {
	            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

	            $header = substr($response, 0, $header_size);
	            $body = substr($response, $header_size);
	        } else {
	            $body = $response;
	        }
	    }

	    curl_close($ch);

	    return $body;
	}
}
