<?php
namespace PhitFlyer\Exception;

class BitflyerApiTimeoutException extends BitflyerApiErrorResponseException
{
    /**
     * construct
     *
     * @param string $api
     * @param string $status
     */
    public function __construct($api, $status){
        parent::__construct($api, $status, 'bitFlyer api timed out:' . $api);
    }
    
}