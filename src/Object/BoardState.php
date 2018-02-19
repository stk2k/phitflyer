<?php
namespace PhitFlyer\Object;


class BoardState
{
    /** @var string  */
    private $health;
    
    /** @var string  */
    private $state;
    
    /** @var array  */
    private $data;
    
    /**
     * construct
     *
     * @param string $health
     * @param string $state
     * @param array $data
     */
    public function __construct($health, $state, $data = []){
        $this->health = $health;
        $this->state = $state;
        $this->data = $data;
    }
    
    /**
     * construct from stdObject
     *
     * @param object $obj
     *
     * @return BoardState
     */
    public static function fromObject($obj){
        return new self(
            property_exists($obj,'health') ? $obj->health : null,
            property_exists($obj,'state') ? $obj->state : null,
            property_exists($obj,'data') ? $obj->data : []
        );
    }
    
    /**
     * get health
     *
     * @return string
     */
    public function getHealth(){
        return $this->state;
    }
    
    /**
     * get state
     *
     * @return string
     */
    public function getState(){
        return $this->state;
    }
    
    /**
     * get data
     *
     * @return array
     */
    public function getData(){
        return $this->data;
    }
    
}