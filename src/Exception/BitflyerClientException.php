<?php
namespace PhitFlyer\Exception;

class BitflyerClientException extends \Exception
{
    /** @var string */
    private $api;
    
    /**
     * construct
     *
     * @param string $api
     * @param \Exception|null $prev
     */
    public function __construct($api, $prev = null){
        parent::__construct('bitFlyer api call failed:' . $api,0,$prev);
    
        $this->api = $api;
    }
    
    /**
     * get api
     *
     * @return string
     */
    public function getApi()
    {
        return $this->api;
    }
    
}