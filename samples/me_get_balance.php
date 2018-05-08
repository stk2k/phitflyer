<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use PhitFlyer\PhitFlyerClient;

list($api_key, $api_secret) = bitflyer_credentials();

try{
    $flyer = new PhitFlyerClient($api_key, $api_secret);

    // call web API
    $balances = $flyer->meGetBalance();

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    foreach($balances as $idx => $item){
        echo ' [' . $idx . ']' . PHP_EOL;
        echo '  ' . $item['currency_code'] . PHP_EOL;
        echo '  ' . $item['amount'] . PHP_EOL;
        echo '  ' . $item['available'] . PHP_EOL;
    }

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
