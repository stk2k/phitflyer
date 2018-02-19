<?php
require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerApi;
use PhitFlyer\PhitFlyerBenchmarkClient;

$api_key = getenv('PHITFLYER_API_KEY');
$api_secret = getenv('PHITFLYER_API_SECRET');

$flyer = new PhitFlyerBenchmarkClient(new PhitFlyerClient($api_key, $api_secret), function ($m, $e){
    echo "[$m]finished in $e sec" . PHP_EOL;
});

date_default_timezone_set('UTC');

// call API: /v1/markets
echo 'calling api: ' . PhitFlyerApi::MARKETS . PHP_EOL;
$flyer->getMarkets();

sleep(1);

// call API: /v1/board
echo 'calling api: ' . PhitFlyerApi::BOARD . PHP_EOL;
$flyer->getBoard('BTC_JPY');

sleep(1);

// call API: /v1/ticker
echo 'calling api: ' . PhitFlyerApi::TICKER . PHP_EOL;
$flyer->getTicker('BTC_JPY');

sleep(1);

// call API: /v1/executions
echo 'calling api: ' . PhitFlyerApi::EXECUTIONS . PHP_EOL;
$flyer->getExecutions('BTC_JPY',null,null,10);

sleep(1);

// call API: /v1/gethealth
echo 'calling api: ' . PhitFlyerApi::GETHEALTH . PHP_EOL;
$flyer->getHealth();

sleep(1);

// call API: /v1/getchats
echo 'calling api: ' . PhitFlyerApi::GETCHATS . PHP_EOL;

$from_date = date('Y-m-d\Th:i:s', strtotime('-10 min'));
$chats = $flyer->getChats($from_date);

// call API: /v1/getpermissions
echo 'calling api: ' . PhitFlyerApi::GETPERMISSIONS . PHP_EOL;
$flyer->getPermissions();

sleep(1);

// call API: /v1/getbalance
echo 'calling api: ' . PhitFlyerApi::GETBALANCE . PHP_EOL;
$flyer->getBalance();

sleep(1);

// call API: /v1/getcollateral
echo 'calling api: ' . PhitFlyerApi::GETCOLLATERAL . PHP_EOL;
$flyer->getCollateral();

sleep(1);

// call API: /v1/getcollateralaccounts
echo 'calling api: ' . PhitFlyerApi::GETCOLLATERALACCOUNTS . PHP_EOL;
$flyer->getCollateralAccounts();

sleep(1);

// call API: /v1/getaddresses
echo 'calling api: ' . PhitFlyerApi::GETADDRESS . PHP_EOL;
$flyer->getAddress();

sleep(1);

// call API: /v1/getcoinins
echo 'calling api: ' . PhitFlyerApi::GETCOININS . PHP_EOL;
$flyer->getCoinIns();

sleep(1);

// call API: /v1/getcoinouts
echo 'calling api: ' . PhitFlyerApi::GETCOINOUTS . PHP_EOL;
$flyer->getCoinOuts();

sleep(1);
