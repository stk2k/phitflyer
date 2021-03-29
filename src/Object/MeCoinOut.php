<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class MeCoinOut
{
    /** @var integer  */
    private $id;
    
    /** @var string  */
    private $order_id;
    
    /** @var string  */
    private $currency_code;
    
    /** @var float  */
    private $amount;
    
    /** @var string  */
    private $address;
    
    /** @var string  */
    private $tx_hash;
    
    /** @var float  */
    private $fee;
    
    /** @var float  */
    private $additional_fee;
    
    /** @var string  */
    private $status;
    
    /** @var string  */
    private $event_date;
    
    /**
     * construct
     *
     * @param string $id
     * @param string $order_id
     * @param string $currency_code
     * @param float $amount
     * @param string $address
     * @param string $tx_hash
     * @param float $fee
     * @param float $additional_fee
     * @param string $status
     * @param string $event_date;
     */
    public function __construct($id, $order_id, $currency_code, $amount, $address, $tx_hash, $fee, $additional_fee, $status, $event_date){
        $this->id = $id;
        $this->order_id = $order_id;
        $this->currency_code = $currency_code;
        $this->amount = $amount;
        $this->address = $address;
        $this->tx_hash = $tx_hash;
        $this->fee = $fee;
        $this->additional_fee = $additional_fee;
        $this->status = $status;
        $this->event_date = $event_date;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return MeCoinOut
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['id']) ? $data['id'] : null,
            isset($data['order_id']) ? $data['order_id'] : null,
            isset($data['currency_code']) ? $data['currency_code'] : null,
            isset($data['amount']) ? $data['amount'] : null,
            isset($data['address']) ? $data['address'] : null,
            isset($data['tx_hash']) ? $data['tx_hash'] : null,
            isset($data['fee']) ? $data['fee'] : null,
            isset($data['additional_fee']) ? $data['additional_fee'] : null,
            isset($data['status']) ? $data['status'] : null,
            isset($data['event_date']) ? $data['event_date'] : null
        );
    }
    
    /**
     * get id
     *
     * @return integer
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * get order id
     *
     * @return string
     */
    public function getOrderId(){
        return $this->order_id;
    }
    
    /**
     * get currency code
     *
     * @return string
     */
    public function getCurrencyCode(){
        return $this->currency_code;
    }
    
    /**
     * get amount
     *
     * @return float
     */
    public function getAmount(){
        return $this->amount;
    }
    
    /**
     * get address
     *
     * @return string
     */
    public function getAddress(){
        return $this->address;
    }
    
    /**
     * get tx hash
     *
     * @return string
     */
    public function getTxHash(){
        return $this->tx_hash;
    }
    
    /**
     * get fee
     *
     * @return float
     */
    public function getFee(){
        return $this->fee;
    }
    
    /**
     * get additional fee
     *
     * @return float
     */
    public function getAdditionalFee(){
        return $this->additional_fee;
    }
    
    /**
     * get status
     *
     * @return string
     */
    public function getStatus(){
        return $this->status;
    }
    
    /**
     * get event date
     *
     * @return string
     */
    public function getEventDate(){
        return $this->event_date;
    }
}