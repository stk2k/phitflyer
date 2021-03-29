<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use Stk2k\PhitFlyer\PhitFlyerClient;

try{
    $flyer = new PhitFlyerClient();

    // call web API
    $board_state = $flyer->getBoardState();

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    echo '  health:' . $board_state['health'] . PHP_EOL;
    echo '  state:' . $board_state['state'] . PHP_EOL;

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}