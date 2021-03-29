<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use Stk2k\PhitFlyer\PhitFlyerClient;

try{
    $flyer = new PhitFlyerClient();

// call web API
    $board = $flyer->getBoard('BTC_JPY');

// show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

// show result
    echo 'RESULT:' . PHP_EOL;
    echo ' =========================' . PHP_EOL;
    echo ' mid_price:' . $board['mid_price'] . PHP_EOL;

    echo ' =========================' . PHP_EOL;
    echo ' bids:' . PHP_EOL;
    foreach($board['bids'] as $idx => $item){
        echo ' [' . $idx . ']' . PHP_EOL;
        echo '  price:' . $item['price'] . PHP_EOL;
        echo '  size:' . $item['size'] . PHP_EOL;
    }

    echo '=========================' . PHP_EOL;
    echo 'asks:' . PHP_EOL;
    foreach($board['asks'] as $idx => $item){
        echo ' [' . $idx . ']' . PHP_EOL;
        echo '  price:' . $item['price'] . PHP_EOL;
        echo '  size:' . $item['size'] . PHP_EOL;
    }
}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
