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
     * @param array $data
     *
     * @return MeDeposit
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['id']) ? $data['id'] : null,
            isset($data['order_id']) ? $data['order_id'] : null,
            isset($data['currency_code']) ? $data['currency_code'] : null,
            isset($data['amount']) ? $data['amount'] : null,
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