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
);
list($product_code,$before,$after,$count) = get_args($argdefs,__FILE__);

list($api_key, $api_secret) = bitflyer_credentials();

try{
    $flyer = new PhitFlyerClient($api_key, $api_secret);

    // call web API
    $executions = $flyer->meGetExecutions( $product_code, $before, $after, $count );

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    foreach($executions as $idx => $item){
        echo ' [' . $idx . ']' . PHP_EOL;
        echo '  id:' . $item['id'] . PHP_EOL;
        echo '  child_order_id:' . $item['child_order_id'] . PHP_EOL;
        echo '  side:' . $item['side'] . PHP_EOL;
        echo '  price:' . $item['price'] . PHP_EOL;
        echo '  size:' . $item['size'] . PHP_EOL;
        echo '  commission:' . $item['commission'] . PHP_EOL;
        echo '  exec_date:' . $item['exec_date'] . PHP_EOL;
    }

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
