<?php

require $_SERVER['DOCUMENT_ROOT'].'/sistema/bitpay_config/vendor/autoload.php';

// Now fetch the invoice from BitPay
$storageEngine = new \Bitpay\Storage\EncryptedFilesystemStorage('SITEnowA5720'); // Password may need to be updated if you changed it
$privateKey    = $storageEngine->load('../tmp/api.key');
$publicKey     = $storageEngine->load('../tmp/api.pub');
$client        = new \Bitpay\Client\Client();
//$network       = new \Bitpay\Network\Testnet();
$network = new \Bitpay\Network\Livenet();
$adapter       = new \Bitpay\Client\Adapter\CurlAdapter();
$client->setNetwork($network);
$client->setAdapter($adapter);

$token = new \Bitpay\Token();
$token->setToken('9UCGW93EsBpKxot5PQVqDmWWtHoijckqFrMp1tR5KH8U'); // UPDATE THIS VALUE

$client->setToken($token);

/**
 * This is where we will fetch the invoice object
 */
$invoice = $client->getInvoice("0111");

$request  = $client->getRequest();
$response = $client->getResponse();
echo (string) $request.PHP_EOL.PHP_EOL.PHP_EOL;
echo (string) $response.PHP_EOL.PHP_EOL;

print_r($invoice);

?>