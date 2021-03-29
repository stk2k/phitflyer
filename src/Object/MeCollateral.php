<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class MeCollateral
{
    /** @var integer  */
    private $collateral;
    
    /** @var integer  */
    private $open_position_pnl;
    
    /** @var integer  */
    private $require_collateral;
    
    /** @var float  */
    private $keep_rate;
    
    /**
     * construct
     *
     * @param string $collateral
     * @param float $open_position_pnl
     * @param float $require_collateral
     * @param float $keep_rate
     */
    public function __construct(string $collateral, float $open_position_pnl, float $require_collateral, float $keep_rate){
        $this->collateral = $collateral;
        $this->open_position_pnl = $open_position_pnl;
        $this->require_collateral = $require_collateral;
        $this->keep_rate = $keep_rate;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return MeCollateral
     */
    public static function fromArray(array $data) : MeCollateral
    {
        return new self(
            $data['collateral'] ?? null,
            $data['open_position_pnl'] ?? null,
            $data['require_collateral'] ?? null,
            $data['keep_rate'] ?? null
        );
    }
    
    /**
     * get collateral
     *
     * @return string
     */
    public function getCollateral() : string
    {
        return $this->collateral;
    }
    
    /**
     * get open position Pnl
     *
     * @return float
     * @noinspection PhpUnused
     */
    public function getOpenPositionPnl() : float
    {
        return $this->open_position_pnl;
    }
    
    /**
     * get require collateral
     *
     * @return float
     */
    public function getRequireCollateral() : float
    {
        return $this->require_collateral;
    }
    
    /**
     * get keep rate
     *
     * @return float
     */
    public function getKeepRate() : float
    {
        return $this->keep_rate;
    }
}