<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class MeCommission
{
    /** @var string  */
    private $commission_rate;
    
    /**
     * construct
     *
     * @param float $commission_rate
     */
    public function __construct(float $commission_rate){
        $this->commission_rate = $commission_rate;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return MeCommission
     */
    public static function fromArray(array $data) : MeCommission
    {
        return new self(
            $data['commission_rate'] ?? null
        );
    }

    /**
     * get commission rate
     *
     * @return string
     */
    public function getCommissionRate() : string
    {
        return $this->commission_rate;
    }
    
}