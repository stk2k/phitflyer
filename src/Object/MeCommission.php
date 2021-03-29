<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class MeCommission
{
    /** @var float  */
    private $commission_rate;
    
    /**
     * construct
     *
     * @param float $commission_rate
     */
    public function __construct($commission_rate){
        $this->commission_rate = $commission_rate;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return MeCommission
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['commission_rate']) ? $data['commission_rate'] : null
        );
    }

    /**
     * get commission rate
     *
     * @return string
     */
    public function getCommissionRate(){
        return $this->commission_rate;
    }
    
}