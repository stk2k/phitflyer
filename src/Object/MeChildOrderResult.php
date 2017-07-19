<?php
namespace PhitFlyer\Object;


class MeChildOrderResult
{
    /** @var string  */
    private $child_order_acceptance_id;
    
    /**
     * construct
     *
     * @param string $child_order_acceptance_id
     */
    public function __construct($child_order_acceptance_id){
        $this->child_order_acceptance_id = $child_order_acceptance_id;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return MeChildOrderResult
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'child_order_acceptance_id') ? $obj->child_order_acceptance_id : null
        );
    }
    
    /**
     * get child order acceptance id(child order id)
     *
     * @return string
     */
    public function getChildOrderAcceptanceId(){
        return $this->child_order_acceptance_id;
    }
    
}