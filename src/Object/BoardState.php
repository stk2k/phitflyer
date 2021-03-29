<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


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
     * @param array $data
     *
     * @return BoardState
     */
    public static function fromArray(array $data){
        return new self(
            isset($data['health']) ? $data['health'] : null,
            isset($data['state']) ? $data['state'] : null,
            isset($data['data']) ? $data['data'] : []
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