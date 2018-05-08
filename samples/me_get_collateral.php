<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use PhitFlyer\PhitFlyerClient;

list($api_key, $api_secret) = bitflyer_credentials();

try{
    $flyer = new PhitFlyerClient($api_key, $api_secret);

// call web API
    $collateral = $flyer->meGetCollateral();

// show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

// show result
    echo 'RESULT:' . PHP_EOL;
    echo '  ' . $collateral['collateral'] . PHP_EOL;
    echo '  ' . $collateral['open_position_pnl'] . PHP_EOL;
    echo '  ' . $collateral['require_collateral'] . PHP_EOL;
    echo '  ' . $collateral['keep_rate'] . PHP_EOL;
}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
