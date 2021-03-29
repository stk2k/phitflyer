<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


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
     * @param array $data
     *
     * @return Board
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['mid_price']) ? $data['mid_price'] : null,
            array_map(function($i){ return Bid::fromArray($i); }, isset($data['bids']) ? $data['bids'] : []),
            array_map(function($i){ return Ask::fromArray($i); }, isset($data['asks']) ? $data['asks'] : [])
        );
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