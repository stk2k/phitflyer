phitFlyer, bitFlyer API PHP client
=======================

## Description

phitFlyer is a PHP library which provides calling bitFLyer-API.
It provides multiple access methods, such as array, class.

## Feature

- simple interface
- return values are result of json decoding(array/object), but it also has object interface by using decorator class. 
- bundles benchmark class which can be used alternatively.

## Demo

### simple and fastest sample:
```php
use PhitFlyer\PhitFlyerClient;
 
$client = new PhitFlyerClient();
 
$markets = $client->getMarkets();
 
foreach($markets as $idx => $market){
    echo $idx . '.' . PHP_EOL;
    echo 'product_code:' . $market->product_code . PHP_EOL;
    echo 'alias:' . (isset($market['alias']) ? $market['alias'] : '') . PHP_EOL;
}
 
```

### objective access sample:
```php
use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerObjectClient;
 
$client = new PhitFlyerObjectClient(new PhitFlyerClient());
 
$markets = $client->getMarkets();
 
foreach($markets as $idx => $market){
    echo $idx . '.' . PHP_EOL;
    echo 'product_code:' . $market->getProductCode() . PHP_EOL;
    echo 'alias:' . $market->getAlias() . PHP_EOL;
}
 
```

### benchmark sample:
```php
use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerBenchmarkClient;
 
$client = new PhitFlyerBenchmarkClient(
            new PhitFlyerClient(), 
            function ($m, $e) use(&$method, &$elapsed){
                 echo "[$m]finished in $e sec" . PHP_EOL;
             }
        );
 
$client->getMarkets();
 
```

### benchmark sample:
```php
use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerBenchmarkClient;

$client = new PhitFlyerBenchmarkClient(
            new PhitFlyerClient(),
            function ($m, $e) use(&$method, &$elapsed){
                 echo "[$m]finished in $e sec" . PHP_EOL;
             }
        );

$client->getMarkets();

```

### logger client sample:
```php
use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerLoggerClient;

$client = new PhitFlyerLoggerClient(
            new PhitFlyerClient(),
            new PhitFlyerClient(), new YourLogger());    // YourLogger: Psr-3 compliant logger
        );

```

## Usage

1. create PhitFlyerClient object.
2. call API method.
3. PhitFlyer returns array or object(stdClass).

## Requirement

PHP 5.5 or later


## Installing phitFlyer

The recommended way to install phitFlyer is through
[Composer](http://getcomposer.org).

```bash
composer require stk2k/phitflyer
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## License
[MIT](https://github.com/stk2k/phitflyer/blob/master/LICENSE)

## Author

[stk2k](https://github.com/stk2k)

## Disclaimer

This software is no warranty.

We are not responsible for any results caused by the use of this software.

Please use the responsibility of the your self.


## Donation

-Bitcoin: 3HCw9pp6dSq1xU9iPoPKVFyVbM8iBrrinn
