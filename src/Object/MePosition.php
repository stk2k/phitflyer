<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


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
     * @param int $price
     * @param float $size
     * @param float $commission
     * @param int $swap_point_accumulate
     * @param int $require_collateral
     * @param string $open_date
     * @param int $leverage
     * @param int $pnl
     */
    public function __construct(
        string $product_code,
        string $side,
        int $price,
        float $size,
        float $commission,
        int $swap_point_accumulate,
        int $require_collateral,
        string $open_date,
        int $leverage,
        int $pnl
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
     * @param array $data
     *
     * @return MePosition
     */
    public static function fromArray(array $data) : MePosition{
        return new self(
            $data['product_code'] ?? null,
            $data['side'] ?? null,
            $data['price'] ?? null,
            $data['size'] ?? null,
            $data['commission'] ?? null,
            $data['swap_point_accumulate'] ?? null,
            $data['require_collateral'] ?? null,
            $data['open_date'] ?? null,
            $data['leverage'] ?? null,
            $data['pnl'] ?? null
        );
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
     * get price
     *
     * @return int
     */
    public function getPrice() : int
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
     * @return float
     */
    public function getCommission() : float
    {
        return $this->commission;
    }
    
    /**
     * get swap point accumulate
     *
     * @return int
     * @noinspection PhpUnused
     */
    public function getSwapPointAccumulate() : int
    {
        return $this->swap_point_accumulate;
    }

    /**
     * get require collateral
     *
     * @return int
     */
    public function getRequireCollateral() : int
    {
        return $this->require_collateral;
    }
    
    /**
     * get open date
     *
     * @return string
     */
    public function getOpenDate() : string
    {
        return $this->open_date;
    }
    
    /**
     * get leverage
     *
     * @return int
     */
    public function getLeverage() : int
    {
        return $this->leverage;
    }
    
    /**
     * get pnl
     *
     * @return int
     * @noinspection PhpUnused
     */
    public function getPnl() : int
    {
        return $this->pnl;
    }
    
}