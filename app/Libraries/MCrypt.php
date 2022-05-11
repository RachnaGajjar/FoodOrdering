<?php

namespace App\Libraries;

class MCrypt
{
	private $iv = 'fedcba9876543210'; #Same as in JAVA
	private $key = '0123456789abcdef'; #Same as in JAVA


	function __construct() {
		error_reporting(E_ALL ^ E_DEPRECATED);
	}

	/* function encrypt($str) {

		//echo $str; exit;

		//$key = $this->hex2bin($key);
		$iv = $this->iv;

		$td = mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

		mcrypt_generic_init($td, $this->key, $iv);
		$encrypted = mcrypt_generic($td, $str);

		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		return bin2hex($encrypted);
	}

	function decrypt($code) {

		//$key = $this->hex2bin($key);
		$code = $this->hex2bin($code);
		$iv = $this->iv;

		$td = mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

		mcrypt_generic_init($td, $this->key, $iv);
		$decrypted = mdecrypt_generic($td, $code);

		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		return utf8_encode(trim($decrypted));
	} */


	function encrypt($str) {
        //$key = $this->hex2bin($key);
        $str = base64_encode($str);

        $iv = $this->iv;
        $encrypted = openssl_encrypt($str, 'AES-128-CBC', $this->key, OPENSSL_RAW_DATA, $iv);

        return bin2hex($encrypted);
    }

    function decrypt($code) {

        $iv = $this->iv;

        $decrypted= openssl_decrypt(hex2bin($code), 'AES-128-CBC', '0123456789abcdef', OPENSSL_RAW_DATA, 'fedcba9876543210');

        $decrypted = base64_decode(utf8_encode(trim($decrypted)));

        return utf8_encode(trim($decrypted));
    }


	protected function hex2bin($hexdata)
	{
		$bindata = '';

		for ($i = 0; $i < strlen($hexdata); $i += 2) {
			$bindata .= chr(hexdec(substr($hexdata, $i, 2)));
		}

		return $bindata;
	}
}
