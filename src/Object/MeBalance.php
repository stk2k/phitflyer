<?php
namespace PhitFlyer\Object;


class MeBalance
{
    /** @var float  */
    private $currency_code;
    
    /** @var float  */
    private $amount;
    
    /** @var float  */
    private $available;
    
    /**
     * construct
     *
     * @param string $currency_code
     * @param float $amount
     * @param float $available
     */
    public function __construct($currency_code, $amount, $available){
        $this->currency_code = $currency_code;
        $this->amount = $amount;
        $this->available = $available;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return MeBalance
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['currency_code']) ? $data['currency_code'] : null,
            isset($data['amount']) ? $data['amount'] : null,
            isset($data['available']) ? $data['available'] : null
        );
    }
    
    /**
     * get currency code
     *
     * @return string
     */
    public function getCurrenecyCode(){
        return $this->currency_code;
    }
    
    /**
     * get amount
     *
     * @return float
     */
    public function getAmount(){
        return $this->amount;
    }
    
    /**
     * get available
     *
     * @return float
     */
    public function getAvailable(){
        return $this->available;
    }
}