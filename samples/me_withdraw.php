<?php
require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

require_once 'sample.inc.php';

use PhitFlyer\PhitFlyerClient;

$argdefs = array(
    'bank_account_id' =>'string',
    'amount' => 'integer',
);
list($bank_account_id, $amount) = get_args($argdefs,__FILE__);

list($api_key, $api_secret) = bitflyer_credentials();

$flyer = new PhitFlyerClient($api_key, $api_secret);

// call web API
$message = $flyer->meWithdraw('JPY', $bank_account_id, $amount );

// show request URI
$uri = $flyer->getLastRequest()->getUrl();
echo 'URI:' . PHP_EOL;
echo ' ' . $uri . PHP_EOL;

// show result
echo 'RESULT:' . PHP_EOL;
echo '  message_id:' . $message->message_id . PHP_EOL;
