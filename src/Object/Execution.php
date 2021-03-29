<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class Execution
{
    /** @var int  */
    private $id;

    /** @var string  */
    private $side;

    /** @var float  */
    private $price;

    /** @var float  */
    private $size;

    /** @var string  */
    private $exec_date;

    /** @var string  */
    private $buy_child_order_acceptance_id;

    /** @var string  */
    private $sell_child_order_acceptance_id;
    
    /**
     * construct
     *
     * @param int $id
     * @param string $side
     * @param float $price
     * @param float $size
     * @param string $exec_date
     * @param string $buy_child_order_acceptance_id
     * @param string $sell_child_order_acceptance_id
     */
    public function __construct(
        int $id,
        string $side,
        float $price,
        float $size,
        string $exec_date,
        string $buy_child_order_acceptance_id,
        string $sell_child_order_acceptance_id
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
    public static function fromArray(array $data) : Execution
    {
        return new self(
            $data['id'] ?? null,
            $data['side'] ?? null,
            $data['price'] ?? null,
            $data['size'] ?? null,
            $data['exec_date'] ?? null,
            $data['buy_child_order_acceptance_id'] ?? null,
            $data['sell_child_order_acceptance_id'] ?? null
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
        return $this->buy_child_order_acceptance_id;
    }
    
    /**
     * get sell child order acceptance id
     *
     * @return string
     */
    public function getSellChildOrderAcceptanceId() : string
    {
        return $this->sell_child_order_acceptance_id;
    }
}