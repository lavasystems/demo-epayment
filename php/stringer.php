<?php
/*
*  Title: String Encryptor Helper
*  Version: 1.0 from 3 August 2017
*  Author: Fadli Saad
*  Website: https://fadli.my
*/
class StringerController
{
	public function getChecksum($data)
	{
		$client = new Client();
		$result = $client->post(env('STRINGER_URL'), [
		    'form_params' => [
		        'TRANS_ID' => $data['TRANS_ID'],
		        'MERCHANT_CODE' => $data['MERCHANT_CODE'],
		        'PAYMENT_MODE' => $data['PAYMENT_MODE'],
		        'AMOUNT' => $data['AMOUNT']
		    ]
		]);

		return $result->getBody();
	}
}
