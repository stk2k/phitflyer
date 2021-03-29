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
     * @param int $mid_price
     * @param Bid[] $bids
     * @param Ask[] $asks
     */
    public function __construct(int $mid_price, array $bids, array $asks){
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
    public static function fromArray(array $data) : Board
    {
        return new self(
            $data['mid_price'] ?? null,
            array_map(function($i){ return Bid::fromArray($i); }, $data['bids'] ?? []),
            array_map(function($i){ return Ask::fromArray($i); }, $data['asks'] ?? [])
        );
    }
    
    /**
     * get mid price
     *
     * @return int
     * @noinspection PhpUnused
     */
    public function getMidPrice() : int
    {
        return $this->mid_price;
    }
    
    /**
     * get bids
     *
     * @return Bid[]
     * @noinspection PhpUnused
     */
    public function getBids() : array
    {
        return $this->bids;
    }
    
    /**
     * get bids
     *
     * @return Ask[]
     */
    public function getAsks() : array
    {
        return $this->asks;
    }
}