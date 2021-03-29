<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class MeExecution
{
    /** @var int  */
    private $id;

    /** @var string  */
    private $child_order_id;

    /** @var string  */
    private $side;

    /** @var float  */
    private $price;

    /** @var float  */
    private $size;

    /** @var string  */
    private $commission;

    /** @var string  */
    private $exec_date;

    /** @var string  */
    private $child_order_acceptance_id;
    
    /**
     * construct
     *
     * @param int $id
     * @param string $child_order_id
     * @param string $side
     * @param float $price
     * @param float $size
     * @param string $commission
     * @param string $exec_date
     * @param string $child_order_acceptance_id
     */
    public function __construct(
        int $id,
        string $child_order_id,
        string $side,
        float $price,
        float $size,
        string $commission,
        string $exec_date,
        string $child_order_acceptance_id
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
    public static function fromArray(array $data) : MeExecution
    {
        return new self(
            $data['id'] ?? null,
            $data['child_order_id'] ?? null,
            $data['side'] ?? null,
            $data['price'] ?? null,
            $data['size'] ?? null,
            $data['commission'] ?? null,
            $data['exec_date'] ?? null,
            $data['child_order_acceptance_id'] ?? null
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
     * get side
     *
     * @return string
     */
    public function getSide() : string
    {
        return $this->side;
    }
    
    /**
     * get price
     *
     * @return float
     */
    public function getPrice() : float
    {
        return $this->price;
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
     * get commission
     *
     * @return string
     */
    public function getCommission() : string
    {
        return $this->commission;
    }
    
    /**
     * get exec date
     *
     * @return string
     */
    public function getExecDate() : string
    {
        return $this->exec_date;
    }
    
    /**
     * get buy child order acceptance id
     *
     * @return string
     * @noinspection PhpUnused
     */
    public function getBuyChildOrderAcceptanceId() : string
    {
        return $this->child_order_acceptance_id;
    }
    
}