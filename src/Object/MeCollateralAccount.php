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
    public function __construct(string $currency_code, float $amount, float $require_collateral, float $keep_rate){
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
    public static function fromArray(array $data) : MeCollateralAccount
    {
        return new self(
            $data['currency_code'] ?? null,
            $data['amount'] ?? null,
            $data['require_collateral'] ?? null,
            $data['keep_rate'] ?? null
        );
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
     * get amount
     *
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }
    
}