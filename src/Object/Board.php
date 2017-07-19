<?php
namespace PhitFlyer\Object;


class Board
{
    /** @var integer */
    private $mid_price;
    
    /** @var Bid[] */
    private $bids;
    
    /** @var Ask[] */
    private $asks;
    
    /**
     * construct
     *
     * @param integer $mid_price
     * @param Bid[] $bids
     * @param Ask[] $asks
     */
    public function __construct($mid_price, $bids, $asks){
        $this->mid_price = $mid_price;
        $this->bids = $bids;
        $this->asks = $asks;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return Board
     */
    public static function fromObject($obj){
        $mid_price = property_exists($obj,'mid_price') ? $obj->mid_price : null;
        $bids = property_exists($obj,'bids') ? $obj->bids : array();
        $asks = property_exists($obj,'asks') ? $obj->asks : array();
    
        $bids = array_map(function($i){ return Bid::fromObject($i); }, $bids);
        $asks = array_map(function($i){ return Ask::fromObject($i); }, $asks);
        
        return new self($mid_price, $bids, $asks);
    }
    
    /**
     * get mid price
     *
     * @return integer
     */
    public function getMidPrice(){
        return $this->mid_price;
    }
    
    /**
     * get bids
     *
     * @return Bid[]
     */
    public function getBids(){
        return $this->bids;
    }
    
    /**
     * get bids
     *
     * @return Ask[]
     */
    public function getAsks(){
        return $this->asks;
    }
}