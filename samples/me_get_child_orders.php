<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use PhitFlyer\PhitFlyerClient;

$argdefs = array(
    'product_code' => 'string',
    '[before]' => 'integer',
    '[after]' => 'integer',
    '[count]' => 'integer',
    '[child_order_state]' => 'string',
    '[parent_order_id]' => 'string',
);
list($product_code,$before,$after,$count,$child_order_state,$parent_order_id) = get_args($argdefs,__FILE__);

list($api_key, $api_secret) = bitflyer_credentials();

try{
    $flyer = new PhitFlyerClient($api_key, $api_secret);

    // call web API
    $deposits = $flyer->meGetChildOrders($product_code,$before,$after,$count,$child_order_state,$parent_order_id);

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    foreach($deposits as $idx => $item){
        echo ' [' . $idx . ']' . PHP_EOL;
        echo '  id:' . $item['id'] . PHP_EOL;
        echo '  child_order_id:' . $item['child_order_id'] . PHP_EOL;
        echo '  product_code:' . $item['product_code'] . PHP_EOL;
        echo '  side:' . $item['side'] . PHP_EOL;
        echo '  child_order_type:' . $item['child_order_type'] . PHP_EOL;
        echo '  price:' . $item['price'] . PHP_EOL;
        echo '  average_price:' . $item['average_price'] . PHP_EOL;
        echo '  size:' . $item['size'] . PHP_EOL;
        echo '  child_order_state:' . $item['child_order_state'] . PHP_EOL;
        echo '  expire_date:' . $item['expire_date'] . PHP_EOL;
        echo '  child_order_date:' . $item['child_order_date'] . PHP_EOL;
        echo '  child_order_acceptance_id:' . $item['child_order_acceptance_id'] . PHP_EOL;
        echo '  outstanding_size:' . $item['outstanding_size'] . PHP_EOL;
        echo '  cancel_size:' . $item['cancel_size'] . PHP_EOL;
        echo '  executed_size:' . $item['executed_size'] . PHP_EOL;
        echo '  total_commission:' . $item['total_commission'] . PHP_EOL;
    }

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
