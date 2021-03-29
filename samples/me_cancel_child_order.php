<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use Stk2k\PhitFlyer\PhitFlyerClient;

$argdefs = array(
    'product_code' => 'string',
    'child_order_id' => 'string',
);
list($product_code, $child_order_id) = get_args($argdefs,__FILE__);

list($api_key, $api_secret) = bitflyer_credentials();

try{
    $flyer = new PhitFlyerClient($api_key, $api_secret);

    // call web API
    $flyer->meCancelChildOrder($product_code, $child_order_id);

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
