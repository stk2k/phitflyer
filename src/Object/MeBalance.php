<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


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
    public function __construct(string $currency_code, float $amount, float $available){
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
    public static function fromArray(array $data) : MeBalance
    {
        return new self(
            $data['currency_code'] ?? null,
            $data['amount'] ?? null,
            $data['available'] ?? null
        );
    }
    
    /**
     * get currency code
     *
     * @return string
     */
    public function getCurrenecyCode() : string
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
    
    /**
     * get available
     *
     * @return float
     */
    public function getAvailable() : float
    {
        return $this->available;
    }
}