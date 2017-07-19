<?php
namespace PhitFlyer\Object;


class MeWithdrawMessage
{
    /** @var string  */
    private $message;
    
    /**
     * construct
     *
     * @param string $message
     */
    public function __construct($message){
        $this->message = $message;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return MeWithdrawMessage
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'message') ? $obj->message : null
        );
    }
    
    /**
     * get message
     *
     * @return string
     */
    public function getMessage(){
        return $this->message;
    }
    
}