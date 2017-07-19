<?php
namespace PhitFlyer\Object;


class MeAddress
{
    /** @var string  */
    private $type;
    
    /** @var string  */
    private $currency_code;
    
    /** @var string  */
    private $address;
    
    /**
     * construct
     *
     * @param string $type
     * @param string $currency_code
     * @param string $address
     */
    public function __construct($type, $currency_code, $address){
        $this->type = $type;
        $this->currency_code = $currency_code;
        $this->address = $address;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return MeAddress
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'type') ? $obj->type : null,
            property_exists($obj,'currency_code') ? $obj->currency_code : null,
            property_exists($obj,'address') ? $obj->address : null
        );
    }
    
    /**
     * get type
     *
     * @return string
     */
    public function getType(){
        return $this->type;
    }
    
    /**
     * get currency code
     *
     * @return string
     */
    public function getCurrencyCode(){
        return $this->currency_code;
    }
    
    /**
     * get address
     *
     * @return string
     */
    public function getAddress(){
        return $this->address;
    }
}