<?php
namespace PhitFlyer\Object;


class Execution
{
    private $id;
    private $side;
    private $price;
    private $size;
    private $exec_date;
    private $buy_child_order_acceptance_id;
    private $sell_child_order_acceptance_id;
    
    /**
     * construct
     *
     * @param integer $id
     * @param string $side
     * @param float $price
     * @param float $size
     * @param string $exec_date
     * @param string $buy_child_order_acceptance_id
     * @param string $sell_child_order_acceptance_id
     */
    public function __construct(
        $id,
        $side,
        $price,
        $size,
        $exec_date,
        $buy_child_order_acceptance_id,
        $sell_child_order_acceptance_id
    ){
        $this->id = $id;
        $this->side = $side;
        $this->price = $price;
        $this->size= $size;
        $this->exec_date = $exec_date;
        $this->buy_child_order_acceptance_id = $buy_child_order_acceptance_id;
        $this->sell_child_order_acceptance_id = $sell_child_order_acceptance_id;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return Execution
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['id']) ? $data['id'] : null,
            isset($data['side']) ? $data['side'] : null,
            isset($data['price']) ? $data['price'] : null,
            isset($data['size']) ? $data['size'] : null,
            isset($data['exec_date']) ? $data['exec_date'] : null,
            isset($data['buy_child_order_acceptance_id']) ? $data['buy_child_order_acceptance_id'] : null,
            isset($data['sell_child_order_acceptance_id']) ? $data['sell_child_order_acceptance_id'] : null
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
        return $this->buy_child_order_acceptance_id;
    }
    
    /**
     * get sell child order acceptance id
     *
     * @return string
     */
    public function getSellChildOrderAcceptanceId(){
        return $this->sell_child_order_acceptance_id;
    }
}