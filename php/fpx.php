<?php
// Defines
define('ROOT_DIR', dirname(__DIR__, 1));

class FPX
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

	public function get_bank_list($post)
	{
		$mode = $post['mode'];
		$env = $post['env'];
		$cache = $this->config['cache'];

		$file = ROOT_DIR.'/fpx/'. $mode. '-'. $env. '.json';
		$be_file = ROOT_DIR.'/fpx/be_message.json';
		$current_time = time();
		$expire_time = $cache * 60;

		if(file_exists($file) && $current_time - $expire_time < filemtime($file)) {
			$bank_list = json_decode(file_get_contents($file),true);
			$be_message = json_decode(file_get_contents($be_file),true);
		} else {

			if($this->config['fpx']['environment'] == 'Production')
				$url = "https://www.mepsfpx.com.my/FPXMain/RetrieveBankList";
			else
				$url = "https://uat.mepsfpx.com.my/FPXMain/RetrieveBankList";

			$data = $this->get_checksum($mode);
			$content = $this->get_response($url, $data);
			$token = strtok($content, "&");

			while ($token !== false) {
				list($key, $value) = explode("=", $token);
				$value = urldecode($value);
				$response_value[$key] = $value;
				$token = strtok("&");
			}
			
			// temporary to get BC message. Plese remove once in production
			$bc_file = ROOT_DIR.'/fpx/bc_message.txt';
			file_put_contents($bc_file, $content);

			$fpx_msgToken = reset($response_value);

			$token = strtok($response_value['fpx_bankList'], ",");

			while ($token !== false) {
				list($key, $value) = explode("~", $token);
				$value = urldecode($value);
				$bank_list[$key] = $value;
				$token = strtok(",");
			}

			$be_message = $response_value['fpx_bankList']."|".$fpx_msgToken."|".$response_value['fpx_msgType']."|".$response_value['fpx_sellerExId'];

			if ($mode == '01'){
				$cimb = 'CIMB Clicks';
			} else {
				$cimb = 'CIMB Bank';
			}

			$bank_name = [
				'TEST0021' => 'SBI Bank A',
				'TEST0022' => 'SBI Bank B',
				'TEST0023' => 'SBI Bank C',
				'ABB0234' => 'Affin B2C - Test ID',
				'ABB0233' => 'Affin Bank',
				'ABB0232' => 'Affin Bank',
				'ABB0235' => 'AFFINMAX',
				'ABMB0212' => 'Alliance Bank (Personal)',
				'ABMB0213' => 'Alliance Bank (Business)',
				'AGRO01' => 'AGRONet',
				'AGRO02' => 'AGRONetBiz',
				'AMBB0208' => 'AmBank',
				'AMBB0209' => 'AmBank',
				'BIMB0340' => 'Bank Islam',
				'BKRM0602' => 'Bank Rakyat',
				'BKRM0602' => 'i-bizRAKYAT',
				'BMMB0341' => 'Bank Muamalat',
				'BMMB0342' => 'Bank Muamalat',
				'BNP003' => 'BNP Paribas',
				'BSN0601' => 'BSN',
				'BCBB0235' => $cimb,
				'CIT0218' => 'Citibank Corporate Banking',
				'CIT0219' => 'Citibank',
				'DBB0199' => 'Deutsche Bank',
				'HLB0224' => 'Hong Leong Bank',
				'HSBC0223' => 'HSBC Bank',
				'KFH0346' => 'KFH',
				'MB2U0227' => 'Maybank2U',
				'MBB0228' => 'Maybank2E',
				'OCBC0229' => 'OCBC Bank',
				'PBB0233' => 'Public Bank',
				'PBB0234' => 'PB Enterprise',
				'RHB0218' => 'RHB Bank',
				'SCB0215' => 'Standard Chartered',
				'SCB0216' => 'Standard Chartered',
				'UOB0226' => 'UOB Bank',
				'UOB0228' => 'UOB Regional',
				'UOB0229' => 'UOB Bank - Test ID',
			];

			foreach ($bank_list as $key => $value) {
				if ($value == 'B') $value = ' (Offline)'; else $value = '';
				if(isset($bank_name[$key])) 
					$bank_list[$key] = $bank_name[$key].$value;
				else
					$bank_list[$key] = $key.$value;
			}

			natcasesort($bank_list);

			# store bank list for drop down select
			file_put_contents($file, json_encode($bank_list));

			#store bank list for BE message
			file_put_contents($be_file, json_encode($be_message));
		}
		
		$content = array();
		$content['bank_list'] = $bank_list;
		$content['be_message'] = $be_message;

		return $content;
	}

	private function get_checksum($mode)
	{
		$msgToken = $mode;
		$msgType = 'BE';
		$sellerExId = $this->config['fpx']['exchange-id'];
		$version = '6.0';

		$out = $msgToken.'|'.$msgType.'|'.$sellerExId.'|'.$version;
		$key_location = ROOT_DIR.'/fpx/'.$this->config['fpx']['environment'].'/'.$sellerExId.'/'.$sellerExId.'.key';
		
		try{
			$priv_key = file_get_contents($key_location);
			$pkeyid = openssl_get_privatekey($priv_key);
			openssl_sign($out, $binary_signature, $pkeyid, OPENSSL_ALGO_SHA1);
			$checkSum = strtoupper(bin2hex( $binary_signature ));

			$data = array(
				"fpx_msgType" => $msgType,
				"fpx_msgToken" => $msgToken,
				"fpx_sellerExId" => $sellerExId,
				"fpx_version" => $version,
				"fpx_checkSum" => $checkSum
			);

			return $data;
		}
		catch (Exception $e) {
    		return $e->getMessage(); 
		}
	}

	private function get_response($url, $param)
	{
		try {
			$data = http_build_query($param);

			$opts = array(
			  'http' => array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $data
			  ),
			  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			  )
			);

			$context  = stream_context_create($opts);
			$result = file_get_contents($url, false, $context);

			return $result;
		}
		catch(Exception $e) {
			return $e->getMessage(); 
		}
	}

}
