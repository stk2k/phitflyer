<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use Stk2k\PhitFlyer\PhitFlyerClient;

$argdefs = array(
    'product_code' => 'string',
    'child_order_type' => 'string',
    'side' => 'string',
    'price' => 'integer',
    'size' => 'float',
    '[minute_to_expire]' => 'integer',
    '[time_in_force]' => 'string',
);
list($product_code, $child_order_type, $side, $price, $size, $minute_to_expire, $time_in_force) = get_args($argdefs,__FILE__);

list($api_key, $api_secret) = bitflyer_credentials();

try{
    $flyer = new PhitFlyerClient($api_key, $api_secret);

    // call web API
    $result = $flyer->meSendChildOrder($product_code, $child_order_type, $side, $price, $size, $minute_to_expire, $time_in_force);

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    echo '  child_order_acceptance_id:' . $result['child_order_acceptance_id'] . PHP_EOL;

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
