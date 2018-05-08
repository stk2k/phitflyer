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
     * @param array $data
     *
     * @return MeCollateral
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['collateral']) ? $data['collateral'] : null,
            isset($data['open_position_pnl']) ? $data['open_position_pnl'] : null,
            isset($data['require_collateral']) ? $data['require_collateral'] : null,
            isset($data['keep_rate']) ? $data['keep_rate'] : null
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