<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class Bid
{
    /** @var float  */
    private $price;
    
    /** @var float  */
    private $size;
    
    /**
     * construct
     *
     * @param float $price
     * @param float $size
     */
    public function __construct(float $price, float $size){
        $this->price = $price;
        $this->size = $size;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return Bid
     */
    public static function fromArray(array $data) : Bid
    {
        return new self(
            $data['price'] ?? null,
            $data['size'] ?? null
        );
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
}