<?php
namespace PhitFlyer\Object;


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
    public function __construct($price, $size){
        $this->price = $price;
        $this->size = $size;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return Bid
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'price') ? $obj->price : null,
            property_exists($obj,'size') ? $obj->size : null
        );
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
}