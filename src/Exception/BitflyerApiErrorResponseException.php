<?php
namespace PhitFlyer\Exception;

class BitflyerApiErrorResponseException extends \Exception
{
    /** @var string */
    private $api;
    
    /** @var string */
    private $response_status;
    
    /** @var string */
    private $response_message;
    
    /** @var string */
    private $response_data;
    
    /**
     * construct
     *
     * @param string $api
     * @param string $status
     * @param string $message
     * @param string $data
     */
    public function __construct($api, $status, $message, $data = null){
        $msg = 'bitFlyer api returned error response:' . $message;
        parent::__construct($msg);
        
        $this->api = $api;
        $this->response_status = $status;
        $this->response_message = $message;
        $this->response_data = $data;
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
    
    /**
     * get status
     *
     * @return string
     */
    public function getResponseStatus()
    {
        return $this->response_status;
    }
    
    /**
     * get message
     *
     * @return string
     */
    public function getResponseMessage()
    {
        return $this->response_message;
    }
    
    /**
     * get api
     *
     * @return string
     */
    public function getResponseData()
    {
        return $this->response_data;
    }
}