<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class MeChildOrderResult
{
    /** @var string  */
    private $child_order_acceptance_id;
    
    /**
     * construct
     *
     * @param string $child_order_acceptance_id
     */
    public function __construct(string $child_order_acceptance_id){
        $this->child_order_acceptance_id = $child_order_acceptance_id;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return MeChildOrderResult
     */
    public static function fromArray(array $data) : MeChildOrderResult
    {
        return new self(
            $data['child_order_acceptance_id'] ?? null
        );
    }
    
    /**
     * get child order acceptance id(child order id)
     *
     * @return string
     */
    public function getChildOrderAcceptanceId() : string
    {
        return $this->child_order_acceptance_id;
    }
    
}