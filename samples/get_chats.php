<?php
require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
require_once 'include/autoload.php';
require_once 'include/sample.inc.php';

use Stk2k\PhitFlyer\PhitFlyerClient;

try{
    $flyer = new PhitFlyerClient();

    date_default_timezone_set('UTC');

    $from_date = date('Y-m-d\Th:i:s', strtotime('-10 min'));
    echo 'from_date:' . PHP_EOL;
    echo ' ' . $from_date . PHP_EOL;

    // call web API
    $chats = $flyer->getChats($from_date);

    // show request URI
    $uri = $flyer->getLastRequest()->getUrl();
    echo 'URI:' . PHP_EOL;
    echo ' ' . $uri . PHP_EOL;

    // show result
    echo 'RESULT:' . PHP_EOL;
    foreach($chats as $idx => $item){
        echo ' [' . $idx . ']' . PHP_EOL;
        echo '  nickname:' . $item['nickname'] . PHP_EOL;
        echo '  message:' . $item['message'] . PHP_EOL;
        echo '  date:' . $item['date'] . PHP_EOL;
    }

}
catch(\Throwable $e)
{
    print_stacktrace($e);
}