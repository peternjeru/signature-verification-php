<?php
namespace App;

use \phpseclib\Crypt\RSA;

class Verifier
{
	function verify($callbackRequest)
	{
		//use next line if conversion to json object returns null and json_last_error_msg() returns the error "Control character error, possibly incorrectly encoded"
		$callbackRequest = preg_replace('/[[:cntrl:]]/', '', $callbackRequest);

		$jsonObj = json_decode($callbackRequest, true);
		$rsaPk = $jsonObj["PublicKey"];

		//see how it looks like in PHP
		echo "<pre>";
		var_dump($rsaPk);
		echo "</pre>";

		$data = $jsonObj["TransactionTime"]
			.$jsonObj["TransactionID"]
			.$jsonObj["TransactionAmount"]
			.$jsonObj["AccountReference"]
			.$jsonObj["SenderMSISDN"]
			.$jsonObj["BusinessShortcode"];

		$signature = $jsonObj["Signature"];

		$rsa = new RSA();
		$rsa->loadKey($rsaPk);
		$rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);
		$signatureBinary = base64_decode($signature);

		if($signatureBinary === FALSE)
		{
			throw new \Exception("Invalid Signature");
		}

		$verified = $rsa->verify($data, $signatureBinary);

		echo "Verified: ".($verified == true ? "True" : "False");
		return $verified;
	}
}
