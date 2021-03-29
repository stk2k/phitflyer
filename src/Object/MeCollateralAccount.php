<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


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
     * @param array $data
     *
     * @return MeCollateralAccount
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['currency_code']) ? $data['currency_code'] : null,
            isset($data['amount']) ? $data['amount'] : null,
            isset($data['require_collateral']) ? $data['require_collateral'] : null,
            isset($data['keep_rate']) ? $data['keep_rate'] : null
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