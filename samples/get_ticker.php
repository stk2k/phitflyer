<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use Stk2k\PhitFlyer\PhitFlyerClient;

try{
    $flyer = new PhitFlyerClient();

    // call web API
    $ticker = $flyer->getTicker('BTC_JPY');

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    echo ' product_code:' . $ticker['product_code'] . PHP_EOL;
    echo ' timestamp:' . $ticker['timestamp'] . PHP_EOL;
    echo ' tick_id:' . $ticker['tick_id'] . PHP_EOL;
    echo ' best_bid:' . $ticker['best_bid'] . PHP_EOL;
    echo ' best_ask:' . $ticker['best_ask'] . PHP_EOL;
    echo ' best_bid_size:' . $ticker['best_bid_size'] . PHP_EOL;
    echo ' best_ask_size:' . $ticker['best_ask_size'] . PHP_EOL;
    echo ' total_bid_depth:' . $ticker['total_bid_depth'] . PHP_EOL;
    echo ' total_ask_depth:' . $ticker['total_ask_depth'] . PHP_EOL;
    echo ' ltp:' . $ticker['ltp'] . PHP_EOL;
    echo ' volume:' . $ticker['volume'] . PHP_EOL;
    echo ' volume_by_product:' . $ticker['volume_by_product'] . PHP_EOL;

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
