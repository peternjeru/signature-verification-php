<?php
namespace App;

use \phpseclib\Crypt\RSA;

class Verifier
{
	function verify($callbackRequest)
	{
		//use if conversion to json object throws the error "Control character error, possibly incorrectly encoded"
		$callbackRequest = preg_replace('/[[:cntrl:]]/', '', $callbackRequest);

		$jsonObj = json_decode($callbackRequest, true);
		$rsaPk = $jsonObj["PublicKey"];

		//see how it looks like in PHP
		echo "<pre>";
		var_dump($rsaPk);
		echo "</pre>";

		$data = $jsonObj["TransactionID"]
			.$jsonObj["TransactionAmount"]
			.$jsonObj["AccountReference"]
			.$jsonObj["SenderMSISDN"]
			.$jsonObj["BusinessShortcode"];

		$signature = $jsonObj["Signature"];

		$rsa = new RSA();
		$rsa->loadKey($rsaPk);
		$rsa->setSignatureMode(RSA::SIGNATURE_PKCS1);
		$verified = $rsa->verify($data, hex2bin($signature));

		echo "Verified: ".($verified == true ? "True" : "False");
		return $verified;
	}
}
