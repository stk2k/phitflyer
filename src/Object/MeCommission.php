<?php
namespace PhitFlyer\Object;


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
     * @param object $obj
     *
     * @return MeCommission
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'commission_rate') ? $obj->commission_rate : null
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