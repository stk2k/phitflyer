<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class Ticker
{
    private $product_code;
    private $timestamp;
    private $tick_id;
    private $best_bid;
    private $best_ask;
    private $best_bid_size;
    private $best_ask_size;
    private $total_bid_depth;
    private $total_ask_depth;
    private $ltp;
    private $volume;
    private $volume_by_product;
    
    /**
     * construct
     *
     * @param string $product_code,
     * @param string $timestamp,
     * @param int $tick_id,
     * @param float $best_bid,
     * @param float $best_ask,
     * @param float $best_bid_size,
     * @param float $best_ask_size,
     * @param float $total_bid_depth,
     * @param float $total_ask_depth,
     * @param float $ltp,
     * @param float $volume,
     * @param float $volume_by_product
     */
    public function __construct(
        string $product_code,
        string $timestamp,
        int $tick_id,
        float $best_bid,
        float $best_ask,
        float $best_bid_size,
        float $best_ask_size,
        float $total_bid_depth,
        float $total_ask_depth,
        float $ltp,
        float $volume,
        float $volume_by_product
    ){
        $this->product_code = $product_code;
        $this->timestamp = $timestamp;
        $this->tick_id = $tick_id;
        $this->best_bid = $best_bid;
        $this->best_ask = $best_ask;
        $this->best_bid_size = $best_bid_size;
        $this->best_ask_size = $best_ask_size;
        $this->total_bid_depth = $total_bid_depth;
        $this->total_ask_depth = $total_ask_depth;
        $this->ltp = $ltp;
        $this->volume = $volume;
        $this->volume_by_product = $volume_by_product;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return Ticker
     */
    public static function fromArray(array $data) : Ticker
    {
        return new self(
            $data['product_code'] ?? null,
            $data['timestamp'] ?? null,
            $data['tick_id'] ?? null,
            $data['best_bid'] ?? null,
            $data['best_ask'] ?? null,
            $data['best_bid_size'] ?? null,
            $data['best_ask_size'] ?? null,
            $data['total_bid_depth'] ?? null,
            $data['total_ask_depth'] ?? null,
            $data['ltp'] ?? null,
            $data['volume'] ?? null,
            $data['volume_by_product'] ?? null
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
     * get timestamp
     *
     * @return string
     * @noinspection PhpUnused
     */
    public function getTimeStamp() : string
    {
        return $this->timestamp;
    }
    
    /**
     * get ticker id
     *
     * @return int
     * @noinspection PhpUnused
     */
    public function getTickId() : int
    {
        return $this->tick_id;
    }
    
    /**
     * get best bid
     *
     * @return float
     * @noinspection PhpUnused
     */
    public function getBestBid() : float
    {
        return $this->best_bid;
    }

    /**
     * get best bid size
     *
     * @return float
     * @noinspection PhpUnused
     */
    public function getBestBidSize() : float
    {
        return $this->best_bid_size;
    }
    
    /**
     * get best ask size
     *
     * @return float
     */
    public function getBestAskSize() : float
    {
        return $this->best_ask_size;
    }
    
    /**
     * get total bid depth
     *
     * @return float
     */
    public function getTotalBidDepth() : float
    {
        return $this->total_bid_depth;
    }
    
    /**
     * get total ask depth
     *
     * @return float
     * @noinspection PhpUnused
     */
    public function getTotalAskDepth() : float
    {
        return $this->total_ask_depth;
    }
    
    /**
     * get ltp
     *
     * @return float
     * @noinspection PhpUnused
     */
    public function getLtp() : float
    {
        return $this->ltp;
    }
    
    /**
     * get volume
     *
     * @return float
     * @noinspection PhpUnused
     */
    public function getVolume() : float
    {
        return $this->volume;
    }
    
    /**
     * get volume
     *
     * @return float
     * @noinspection PhpUnused
     */
    public function getVolumeByProduct() : float
    {
        return $this->volume_by_product;
    }
}