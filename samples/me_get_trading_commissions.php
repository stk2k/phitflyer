<?php
require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

require_once 'sample.inc.php';

use PhitFlyer\PhitFlyerClient;

$argdefs = array(
    'product_code' => 'string',
);
list($product_code) = get_args($argdefs,__FILE__);

list($api_key, $api_secret) = bitflyer_credentials();

$flyer = new PhitFlyerClient($api_key, $api_secret);

// call web API
$commission = $flyer->meGetTradingCommission( $product_code );

// show request URI
$uri = $flyer->getLastRequest()->getUrl();
echo 'URI:' . PHP_EOL;
echo ' ' . $uri . PHP_EOL;

// show result
echo 'RESULT:' . PHP_EOL;
echo '  commission_rate:' . $commission->commission_rate . PHP_EOL;
