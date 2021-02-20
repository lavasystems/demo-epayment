<?php
/*
*  Title: String Encryptor Helper
*  Version: 1.0 from 3 August 2017
*  Author: Fadli Saad
*  Website: https://fadli.my
*/
class StringEncrypter
{
	const STRENCRYPTER_BLOCK_SIZE = 16;

	private $key;
	private $initialVector;

	function __construct ($key, $initialVector) {
		if (!is_string ($key) or $key == "")
			throw new Exception ("The key must be a non-empty string.");

		if (!is_string ($initialVector) or $initialVector == "")
			throw new Exception ("The initial vector must be a non-empty string.");

		$this->key = md5 ($key, TRUE);
		$this->initialVector = md5 ($initialVector, TRUE);
	}

	public function encrypt ($value) {
		if (is_null ($value))
			$value = "";

		if (!is_string ($value))
			throw new Exception ("A non-string value can not be encrypted.");

		$value = self::toPkcs7 ($value);
		$output = mcrypt_encrypt (MCRYPT_RIJNDAEL_128, $this->key, $value, MCRYPT_MODE_CBC, $this->initialVector);

		return base64_encode ($output);
	}

	public function decrypt ($value) {
		if (!is_string ($value) or $value == "")
			throw new Exception ("The cipher string must be a non-empty string.");

		$value = base64_decode ($value);
		$output = mcrypt_decrypt (MCRYPT_RIJNDAEL_128, $this->key, $value, MCRYPT_MODE_CBC, $this->initialVector);

		return self::fromPkcs7 ($output);
	}

	private static function toPkcs7 ($value) {
		if (is_null ($value))
			$value = "";

		if (!is_string ($value))
			throw new Exception ("A non-string value can not be used to pad.");

		$padSize = self::STRENCRYPTER_BLOCK_SIZE - (strlen ($value) % self::STRENCRYPTER_BLOCK_SIZE);

		return $value .str_repeat (chr ($padSize), $padSize);
	}

	private static function fromPkcs7 ($value) {
		if (!is_string ($value) or $value == "")
			throw new Exception ("The string padded by PKCS7 must be a non-empty string.");

		$valueLen = strlen ($value);

		if ($valueLen % self::STRENCRYPTER_BLOCK_SIZE > 0)
			throw new Exception ("The length of the string is not a multiple of block size.");

		$padSize = ord ($value{$valueLen - 1});

		if (($padSize < 1) or ($padSize > self::STRENCRYPTER_BLOCK_SIZE))
			throw new Exception ("The padding size must be a number greater than 0 and less equal than the block size.");

		for ($i = 0; $i < $padSize; $i++) {
			if (ord ($value{$valueLen - $i - 1}) != $padSize)
				throw new Exception ("A padded value is not valid.");
		}

		return substr ($value, 0, $valueLen - $padSize);
	}
}