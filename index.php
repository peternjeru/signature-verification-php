<?php

require './vendor/autoload.php';

$callbackRequest = "{\"TransactionType\":\"CustomerPayBillValidation\",
		\"TransactionTime\":\"20191004091557\",
		\"TransactionID\":\"NJ41HBN8ED\",
		\"TransactionAmount\":10,
		\"BusinessShortcode\":\"107050\",
		\"AccountReference\":\"acc_ref\",
		\"SenderMSISDN\":\"254796778039\",
		\"SenderFirstName\":\"Peter\",
		\"SenderMiddleName\":null,
		\"SenderLastName\":\"Test\",
		\"RemainingCredits\":19,
		\"Signature\":\"22c2b998166a2bb9423d69f18afd9fe028f2093f630b6d17ca2c4f0afab05b412af2dfd0beab9a99191e91373771b11f5ada5ca5cdd87078c373889f23db65ed20816cdd9885650f63d5c6d09968440aa9e9449981b73d16567c8ce2cb565aa62b40631f71d6a1bf385d6e5593d5d37622fd297613f20137d551c89ce6af7eef\",
		\"PublicKey\":\"-----BEGIN RSA PUBLIC KEY-----\r\nMIGJAoGBALiFSfWjLuXG\/yx92\/zqIDX5zvAs\/d6KEXiK6EPbbZ7CKw+w04qNJXoi\r\nR4azCVwuq0+94IIQh1udGz3Xyo2Bovso3nKcz+4\/Cq7DdRBk327fLgzOD47QL8no\r\nXj+MU2KmioAwRreINfxSR9ufUyz7ef1Zd\/jL66n6jBp2DfcoSe\/VAgMBAAE=\r\n-----END RSA PUBLIC KEY-----\"}";

$dec = new \App\Verifier();
$dec->verify($callbackRequest);
