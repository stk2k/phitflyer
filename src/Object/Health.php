<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class Health
{
    /** @var string  */
    private $status;
    
    /**
     * construct
     *
     * @param string $status
     */
    public function __construct(string $status){
        $this->status = $status;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return Health
     */
    public static function fromArray(array $data) : Health
    {
        return new self(
            $data['status'] ?? null
        );
    }
    
    /**
     * get status
     *
     * @return string
     */
    public function getStatus() : string{
        return $this->status;
    }
    
}