<?php

require './vendor/autoload.php';

$callbackRequest = "{\"TransactionType\":\"CustomerPayBillConfirmation\","
	."\"TransactionTime\":\"20191007081144\","
	."\"TransactionID\":\"NJ78HBNHAA\","
	."\"TransactionAmount\":10,"
	."\"BusinessShortcode\":\"107050\","
	."\"AccountReference\":\"acc_ref\","
	."\"SenderMSISDN\":\"254796778039\","
	."\"SenderFirstName\":\"Peter\","
	."\"SenderMiddleName\":null,"
	."\"SenderLastName\":\"Test\","
	."\"RemainingCredits\":983,"
	."\"Signature\":\"db0d88f2ae43ca244ae8650b151d94cbe40a540ae30df64ae5559cef7866961911b4e802205af561b569833c5bcf710fa9d3cd540d5432a8d31d5a1fc8d02b33b2cef345388d65b7fb26fc9509676ab73eb0d35042e55d5766e2818f35c56b535ce3c7e097417575d3788601d373b6f7cc401f093302a8fcd75becaa2f9cbac1\","
	."\"PublicKey\":\"-----BEGIN RSA PUBLIC KEY-----\r\nMIGJAoGBAN4ZwWG3mRtJoBOw\/z9+\/\/z\/nM6IlFt1vpDeLM0i\/swZqeV1Jzh8E0KP\r\neUHyIvrWJjxsFXI4kbCmhGm44baB4IRkWYc+M7eSWtWTKz12EY0MNdVCed1HqvAy\r\n4cNQ1FSEuqQt6Iroe5D8JF5V3+3Pg7IrfW2NVn\/+BNVidYeyElnfAgMBAAE=\r\n-----END RSA PUBLIC KEY-----\"}";

$dec = new \App\Verifier();
$dec->verify($callbackRequest);
