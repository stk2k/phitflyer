<?php
require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use PhitFlyer\PhitFlyerClient;

$flyer = new PhitFlyerClient();

// call web API
$markets = $flyer->getMarkets();

// show request URI
$uri = $flyer->getLastRequest()->getUrl();
echo 'URI:' . PHP_EOL;
echo ' ' . $uri . PHP_EOL;

// show result
echo 'RESULT:' . PHP_EOL;
foreach($markets as $idx => $item){
    echo ' [' . $idx . ']' . PHP_EOL;
    echo '  product_code:' . $item->product_code . PHP_EOL;
    echo '  alias:' . (property_exists($item,'alias') ? $item->alias : '') . PHP_EOL;
}
