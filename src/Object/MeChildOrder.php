<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


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
     * @param int $id
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
        int $id,
        string $child_order_id,
        string $product_code,
        string $side,
        string $child_order_type,
        string $price,
        string $average_price,
        string $size,
        string $child_order_state,
        string $expire_date,
        string $child_order_date,
        string $child_order_acceptance_id,
        string $outstanding_size,
        string $cancel_size,
        string $executed_size,
        string $total_commission
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
     * @param array $data
     *
     * @return MeChildOrder
     */
    public static function fromArray(array $data) : MeChildOrder
    {
        return new self(
            $data['id'] ?? null,
            $data['child_order_id'] ?? null,
            $data['product_code'] ?? null,
            $data['side'] ?? null,
            $data['child_order_type'] ?? null,
            $data['price'] ?? null,
            $data['average_price'] ?? null,
            $data['size'] ?? null,
            $data['child_order_state'] ?? null,
            $data['expire_date'] ?? null,
            $data['child_order_date'] ?? null,
            $data['child_order_acceptance_id'] ?? null,
            $data['outstanding_size'] ?? null,
            $data['cancel_size'] ?? null,
            $data['executed_size'] ?? null,
            $data['total_commission'] ?? null
        );
    }
    
    /**
     * get id
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }
    
    /**
     * get child order id
     *
     * @return string
     */
    public function getChildOrderId() : string
    {
        return $this->child_order_id;
    }
    
    /**
     * get product code
     *
     * @return string
     */
    public function getProductCode() : string
    {
        return $this->product_code;
    }
    
    /**
     * get side
     *
     * @return string
     */
    public function getSide() : string
    {
        return $this->side;
    }
    
    /**
     * get child order type
     *
     * @return string
     */
    public function getChildOrderType() : string
    {
        return $this->child_order_type;
    }
    
    /**
     * get price
     *
     * @return int
     */
    public function getPrice() : int
    {
        return $this->price;
    }
    
    /**
     * get average price
     *
     * @return int
     * @noinspection PhpUnused
     */
    public function getAveragePrice() : int
    {
        return $this->average_price;
    }
    
    /**
     * get size
     *
     * @return float
     */
    public function getSize() : float
    {
        return $this->size;
    }
    
    /**
     * get child order state
     *
     * @return string
     */
    public function getChildOrderState() : string
    {
        return $this->child_order_state;
    }
    
    /**
     * get expire date
     *
     * @return string
     */
    public function getExpireDate() : string
    {
        return $this->expire_date;
    }
    
    /**
     * get child order date
     *
     * @return string
     */
    public function getChildOrderDate() : string
    {
        return $this->child_order_date;
    }
    
    /**
     * get child order acceptance id
     *
     * @return string
     */
    public function getChildOrderAcceptanceId() : string
    {
        return $this->child_order_acceptance_id;
    }
    
    /**
     * get outstanding size
     *
     * @return float
     * @noinspection PhpUnused
     */
    public function getOutstandingSize() : float
    {
        return $this->outstanding_size;
    }
    
    /**
     * get cancel size
     *
     * @return float
     */
    public function getCancelSize() : float
    {
        return $this->cancel_size;
    }
    
    /**
     * get executed size
     *
     * @return float
     */
    public function getExecutedSize() : float
    {
        return $this->executed_size;
    }
    
    /**
     * get total commission
     *
     * @return float
     */
    public function getTotalCommission() : float
    {
        return $this->total_commission;
    }
    
}