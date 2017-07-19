<?php
namespace PhitFlyer\Exception;

class JsonFormatException extends \Exception
{
    private $body;
    private $json_error;
    
    /**
     * construct
     *
     * @param string $body
     */
    public function __construct($body){
        $this->body = $body;
        $this->json_error = json_last_error();
        parent::__construct('server returned illegal json format(' . $this->json_error . '):' . $body);
    }
    
    /**
     * get json error
     *
     * @return integer
     */
    public function getJsonError(){
        return $this->json_error;
    }
}