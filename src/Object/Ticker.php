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
     * @param integer $tick_id,
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
        $product_code,
        $timestamp,
        $tick_id,
        $best_bid,
        $best_ask,
        $best_bid_size,
        $best_ask_size,
        $total_bid_depth,
        $total_ask_depth,
        $ltp,
        $volume,
        $volume_by_product
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
    public static function fromArray(array $data){
        return new self(
            isset($data['product_code']) ? $data['product_code'] : null,
            isset($data['timestamp']) ? $data['timestamp'] : null,
            isset($data['tick_id']) ? $data['tick_id'] : null,
            isset($data['best_bid']) ? $data['best_bid'] : null,
            isset($data['best_ask']) ? $data['best_ask'] : null,
            isset($data['best_bid_size']) ? $data['best_bid_size'] : null,
            isset($data['best_ask_size']) ? $data['best_ask_size'] : null,
            isset($data['total_bid_depth']) ? $data['total_bid_depth'] : null,
            isset($data['total_ask_depth']) ? $data['total_ask_depth'] : null,
            isset($data['ltp']) ? $data['ltp'] : null,
            isset($data['volume']) ? $data['volume'] : null,
            isset($data['volume_by_product']) ? $data['volume_by_product'] : null
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
     * get timestamp
     *
     * @return string
     */
    public function getTimeStamp(){
        return $this->timestamp;
    }
    
    /**
     * get ticker id
     *
     * @return integer
     */
    public function getTickId(){
        return $this->tick_id;
    }
    
    /**
     * get best bid
     *
     * @return float
     */
    public function getBestBid(){
        return $this->best_bid;
    }
    
    /**
     * get best ask
     *
     * @return float
     */
    public function getBestAsk(){
        return $this->best_ask;
    }
    
    /**
     * get best bid size
     *
     * @return float
     */
    public function getBestBidSize(){
        return $this->best_bid_size;
    }
    
    /**
     * get best ask size
     *
     * @return float
     */
    public function getBestAskSize(){
        return $this->best_ask_size;
    }
    
    /**
     * get total bid depth
     *
     * @return float
     */
    public function getTotalBidDepth(){
        return $this->total_bid_depth;
    }
    
    /**
     * get total ask depth
     *
     * @return float
     */
    public function getTotalAskDepth(){
        return $this->total_ask_depth;
    }
    
    /**
     * get ltp
     *
     * @return float
     */
    public function getLtp(){
        return $this->ltp;
    }
    
    /**
     * get volume
     *
     * @return float
     */
    public function getVolume(){
        return $this->volume;
    }
    
    /**
     * get volume
     *
     * @return float
     */
    public function getVolumeByProduct(){
        return $this->volume_by_product;
    }
}