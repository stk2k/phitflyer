<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Exception;

use Exception;

class WebApiCallException extends Exception implements PhitFlyerClientExceptionInterface
{
    /**
     * construct
     *
     * @param string $message
     * @param Exception|null $prev
     */
    public function __construct(string $message, Exception $prev = null){
        parent::__construct($message,0,$prev);
    }
}