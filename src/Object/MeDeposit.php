<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class MeDeposit
{
    /** @var integer  */
    private $id;
    
    /** @var string  */
    private $order_id;
    
    /** @var string  */
    private $currency_code;
    
    /** @var int  */
    private $amount;
    
    /** @var string  */
    private $status;
    
    /** @var string  */
    private $event_date;
    
    /**
     * construct
     *
     * @param int $id
     * @param string $order_id
     * @param string $currency_code
     * @param integer $amount
     * @param string $status
     * @param string $event_date
     */
    public function __construct(int $id, string $order_id, string $currency_code, int $amount, string $status, string $event_date)
    {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->currency_code = $currency_code;
        $this->amount = $amount;
        $this->status = $status;
        $this->event_date = $event_date;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return MeDeposit
     */
    public static function fromArray(array $data) : MeDeposit
    {
        return new self(
            $data['id'] ?? null,
            $data['order_id'] ?? null,
            $data['currency_code'] ?? null,
            $data['amount'] ?? null,
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
     * @return int
     */
    public function getAmount() : int
    {
        return $this->amount;
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