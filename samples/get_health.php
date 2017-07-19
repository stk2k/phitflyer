<?php
require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use PhitFlyer\PhitFlyerClient;

$flyer = new PhitFlyerClient();

// call web API
$health = $flyer->getHealth();

// show request URI
$uri = $flyer->getLastRequest()->getUrl();
echo 'URI:' . PHP_EOL;
echo ' ' . $uri . PHP_EOL;

// show result
echo 'RESULT:' . PHP_EOL;
echo '  status:' . $health->status . PHP_EOL;
