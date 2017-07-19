<?php
namespace PhitFlyer\Object;


class Health
{
    /** @var string  */
    private $status;
    
    /**
     * construct
     *
     * @param string $status
     */
    public function __construct($status){
        $this->status = $status;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return Health
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'status') ? $obj->status : null
        );
    }
    
    /**
     * get status
     *
     * @return string
     */
    public function getStatus(){
        return $this->status;
    }
    
}