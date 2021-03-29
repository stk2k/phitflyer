<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class Market
{
    /** @var string  */
    private $product_code;

    /** @var string|null  */
    private $alias;
    
    /**
     * construct
     *
     * @param string $product_code
     * @param string|null $alias
     */
    public function __construct(string $product_code, string $alias = null){
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
    public static function fromArray(array $data) : Market
    {
        return new self(
            $data['product_code'] ?? null,
            $data['alias'] ?? null
        );
    }
    
    /**
     * get product code
     *
     * @return string|null
     */
    public function getProductCode() : string
    {
        return $this->product_code;
    }
    
    /**
     * get alias
     *
     * @return string|null
     */
    public function getAlias() : string
    {
        return $this->alias;
    }
}