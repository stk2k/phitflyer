<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use PhitFlyer\PhitFlyerClient;

list($api_key, $api_secret) = bitflyer_credentials();

try{
    $flyer = new PhitFlyerClient($api_key, $api_secret);

    // call web API
    $bank_accounts = $flyer->meGetBankAccounts();

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    foreach($bank_accounts as $idx => $item){
        echo ' [' . $idx . ']' . PHP_EOL;
        echo '  id:' . $item['id'] . PHP_EOL;
        echo '  is_verified:' . $item['is_verified'] . PHP_EOL;
        echo '  bank_name:' . $item['bank_name'] . PHP_EOL;
        echo '  branch_name:' . $item['branch_name'] . PHP_EOL;
        echo '  account_type:' . $item['account_type'] . PHP_EOL;
        echo '  account_number:' . $item['account_number'] . PHP_EOL;
        echo '  account_name:' . $item['account_name'] . PHP_EOL;
    }

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}
