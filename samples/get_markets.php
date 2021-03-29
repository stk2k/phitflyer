<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use Stk2k\PhitFlyer\PhitFlyerClient;

try{
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
        echo '  product_code:' . $item['product_code'] . PHP_EOL;
        echo '  alias:' . (isset($item['alias']) ? $item['alias'] : '') . PHP_EOL;
    }

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
