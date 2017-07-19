<?php
namespace PhitFlyer\Object;


class MePosition
{
    /** @var string  */
    private $product_code;
    
    /** @var string  */
    private $side;
    
    /** @var integer  */
    private $price;
    
    /** @var float  */
    private $size;
    
    /** @var float  */
    private $commission;
    
    /** @var integer  */
    private $swap_point_accumulate;
    
    /** @var integer  */
    private $require_collateral;
    
    /** @var string  */
    private $open_date;
    
    /** @var integer  */
    private $leverage;
    
    /** @var integer  */
    private $pnl;
    
    /**
     * construct
     *
     * @param string $product_code
     * @param string $side
     * @param integer $price
     * @param float $size
     * @param float $commission
     * @param integer $swap_point_accumulate
     * @param integer $require_collateral
     * @param string $open_date
     * @param integer $leverage
     * @param integer $pnl
     */
    public function __construct(
        $product_code,
        $side,
        $price,
        $size,
        $commission,
        $swap_point_accumulate,
        $require_collateral,
        $open_date,
        $leverage,
        $pnl
    ){
        $this->product_code = $product_code;
        $this->side = $side;
        $this->price = $price;
        $this->size = $size;
        $this->commission = $commission;
        $this->swap_point_accumulate = $swap_point_accumulate;
        $this->require_collateral = $require_collateral;
        $this->open_date = $open_date;
        $this->leverage = $leverage;
        $this->pnl = $pnl;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return MePosition
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'product_code') ? $obj->product_code : null,
            property_exists($obj,'side') ? $obj->side : null,
            property_exists($obj,'price') ? $obj->price : null,
            property_exists($obj,'size') ? $obj->size : null,
            property_exists($obj,'commission') ? $obj->commission : null,
            property_exists($obj,'swap_point_accumulate') ? $obj->swap_point_accumulate : null,
            property_exists($obj,'require_collateral') ? $obj->require_collateral : null,
            property_exists($obj,'open_date') ? $obj->open_date : null,
            property_exists($obj,'leverage') ? $obj->leverage : null,
            property_exists($obj,'pnl') ? $obj->pnl : null
        );
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
     * get price
     *
     * @return integer
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
    
    /**
     * get commission
     *
     * @return float
     */
    public function getCommission(){
        return $this->commission;
    }
    
    /**
     * get swap point accumulate
     *
     * @return integer
     */
    public function getSwapPointAccumulate(){
        return $this->swap_point_accumulate;
    }

    /**
     * get require collateral
     *
     * @return integer
     */
    public function getRequireCollateral(){
        return $this->require_collateral;
    }
    
    /**
     * get open date
     *
     * @return string
     */
    public function getOpenDate(){
        return $this->open_date;
    }
    
    /**
     * get leverage
     *
     * @return integer
     */
    public function getLeverage(){
        return $this->leverage;
    }
    
    /**
     * get pnl
     *
     * @return integer
     */
    public function getPnl(){
        return $this->pnl;
    }
    
}