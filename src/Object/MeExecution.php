<?php
namespace PhitFlyer\Object;


class MeExecution
{
    private $id;
    private $child_order_id;
    private $side;
    private $price;
    private $size;
    private $commission;
    private $exec_date;
    
    /**
     * construct
     *
     * @param integer $id
     * @param string $child_order_id
     * @param string $side
     * @param float $price
     * @param float $size
     * @param string $commission
     * @param string $exec_date
     * @param string $child_order_acceptance_id
     */
    public function __construct(
        $id,
        $child_order_id,
        $side,
        $price,
        $size,
        $commission,
        $exec_date,
        $child_order_acceptance_id
    ){
        $this->id = $id;
        $this->child_order_id = $child_order_id;
        $this->side = $side;
        $this->price = $price;
        $this->size= $size;
        $this->commission= $commission;
        $this->exec_date = $exec_date;
        $this->child_order_acceptance_id = $child_order_acceptance_id;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return MeExecution
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'id') ? $obj->id : null,
            property_exists($obj,'child_order_id') ? $obj->child_order_id : null,
            property_exists($obj,'side') ? $obj->side : null,
            property_exists($obj,'price') ? $obj->price : null,
            property_exists($obj,'size') ? $obj->size : null,
            property_exists($obj,'commission') ? $obj->commission : null,
            property_exists($obj,'exec_date') ? $obj->exec_date : null,
            property_exists($obj,'child_order_acceptance_id') ? $obj->child_order_acceptance_id : null
        );
    }
    
    /**
     * get id
     *
     * @return string
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * get child order id
     *
     * @return string
     */
    public function getChildOrderId(){
        return $this->child_order_id;
    }
    
    /**
     * get side
     *
     * @return string
     */
    public function getSide(){
        return $this->side;
    }
    
    /**
     * get price
     *
     * @return float
     */
    public function getPrice(){
        return $this->price;
    }
    
    /**
     * get size
     *
     * @return float
     */
    public function getSize(){
        return $this->size;
    }
    
    /**
     * get commission
     *
     * @return string
     */
    public function getCommission(){
        return $this->commission;
    }
    
    /**
     * get exec date
     *
     * @return string
     */
    public function getExecDate(){
        return $this->exec_date;
    }
    
    /**
     * get buy child order acceptance id
     *
     * @return string
     */
    public function getBuyChildOrderAcceptanceId(){
        return $this->child_order_acceptance_id;
    }
    
}