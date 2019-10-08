<?php

use App\Verifier;

require './vendor/autoload.php';

//sample B2C callback
$callbackRequest = "{\"ResultCode\":\"0\",
\"ResultDesc\":\"The service request is processed successfully.\",
\"RequestID\":\"5057242165947576\",
\"MpesaRequestID\":\"AG_20191008_00007e2510a9a3639b00\",
\"MpesaTransactionID\":\"NJ81HBNKJV\",
\"ReferenceData\":[],
\"ResultData\":
	{\"TransactionAmount\":10,
	\"ReceiverPartyName\":\"254796778039 - Peter Test\",
	\"IsReceiverRegistered\":\"Y\",
	\"UtilityAccBalance\":1004326077.29,
	\"WorkingAccBalance\":299183729,
	\"TransactionCompleteTime\":\"08.10.2019 09:52:32\",
	\"Signature\":\"hqRWjWRJPCqlqG3FuEj+y8k0Guse4ZSIIYSIYduMDH8eMZJtU2ZqVzezjiPhLCjsJzVvaKrPiJNn2irmeWuxrCroehXowD5RpjcuqpJZ1qJxKXdVtZ90Np4ICqTwMHUM\/8NbCXmFU\/Gz5UddFhAtQkaNHzY9pZiLCPbcHv4n500=\",
	\"PublicKey\":\"-----BEGIN RSA PUBLIC KEY-----\r\nMIGJAoGBAMJZZLoxxGE\/lQgXnUA59L9d35IIveKd8W0peiJbJxTpnk0RufFfgnIP\r\nx5GWVCJvcy2C4x6Bak21J9jEc5eaEcvGTf8SMPcf0qc3dtbTtbGxV7BW\/vhZimbP\r\nLI9+yxFszym3+A4zd0uOfr37juwRedtr6UufuTwbZzFheC9eEVYpAgMBAAE=\r\n-----END RSA PUBLIC KEY-----\"}
}";

//use next line if conversion to json object returns null and json_last_error_msg() returns the error "Control character error, possibly incorrectly encoded"
$callbackRequest = preg_replace('/[[:cntrl:]]/', '', $callbackRequest);

$jsonObj = json_decode($callbackRequest, true);
$data = $jsonObj["MpesaRequestID"]
	.$jsonObj["MpesaTransactionID"]
	.$jsonObj["ResultData"]["TransactionAmount"]
	.$jsonObj["ResultData"]["ReceiverPartyName"]
	.$jsonObj["ResultData"]["UtilityAccBalance"]
	.$jsonObj["ResultData"]["WorkingAccBalance"]
	.$jsonObj["ResultData"]["TransactionCompleteTime"];

$dec = new Verifier();
$verified = $dec->verify(
	$jsonObj["ResultData"]["PublicKey"],
	$data,
	$jsonObj["ResultData"]["Signature"]);

echo "Verified: ".($verified == true ? "True" : "False");
