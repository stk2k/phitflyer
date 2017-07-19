<?php
namespace PhitFlyer\Object;


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
    public function __construct($collateral, $open_position_pnl, $require_collateral, $keep_rate){
        $this->collateral = $collateral;
        $this->open_position_pnl = $open_position_pnl;
        $this->require_collateral = $require_collateral;
        $this->keep_rate = $keep_rate;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return MeCollateral
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'collateral') ? $obj->collateral : null,
            property_exists($obj,'open_position_pnl') ? $obj->open_position_pnl : null,
            property_exists($obj,'require_collateral') ? $obj->require_collateral : null,
            property_exists($obj,'keep_rate') ? $obj->keep_rate : null
        );
    }
    
    /**
     * get collateral
     *
     * @return string
     */
    public function getCollateral(){
        return $this->collateral;
    }
    
    /**
     * get open position Pnl
     *
     * @return float
     */
    public function getOpenPositionPnl(){
        return $this->open_position_pnl;
    }
    
    /**
     * get require collateral
     *
     * @return float
     */
    public function getRequireCollateral(){
        return $this->require_collateral;
    }
    
    /**
     * get keep rate
     *
     * @return float
     */
    public function getKeepRate(){
        return $this->keep_rate;
    }
}