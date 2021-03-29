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
    public function __construct(string $type, string $currency_code, string $address){
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
    public static function fromArray(array $data) : MeAddress
    {
        return new self(
            $data['type'] ?? null,
            $data['currency_code'] ?? null,
            $data['address'] ?? null
        );
    }
    
    /**
     * get type
     *
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }
    
    /**
     * get currency code
     *
     * @return string
     */
    public function getCurrencyCode() : string
    {
        return $this->currency_code;
    }
    
    /**
     * get address
     *
     * @return string
     */
    public function getAddress() : string
    {
        return $this->address;
    }
}