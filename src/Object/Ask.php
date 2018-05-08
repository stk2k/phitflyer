<?php
namespace PhitFlyer\Object;


class Ask
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
     * @param array $data
     *
     * @return Ask
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['price']) ? $data['price'] : null,
            isset($data['size']) ? $data['size'] : null
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