<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use PhitFlyer\PhitFlyerClient;

try{
    $flyer = new PhitFlyerClient();

    // call web API
    $health = $flyer->getHealth();

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    echo '  status:' . $health['status'] . PHP_EOL;

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
