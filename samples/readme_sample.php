<?php
require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerObjectClient;
use PhitFlyer\PhitFlyerBenchmarkClient;

echo '===[ simple and fastest sample ]===', PHP_EOL;

$flyer = new PhitFlyerClient();

$markets = $flyer->getMarkets();

foreach($markets as $idx => $market){
    echo $idx . '.' . PHP_EOL;
    echo 'product_code:' . $market->product_code . PHP_EOL;
    echo 'alias:' . (property_exists($market,'alias') ? $market->alias : '') . PHP_EOL;
}
echo PHP_EOL;

echo '===[ objective access sample ]===', PHP_EOL;

$flyer = new PhitFlyerObjectClient(new PhitFlyerClient());

$markets = $flyer->getMarkets();

foreach($markets as $idx => $market){
    /** @var \PhitFlyer\Object\Market $market */
    echo $idx . '.' . PHP_EOL;
    echo 'product_code:' . $market->getProductCode() . PHP_EOL;
    echo 'alias:' . $market->getAlias() . PHP_EOL;
}
echo PHP_EOL;

echo '===[ benchmark sample ]===', PHP_EOL;

$flyer = new PhitFlyerBenchmarkClient(
    new PhitFlyerClient(),
    function ($m, $e){
        echo "[$m]finished in $e sec" . PHP_EOL;
    }
);

$flyer->getMarkets();
