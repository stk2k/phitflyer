<?php
require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

require_once 'sample.inc.php';

use PhitFlyer\PhitFlyerClient;

list($api_key, $api_secret) = bitflyer_credentials();

$flyer = new PhitFlyerClient($api_key, $api_secret);

// call web API
$addresses = $flyer->meGetAddress();

// show request URI
$uri = $flyer->getLastRequest()->getUrl();
echo 'URI:' . PHP_EOL;
echo ' ' . $uri . PHP_EOL;

// show result
echo 'RESULT:' . PHP_EOL;
foreach($addresses as $idx => $item){
    echo ' [' . $idx . ']' . PHP_EOL;
    echo '  type:' . $item->type . PHP_EOL;
    echo '  currency_code:' . $item->currency_code . PHP_EOL;
    echo '  address:' . $item->address . PHP_EOL;
}
