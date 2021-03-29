<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


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
     * @param array $data
     *
     * @return Market
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['product_code']) ? $data['product_code'] : null,
            isset($data['alias']) ? $data['alias'] : null
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