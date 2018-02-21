<?php
namespace PhitFlyer\Object;


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
     * @param object $obj
     *
     * @return Ticker
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'product_code') ? $obj->product_code : null,
            property_exists($obj,'timestamp') ? $obj->timestamp : null,
            property_exists($obj,'tick_id') ? $obj->tick_id : null,
            property_exists($obj,'best_bid') ? $obj->best_bid : null,
            property_exists($obj,'best_ask') ? $obj->best_ask : null,
            property_exists($obj,'best_bid_size') ? $obj->best_bid_size : null,
            property_exists($obj,'best_ask_size') ? $obj->best_ask_size : null,
            property_exists($obj,'total_bid_depth') ? $obj->total_bid_depth : null,
            property_exists($obj,'total_ask_depth') ? $obj->total_ask_depth : null,
            property_exists($obj,'ltp') ? $obj->ltp : null,
            property_exists($obj,'volume') ? $obj->volume : null,
            property_exists($obj,'volume_by_product') ? $obj->volume_by_product : null
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