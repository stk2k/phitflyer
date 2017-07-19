<?php
namespace PhitFlyer\Object;


class MeDeposit
{
    /** @var integer  */
    private $id;
    
    /** @var string  */
    private $order_id;
    
    /** @var string  */
    private $currency_code;
    
    /** @var integer  */
    private $amount;
    
    /** @var string  */
    private $status;
    
    /** @var string  */
    private $event_date;
    
    /**
     * construct
     *
     * @param integer $id
     * @param boolean $order_id
     * @param string $currency_code
     * @param integer $amount
     * @param string $status
     * @param string $event_date
     */
    public function __construct($id, $order_id, $currency_code, $amount, $status, $event_date){
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
     * @param object $obj
     *
     * @return MeDeposit
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'id') ? $obj->id : null,
            property_exists($obj,'order_id') ? $obj->order_id : null,
            property_exists($obj,'currency_code') ? $obj->currency_code : null,
            property_exists($obj,'amount') ? $obj->amount : null,
            property_exists($obj,'status') ? $obj->status : null,
            property_exists($obj,'event_date') ? $obj->event_date : null
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
     * @return boolean
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
     * @return string
     */
    public function getAmount(){
        return $this->amount;
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