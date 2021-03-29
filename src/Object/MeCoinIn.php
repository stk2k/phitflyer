<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class MeCoinIn
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
     * @param string $status
     * @param string $event_date;
     */
    public function __construct(string $id, string $order_id, string $currency_code, float $amount, string $address,
                                string $tx_hash, string $status, string $event_date){
        $this->id = $id;
        $this->order_id = $order_id;
        $this->currency_code = $currency_code;
        $this->amount = $amount;
        $this->address = $address;
        $this->tx_hash = $tx_hash;
        $this->status = $status;
        $this->event_date = $event_date;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return MeCoinIn
     */
    public static function fromArray(array $data) : MeCoinIn
    {
        return new self(
            $data['id'] ?? null,
            $data['order_id'] ?? null,
            $data['currency_code'] ?? null,
            $data['amount'] ?? null,
            $data['address'] ?? null,
            $data['tx_hash'] ?? null,
            $data['status'] ?? null,
            $data['event_date'] ?? null
        );
    }
    
    /**
     * get id
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }
    
    /**
     * get order id
     *
     * @return string
     */
    public function getOrderId() : string
    {
        return $this->order_id;
    }
    
    /**
     * get currency code
     *
     * @return string
     */
    public function getCurrencyCode() : string
    {
        return $this->currency_code;
    }
    
    /**
     * get amount
     *
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }
    
    /**
     * get address
     *
     * @return string
     */
    public function getAddress() : string
    {
        return $this->address;
    }
    
    /**
     * get tx hash
     *
     * @return string
     * @noinspection PhpUnused
     */
    public function getTxHash() : string
    {
        return $this->tx_hash;
    }
    
    /**
     * get status
     *
     * @return string
     */
    public function getStatus() : string
    {
        return $this->status;
    }
    
    /**
     * get event date
     *
     * @return string
     */
    public function getEventDate() : string
    {
        return $this->event_date;
    }
}