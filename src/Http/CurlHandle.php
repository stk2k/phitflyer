<?php
namespace PhitFlyer\Http;


class CurlHandle
{
    /** @var resource  */
    private $handle;
    
    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->handle = curl_init();
    }
    
    /**
     * Reset
     *
     * @return resource
     */
    public function reset()
    {
        curl_reset($this->handle);
        return $this->handle;
    }
    
    /**
     * Close
     *
     */
    public function close()
    {
        if ($this->handle){
            curl_close($this->handle);
        }
        $this->handle = null;
    }
}