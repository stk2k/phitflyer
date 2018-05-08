<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use PhitFlyer\PhitFlyerClient;

$argdefs = array(
    'product_code' => 'string',
);
list($product_code) = get_args($argdefs,__FILE__);

list($api_key, $api_secret) = bitflyer_credentials();

try{
    $flyer = new PhitFlyerClient($api_key, $api_secret);

    // call web API
    $positions = $flyer->meGetPositions( $product_code );

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    foreach($positions as $idx => $item){
        echo ' [' . $idx . ']' . PHP_EOL;
        echo '  product_code:' . $item['product_code'] . PHP_EOL;
        echo '  side:' . $item['side'] . PHP_EOL;
        echo '  price:' . $item['price'] . PHP_EOL;
        echo '  size:' . $item['size'] . PHP_EOL;
        echo '  commission:' . $item['commission'] . PHP_EOL;
        echo '  swap_point_accumulate:' . $item['swap_point_accumulate'] . PHP_EOL;
        echo '  exec_require_collateraldate:' . $item['require_collateral'] . PHP_EOL;
        echo '  open_date:' . $item['open_date'] . PHP_EOL;
        echo '  leverage:' . $item['leverage'] . PHP_EOL;
        echo '  pnl:' . $item['pnl'] . PHP_EOL;
    }

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
