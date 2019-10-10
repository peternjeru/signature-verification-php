<?php

use App\Verifier;

require './vendor/autoload.php';

//sample B2C callback
$callbackRequest = "{\"ResultCode\":\"0\",
\"ResultDesc\":\"The service request is processed successfully.\",
\"RequestID\":\"3113319730816318\",
\"MpesaRequestID\":\"AG_20191010_00004342ca57f86f0572\",
\"MpesaTransactionID\":\"NJA6HBNZP0\",
\"ReferenceData\":[],
\"ResultData\":{
	\"TransactionAmount\":10,
	\"ReceiverPartyName\":\"254796778039 - Peter Test\",
	\"IsReceiverRegistered\":\"Y\",
	\"UtilityAccBalance\":1004321692.29,
	\"WorkingAccBalance\":299178669,
	\"TransactionCompleteTime\":\"10.10.2019 09:29:09\",
	\"Signature\":\"HA3DsXbWYdl7WnBURDyPxxNlrP73Jc1ai+44GIzs0kPLkmke75Zlp4K+9KPffMpykSpqhs686SMURhUgwkrOpm51D8airZQ3VzXwgPYe3y53gTgFxNknORhXgAf9yUeMJx5pwsy1Sak0WYh09ShhiqVJ\/0KqAeaWXEUO\/MGMkfY=\",
	\"PublicKey\":\"-----BEGIN RSA PUBLIC KEY-----\r\nMIGJAoGBANaKQyGjaID9xw8NtxbLolXfInrzDZ5DLPlW7hW54p051FKskKo94AZs\r\n+m\/ARuR3x0aLb7awJIeuY1yJLeb6cwLg+P5mgbQxKdFQnwwuHNZtKpPxZ0KDLnRg\r\n3lSvuDpCr1zoA8XZaHVZwDq9FMvh6eMchRYD7qfMK9jSQY+jT1bBAgMBAAE=\r\n-----END RSA PUBLIC KEY-----\"}
}";

//use next line if conversion to json object returns null and json_last_error_msg() returns the error "Control character error, possibly incorrectly encoded"
$callbackRequest = preg_replace('/[[:cntrl:]]/', '', $callbackRequest);

$jsonObj = json_decode($callbackRequest, true);
$data = $jsonObj["RequestID"]
	.$jsonObj["MpesaRequestID"]
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
