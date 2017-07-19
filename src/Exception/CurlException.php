<?php
namespace PhitFlyer\Exception;

class CurlException extends \Exception
{
    /** @var string */
    private $function;
    
    /** @var string */
    private $errno;
    
    /** @var string */
    private $errmsg;
    
    /**
     * construct
     *
     * @param string $function
     * @param resource $curl_handle
     */
    public function __construct($function, $curl_handle){
    
        $this->errno = curl_errno($curl_handle);
        $this->errmsg = curl_error($curl_handle);
        
        $msg = 'cURL error:' . $this->errmsg . '(' . $this->errno . ')';
        parent::__construct($msg);
        
        $this->function = $function;
    }
    
    /**
     * get error curl function
     *
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }
    
    /**
     * get error number
     *
     * @return string
     */
    public function getErrorNumber()
    {
        return $this->errno;
    }
    
    /**
     * get error message
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errmsg;
    }
}