<?php
namespace PhitFlyer\Exception;

class ServerResponseFormatException extends \Exception
{
    /**
     * construct
     *
     * @param string $message
     */
    public function __construct($message){
        parent::__construct('bitFlyer api server returned illegal response:' . $message);
    }
}