<?php

use App\Verifier;

require './vendor/autoload.php';

$callbackRequest = "{\"TransactionType\":\"CustomerPayBillConfirmation\",
\"TransactionTime\":\"20191008083205\",
\"TransactionID\":\"NJ83HBNKED\",
\"TransactionAmount\":10,
\"BusinessShortcode\":\"107050\",
\"AccountReference\":\"acc_ref\",
\"SenderMSISDN\":\"254796778039\",
\"SenderFirstName\":\"Peter\",
\"SenderMiddleName\":null,
\"SenderLastName\":\"Test\",
\"RemainingCredits\":982,
\"Signature\":\"I8iVcPXe5\/KGyUUPwTj9AIymbSTp39hMaFJCW56ZuJK2QHNbh2zJVzynDZnB2sWI6pPb8GQR0s+FmhKow3gFwE2XaQ1JprX3jtVKEkW1UDwfw9XpXwlaBRLp6K+DLc7NPSxoeq5bj0Z9PjnLUTm0uklgA\/HJS8HxI0O2gRIJZqY=\",
\"PublicKey\":\"-----BEGIN RSA PUBLIC KEY-----\r\nMIGJAoGBAJ6bBYcQrVNJH+dFvA1nkRXcuGrJLqKKuF7IscD6dvymi3xQht\/bPC\/z\r\nSXnu0RLQwvymyRsqgAs4+jDgZH5NRNIx8qg\/8K\/thNc+XJzssmt8gFddWR4V++Sf\r\nu8x8GPNtkJyGSywp4Y4yukt\/CN7b2aop68bnhrZd8f\/s8VJqR7EvAgMBAAE=\r\n-----END RSA PUBLIC KEY-----\"}";

$dec = new Verifier();
$dec->verify($callbackRequest);
