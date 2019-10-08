<?php
namespace App;

use Exception;
use \phpseclib\Crypt\RSA;

class Verifier
{
	function verify($callbackRequest)
	{
		//use next line if conversion to json object returns null and json_last_error_msg() returns the error "Control character error, possibly incorrectly encoded"
		$callbackRequest = preg_replace('/[[:cntrl:]]/', '', $callbackRequest);

		$jsonObj = json_decode($callbackRequest, true);
		$data = $jsonObj["TransactionTime"]
			.$jsonObj["TransactionID"]
			.$jsonObj["TransactionAmount"]
			.$jsonObj["AccountReference"]
			.$jsonObj["SenderMSISDN"]
			.$jsonObj["BusinessShortcode"];

		$rsa = new RSA();
		$rsa->loadKey($jsonObj["PublicKey"]);
		$rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);
		$signatureBinary = base64_decode($jsonObj["Signature"]);

		if($signatureBinary === FALSE)
		{
			throw new Exception("Invalid Signature");
		}

		$verified = $rsa->verify($data, $signatureBinary);
		return $verified;
	}
}
