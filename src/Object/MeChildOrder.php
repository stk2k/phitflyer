<?php
namespace PhitFlyer\Object;


class MeChildOrder
{
    /** @var integer  */
    private $id;
    
    /** @var string  */
    private $child_order_id;
    
    /** @var string  */
    private $product_code;
    
    /** @var string  */
    private $side;
    
    /** @var string  */
    private $child_order_type;
    
    /** @var integer  */
    private $price;
    
    /** @var integer  */
    private $average_price;
    
    /** @var float  */
    private $size;
    
    /** @var integer  */
    private $child_order_state;
    
    /** @var string  */
    private $expire_date;
    
    /** @var string  */
    private $child_order_date;
    
    /** @var string  */
    private $child_order_acceptance_id;
    
    /** @var float  */
    private $outstanding_size;
    
    /** @var float  */
    private $cancel_size;
    
    /** @var float  */
    private $executed_size;
    
    /** @var float  */
    private $total_commission;
    
    /**
     * construct
     *
     * @param integer $id
     * @param string $child_order_id
     * @param string $product_code
     * @param string $side
     * @param string $child_order_type
     * @param string $price
     * @param string $average_price
     * @param string $size
     * @param string $child_order_state
     * @param string $expire_date
     * @param string $child_order_date
     * @param string $child_order_acceptance_id
     * @param string $outstanding_size
     * @param string $cancel_size
     * @param string $executed_size
     * @param string $total_commission
     */
    public function __construct(
        $id,
        $child_order_id,
        $product_code,
        $side,
        $child_order_type,
        $price,
        $average_price,
        $size,
        $child_order_state,
        $expire_date,
        $child_order_date,
        $child_order_acceptance_id,
        $outstanding_size,
        $cancel_size,
        $executed_size,
        $total_commission
    ){
        $this->id = $id;
        $this->child_order_id = $child_order_id;
        $this->product_code = $product_code;
        $this->side = $side;
        $this->child_order_type = $child_order_type;
        $this->price = $price;
        $this->average_price = $average_price;
        $this->size = $size;
        $this->child_order_state = $child_order_state;
        $this->expire_date = $expire_date;
        $this->child_order_date = $child_order_date;
        $this->child_order_acceptance_id = $child_order_acceptance_id;
        $this->outstanding_size = $outstanding_size;
        $this->cancel_size = $cancel_size;
        $this->executed_size = $executed_size;
        $this->total_commission = $total_commission;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return MeChildOrder
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'id') ? $obj->id : null,
            property_exists($obj,'child_order_id') ? $obj->child_order_id : null,
            property_exists($obj,'product_code') ? $obj->product_code : null,
            property_exists($obj,'side') ? $obj->side : null,
            property_exists($obj,'child_order_type') ? $obj->child_order_type : null,
            property_exists($obj,'price') ? $obj->price : null,
            property_exists($obj,'average_price') ? $obj->average_price : null,
            property_exists($obj,'size') ? $obj->size : null,
            property_exists($obj,'child_order_state') ? $obj->child_order_state : null,
            property_exists($obj,'expire_date') ? $obj->expire_date : null,
            property_exists($obj,'child_order_date') ? $obj->child_order_date : null,
            property_exists($obj,'child_order_acceptance_id') ? $obj->child_order_acceptance_id : null,
            property_exists($obj,'outstanding_size') ? $obj->outstanding_size : null,
            property_exists($obj,'cancel_size') ? $obj->cancel_size : null,
            property_exists($obj,'executed_size') ? $obj->executed_size : null,
            property_exists($obj,'total_commission') ? $obj->total_commission : null
        );
    }
    
    /**
     * get id
     *
     * @return integer
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
     * get product code
     *
     * @return string
     */
    public function getProductCode(){
        return $this->product_code;
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
     * get child order type
     *
     * @return string
     */
    public function getChildOrderType(){
        return $this->child_order_type;
    }
    
    /**
     * get price
     *
     * @return integer
     */
    public function getPrice(){
        return $this->price;
    }
    
    /**
     * get average price
     *
     * @return integer
     */
    public function getAveragePrice(){
        return $this->average_price;
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
     * get child order state
     *
     * @return string
     */
    public function getChildOrderState(){
        return $this->child_order_state;
    }
    
    /**
     * get expire date
     *
     * @return string
     */
    public function getExpireDate(){
        return $this->expire_date;
    }
    
    /**
     * get child order date
     *
     * @return string
     */
    public function getChildOrderDate(){
        return $this->child_order_date;
    }
    
    /**
     * get child order acceptance id
     *
     * @return string
     */
    public function getChildOrderAcceptanceId(){
        return $this->child_order_acceptance_id;
    }
    
    /**
     * get outstanding size
     *
     * @return float
     */
    public function getOutstandingSize(){
        return $this->outstanding_size;
    }
    
    /**
     * get cancel size
     *
     * @return float
     */
    public function getCancelSize(){
        return $this->cancel_size;
    }
    
    /**
     * get executed size
     *
     * @return float
     */
    public function getExecutedSize(){
        return $this->executed_size;
    }
    
    /**
     * get total commission
     *
     * @return float
     */
    public function getTotalCommission(){
        return $this->total_commission;
    }
    
}