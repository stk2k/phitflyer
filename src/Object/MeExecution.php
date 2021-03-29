<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class MeExecution
{
    private $id;
    private $child_order_id;
    private $side;
    private $price;
    private $size;
    private $commission;
    private $exec_date;
    private $child_order_acceptance_id;
    
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
     * @param array $data
     *
     * @return MeExecution
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['id']) ? $data['id'] : null,
            isset($data['child_order_id']) ? $data['child_order_id'] : null,
            isset($data['side']) ? $data['side'] : null,
            isset($data['price']) ? $data['price'] : null,
            isset($data['size']) ? $data['size'] : null,
            isset($data['commission']) ? $data['commission'] : null,
            isset($data['exec_date']) ? $data['exec_date'] : null,
            isset($data['child_order_acceptance_id']) ? $data['child_order_acceptance_id'] : null
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