<?php
namespace App;

use Exception;
use \phpseclib\Crypt\RSA;

class Verifier
{
	function verify($keyString, $data, $signature)
	{
		$rsa = new RSA();
		$rsa->loadKey($keyString);
		$rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);
		$signatureBase64 = base64_decode($signature);

		if($signatureBase64 === FALSE)
		{
			throw new Exception("Invalid Signature");
		}

		$verified = $rsa->verify($data, $signatureBase64);
		return $verified;
	}
}
