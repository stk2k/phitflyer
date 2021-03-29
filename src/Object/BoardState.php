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
    public function __construct(string $health, string $state, array $data = []){
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
    public static function fromArray(array $data) : BoardState
    {
        return new self(
            $data['health'] ?? null,
            $data['state'] ?? null,
            $data['data'] ?? []
        );
    }
    
    /**
     * get health
     *
     * @return string
     */
    public function getHealth() : string
    {
        return $this->state;
    }
    
    /**
     * get state
     *
     * @return string
     */
    public function getState() : string
    {
        return $this->state;
    }
    
    /**
     * get data
     *
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }
    
}