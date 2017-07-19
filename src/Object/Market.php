<?php
namespace PhitFlyer\Object;


class Market
{
    private $product_code;
    private $alias;
    
    /**
     * construct
     *
     * @param string $product_code
     * @param string|null $alias
     */
    public function __construct($product_code, $alias = null){
        $this->product_code = $product_code;
        $this->alias = $alias;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return Market
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'product_code') ? $obj->product_code : null,
            property_exists($obj,'alias') ? $obj->alias : null
        );
    }
    
    /**
     * get product code
     *
     * @return string|null
     */
    public function getProductCode(){
        return $this->product_code;
    }
    
    /**
     * get alias
     *
     * @return string|null
     */
    public function getAlias(){
        return $this->alias;
    }
}