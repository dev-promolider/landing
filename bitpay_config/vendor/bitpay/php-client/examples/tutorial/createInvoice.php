<?php

require $_SERVER['DOCUMENT_ROOT'].'/sistema/bitpay_config/vendor/autoload.php';

// See 002.php for explanation
$storageEngine = new \Bitpay\Storage\EncryptedFilesystemStorage('SITEnowA5720'); // Password may need to be updated if you changed it
$privateKey    = $storageEngine->load('../tmp/api.key');
$publicKey     = $storageEngine->load('../tmp/api.pub');
$client        = new \Bitpay\Client\Client();
$network       = new \Bitpay\Network\Testnet();
//$network       = new \Bitpay\Network\Livenet();
$adapter       = new \Bitpay\Client\Adapter\CurlAdapter();
$client->setPrivateKey($privateKey);
$client->setPublicKey($publicKey);
$client->setNetwork($network);
$client->setAdapter($adapter);
// ---------------------------

/**
 * The last object that must be injected is the token object.
 */
$token = new \Bitpay\Token();
$token->setToken('FurmKKpiegDjFUWSqfLpN5uPToLj4QfasKokC4oUcvn6'); // UPDATE THIS VALUE

/**
 * Token object is injected into the client
 */
$client->setToken($token);

/**
 * This is where we will start to create an Invoice object, make sure to check
 * the InvoiceInterface for methods that you can use.
 */
$invoice = new \Bitpay\Invoice();

$buyer = new \Bitpay\Buyer();
$buyer
    ->setEmail('hokaide@outlook.com');

// Add the buyers info to invoice
$invoice->setBuyer($buyer);

/**
 * Item is used to keep track of a few things
 */
 
         



 

$item = new \Bitpay\Item();
$item  
      ->setCode('0111')
      ->setDescription('Gerneal Description of item')
      ->setPrice('1');
    
 // Configure the rest of the invoice   
$invoice
        ->setItem($item)
        ->setNotificationEmail('silvi14499@gmail.com')
        ->setNotificationUrl('https://www.promolider.org/sistema/bitpay_config/vendor/bitpay/php-client/examples/tutorial/IPNlogger.php')
        ->setRedirectUrl('https://promolider.org')
        ->setCurrency(new \Bitpay\Currency('USD')) 
        ->setOrderId('001');
           


/**
 * Updates invoice with new information such as the invoice id and the URL where
 * a customer can view the invoice.
 */
try {
    
    $client->createInvoice($invoice);
    
} catch (\Exception $e) {
    echo "Exception occured: " . $e->getMessage().PHP_EOL;
    $request  = $client->getRequest();
    $response = $client->getResponse();
    echo (string) $request.PHP_EOL.PHP_EOL.PHP_EOL;
    echo (string) $response.PHP_EOL.PHP_EOL;
    exit(1); // We do not want to continue if something went wrong
}



echo 'Invoice "'.$invoice->getId().'" created, see '.$invoice->getUrl().PHP_EOL;