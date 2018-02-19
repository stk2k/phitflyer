<?php
require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use PhitFlyer\PhitFlyerClient;

$flyer = new PhitFlyerClient();

// call web API
$board_state = $flyer->getBoardState();

// show request URI
$uri = $flyer->getLastRequest()->getUrl();
echo 'URI:' . PHP_EOL;
echo ' ' . $uri . PHP_EOL;

// show result
echo 'RESULT:' . PHP_EOL;
echo '  health:' . $board_state->health . PHP_EOL;
echo '  state:' . $board_state->state . PHP_EOL;
