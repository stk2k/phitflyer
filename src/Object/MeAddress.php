<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


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
     * @param array $data
     *
     * @return MeAddress
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['type']) ? $data['type'] : null,
            isset($data['currency_code']) ? $data['currency_code'] : null,
            isset($data['address']) ? $data['address'] : null
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