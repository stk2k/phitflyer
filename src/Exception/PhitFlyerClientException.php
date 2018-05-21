<?php
namespace PhitFlyer\Exception;

class PhitFlyerClientException extends \Exception implements PhitFlyerClientExceptionInterface
{
    /**
     * construct
     *
     * @param string $message
     * @param \Exception|null $prev
     */
    public function __construct($message, $prev = null){
        parent::__construct($message,0,$prev);
    }
}