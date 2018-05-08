<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use PhitFlyer\PhitFlyerClient;

try{
    $flyer = new PhitFlyerClient();

    // call web API
    $executions = $flyer->getExecutions('BTC_JPY',null,null,10);

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    foreach($executions as $idx => $item){
        echo ' [' . $idx . ']' . PHP_EOL;
        echo '  id:' . $item['id'] . PHP_EOL;
        echo '  side:' . $item['side'] . PHP_EOL;
        echo '  price:' . $item['price'] . PHP_EOL;
        echo '  size:' . $item['size'] . PHP_EOL;
        echo '  exec_date:' . $item['exec_date'] . PHP_EOL;
        echo '  buy_child_order_acceptance_id:' . $item['buy_child_order_acceptance_id'] . PHP_EOL;
        echo '  sell_child_order_acceptance_id:' . $item['sell_child_order_acceptance_id'] . PHP_EOL;
    }

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
