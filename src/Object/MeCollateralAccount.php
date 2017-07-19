<?php
namespace PhitFlyer\Object;


class MeCollateralAccount
{
    /** @var integer  */
    private $currency_code;
    
    /** @var integer  */
    private $amount;
    
    /** @var integer  */
    private $require_collateral;
    
    /** @var float  */
    private $keep_rate;
    
    /**
     * construct
     *
     * @param string $currency_code
     * @param float $amount
     * @param float $require_collateral
     * @param float $keep_rate
     */
    public function __construct($currency_code, $amount, $require_collateral, $keep_rate){
        $this->currency_code = $currency_code;
        $this->amount = $amount;
        $this->require_collateral = $require_collateral;
        $this->keep_rate = $keep_rate;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return MeCollateralAccount
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'currency_code') ? $obj->currency_code : null,
            property_exists($obj,'amount') ? $obj->amount : null,
            property_exists($obj,'require_collateral') ? $obj->require_collateral : null,
            property_exists($obj,'keep_rate') ? $obj->keep_rate : null
        );
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
     * get amount
     *
     * @return float
     */
    public function getAmount(){
        return $this->amount;
    }
    
}