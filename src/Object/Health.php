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
     * @param array $data
     *
     * @return Health
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['status']) ? $data['status'] : null
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